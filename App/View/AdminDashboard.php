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
                        <a href="users.php">
                            <i class="fas fa-users"></i>
                            <span>Users</span>
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
                            <h3>245</h3>
                            <p>Total Users</p>
                        </div>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 75%"></div>
                        </div>
                        <div class="stat-link">
                            <a href="users.php">View Details <i class="fas fa-arrow-right"></i></a>
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
                            <a href="properties.php">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="stat-details">
                            <h3>42</h3>
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
                        <a href="users.php" class="view-all">View All</a>
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
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="user-info">
                                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Smith">
                                                <span>John Smith</span>
                                            </div>
                                        </td>
                                        <td>john@example.com</td>
                                        <td><span class="badge badge-regular">Regular</span></td>
                                        <td><span class="badge badge-active">Active</span></td>
                                        <td>May 12, 2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="EditUser.php?id=1" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn-delete" title="Delete" data-id="1"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div class="user-info">
                                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Johnson">
                                                <span>Sarah Johnson</span>
                                            </div>
                                        </td>
                                        <td>sarah@example.com</td>
                                        <td><span class="badge badge-premium">Premium</span></td>
                                        <td><span class="badge badge-active">Active</span></td>
                                        <td>May 10, 2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="edit-user.php?id=2" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn-delete" title="Delete" data-id="2"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <div class="user-info">
                                                <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Michael Brown">
                                                <span>Michael Brown</span>
                                            </div>
                                        </td>
                                        <td>michael@example.com</td>
                                        <td><span class="badge badge-agent">Agent</span></td>
                                        <td><span class="badge badge-active">Active</span></td>
                                        <td>May 8, 2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="edit-user.php?id=3" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn-delete" title="Delete" data-id="3"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            <div class="user-info">
                                                <img src="https://randomuser.me/api/portraits/women/22.jpg" alt="Emily Davis">
                                                <span>Emily Davis</span>
                                            </div>
                                        </td>
                                        <td>emily@example.com</td>
                                        <td><span class="badge badge-premium">Premium</span></td>
                                        <td><span class="badge badge-inactive">Inactive</span></td>
                                        <td>May 5, 2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="edit-user.php?id=4" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn-delete" title="Delete" data-id="4"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>
                                            <div class="user-info">
                                                <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Robert Wilson">
                                                <span>Robert Wilson</span>
                                            </div>
                                        </td>
                                        <td>robert@example.com</td>
                                        <td><span class="badge badge-regular">Regular</span></td>
                                        <td><span class="badge badge-suspended">Suspended</span></td>
                                        <td>May 1, 2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="edit-user.php?id=5" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn-delete" title="Delete" data-id="5"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
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
                <button class="btn-confirm">Delete</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/REALSTATE/Public/js/Admin.js"></script>
</body>
</html>