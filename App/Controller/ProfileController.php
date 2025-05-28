<?php

namespace App\Controller;

use App\Controller\TourFacade;

class ProfileController
{
    private $tourFacade;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->tourFacade = new TourFacade();
    }

    public function profile()
    {
        $userId   = $_SESSION['user_id'] ?? null;
        $userName = $_SESSION['user_name'] ?? null;

        if (!$userId || !$userName) {
            header("Location: /login.php");
            exit;
        }

        // Build user array for the view
        $user = [
            'id'           => $userId,
            'name'         => $userName,
            'email'        => $_SESSION['user_email'] ?? '',
            'user_type'    => $_SESSION['user_role'] ?? 'User',
            'phone_number' => $_SESSION['user_phone'] ?? '',
            'address'      => $_SESSION['user_address'] ?? '',
            'avatar_url'   => $_SESSION['user_avatar'] ?? '',
        ];

        // Fetch user's scheduled tours
        $scheduledTours = $this->tourFacade->getToursByUser($userName);

        // Pass $user and $scheduledTours to the view
        include __DIR__ . '/../View/Profile.php';
    }
}
