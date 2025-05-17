<?php
namespace App\Controller;

use App\Config\Database;

class ScheduleTourController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
public function index()
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (empty($_SESSION['logged_in']) || !isset($_SESSION['user_name'])) {
        $_SESSION['tour_error'] = "You must be logged in to schedule a tour.";
        if (!empty($_POST['property_id'])) {
            $_SESSION['return_to'] = "/RealState/index.php?page=details&id=" . urlencode($_POST['property_id']);
        }
        header("Location: /RealState/index.php?page=login");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit('Method Not Allowed');
    }

    $propertyId = $_POST['property_id'] ?? null;
    $userName = $_SESSION['user_name'];
    $tourDate = $_POST['tour_date'] ?? null;
    $tourTime = $_POST['tour_time'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $notes = $_POST['notes'] ?? '';

    if (!$propertyId || !$userName || !$tourDate || !$tourTime || !$phone) {
        $_SESSION['tour_error'] = "All fields are required.";
        header("Location: /RealState/index.php?page=details&id=" . urlencode($propertyId));
        exit;
    }

    try {
        $conn = Database::getInstance()->getConnection();

        // Save tour
        $stmt = $conn->prepare("INSERT INTO tours (property_id, user_name, tour_date, tour_time, phone, notes)
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$propertyId, $userName, $tourDate, $tourTime, $phone, $notes]);

        // 📨 Fetch agent who created this property
        $agentQuery = $conn->prepare("SELECT created_by FROM properties WHERE id = ?");
        $agentQuery->execute([$propertyId]);
        $agent = $agentQuery->fetch(\PDO::FETCH_ASSOC);

        if ($agent && !empty($agent['created_by'])) {
            $agentName = $agent['created_by'];

            $message = "$userName has scheduled a tour for Property ID $propertyId on $tourDate at $tourTime.";
            
            // Save notification
            $notifyStmt = $conn->prepare("INSERT INTO notifications (recipient_name, message) VALUES (?, ?)");
            $notifyStmt->execute([$agentName, $message]);
        }

        $_SESSION['tour_success'] = "Tour scheduled successfully on $tourDate at $tourTime.";
        header("Location: /RealState/index.php?page=details&id=" . urlencode($propertyId));
        exit;
    } catch (\Exception $e) {
        $_SESSION['tour_error'] = "Error scheduling tour: " . $e->getMessage();
        header("Location: /RealState/index.php?page=details&id=" . urlencode($propertyId));
        exit;
    }
}


}
