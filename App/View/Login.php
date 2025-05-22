
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HOUSOFT</title>
    <link rel="stylesheet" href="/REALSTATE/Public/css/Login.css">
    <script src="/REALSTATE/Public/js/Login.js"></script>
</head>

<body>
    <div class="container">
        <!-- Left side - Image and content -->
        <div class="image-side">
            <div class="image-overlay"></div>
            <div class="background-image"></div>
            <div class="image-content">
                <h1 class="brand-title">HOUSOFT</h1>
                <p class="brand-subtitle">Welcome back to your real estate portal.</p>

                <div class="features">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h3>Browse Properties</h3>
                            <p>Discover homes that match your preferences</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h3>Schedule Viewings</h3>
                            <p>Book appointments with just a few clicks</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h3>Connect with Agents</h3>
                            <p>Get expert advice on your real estate journey</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side - Form -->
        <div class="form-side">
            <div class="form-container">
                <div class="mobile-header">
                    <h1 class="mobile-title">HOUSOFT</h1>
                    <p class="mobile-subtitle">Welcome back</p>
                </div>

                <?php if (isset($_SESSION['login_error'])): ?>
                    <div class="error-message" id="form-error"><?= htmlspecialchars($_SESSION['login_error']) ?></div>
                    <?php unset($_SESSION['login_error']); ?>
                <?php endif; ?>

                <h2 class="form-title">Sign in to your account</h2>
                <form id="login-form" action="/RealState/index.php?page=login&action=authenticate" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input" required>
                        <div class="error-message" id="email-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-input" required>
                        <div class="error-message" id="password-error"></div>
                    </div>

                   

                    <button type="submit" class="submit-button" id="submit-button">Sign in</button>
                </form>

                <p class="signup-link">
                    Don't have an account? <a href="http://localhost/REALSTATE/index.php?page=signup">Create account</a>
                </p>
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const form = document.getElementById('login-form');
            form.addEventListener('submit', function(e) {
                let hasError = false;
                
                // Clear previous errors
                document.querySelectorAll('.error-message').forEach(el => {
                    el.textContent = '';
                });
                
                // Validate email
                const emailInput = document.getElementById('email');
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(emailInput.value)) {
                    document.getElementById('email-error').textContent = 'Please enter a valid email address';
                    hasError = true;
                }
                
                // Validate password
                const passwordInput = document.getElementById('password');
                if (passwordInput.value.length === 0) {
                    document.getElementById('password-error').textContent = 'Password is required';
                    hasError = true;
                }
                
                if (hasError) {
                    e.preventDefault();
                }
            });
        });
    </script>

    <style>
        .error-message {
            color: #e74c3c;
            background-color: rgba(231, 76, 60, 0.1);
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border-left: 3px solid #e74c3c;
            font-weight: 500;
        }
    </style>
</body>
</html>
