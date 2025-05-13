<?php

namespace App\Model;

class User {
    private $id;
    private $fullName;
    private $email;
    private $password;
    private $userType;
    private $adminCode;
    private $createdAt;
    
    // Protected constructor - now allows creation within the same class
    protected function __construct() {
        $this->createdAt = date('Y-m-d H:i:s');
    }
    
    // Static factory method to create a User
    public static function create() {
        return new self();
    }
    
    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getFullName() {
        return $this->fullName;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getUserType() {
        return $this->userType;
    }
    
    public function getAdminCode() {
        return $this->adminCode;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    // Setters for UserBuilder
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    public function setFullName($fullName) {
        $this->fullName = $fullName;
        return $this;
    }
    
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    
    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }
    
    public function setUserType($userType) {
        $this->userType = $userType;
        return $this;
    }
    
    public function setAdminCode($adminCode) {
        $this->adminCode = $adminCode;
        return $this;
    }
    
    // Builder class for User
    public static function builder() {
        return new UserBuilder();
    }
}

class UserBuilder {
    private $properties = [];
    
    public function __construct() {
        // Initialize with default values
        $this->properties = [
            'id' => null,
            'fullName' => null,
            'email' => null,
            'password' => null,
            'userType' => null,
            'adminCode' => null
        ];
    }
    
    public function id($id) {
        $this->properties['id'] = $id;
        return $this;
    }
    
    public function fullName($fullName) {
        $this->properties['fullName'] = $fullName;
        return $this;
    }
    
    public function email($email) {
        $this->properties['email'] = $email;
        return $this;
    }
    
    public function password($password) {
        // Store raw password - will be hashed when set in User
        $this->properties['password'] = $password;
        return $this;
    }
    
    public function userType($userType) {
        $this->properties['userType'] = $userType;
        return $this;
    }
    
    public function adminCode($adminCode) {
        $this->properties['adminCode'] = $adminCode;
        return $this;
    }
    
    public function build() {
        // Use the factory method to create a User
        $user = User::create();
        
        // Set all properties using setters
        if (isset($this->properties['id'])) {
            $user->setId($this->properties['id']);
        }
        
        if (isset($this->properties['fullName'])) {
            $user->setFullName($this->properties['fullName']);
        }
        
        if (isset($this->properties['email'])) {
            $user->setEmail($this->properties['email']);
        }
        
        if (isset($this->properties['password'])) {
            $user->setPassword($this->properties['password']);
        }
        
        if (isset($this->properties['userType'])) {
            $user->setUserType($this->properties['userType']);
        }
        
        if (isset($this->properties['adminCode'])) {
            $user->setAdminCode($this->properties['adminCode']);
        }
        
        return $user;
    }
} 