<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Real Estate Portal</title>
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
                        <a href="dashboard.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="active">
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

            <!-- Edit User Content -->
            <div class="dashboard-content">
                <div class="page-header">
                    <h1>Edit User</h1>
                    <div class="breadcrumb">
                        <a href="dashboard.php">Home</a> / <a href="users.php">Users</a> / <span>Edit User</span>
                    </div>
                </div>

                <!-- User Edit Form -->
                <div class="content-card">
                    <div class="card-header">
                        <h2>User Information</h2>
                    </div>
                    <div class="card-body">
                        <form id="editUserForm" class="form-grid">
                            <!-- User Avatar -->
                            <div class="form-group full-width">
                                <div class="user-profile-header">
                                    <div class="user-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Smith">
                                        <div class="avatar-edit">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                    </div>
                                    <div class="user-info-summary">
                                        <h3>John Smith</h3>
                                        <p>Update user profile information</p>
                                        <div class="file-upload">
                                            <input type="file" id="profileImage" accept="image/*">
                                            <label for="profileImage" class="file-label">
                                                <i class="fas fa-upload"></i> Change Profile Picture
                                            </label>
                                            <span class="file-name">No file chosen</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Basic Information -->
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" value="John" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" value="Smith" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" value="johnsmith" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" value="john@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" value="+1 (555) 123-4567">
                            </div>
                            <div class="form-group">
                                <label for="role">User Role</label>
                                <select id="role" required>
                                    <option value="admin">Administrator</option>
                                    <option value="agent">Agent</option>
                                    <option value="premium">Premium User</option>
                                    <option value="regular" selected>Regular User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Account Status</label>
                                <select id="status" required>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="suspended">Suspended</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="registrationDate">Registration Date</label>
                                <input type="date" id="registrationDate" value="2025-05-12" disabled>
                            </div>

                            <!-- Address Information -->
                            <div class="form-group full-width">
                                <label for="address">Address</label>
                                <input type="text" id="address" value="123 Main Street, Apt 4B">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" value="New York">
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" id="state" value="NY">
                            </div>
                            <div class="form-group">
                                <label for="zipCode">ZIP Code</label>
                                <input type="text" id="zipCode" value="10001">
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" id="country" value="United States">
                            </div>

                            <!-- Password Change -->
                            <div class="form-group full-width">
                                <h3 style="margin-top: 20px; margin-bottom: 10px; font-size: 1.6rem;">Change Password</h3>
                                <p style="color: var(--text-muted); font-size: 1.4rem; margin-bottom: 15px;">Leave blank to keep the current password</p>
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm New Password</label>
                                <input type="password" id="confirmPassword">
                            </div>

                            <!-- Preferences -->
                            <div class="form-group full-width">
                                <h3 style="margin-top: 20px; margin-bottom: 10px; font-size: 1.6rem;">Preferences</h3>
                            </div>
                            <div class="form-group full-width">
                                <div class="checkbox-group">
                                    <label class="checkbox-container">
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                        Receive email notifications
                                    </label>
                                </div>
                                <div class="checkbox-group">
                                    <label class="checkbox-container">
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                        Receive property alerts
                                    </label>
                                </div>
                                <div class="checkbox-group">
                                    <label class="checkbox-container">
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                        Receive newsletter
                                    </label>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="users.php" class="btn-cancel">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/REALSTATE/Public/js/Admin.js"></script>
</body>
</html>