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
$property_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if property ID is provided
if ($property_id <= 0) {
    $error = "Invalid property ID";
} else {
    // Fetch property data from database
    $stmt = $conn->prepare("SELECT * FROM properties WHERE id = ?");
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $error = "Property not found";
    } else {
        $propertyData = $result->fetch_assoc();
    }
    $stmt->close();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($propertyData)) {
    // Get form data
    $formData = [
        'name' => $_POST['name'] ?? '',
        'price' => $_POST['price'] ?? '',
        'developer' => $_POST['developer'] ?? '',
        'location' => $_POST['location'] ?? ''
    ];
    
    // Validate form data
    $errors = [];
    
    if (empty($formData['name'])) {
        $errors[] = "Property name is required";
    }
    
    if (empty($formData['price'])) {
        $errors[] = "Price is required";
    } elseif (!is_numeric($formData['price'])) {
        $errors[] = "Price must be a number";
    }
    
    if (empty($formData['developer'])) {
        $errors[] = "Developer is required";
    }
    
    if (empty($formData['location'])) {
        $errors[] = "Location is required";
    }
    
    // Process property image if uploaded
    $image_sql = "";
    $image_param = "";
    if (isset($_FILES['property_image']) && $_FILES['property_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['property_image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        
        // Verify file extension
        if (in_array(strtolower($filetype), $allowed)) {
            // Create unique filename
            $newFilename = uniqid() . '.' . $filetype;
            $uploadDir = 'uploads/property_images/';
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $uploadPath = $uploadDir . $newFilename;
            
            // Move the file
            if (move_uploaded_file($_FILES['property_image']['tmp_name'], $uploadPath)) {
                $image_sql = ", image = ?";
                $image_param = $newFilename;
            } else {
                $errors[] = "Failed to upload image";
            }
        } else {
            $errors[] = "Invalid file type. Only JPG, JPEG, PNG and GIF are allowed";
        }
    }
    
    // If no errors, update property in database
    if (empty($errors)) {
        // Prepare SQL statement
        $sql = "UPDATE properties SET 
                name = ?, 
                price = ?, 
                developer = ?, 
                location = ?";
        
        // Add image if it's being updated
        $sql .= $image_sql . " WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        
        // Create parameter types string and array
        $types = "sdssi"; // string, double, string, string, integer (id)
        $params = [
            $formData['name'],
            $formData['price'],
            $formData['developer'],
            $formData['location'],
            $property_id
        ];
        
        // Add image parameter if it's being updated
        if (!empty($image_param)) {
            $types .= "s";
            array_splice($params, -1, 0, [$image_param]); // Insert before property_id
        }
        
        // Bind parameters dynamically
        $stmt->bind_param($types, ...$params);
        
        if ($stmt->execute()) {
            $success = true;
            
            // Refresh property data
            $stmt->close(); // Close the previous statement before creating a new one
            $stmt = $conn->prepare("SELECT * FROM properties WHERE id = ?");
            $stmt->bind_param("i", $property_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $propertyData = $result->fetch_assoc();
            $stmt->close();
        } else {
            $error = "Error: " . $stmt->error;
            $stmt->close();
        }
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
    <title>Edit Property - Real Estate Portal</title>
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
                    <li>
                        <a href="AddUser.php">
                            <i class="fas fa-users"></i>
                            <span>Add User</span>
                        </a>
                    </li>
                    <li class="active">
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

            <!-- Edit Property Content -->
            <div class="dashboard-content">
                <div class="page-header">
                    <h1>Edit Property</h1>
                    <div class="breadcrumb">
                        <a href="AdminDashboard.php">Home</a> / <a href="properties.php">Properties</a> / <span>Edit Property</span>
                    </div>
                </div>

                <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>

                <?php if (isset($propertyData)): ?>
                <!-- Property Edit Form -->
                <div class="content-card">
                    <div class="card-header">
                        <h2>Property Information</h2>
                    </div>
                    <div class="card-body">
                        <form id="editPropertyForm" class="form-grid" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $property_id); ?>" enctype="multipart/form-data">
                            <!-- Property Image -->
                            <div class="form-group full-width">
                                <div class="user-profile-header">
                                    <div class="user-avatar">
                                        <img src="<?php echo !empty($propertyData['image']) ? htmlspecialchars('uploads/property_images/' . $propertyData['image']) : 'https://via.placeholder.com/150x150.png?text=Property+Image'; ?>" alt="<?php echo htmlspecialchars($propertyData['name']); ?>" id="propertyPreview">
                                        <div class="avatar-edit">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                    </div>
                                    <div class="user-info-summary">
                                        <h3><?php echo htmlspecialchars($propertyData['name']); ?></h3>
                                        <p>Update property information</p>
                                        <div class="file-upload">
                                            <input type="file" id="propertyImage" name="property_image" accept="image/*">
                                            <label for="propertyImage" class="file-label">
                                                <i class="fas fa-upload"></i> Change Property Image
                                            </label>
                                            <span class="file-name">No file chosen</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Property Details -->
                            <div class="form-group">
                                <label for="propertyName">Property Name</label>
                                <input type="text" id="propertyName" name="name" value="<?php echo htmlspecialchars($propertyData['name']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="propertyPrice">Price</label>
                                <input type="number" id="propertyPrice" name="price" step="0.01" value="<?php echo htmlspecialchars($propertyData['price']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="propertyDeveloper">Developer</label>
                                <input type="text" id="propertyDeveloper" name="developer" value="<?php echo htmlspecialchars($propertyData['developer']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="propertyLocation">Location</label>
                                <select id="propertyLocation" name="location" required>
                                    <option value="" disabled>Select Location</option>
                                    <option value="Cairo" <?php echo $propertyData['location'] == 'Cairo' ? 'selected' : ''; ?>>Cairo</option>
                                    <option value="Giza" <?php echo $propertyData['location'] == 'Giza' ? 'selected' : ''; ?>>Giza</option>
                                    <option value="Alexandria" <?php echo $propertyData['location'] == 'Alexandria' ? 'selected' : ''; ?>>Alexandria</option>
                                    <option value="Other" <?php echo !in_array($propertyData['location'], ['Cairo', 'Giza', 'Alexandria']) ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="properties.php" class="btn-cancel">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
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
                <p>Property has been updated successfully!</p>
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
        const fileInput = document.getElementById('propertyImage');
        const fileName = document.querySelector('.file-name');
        const propertyPreview = document.getElementById('propertyPreview');
        
        if (fileInput && fileName) {
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileName.textContent = fileInput.files[0].name;
                    
                    // Preview the image
                    if (propertyPreview) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            propertyPreview.src = e.target.result;
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                } else {
                    fileName.textContent = 'No file chosen';
                }
            });
        }
        
        // Form Validation
        const editPropertyForm = document.getElementById('editPropertyForm');
        
        if (editPropertyForm) {
            editPropertyForm.addEventListener('submit', function(e) {
                const price = document.getElementById('propertyPrice');
                
                if (price.value <= 0) {
                    e.preventDefault();
                    alert('Price must be greater than zero!');
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
                    window.location.href = 'properties.php';
                });
            }
            
            if (successOkBtn) {
                successOkBtn.addEventListener('click', function() {
                    successModal.classList.remove('active');
                    window.location.href = 'properties.php';
                });
            }
        }
    });
    </script>
</body>
</html>
<?php
// Close the database connection
$conn->close();
?>