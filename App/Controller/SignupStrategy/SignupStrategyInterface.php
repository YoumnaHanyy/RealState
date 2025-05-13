<?php

namespace App\Controller\SignupStrategy;

use App\Model\User;

interface SignupStrategyInterface {
    /**
     * Process signup for specific user type
     * 
     * @param User $user The user to process
     * @param array $data Additional data for signup
     * @return array Result with success status and message
     */
    public function process(User $user, array $data): array;
} 