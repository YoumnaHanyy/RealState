<?php

namespace App\Controller;

class ProfileController
{
    public function __construct()
    {
        // No facade used in this version
    }

    public function profile()
    {
      

        // Get session data
        $userId    = $_SESSION['user_id'] ?? null;
        $userName  = $_SESSION['user_name'] ?? 'Guest';
        $userEmail = $_SESSION['user_email'] ?? 'Not available';
        $userType  = $_SESSION['user_role'] ?? 'User';

        if (!$userId) {
            echo "<h1>Error: User not logged in.</h1>";
            return;
        }

        // Build the $user array for the view
        $user = [
            'id'         => $userId,
            'name'       => $userName,
            'email'      => $userEmail,
            'user_type'  => $userType,
            'phone_number' => $_SESSION['user_phone'] ?? '',
            'address'      => $_SESSION['user_address'] ?? '',
            'avatar_url'   => $_SESSION['user_avatar'] ?? '',
        ];

        // These could be empty or fetched later if needed
        $savedProperties = [];
        $userProperties = [];
        $requestedProperties = [];

    
        // Load the profile view
        include __DIR__ . '/../View/Profile.php';
    }
}
