<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'App/Config/Autoloader.php';
require_once 'App/Config/Database.php';
App\Config\Autoloader::register();

// Direct inclusion of model files
require_once 'App/Model/User.php';
require_once 'App/Model/UserRepository.php';
require_once 'App/Model/AuthModel.php';

// Direct inclusion of controller files
require_once 'App/Controller/HomeController.php';
require_once 'App/Controller/SignupController.php';
require_once 'App/Controller/LoginController.php';

// Direct inclusion of strategy files
require_once 'App/Controller/SignupStrategy/SignupStrategyInterface.php';
require_once 'App/Controller/SignupStrategy/SignupStrategyFactory.php';
require_once 'App/Controller/SignupStrategy/BuyerSignupStrategy.php';
require_once 'App/Controller/SignupStrategy/AgentSignupStrategy.php';
require_once 'App/Controller/SignupStrategy/AdminSignupStrategy.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Controller\HomeController;
use App\Controller\SignupController;
use App\Controller\LoginController;

// Simple routing
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';

switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
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
        } else if ($action === 'logout') {
            $controller->logout();
        } else {
            $controller->index();
        }
        break;
        
    default:
        echo "404 - Page not found";
        break;
}
