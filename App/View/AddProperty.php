<?php
// Start a session to access session variables for messages
session_start();

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
    <title>Add Property - HOUSOFT</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="/REALSTATE/Public/css/HomePagee.css">
    <link rel="stylesheet" href="/REALSTATE/Public/css/AddPropertyy.css">
</head>
<body>

   <header class="navbar">
    <a href="http://localhost/REALSTATE/index.php?page=home" class="logo">HOUSOFT</a>
    <nav>
      
      <a href="/REALSTATE/index.php?page=properties"><i class="fas fa-building"></i> Properties</a>
      <a href="#"><i class="fas fa-concierge-bell"></i> Services</a>
    <?php if (isset($_SESSION['user_name'])): ?>
  <a href="/REALSTATE/index.php?page=profile"><i class="fa-solid fa-user"></i> Profile →</a>
<?php endif; ?>
      <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'agent'): ?>
        <a href="/REALSTATE/index.php?page=agentMessages"><i class="fas fa-envelope"></i> Messages</a>
      <?php endif; ?>
      <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'agent'): ?>
        <a href="/REALSTATE/App/View/AddProperty.php"><i class="fas fa-plus-circle"></i> Add Property</a> 
      <?php endif; ?>
      <?php if (isset($_SESSION['user_name'])): ?>
        <span><i class="fas fa-user-circle"></i> Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
        <a href="index.php?page=login&action=logout" class="sign-up-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
      <?php else: ?>
        <a href="index.php?page=signup" class="sign-up-btn"><i class="fas fa-user-plus"></i> Sign Up</a>
      <?php endif; ?>
    </nav>
    <button class="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </header>

    <!-- Main Form Container -->
    <div class="property-form-container">
        <h1 class="form-title">Add New Property</h1>

        <?php if ($success_message): ?>
            <div class="message success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="message error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form action="/RealState/App/Controller/PropertyController.php" method="POST" enctype="multipart/form-data">
            <!-- Image Upload -->
            <div class="form-group">
                <label for="image">Property Image:</label>
                <div class="file-upload-container" id="file-upload-container">
                    <span class="file-upload-label"><i class="fas fa-cloud-upload-alt"></i> Drag & Drop or</span>
                    <input type="file" id="image" name="image" accept="image/*" style="display:none;" required>
                    <button type="button" class="file-upload-btn" onclick="document.getElementById('image').click()">Choose File</button>
                    <div class="file-name" id="file-name">No file chosen</div>
                </div>
            </div>

            <!-- Form Grid -->
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Property Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="developer">Developer:</label>
                    <input type="text" id="developer" name="developer" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" class="form-control" required>
                </div>
            </div>

            <!-- Details -->
            <div class="form-group">
                <label for="details">Details:</label>
                <textarea id="details" name="details" class="form-control form-control-textarea" rows="5"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-button">Add Property</button>
        </form>

        <!-- Optional Feature Section -->
        <div class="features-section">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="feature-text">Get more visibility with professional listings</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="feature-text">Track your property performance with analytics</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="feature-text">Connect with potential buyers directly</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <div class="feature-text">Mobile-friendly listings for better reach</div>
            </div>
        </div>
    </div>

    <script>
        // File preview interaction
        document.getElementById('image').addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;

            if (this.files[0]) {
                document.getElementById('file-upload-container').style.borderColor = '#d4af37';
            }
        });
    </script>

</body>
</html>