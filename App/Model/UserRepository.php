<?php

namespace App\Model;

use App\Config\Database;

class UserRepository {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        file_put_contents('signup_debug.log', "UserRepository: Constructed with database connection\n", FILE_APPEND);
    }
    
    /**
     * Save a user to the database
     * 
     * @param User $user The user to save
     * @return bool|int False if failed, or the new user ID if successful
     */
    public function save(User $user) {
        try {
            // Debug: log the SQL about to be executed
            file_put_contents('signup_debug.log', "UserRepository: Preparing to insert user into database\n", FILE_APPEND);
            
            // Debug: check database connection
            if (!$this->db) {
                file_put_contents('signup_debug.log', "UserRepository: Database connection is null\n", FILE_APPEND);
                return false;
            }
            
            $query = "
                INSERT INTO users (full_name, email, password, user_type, admin_code, created_at) 
                VALUES (:fullName, :email, :password, :userType, :adminCode, :createdAt)
            ";
            file_put_contents('signup_debug.log', "UserRepository: SQL Query: " . $query . "\n", FILE_APPEND);
            
            $stmt = $this->db->prepare($query);
            
            // Debug values to be inserted
            file_put_contents('signup_debug.log', "UserRepository: Binding values: " . 
                "fullName=" . $user->getFullName() . ", " .
                "email=" . $user->getEmail() . ", " . 
                "userType=" . $user->getUserType() . ", " .
                "createdAt=" . $user->getCreatedAt() . "\n", FILE_APPEND
            );
            
            $stmt->bindValue(':fullName', $user->getFullName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':userType', $user->getUserType());
            $stmt->bindValue(':adminCode', $user->getAdminCode());
            $stmt->bindValue(':createdAt', $user->getCreatedAt());
            
            file_put_contents('signup_debug.log', "UserRepository: Executing statement\n", FILE_APPEND);
            $result = $stmt->execute();
            
            if (!$result) {
                file_put_contents('signup_debug.log', "UserRepository: Execute failed: " . implode(", ", $stmt->errorInfo()) . "\n", FILE_APPEND);
                return false;
            }
            
            $lastId = $this->db->lastInsertId();
            file_put_contents('signup_debug.log', "UserRepository: Insert successful, new ID: " . $lastId . "\n", FILE_APPEND);
            return $lastId;
        } catch (\PDOException $e) {
            // Check for duplicate email error (MySQL error code 1062 for duplicate entry)
            if ($e->getCode() == 23000 && strpos($e->getMessage(), "Duplicate entry") !== false && 
                strpos($e->getMessage(), "for key 'email'") !== false) {
                file_put_contents('signup_debug.log', "UserRepository: Duplicate email detected: " . $user->getEmail() . "\n", FILE_APPEND);
                throw new \Exception("This email address is already registered. Please use a different email address.");
            }
            
            // Log detailed error
            file_put_contents('signup_debug.log', "UserRepository: Database error in save(): " . $e->getMessage() . "\n", FILE_APPEND);
            file_put_contents('signup_debug.log', "UserRepository: Error code: " . $e->getCode() . "\n", FILE_APPEND);
            file_put_contents('signup_debug.log', "UserRepository: SQL state: " . ($e->errorInfo[0] ?? 'unknown') . "\n", FILE_APPEND);
            file_put_contents('signup_debug.log', "UserRepository: Error trace: " . $e->getTraceAsString() . "\n", FILE_APPEND);
            throw $e;
        } catch (\Exception $e) {
            // Log any other exceptions
            file_put_contents('signup_debug.log', "UserRepository: General exception in save(): " . $e->getMessage() . "\n", FILE_APPEND);
            file_put_contents('signup_debug.log', "UserRepository: Error trace: " . $e->getTraceAsString() . "\n", FILE_APPEND);
            throw $e;
        }
    }
    
    /**
     * Get user by email
     * 
     * @param string $email The email to find
     * @return User|null The user if found, null otherwise
     */
    public function getUserByEmail($email) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            
            $userData = $stmt->fetch();
            if (!$userData) {
                return null;
            }
            
            return User::builder()
                ->id($userData['id'])
                ->fullName($userData['full_name'])
                ->email($userData['email'])
                ->userType($userData['user_type'])
                ->adminCode($userData['admin_code'])
                ->build();
        } catch (\PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Verify admin code
     * 
     * @param string $adminCode The admin code to verify
     * @return bool True if valid, false otherwise
     */
    public function verifyAdminCode($adminCode) {
        // In a real application, you might have this in a settings table
        // For simplicity, we're hardcoding it here
        $validAdminCode = "ADMIN123"; // Replace with your actual code or mechanism
        
        return $adminCode === $validAdminCode;
    }
} 