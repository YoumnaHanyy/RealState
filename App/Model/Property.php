

<?php
class Property {
    //Factory design pattern
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public static function create($conn) {
        return new self($conn); // Factory method
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM properties");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
