<?php

namespace App\Controller;

use App\Model\User;
use App\Model\UserRepository;
use App\Controller\SignupStrategy\SignupStrategyFactory;

class SignupController {
    private $userRepository;
    private $strategyFactory;
    private const ADMIN_CODE = 'ADMIN123'; // Match the code in UserRepository::verifyAdminCode
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->userRepository = new UserRepository();
        $this->strategyFactory = new SignupStrategyFactory($this->userRepository);
    }

    public function index() {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        require_once __DIR__ . '/../View/Signup.php';
    }

    public function signup() {
        try {
            // Enable detailed error reporting
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Log the request
            error_log("SignupController::signup() called - " . date('Y-m-d H:i:s'));
            file_put_contents('signup_debug.log', "SignupController::signup() called - " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
            file_put_contents('signup_debug.log', "POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);
            
            // Validate CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                file_put_contents('signup_debug.log', "CSRF token mismatch\n", FILE_APPEND);
                throw new \Exception("Security violation: CSRF token mismatch");
            }

            // Validate required fields
            $required = ['fullName', 'email', 'password', 'userType'];
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    file_put_contents('signup_debug.log', "Missing required field: $field\n", FILE_APPEND);
                    throw new \Exception("Please fill in all required fields");
                }
            }

            // Admin-specific validation
            if ($_POST['userType'] === 'admin' && empty($_POST['admin_code'])) {
                file_put_contents('signup_debug.log', "Admin code required but missing\n", FILE_APPEND);
                throw new \Exception("Admin code is required");
            }

            try {
                // Get the appropriate strategy
                file_put_contents('signup_debug.log', "Getting strategy for user type: " . $_POST['userType'] . "\n", FILE_APPEND);
                $strategy = $this->strategyFactory->getStrategy($_POST['userType']);
                
                // Build user object
                file_put_contents('signup_debug.log', "Building user object\n", FILE_APPEND);
                $user = User::builder()
                    ->fullName($_POST['fullName'])
                    ->email($_POST['email'])
                    ->password($_POST['password'])
                    ->userType($_POST['userType'])
                    ->adminCode($_POST['admin_code'] ?? null)
                    ->build();
    
                file_put_contents('signup_debug.log', "User object built successfully\n", FILE_APPEND);
                
                // Process signup with strategy
                $data = $_POST; // Pass all form data to strategy
                file_put_contents('signup_debug.log', "Processing signup with strategy\n", FILE_APPEND);
                $result = $strategy->process($user, $data);
                file_put_contents('signup_debug.log', "Strategy result: " . print_r($result, true) . "\n", FILE_APPEND);
                
                if ($result['success']) {
                    // Store user data in session
                    $_SESSION['user_id'] = $result['user_id'] ?? null;
                    $_SESSION['user_role'] = $user->getUserType();
                    $_SESSION['logged_in'] = true;
                    
                    // Show success message and redirect to homepage
                    $_SESSION['home_message'] = "Your account was created successfully! Welcome to HOUSOFT.";
                    file_put_contents('signup_debug.log', "Signup successful, redirecting to homepage\n", FILE_APPEND);
                    header("Location: /RealState/index.php?page=home");
                    exit();
                } else {
                    file_put_contents('signup_debug.log', "Signup unsuccessful: " . ($result['message'] ?? 'Unknown error') . "\n", FILE_APPEND);
                    throw new \Exception($result['message'] ?? 'Failed to create account');
                }
            } catch (\Exception $e) {
                file_put_contents('signup_debug.log', "Exception during signup process: " . $e->getMessage() . "\n", FILE_APPEND);
                file_put_contents('signup_debug.log', "Exception trace: " . $e->getTraceAsString() . "\n", FILE_APPEND);
                throw $e;
            }
        } catch (\Exception $e) {
            file_put_contents('signup_debug.log', "Signup error: " . $e->getMessage() . "\n", FILE_APPEND);
            $_SESSION['signup_error'] = $e->getMessage();
            header("Location: /RealState/index.php?page=signup");
            exit();
        }
    }

    public function success() {
        if (empty($_SESSION['signup_success'])) {
            header("Location: /index.php?page=signup");
            exit();
        }
        
        $message = $_SESSION['signup_success'];
        unset($_SESSION['signup_success']);
        
        // Display a proper success page
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Signup Success - HOUSOFT</title>
            <link rel='stylesheet' href='/REALSTATE/Public/css/styles.css'>
        </head>
        <body>
            <div class='container'>
                <div class='success-message'>
                    <h1>Account Created Successfully!</h1>
                    <p>$message</p>
                    <p>You can now <a href='/index.php?page=login'>log in</a> to your account.</p>
                </div>
            </div>
        </body>
        </html>";
    }
}