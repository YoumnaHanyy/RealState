<?php

namespace App\Controller\SignupStrategy;

use App\Model\UserRepository;

class SignupStrategyFactory {
    private $userRepository;
    
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    
    /**
     * Get the appropriate signup strategy based on user type
     * 
     * @param string $userType The type of user (buyer, agent, admin)
     * @return SignupStrategyInterface The appropriate strategy
     * @throws \InvalidArgumentException If an invalid user type is provided
     */
    public function getStrategy(string $userType): SignupStrategyInterface {
        switch (strtolower($userType)) {
            case 'buyer':
                return new BuyerSignupStrategy($this->userRepository);
                
            case 'agent':
                return new AgentSignupStrategy($this->userRepository);
                
            case 'admin':
                return new AdminSignupStrategy($this->userRepository);
                
            default:
                throw new \InvalidArgumentException("Invalid user type: {$userType}");
        }
    }
} 