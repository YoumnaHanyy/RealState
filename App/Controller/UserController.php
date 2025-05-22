<?php

namespace App\Controller;

// Use statements for classes this controller needs
use App\Model\User;
use App\Model\Property; // Assuming Property model is used for hydrating results
use App\Model\UserRepository; // Directly use UserRepository
use App\Controller\PropertyRepository; // Directly use PropertyRepository

// Remove 'use App\Controller\UserProfileFacade;' as it's no longer needed

class UserController
{
    private UserRepository $userRepository;
    private PropertyRepository $propertyRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->propertyRepository = new PropertyRepository();
    }

    /**
     * Displays the user's profile.
     * Fetches all necessary data directly from repositories.
     */
    public function profile()
    {

        // Get the user ID. Default to 1 for testing if not in session.
        $userId = $_SESSION['user_id'] ?? 1;
        // Fetch user data
       $user = $this->userRepository->getUserById($userId); 
        // Check if user data was found
        if (!$user) {
            echo "<h1>Error: User profile not found for ID: " . htmlspecialchars($userId) . "</h1>";
            return; // Stop execution if user not found
        }

        // Fetch user-specific properties

        // Pass data to the view
        // Note: The variable names $user, $savedProperties, etc., must match what's used in Profile.php
        // These variables will be available within Profile.php due to the 'include'
        // $user // already available from $user object
        // $savedProperties // already available
        // $userProperties // already available
        // $requestedProperties // already available

        // Include the profile view. Adjust path if necessary.
        include __DIR__ . '/../View/Profile.php';
    }

    // You can add other methods here that belong to a UserController.
}