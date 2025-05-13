<?php

require_once __DIR__ . '/../Config/db.php';
require_once __DIR__ . '/../Model/Property.php';

class HomeController {
    public function index() {
        include_once __DIR__ . '/../View/HomePage.php';
    }

    public function properties() {
        global $conn;
        $filters = [
            'location'   => $_GET['location'] ?? null,
            'min_price'  => $_GET['min_price'] ?? null,
            'max_price'  => $_GET['max_price'] ?? null,
        ];

        $properties = $this->getAllProperties($conn, $filters);
        include_once __DIR__ . '/../View/Properties.php';
    }

    private function getAllProperties($conn, $filters = []) {
        $sql = "SELECT * FROM properties WHERE 1=1";
        $params = [];

        if (!empty($filters['location'])) {
            $sql .= " AND location LIKE :location";
            $params[':location'] = '%' . $filters['location'] . '%';
        }

        if (!empty($filters['min_price'])) {
            $sql .= " AND price >= :min_price";
            $params[':min_price'] = $filters['min_price'];
        }

        if (!empty($filters['max_price'])) {
            $sql .= " AND price <= :max_price";
            $params[':max_price'] = $filters['max_price'];
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
