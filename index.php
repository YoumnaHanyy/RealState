<?php
require_once 'App/Controller/HomeController.php';

$page = $_GET['page'] ?? 'home';

$controller = new HomeController();

switch ($page) {
    case 'home':
        $controller->index();
        break;

    case 'properties':
        $controller->properties(); // Add this line
        break;


        
    default:
        echo "404 - Page not found";
}
