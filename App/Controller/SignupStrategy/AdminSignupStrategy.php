<?php
namespace App\Controller\SignupStrategy;

use App\Model\User;
use App\Model\UserRepository;

class AdminSignupStrategy implements SignupStrategyInterface {
    private $userRepository;
    
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    
    public function process(User $user, array $data): array {
        // Admin-specific validation
        if (!isset($data['admin_code']) || empty($data['admin_code'])) {
            return [
                'success' => false,
                'message' => 'Admin code is required'
            ];
        }
        
        // Verify admin code
        if (!$this->userRepository->verifyAdminCode($data['admin_code'])) {
            return [
                'success' => false,
                'message' => 'Invalid admin code'
            ];
        }
        
        try {
            $userId = $this->userRepository->save($user);
            
            if ($userId) {
                return [
                    'success' => true,
                    'message' => 'Admin account created successfully!',
                    'user_id' => $userId
                ];
            }
            
            return [
                'success' => false,
                'message' => 'Failed to create admin account. Please try again.'
            ];
        } catch (\Exception $e) {
            // Check if it's a duplicate email error
            if (strpos($e->getMessage(), "email address is already registered") !== false) {
                return [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
            
            error_log("Error creating admin account: " . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Error creating account: ' . $e->getMessage()
            ];
        }
    }
} 
