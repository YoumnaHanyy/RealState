<?php
namespace App\Controller;

session_start();

require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Model/AddProperty.php';
require_once __DIR__ . '/../Builder/PropertyBuilder.php';
use App\Builder\PropertyBuilder;
use App\Config\Database;
use App\Model\AddProperty;

// Create DB connection
$conn = Database::getInstance()->getConnection();

// Create model
$propertyModel = new AddProperty($conn);

// Check for POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $developer = htmlspecialchars(trim($_POST['developer']));
    $location = htmlspecialchars(trim($_POST['location']));

    if (empty($name) || $price === false || empty($developer) || empty($location) || empty($_FILES['image']['name'])) {
        $_SESSION['error_message'] = "Please fill in all fields.";
        header("Location: /REALSTATE/View/AddProperty.php");
        exit();
    }

    $target_dir = __DIR__ . "/../../Public/images/";
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $unique_image_name = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $unique_image_name;

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['error_message'] = "File is not an image.";
        header("Location: /REALSTATE/View/AddProperty.php");
        exit();
    }

    if ($_FILES["image"]["size"] > 5000000) {
        $_SESSION['error_message'] = "File too large (max 5MB).";
        header("Location: /REALSTATE/View/AddProperty.php");
        exit();
    }

    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $_SESSION['error_message'] = "Only JPG, JPEG, PNG & GIF allowed.";
        header("Location: /REALSTATE/View/AddProperty.php");
        exit();
    }

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $builder = new PropertyBuilder();
$propertyData = $builder->setName($name)
    ->setPrice($price)
    ->setDeveloper($developer)
    ->setLocation($location)
    ->setImage($unique_image_name)
    ->setCreatedBy($_SESSION['user_name'] ?? 'Unknown')
    ->build();

        if ($propertyModel->createProperty($propertyData)) {
            $_SESSION['success_message'] = "Property added successfully!";
            header("Location: /REALSTATE/index.php?page=properties");
            exit();
        } else {
            $_SESSION['error_message'] = "Database insertion failed.";
            header("Location: /REALSTATE/View/AddProperty.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Upload failed.";
        header("Location: /REALSTATE/View/AddProperty.php");
        exit();
    }
} else {
    header("Location: /REALSTATE/View/AddProperty.php");
    exit();
}