<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "realstate";

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$success = false;
$error = "";
$formData = [
    'first_name' => '',
    'last_name' => '',
    'username' => '',
    'email' => '',
    'password' => '',
    'phone' => '',
    'role' => 'regular',
    'status' => 'active',
    'registration_date' => date('Y-m-d'),
    'profile_image' => '',
    'email_notifications' => 0,
    'property_alerts' => 0,
    'newsletter' => 0
];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $formData = [
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'username' => $_POST['username'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'role' => $_POST['role'] ?? 'regular',
        'status' => $_POST['status'] ?? 'active',
        'registration_date' => $_POST['registration_date'] ?? date('Y-m-d'),
        'profile_image' => '',
        'email_notifications' => isset($_POST['email_notifications']) ? 1 : 0,
        'property_alerts' => isset($_POST['property_alerts']) ? 1 : 0,
        'newsletter' => isset($_POST['newsletter']) ? 1 : 0
    ];
    
    // Validate form data
    $errors = [];
    
    if (empty($formData['first_name'])) {
        $errors[] = "First name is required";
    }
    
    if (empty($formData['last_name'])) {
        $errors[] = "Last name is required";
    }
    
    if (empty($formData['username'])) {
        $errors[] = "Username is required";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $formData['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Username already exists";
        }
        $stmt->close();
    }
    
    if (empty($formData['email'])) {
        $errors[] = "Email is required";
    } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $formData['email']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Email already exists";
        }
        $stmt->close();
    }
    
    if (empty($formData['password'])) {
        $errors[] = "Password is required";
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $errors[] = "Passwords do not match";
    }
    
    // Process profile image if uploaded
    $profile_image = "";
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['profile_image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        
        // Verify file extension
        if (in_array(strtolower($filetype), $allowed)) {
            // Create unique filename
            $newFilename = uniqid() . '.' . $filetype;
            $uploadDir = 'uploads/profile_images/';
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $uploadPath = $uploadDir . $newFilename;
            
            // Move the file
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadPath)) {
                $profile_image = $uploadPath;
            } else {
                $errors[] = "Failed to upload image";
            }
        } else {
            $errors[] = "Invalid file type. Only JPG, JPEG, PNG and GIF are allowed";
        }
    }
    
    // If no errors, insert user into database
    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($formData['password'], PASSWORD_DEFAULT);
        
        // Prepare SQL statement - following the exact sequence of the database fields
        $stmt = $conn->prepare("INSERT INTO users (
            first_name, 
            last_name, 
            username, 
            email, 
            password, 
            phone, 
            role, 
            status, 
            registration_date, 
            profile_image, 
            email_notifications, 
            property_alerts, 
            newsletter, 
            created_at, 
            updated_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        
        // The type string should be 'ssssssssssiii' for 13 parameters
// (10 strings followed by 3 integers)
$stmt->bind_param("ssssssssssiii", 
    $formData['first_name'],
    $formData['last_name'],
    $formData['username'],
    $formData['email'],
    $hashed_password,
    $formData['phone'],
    $formData['role'],
    $formData['status'],
    $formData['registration_date'],
    $profile_image,
    $formData['email_notifications'],
    $formData['property_alerts'],
    $formData['newsletter']
);
        
        if ($stmt->execute()) {
            $success = true;
            // Reset form data
            $formData = [
                'first_name' => '',
                'last_name' => '',
                'username' => '',
                'email' => '',
                'password' => '',
                'phone' => '',
                'role' => 'regular',
                'status' => 'active',
                'registration_date' => date('Y-m-d'),
                'profile_image' => '',
                'email_notifications' => 0,
                'property_alerts' => 0,
                'newsletter' => 0
            ];
        } else {
            $error = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $error = implode("<br>", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Real Estate Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/REALSTATE/Public/css/Admin.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <span class="logo-icon"><i class="fas fa-home"></i></span>
                    <span class="logo-text">RealEstate</span>
                </div>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="AdminDashboard.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="AddUser.php">
                            <i class="fas fa-users"></i>
                            <span>Add User</span>
                        </a>
                    </li>
                    <li>
                        <a href="properties.php">
                            <i class="fas fa-building"></i>
                            <span>Properties</span>
                        </a>
                    </li>
                    <li>
                        <a href="agents.php">
                            <i class="fas fa-user-tie"></i>
                            <span>Agents</span>
                        </a>
                    </li>
                    <li>
                        <a href="messages.php">
                            <i class="fas fa-envelope"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                    <li>
                        <a href="settings.php">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navigation -->
            <nav class="top-nav">
                <div class="nav-actions">
                    <div class="admin-profile">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin">
                        <div class="admin-info">
                            <span class="admin-name">John Admin</span>
                            <span class="admin-role">Administrator</span>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Add User Content -->
            <div class="dashboard-content">
                <div class="page-header">
                    <h1>Add New User</h1>
                    <div class="breadcrumb">
                        <a href="AdminDashboard.php">Home</a> / <a href="users.php">Users</a> / <span>Add User</span>
                    </div>
                </div>

                <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>

                <!-- User Add Form -->
                <div class="content-card">
                    <div class="card-header">
                        <h2>User Information</h2>
                    </div>
                    <div class="card-body">
                        <form id="addUserForm" class="form-grid" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                            <!-- Form fields in the exact sequence of the database -->
                            
                            <!-- 1. first_name -->
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="first_name" value="<?php echo htmlspecialchars($formData['first_name']); ?>" required>
                            </div>
                            
                            <!-- 2. last_name -->
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="last_name" value="<?php echo htmlspecialchars($formData['last_name']); ?>" required>
                            </div>
                            
                            <!-- 3. username -->
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($formData['username']); ?>" required>
                            </div>
                            
                            <!-- 4. email -->
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($formData['email']); ?>" required>
                            </div>
                            
                            <!-- 5. password (and confirm password) -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" id="confirmPassword" name="confirm_password" required>
                            </div>
                            
                            <!-- 6. phone -->
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($formData['phone']); ?>">
                            </div>
                            
                            <!-- 7. role -->
                            <div class="form-group">
                                <label for="role">User Role</label>
                                <select id="role" name="role" required>
                                    <option value="admin" <?php echo $formData['role'] == 'admin' ? 'selected' : ''; ?>>Administrator</option>
                                    <option value="agent" <?php echo $formData['role'] == 'agent' ? 'selected' : ''; ?>>Agent</option>
                                    <option value="premium" <?php echo $formData['role'] == 'premium' ? 'selected' : ''; ?>>Premium User</option>
                                    <option value="regular" <?php echo $formData['role'] == 'regular' ? 'selected' : ''; ?>>Regular User</option>
                                </select>
                            </div>
                            
                            <!-- 8. status -->
                            <div class="form-group">
                                <label for="status">Account Status</label>
                                <select id="status" name="status" required>
                                    <option value="active" <?php echo $formData['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo $formData['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                    <option value="suspended" <?php echo $formData['status'] == 'suspended' ? 'selected' : ''; ?>>Suspended</option>
                                </select>
                            </div>
                            
                            <!-- 9. registration_date -->
                            <div class="form-group">
                                <label for="registrationDate">Registration Date</label>
                                <input type="date" id="registrationDate" name="registration_date" value="<?php echo htmlspecialchars($formData['registration_date']); ?>" required>
                            </div>
                            
                            <!-- 10. profile_image -->
                            <div class="form-group full-width">
                                <div class="user-profile-header">
                                    <div class="user-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="New User" id="profilePreview">
                                        <div class="avatar-edit">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                    </div>
                                    <div class="user-info-summary">
                                        <h3>Profile Image</h3>
                                        <p>Upload a profile picture for this user</p>
                                        <div class="file-upload">
                                            <input type="file" id="profileImage" name="profile_image" accept="image/*">
                                            <label for="profileImage" class="file-label">
                                                <i class="fas fa-upload"></i> Upload Profile Picture
                                            </label>
                                            <span class="file-name">No file chosen</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 11-13. Preferences (email_notifications, property_alerts, newsletter) -->
                            <div class="form-group full-width">
                                <h3 style="margin-top: 20px; margin-bottom: 10px; font-size: 1.6rem;">Preferences</h3>
                            </div>
                            <div class="form-group full-width">
                                <!-- 11. email_notifications -->
                                <div class="checkbox-group">
                                    <label class="checkbox-container">
                                        <input type="checkbox" name="email_notifications" <?php echo $formData['email_notifications'] ? 'checked' : ''; ?>>
                                        <span class="checkmark"></span>
                                        Receive email notifications
                                    </label>
                                </div>
                                
                                <!-- 12. property_alerts -->
                                <div class="checkbox-group">
                                    <label class="checkbox-container">
                                        <input type="checkbox" name="property_alerts" <?php echo $formData['property_alerts'] ? 'checked' : ''; ?>>
                                        <span class="checkmark"></span>
                                        Receive property alerts
                                    </label>
                                </div>
                                
                                <!-- 13. newsletter -->
                                <div class="checkbox-group">
                                    <label class="checkbox-container">
                                        <input type="checkbox" name="newsletter" <?php echo $formData['newsletter'] ? 'checked' : ''; ?>>
                                        <span class="checkmark"></span>
                                        Receive newsletter
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Note: created_at and updated_at are handled automatically in the PHP code -->

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="AdminDashboard.php" class="btn-cancel">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i> Save User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Success Modal -->
    <div class="modal <?php echo $success ? 'active' : ''; ?>" id="successModal">
        <div class="modal-content">
            <div class="modal-header success">
                <h3>Success</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <p>User has been added successfully!</p>
            </div>
            <div class="modal-footer">
                <button class="btn-primary" id="successOkBtn">OK</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
        }
        
        // File Upload
        const fileInput = document.getElementById('profileImage');
        const fileName = document.querySelector('.file-name');
        const profilePreview = document.getElementById('profilePreview');
        
        if (fileInput && fileName) {
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileName.textContent = fileInput.files[0].name;
                    
                    // Preview the image
                    if (profilePreview) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            profilePreview.src = e.target.result;
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                } else {
                    fileName.textContent = 'No file chosen';
                }
            });
        }
        
        // Form Validation
        const addUserForm = document.getElementById('addUserForm');
        
        if (addUserForm) {
            addUserForm.addEventListener('submit', function(e) {
                const password = document.getElementById('password');
                const confirmPassword = document.getElementById('confirmPassword');
                
                if (password.value !== confirmPassword.value) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                    return false;
                }
                
                return true;
            });
        }
        
        // Success Modal
        const successModal = document.getElementById('successModal');
        const closeModal = document.querySelector('.close-modal');
        const successOkBtn = document.getElementById('successOkBtn');
        
        if (successModal && successModal.classList.contains('active')) {
            if (closeModal) {
                closeModal.addEventListener('click', function() {
                    successModal.classList.remove('active');
                    window.location.href = 'AdminDashboard.php';
                });
            }
            
            if (successOkBtn) {
                successOkBtn.addEventListener('click', function() {
                    successModal.classList.remove('active');
                    window.location.href = 'AdminDashboard.php';
                });
            }
            
            // Auto redirect after 3 seconds
            setTimeout(function() {
                window.location.href = 'AdminDashboard.php';
            }, 3000);
        }
    });
    </script>
</body>
</html>
<?php
// Close the database connection
$conn->close();
?>