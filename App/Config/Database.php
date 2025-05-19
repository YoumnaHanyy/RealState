<?php
namespace App\Config;

class Database {
    private static $instance = null;
    private $conn;
    
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'properties'; // Change to your actual database name
    
    private function __construct() {
        try {
            $this->conn = new \PDO(
                "mysql:host=$this->host;dbname=$this->database",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    // Singleton pattern to ensure only one database connection
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
} 