<?php
namespace App\Controller;

use App\Config\Database;

class AgentMessagesController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public function index()
    {
        // Only agents can access
        if ($_SESSION['user_role'] !== 'agent') {
            echo "Access Denied";
            exit;
        }

        $agentName = $_SESSION['user_name'];
        $conn = Database::getInstance()->getConnection();

        $stmt = $conn->prepare("SELECT * FROM notifications WHERE recipient_name = ? ORDER BY created_at DESC");
        $stmt->execute([$agentName]);

        $notifications = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Pass data to view
        include __DIR__ . '/../View/AgentMessages.php';
    }
}
