<?php
namespace App\Controller;

use App\Config\Database;
use PDO;
use Exception;

class TourFacade
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function scheduleTour(array $postData, array &$session): void
    {
        $propertyId = $postData['property_id'] ?? null;
        $userName   = $session['user_name'] ?? null;
        $tourDate   = $postData['tour_date'] ?? null;
        $tourTime   = $postData['tour_time'] ?? null;
        $phone      = $postData['phone'] ?? null;
        $notes      = $postData['notes'] ?? '';

        if (!$propertyId || !$userName || !$tourDate || !$tourTime || !$phone) {
            $session['tour_error'] = "All fields are required.";
            throw new Exception("Missing required fields.");
        }

        // Save the tour
        $stmt = $this->conn->prepare(
            "INSERT INTO tours (property_id, user_name, tour_date, tour_time, phone, notes)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$propertyId, $userName, $tourDate, $tourTime, $phone, $notes]);

        // Find agent who created the property
        $agentQuery = $this->conn->prepare("SELECT created_by FROM properties WHERE id = ?");
        $agentQuery->execute([$propertyId]);
        $agent = $agentQuery->fetch(PDO::FETCH_ASSOC);

        if ($agent && !empty($agent['created_by'])) {
            $agentName = $agent['created_by'];
            $message = "$userName has scheduled a tour for Property ID $propertyId on $tourDate at $tourTime.";

            $notifyStmt = $this->conn->prepare(
                "INSERT INTO notifications (recipient_name, message) VALUES (?, ?)"
            );
            $notifyStmt->execute([$agentName, $message]);
        }

        $session['tour_success'] = "Tour scheduled successfully on $tourDate at $tourTime.";
    }
}
