
<?php
require_once 'App/Controller/HomeController.php';
require_once 'App/Controller/AdminController.php';

$page = $_GET['page'] ?? 'home';

$controller = new HomeController();

switch ($page) {
    case 'home':
        $controller->index();
        break;

    case 'properties':
        $controller->properties(); // Add this line
        break;

        case 'dashboard':
        $controller->Dashboard(); // Add this line
        break;
        
        

    default:
        echo "404 - Page not found";
}
