<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Require config and autoloader
require_once __DIR__ . '/App/Config/Autoloader.php';
require_once __DIR__ . '/App/Config/Database.php';
\App\Config\Autoloader::register();

// Require models
require_once __DIR__ . '/App/Model/User.php';
require_once __DIR__ . '/App/Model/UserRepository.php';
require_once __DIR__ . '/App/Model/AuthModel.php';

// Require controllers
require_once __DIR__ . '/App/Controller/HomeController.php';
require_once __DIR__ . '/App/Controller/SignupController.php';
require_once __DIR__ . '/App/Controller/LoginController.php';


// Require signup strategy classes
require_once __DIR__ . '/App/Controller/SignupStrategy/SignupStrategyInterface.php';
require_once __DIR__ . '/App/Controller/SignupStrategy/SignupStrategyFactory.php';
require_once __DIR__ . '/App/Controller/SignupStrategy/BuyerSignupStrategy.php';
require_once __DIR__ . '/App/Controller/SignupStrategy/AgentSignupStrategy.php';
require_once __DIR__ . '/App/Controller/SignupStrategy/AdminSignupStrategy.php';

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Use controller namespaces
use App\Controller\HomeController;
use App\Controller\SignupController;
use App\Controller\LoginController;
use App\Controller\ScheduleTourController;
use App\Controller\AgentMessagesController;


// Routing logic
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';

switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'properties':
        $controller = new HomeController();
        $controller->properties();
        break;

    case 'signup':
        try {
            $controller = new SignupController();
            if ($action === 'signup') {
                $controller->signup();
            } else {
                $controller->index();
            }
        } catch (Exception $e) {
            echo "Error creating SignupController: " . $e->getMessage() . "<br>";
            echo "Stack trace: <pre>" . $e->getTraceAsString() . "</pre>";
        }
        break;

    case 'login':
        $controller = new LoginController();
        if ($action === 'authenticate') {
            $controller->authenticate();
        } elseif ($action === 'logout') {
            $controller->logout();
        } else {
            $controller->index();
        }
        break;


    case 'details':
    include 'App/View/Details.php';
    break;
        
    case 'scheduleTour':
    $controller = new ScheduleTourController();
    $controller->index();
    break;

    case 'agentMessages':
    $controller = new AgentMessagesController();
    $controller->index();
    break;

    default:
        echo "404 - Page not found";
} 