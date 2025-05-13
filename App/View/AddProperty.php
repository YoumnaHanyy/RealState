<?php
// Start a session to access session variables for messages
session_start();

// Assuming your database connection is in App/Config/db.php
// You might not need the DB connection directly in the view, but
// if you're including a header that needs it, keep this or move it.
// require_once __DIR__ . '/../App/Config/db.php';

// Check for success or error messages from the controller
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';

// Clear the messages from the session after displaying them
unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Property</title>
    <link rel="stylesheet" href="/REALSTATE/Public/css/HomePagee.css">
    <link rel="stylesheet" href="/REALSTATE/Public/css/AddProperty.css"> </head>
<body>

    <?php
        // Include your header/navbar if it's a separate file
        // For demonstration, let's assume the header is part of this file or included elsewhere
        // If you have a header component, include it here:
        // include __DIR__ . '/partials/header.php'; // Example include path
    ?>

    <div class="container">
        <h2>Add New Property</h2>

        <?php if ($success_message): ?>
            <div class="message success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="message error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form action="/RealState/App/Controller/PropertyController.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Property Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="name">Property Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="developer">Developer:</label>
                <input type="text" id="developer" name="developer" required>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div class="form-group">
    <label for="details">Details:</label><br>
    <textarea id="details" name="details" rows="4" cols="50"></textarea>
</div>


            <div class="form-group">
                <button type="submit">Add Property</button>
            </div>
        </form>
    </div>

    <?php
        // Include your footer if it's a separate file
        // include __DIR__ . '/partials/footer.php'; // Example include path
    ?>

</body>
</html>