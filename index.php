<?php
require_once 'App/Controller/HomeController.php';
require_once 'App/Controller/SignupController.php';

// Simple routing
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
         case 'signup':  
        $controller = new SignupController();
        $controller->index(); 
        break;
    default:
        echo "404 - Page not found";
        break;

    
  

}
