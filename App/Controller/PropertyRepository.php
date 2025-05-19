<?php
namespace App\Controller;

class PropertyRepository {
    public function getAll($conn, $filters = []) {
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
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
