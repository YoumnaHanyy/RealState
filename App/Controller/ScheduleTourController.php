<?php
namespace App\Controller;

use App\Controller\TourFacade;
use Exception;

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

        try {
            $facade = new TourFacade();
            $facade->scheduleTour($_POST, $_SESSION);                                        //hena el facade etnadah
        } catch (Exception $e) {
            $_SESSION['tour_error'] = "Error scheduling tour: " . $e->getMessage();
        }

        // Always redirect back to the property details page
        $propertyId = $_POST['property_id'] ?? '';
        header("Location: /RealState/index.php?page=details&id=" . urlencode($propertyId));
        exit;
    }
}