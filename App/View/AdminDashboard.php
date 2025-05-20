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
$totalUsers = 0;
$totalAgents = 0;
$totalActive = 0;
$totalPremium = 0;

// Get total users count
$sql = "SELECT COUNT(*) as total FROM users";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalUsers = $row['total'];
}

// Get total agents count
$sql = "SELECT COUNT(*) as total FROM users WHERE role = 'agent'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalAgents = $row['total'];
}

// Get total active users count
$sql = "SELECT COUNT(*) as total FROM users WHERE status = 'active'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalActive = $row['total'];
}

// Get total premium users count
$sql = "SELECT COUNT(*) as total FROM users WHERE role = 'premium'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalPremium = $row['total'];
}

// Get recent users (limit to 5)
$recentUsers = [];
$sql = "SELECT id, first_name, last_name, email, role, status, registration_date, profile_image FROM users ORDER BY registration_date DESC LIMIT 5";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recentUsers[] = $row;
    }
}

// Handle user deletion if requested
if (isset($_POST['delete_user']) && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    
    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to refresh the page
        header("Location: " . $_SERVER['PHP_SELF'] . "?deleted=true");
        exit();
    } else {
        $deleteError = "Error deleting user: " . $stmt->error;
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Real Estate Portal</title>
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
                    <li class="active">
                        <a href="dashboard.php">
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
                    <li>
                        <a href="Properties.php">
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

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <div class="page-header">
                    <h1>Dashboard</h1>
                    <div class="breadcrumb">
                        <a href="#">Home</a> / <span>Dashboard</span>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?php echo $totalUsers; ?></h3>
                            <p>Total Users</p>
                        </div>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                        <div class="stat-link">
                            <a href="AdminDashboard.php">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-details">
                            <h3>128</h3>
                            <p>Properties</p>
                        </div>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 65%"></div>
                        </div>
                        <div class="stat-link">
                            <a href="AdminDashboard.php">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="stat-details">
                            <h3><?php echo $totalAgents; ?></h3>
                            <p>Agents</p>
                        </div>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 45%"></div>
                        </div>
                        <div class="stat-link">
                            <a href="agents.php">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="stat-details">
                            <h3>18</h3>
                            <p>New Messages</p>
                        </div>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 25%"></div>
                        </div>
                        <div class="stat-link">
                            <a href="messages.php">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="content-card">
                    <div class="card-header">
                        <h2>Recent Users</h2>
                        <a href="AddUser.php" class="view-all">Add User</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Registered</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($recentUsers)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No users found</td>
                                    </tr>
                                    <?php else: ?>
                                        <?php foreach ($recentUsers as $user): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                                            <td>
                                                <div class="user-info">
                                                    <img src="<?php echo !empty($user['profile_image']) ? htmlspecialchars($user['profile_image']) : 'https://randomuser.me/api/portraits/men/1.jpg'; ?>" alt="<?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>">
                                                    <span><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></span>
                                                </div>
                                            </td>
                                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                                            <td><span class="badge badge-<?php echo htmlspecialchars($user['role']); ?>"><?php echo ucfirst(htmlspecialchars($user['role'])); ?></span></td>
                                            <td><span class="badge badge-<?php echo htmlspecialchars($user['status']); ?>"><?php echo ucfirst(htmlspecialchars($user['status'])); ?></span></td>
                                            <td><?php echo date('M j, Y', strtotime($user['registration_date'])); ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="EditUser.php?id=<?php echo $user['id']; ?>" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a href="#" class="btn-delete" title="Delete" data-id="<?php echo $user['id']; ?>"><i class="fas fa-trash"></i></a>
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
                <p>Are you sure you want to delete this user? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel">Cancel</button>
                <form method="post" id="deleteForm">
                    <input type="hidden" name="user_id" id="userToDelete" value="">
                    <button type="submit" name="delete_user" class="btn-confirm">Delete</button>
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
        const userToDeleteInput = document.getElementById('userToDelete');
        
        // Function to open modal
        function openModal(userId) {
            if (deleteModal) {
                // Set the user ID in the hidden form field
                userToDeleteInput.value = userId;
                
                // Update modal message with user name if available
                const userRow = document.querySelector(`[data-id="${userId}"]`).closest('tr');
                if (userRow) {
                    const userInfo = userRow.querySelector('.user-info span');
                    if (userInfo) {
                        const userName = userInfo.textContent;
                        const modalMessage = deleteModal.querySelector('.modal-body p');
                        if (modalMessage) {
                            modalMessage.innerHTML = `Are you sure you want to delete <strong>${userName}</strong>? This action cannot be undone.`;
                        }
                    }
                }
                
                deleteModal.classList.add('active');
            }
        }
        
        // Function to close modal
        function closeModalFunc() {
            if (deleteModal) {
                deleteModal.classList.remove('active');
                // Reset the user to delete
                userToDeleteInput.value = '';
            }
        }
        
        // Add event listeners to delete buttons
        if (deleteButtons) {
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Get the user ID from the data-id attribute
                    const userId = this.getAttribute('data-id');
                    
                    // Open the modal with this user's ID
                    openModal(userId);
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
        
        // Show success message if user was deleted
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] === 'true'): ?>
        alert('User deleted successfully!');
        <?php endif; ?>
        
        // Show error message if there was an error deleting the user
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