<?php
namespace App\Model;
// Include the database connection file (assuming it returns a PDO connection)
// require_once __DIR__ . '/../Config/db.php'; // Included in the Controller, but can be here if the Model is used independently

class AddProperty {
    private $conn;

    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }

    /**
     * Creates a new property in the database.
     *
     * @param array $data An associative array containing property data (name, price, developer, location, image).
     * @return bool True on success, false on failure.
     */
    public function createProperty(array $data): bool {
       $sql = "INSERT INTO properties (name, price, developer, location, image, created_by)
        VALUES (:name, :price, :developer, :location, :image, :created_by)";


        try {
            $stmt = $this->conn->prepare($sql);

            // Bind parameters to the prepared statement
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':developer', $data['developer']);
            $stmt->bindParam(':location', $data['location']);
            $stmt->bindParam(':image', $data['image']);
$stmt->bindParam(':created_by', $data['created_by']);

            // Execute the statement
            return $stmt->execute();

        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            // echo "Error: " . $e->getMessage(); // For debugging, avoid showing in production
            return false; // Indicate failure
        }
    }

    // You would add other methods here for fetching properties, updating, deleting, etc.
}

// Assuming db.php returns the $conn variable
// If you included db.php directly here, initialize $conn:
// $conn = require __DIR__ . '/../Config/db.php'; // Example if db.php returns connection

?>