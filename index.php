<?php
require_once 'App/Controller/HomeController.php';

// Simple routing
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    default:
        echo "404 - Page not found";
}
