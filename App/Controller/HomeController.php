<?php
namespace App\Controller;

use App\Config\Database;
use App\Controller\PropertyRepository;

class HomeController {
    private $propertyRepo;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->propertyRepo = new PropertyRepository();
    }

    public function index() {
        include_once __DIR__ . '/../View/HomePage.php';
    }

    public function properties() {
        $conn = Database::getInstance()->getConnection();
        $filters = [
            'location'   => $_GET['location'] ?? null,
            'min_price'  => $_GET['min_price'] ?? null,
            'max_price'  => $_GET['max_price'] ?? null,
        ];

        $properties = $this->propertyRepo->getAll($conn, $filters);
        include_once __DIR__ . '/../View/Properties.php';
<<<<<<< HEAD
=======
        include_once __DIR__ . '/../View/HomePage.php';
>>>>>>> 73b493cc0e02677a94d46ab41826ca8be8dd7e2a
    }
}
