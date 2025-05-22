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
        // Add debug logging at the beginning of the index method
        file_put_contents('tour_debug.log', "ScheduleTourController::index() called - " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
        file_put_contents('tour_debug.log', "Request Method: " . $_SERVER['REQUEST_METHOD'] . "\n", FILE_APPEND);
        file_put_contents('tour_debug.log', "Session (before checks): " . print_r($_SESSION, true) . "\n", FILE_APPEND);
        file_put_contents('tour_debug.log', "POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);


        if (session_status() === PHP_SESSION_NONE) session_start();

        if (empty($_SESSION['logged_in']) || !isset($_SESSION['user_name'])) {
            $_SESSION['tour_error'] = "You must be logged in to schedule a tour.";
            if (!empty($_POST['property_id'])) {
                $_SESSION['return_to'] = "/RealState/index.php?page=details&id=" . urlencode($_POST['property_id']);
            }
            // Log redirection for not logged in users
            file_put_contents('tour_debug.log', "User not logged in. Redirecting to login page.\n", FILE_APPEND);
            header("Location: /RealState/index.php?page=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Log invalid request method
            file_put_contents('tour_debug.log', "Invalid request method (" . $_SERVER['REQUEST_METHOD'] . "). Exiting.\n", FILE_APPEND);
            http_response_code(405);
            exit('Method Not Allowed');
        }

        try {
            // Log attempt to schedule tour
            file_put_contents('tour_debug.log', "Attempting to schedule tour...\n", FILE_APPEND);
            $facade = new TourFacade();
            $facade->scheduleTour($_POST, $_SESSION); //hena el facade etnadah
            // Log successful tour scheduling
            file_put_contents('tour_debug.log', "Tour scheduled successfully!\n", FILE_APPEND);

        } catch (Exception $e) {
            $_SESSION['tour_error'] = "Error scheduling tour: " . $e->getMessage();
            // Log the error message
            file_put_contents('tour_debug.log', "Error scheduling tour: " . $e->getMessage() . "\n", FILE_APPEND);
        }

        // Always redirect back to the property details page
        $propertyId = $_POST['property_id'] ?? 'N/A'; // Use N/A if property_id is not set
        // Log the redirection
        file_put_contents('tour_debug.log', "Redirecting back to property details page (ID: " . $propertyId . ").\n", FILE_APPEND);
        header("Location: /RealState/index.php?page=details&id=" . urlencode($propertyId));
        exit;
    }
}