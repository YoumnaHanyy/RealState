<?php

namespace App\Controller;

class HomeController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function index() {
        include_once __DIR__ . '/../View/HomePage.php';
    }
}