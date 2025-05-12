<?php


require_once __DIR__ . '/../Config/db.php';
require_once __DIR__ . '/../Model/Property.php';

class HomeController {
    public function index() {
        include_once __DIR__ . '/../View/HomePage.php';
    }

    public function properties() {
        global $conn;
        $properties = $this->getAllProperties($conn); // Facade-style method
        include_once __DIR__ . '/../View/Properties.php';
    }

    private function getAllProperties($conn) {
        $propertyModel = Property::create($conn); // Factory Method used here
        return $propertyModel->getAll();
    }
}


?>