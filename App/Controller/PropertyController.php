<?php
session_start(); // Start the session to use session messages

// Include necessary files
require_once __DIR__ . '/../Config/db.php'; // Assuming db.php is in Config
require_once __DIR__ . '/../Model/AddProperty.php'; // Assuming Property.php is in Model

// Create a database connection (assuming db.php returns a PDO connection)
// $conn = require_once __DIR__ . '/../Config/db.php'; // If db.php returns the connection directly

// Create a Property Model instance
$propertyModel = new Property($conn); // Pass the database connection to the Model

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Retrieve and Sanitize Input Data
    // Using htmlspecialchars to prevent XSS when displaying data later (though we're not displaying it directly here)
    // Basic sanitization; more robust validation is recommended.
    $name = htmlspecialchars(trim($_POST['name']));
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT); // Validate price as float
    $developer = htmlspecialchars(trim($_POST['developer']));
    $location = htmlspecialchars(trim($_POST['location']));

    // Basic validation
    if (empty($name) || $price === false || empty($developer) || empty($location) || empty($_FILES['image']['name'])) {
        $_SESSION['error_message'] = "Please fill in all fields.";
        header("Location: /REALSTATE/View/AddProperty.php"); // Redirect back to the form
        exit();
    }

    // 2. Handle File Upload
    $target_dir = __DIR__ . "/../../Public/images/"; // Directory to save uploaded images (relative to this controller file)
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Generate a unique filename to avoid overwriting
    $unique_image_name = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $unique_image_name;

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        // File is an image
        $uploadOk = 1;
    } else {
        $_SESSION['error_message'] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists (less likely with unique filename)
    // if (file_exists($target_file)) {
    //     $_SESSION['error_message'] = "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size (e.g., max 5MB)
    if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
        $_SESSION['error_message'] = "Sorry, your file is too large (max 5MB).";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $_SESSION['error_message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // An error occurred, redirect back with error message
        header("Location: /REALSTATE/View/AddProperty.php");
        exit();
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // File uploaded successfully, proceed to save to database

            // Prepare data for the Model
            $propertyData = [
                'name' => $name,
                'price' => $price,
                'developer' => $developer,
                'location' => $location,
                'image' => $unique_image_name // Store the unique filename
            ];

            // 3. Call the Model to Insert Data
            if ($propertyModel->createProperty($propertyData)) {
                // Success
                $_SESSION['success_message'] = "Property added successfully!";
                // Redirect to the properties list page or a success page
                header("Location: /REALSTATE/View/Properties.php"); // Assuming you have a Properties list page
                exit();
            } else {
                // Database insertion failed
                $_SESSION['error_message'] = "Error adding property to database.";
                // You might want to delete the uploaded file in case of a DB error
                // unlink($target_file);
                header("Location: /REALSTATE/View/AddProperty.php"); // Redirect back to the form
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Sorry, there was an error uploading your file.";
            header("Location: /REALSTATE/View/AddProperty.php"); // Redirect back to the form
            exit();
        }
    }
} else {
    // If accessed directly without POST, redirect to the form
    header("Location: /REALSTATE/View/AddProperty.php");
    exit();
}
?>