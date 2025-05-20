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

// Get total counts for stats
$totalProperties = 0;
$totalCairoProperties = 0;
$totalGizaProperties = 0;
$totalAlexandriaProperties = 0;

// Get total properties count
$sql = "SELECT COUNT(*) as total FROM properties";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalProperties = $row['total'];
}

// Get total Cairo properties count
$sql = "SELECT COUNT(*) as total FROM properties WHERE location = 'Cairo'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalCairoProperties = $row['total'];
}

// Get total Giza properties count
$sql = "SELECT COUNT(*) as total FROM properties WHERE location = 'Giza'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalGizaProperties = $row['total'];
}

// Get total Alexandria properties count
$sql = "SELECT COUNT(*) as total FROM properties WHERE location = 'Alexandria'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalAlexandriaProperties = $row['total'];
}

// Get recent properties (limit to 5)
$recentProperties = [];
$sql = "SELECT id, name, price, developer, location, image FROM properties ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recentProperties[] = $row;
    }
}

// Handle property deletion if requested
if (isset($_POST['delete_property']) && isset($_POST['property_id'])) {
    $propertyId = $_POST['property_id'];
    
    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM properties WHERE id = ?");
    $stmt->bind_param("i", $propertyId);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to refresh the page
        header("Location: " . $_SERVER['PHP_SELF'] . "?deleted=true");
        exit();
    } else {
        $deleteError = "Error deleting property: " . $stmt->error;
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties - Real Estate Portal</title>
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

            <!-- Properties Content -->
            <div class="dashboard-content">
                <div class="page-header">
                    <h1>Properties</h1>
                    <div class="breadcrumb">
                        <a href="AdminDashboard.php">Home</a> / <span>Properties</span>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?php echo $totalProperties; ?></h3>
                            <p>Total Properties</p>
                        </div>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                        <div class="stat-link">
                            <a href="properties.php">View All <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?php echo $totalCairoProperties; ?></h3>
                            <p>Cairo Properties</p>
                        </div>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 65%"></div>
                        </div>
                        <div class="stat-link">
                            <a href="properties.php?location=Cairo">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?php echo $totalGizaProperties; ?></h3>
                            <p>Giza Properties</p>
                        </div>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 45%"></div>
                        </div>
                        <div class="stat-link">
                            <a href="properties.php?location=Giza">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?php echo $totalAlexandriaProperties; ?></h3>
                            <p>Alexandria Properties</p>
                        </div>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 25%"></div>
                        </div>
                        <div class="stat-link">
                            <a href="properties.php?location=Alexandria">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Properties List -->
                <div class="content-card">
                    <div class="card-header">
                        <h2>Properties List</h2>
                        <a href="AddProperty.php" class="view-all">Add Property</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Developer</th>
                                        <th>Location</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($recentProperties)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No properties found</td>
                                    </tr>
                                    <?php else: ?>
                                        <?php foreach ($recentProperties as $property): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($property['id']); ?></td>
                                            <td>
                                                <div class="property-image">
                                                    <img src="<?php echo !empty($property['image']) ? htmlspecialchars('uploads/property_images/' . $property['image']) : 'https://via.placeholder.com/100x100.png?text=No+Image'; ?>" alt="<?php echo htmlspecialchars($property['name']); ?>">
                                                </div>
                                            </td>
                                            <td><?php echo htmlspecialchars($property['name']); ?></td>
                                            <td>$<?php echo number_format($property['price'], 2); ?></td>
                                            <td><?php echo htmlspecialchars($property['developer']); ?></td>
                                            <td><?php echo htmlspecialchars($property['location']); ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="EditProperty.php?id=<?php echo $property['id']; ?>" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a href="#" class="btn-delete" title="Delete" data-id="<?php echo $property['id']; ?>"><i class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirm Deletion</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this property? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel">Cancel</button>
                <form method="post" id="deleteForm">
                    <input type="hidden" name="property_id" id="propertyToDelete" value="">
                    <button type="submit" name="delete_property" class="btn-confirm">Delete</button>
                </form>
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
        
        // Delete Modal
        const deleteButtons = document.querySelectorAll('.btn-delete');
        const deleteModal = document.getElementById('deleteModal');
        const closeModal = document.querySelector('.close-modal');
        const cancelButton = document.querySelector('.btn-cancel');
        const propertyToDeleteInput = document.getElementById('propertyToDelete');
        
        // Function to open modal
        function openModal(propertyId) {
            if (deleteModal) {
                // Set the property ID in the hidden form field
                propertyToDeleteInput.value = propertyId;
                
                deleteModal.classList.add('active');
            }
        }
        
        // Function to close modal
        function closeModalFunc() {
            if (deleteModal) {
                deleteModal.classList.remove('active');
                // Reset the property to delete
                propertyToDeleteInput.value = '';
            }
        }
        
        // Add event listeners to delete buttons
        if (deleteButtons) {
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Get the property ID from the data-id attribute
                    const propertyId = this.getAttribute('data-id');
                    
                    // Open the modal with this property's ID
                    openModal(propertyId);
                });
            });
        }
        
        // Close modal when clicking the close button
        if (closeModal) {
            closeModal.addEventListener('click', closeModalFunc);
        }
        
        // Close modal when clicking the cancel button
        if (cancelButton) {
            cancelButton.addEventListener('click', function(e) {
                e.preventDefault();
                closeModalFunc();
            });
        }
        
        // Show success message if property was deleted
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] === 'true'): ?>
        alert('Property deleted successfully!');
        <?php endif; ?>
        
        // Show error message if there was an error deleting the property
        <?php if (isset($deleteError)): ?>
        alert('<?php echo $deleteError; ?>');
        <?php endif; ?>
    });
    </script>
</body>
</html>
<?php
// Close the database connection
$conn->close();
?>