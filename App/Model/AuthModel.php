<?php

namespace App\Model;

use App\Config\Database;

class AuthModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Verify user credentials against the database
     * 
     * @param string $email The user's email
     * @param string $password The user's password
     * @return array|null Returns user data on success, null on failure
     */
    public function verifyLogin(string $email, string $password): ?array {
        try {
            file_put_contents('login_debug.log', "AuthModel::verifyLogin called for email: $email\n", FILE_APPEND);
            
            // Find user by email
            $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            
            $user = $stmt->fetch();
            
            // If no user found
            if (!$user) {
                file_put_contents('login_debug.log', "No user found with email: $email\n", FILE_APPEND);
                return null;
            }
            
            file_put_contents('login_debug.log', "User found, verifying password\n", FILE_APPEND);
            
            // Verify password
            if (!password_verify($password, $user['password'])) {
                file_put_contents('login_debug.log', "Password verification failed\n", FILE_APPEND);
                return null;
            }
            
            file_put_contents('login_debug.log', "Password verified successfully\n", FILE_APPEND);
            
            // Return user data without password
            unset($user['password']);
            return $user;
            
        } catch (\PDOException $e) {
            file_put_contents('login_debug.log', "Database error in verifyLogin: " . $e->getMessage() . "\n", FILE_APPEND);
            return null;
        }
    }
    
    /**
     * Get user by ID
     * 
     * @param int $userId The user's ID
     * @return array|null Returns user data on success, null on failure
     */
    public function getUserById(int $userId): ?array {
        try {
            $query = "SELECT id, full_name, email, user_type, created_at FROM users WHERE id = :id LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $userId);
            $stmt->execute();
            
            return $stmt->fetch() ?: null;
            
        } catch (\PDOException $e) {
            error_log("Get user error: " . $e->getMessage());
            return null;
        }
    }
} 