<?php
namespace App\Controller;

use App\Model\AuthModel;

class LoginController {
    private $authModel;
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->authModel = new AuthModel();
    }
    
    /**
     * Display the login form
     */
    public function index() {
        // Generate CSRF token for form security
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        
        require_once __DIR__ . '/../View/Login.php';
    }
    
    /**
     * Handle login form submission
     */
    public function authenticate() {
        try {
            // Add debug logging
            file_put_contents('login_debug.log', "LoginController::authenticate() called - " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
            file_put_contents('login_debug.log', "POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);
            
            // Validate CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                file_put_contents('login_debug.log', "CSRF token mismatch\n", FILE_APPEND);
                throw new \Exception("Security violation: CSRF token mismatch");
            }
            
            // Validate required fields
            if (empty($_POST['email']) || empty($_POST['password'])) {
                file_put_contents('login_debug.log', "Missing email or password\n", FILE_APPEND);
                throw new \Exception("Please enter both email and password");
            }
            
            // Attempt to authenticate
            file_put_contents('login_debug.log', "Attempting to verify login for email: " . $_POST['email'] . "\n", FILE_APPEND);
            $user = $this->authModel->verifyLogin($_POST['email'], $_POST['password']);
            
            if (!$user) {
                file_put_contents('login_debug.log', "Authentication failed\n", FILE_APPEND);
                throw new \Exception("Incorrect email or password");
            }
            
            file_put_contents('login_debug.log', "Authentication successful for user: " . $user['full_name'] . " (ID: " . $user['id'] . ")\n", FILE_APPEND);
            
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_role'] = $user['user_type'];
            $_SESSION['logged_in'] = true;
            
            // Set a welcome message
            $_SESSION['home_message'] = "Welcome back, " . $user['full_name'] . "!";
            
            file_put_contents('login_debug.log', "Session variables set. Redirecting to homepage.\n", FILE_APPEND);
            
            // Redirect all users to the homepage
            header("Location: /RealState/index.php?page=home");
            exit();
            
        } catch (\Exception $e) {
            file_put_contents('login_debug.log', "Login error: " . $e->getMessage() . "\n", FILE_APPEND);
            $_SESSION['login_error'] = $e->getMessage();
            header("Location: /RealState/index.php?page=login");
            exit();
        }
    }
    
    /**
     * Log out the user
     */
    public function logout() {
        // Unset all session variables
        $_SESSION = [];
        
        // Destroy the session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        
        session_destroy();
        
        // Redirect to home page
        header("Location: /RealState/index.php?page=home");
        exit();
    }
} 