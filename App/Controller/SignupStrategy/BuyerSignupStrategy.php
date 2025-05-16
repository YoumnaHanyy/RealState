<?php
namespace App\Controller\SignupStrategy;

use App\Model\User;
use App\Model\UserRepository;

class BuyerSignupStrategy implements SignupStrategyInterface {
    private $userRepository;
    
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    
    public function process(User $user, array $data): array {
        // Buyer-specific validation or processing can go here
        // For now, just save the user
        
        try {
            // Debug user data
            file_put_contents('signup_debug.log', "BuyerSignupStrategy: Attempting to save buyer: " . $user->getEmail() . "\n", FILE_APPEND);
            file_put_contents('signup_debug.log', "BuyerSignupStrategy: User data: " . 
                "Name: " . $user->getFullName() . ", " .
                "Email: " . $user->getEmail() . ", " .
                "Type: " . $user->getUserType() . ", " .
                "Created: " . $user->getCreatedAt() . "\n", FILE_APPEND
            );
            
            $userId = $this->userRepository->save($user);
            
            if ($userId) {
                file_put_contents('signup_debug.log', "BuyerSignupStrategy: User saved successfully with ID: " . $userId . "\n", FILE_APPEND);
                return [
                    'success' => true,
                    'message' => 'Buyer account created successfully!',
                    'user_id' => $userId
                ];
            }
            
            // Log error if save returns false
            file_put_contents('signup_debug.log', "BuyerSignupStrategy: Failed to save buyer - no error thrown but save returned false\n", FILE_APPEND);
            
            return [
                'success' => false,
                'message' => 'Failed to create buyer account. Please try again.'
            ];
            
        } catch (\Exception $e) {
            // Check if it's a duplicate email error
            if (strpos($e->getMessage(), "email address is already registered") !== false) {
                file_put_contents('signup_debug.log', "BuyerSignupStrategy: Duplicate email: " . $e->getMessage() . "\n", FILE_APPEND);
                return [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
            
            // Log the detailed error
            file_put_contents('signup_debug.log', "BuyerSignupStrategy: Error creating buyer account: " . $e->getMessage() . "\n", FILE_APPEND);
            file_put_contents('signup_debug.log', "BuyerSignupStrategy: Error trace: " . $e->getTraceAsString() . "\n", FILE_APPEND);
            
            return [
                'success' => false,
                'message' => 'Error creating account: ' . $e->getMessage()
            ];
        }
    }
} 