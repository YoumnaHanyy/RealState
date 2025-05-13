<?php

namespace App\Controller\SignupStrategy;

use App\Model\User;
use App\Model\UserRepository;

class AgentSignupStrategy implements SignupStrategyInterface {
    private $userRepository;
    
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    
    public function process(User $user, array $data): array {
        // Agent-specific validation or processing
        // For example, agents might need verification later
        
        try {
            $userId = $this->userRepository->save($user);
            
            if ($userId) {
                // You could add code here to send an agent verification email
                // or set up agent-specific settings
                
                return [
                    'success' => true,
                    'message' => 'Agent account created successfully! Your account will be reviewed by our team.',
                    'user_id' => $userId
                ];
            }
            
            return [
                'success' => false,
                'message' => 'Failed to create agent account. Please try again.'
            ];
        } catch (\Exception $e) {
            // Check if it's a duplicate email error
            if (strpos($e->getMessage(), "email address is already registered") !== false) {
                return [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
            
            error_log("Error creating agent account: " . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Error creating account: ' . $e->getMessage()
            ];
        }
    }
} 