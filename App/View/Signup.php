<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - HOUSOFT</title>
    <link rel="stylesheet" href="/REALSTATE/Public/css/Signup.css">
    <script src="/REALSTATE/Public/js/Signup.js"></script>
</head>

<body>
    <div class="container">
        <!-- Left side - Image and content -->
        <div class="image-side">
            <div class="image-overlay"></div>
            <div class="background-image"></div>
            <div class="image-content">
                <h1 class="brand-title">HOUSOFT</h1>
                <p class="brand-subtitle">Join our community of homeowners, buyers, and real estate professionals.</p>

                <div class="features">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h3>Find Your Dream Home</h3>
                            <p>Access exclusive property listings</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                <rect x="9" y="9" width="6" height="6"></rect>
                                <line x1="9" y1="1" x2="9" y2="4"></line>
                                <line x1="15" y1="1" x2="15" y2="4"></line>
                                <line x1="9" y1="20" x2="9" y2="23"></line>
                                <line x1="15" y1="20" x2="15" y2="23"></line>
                                <line x1="20" y1="9" x2="23" y2="9"></line>
                                <line x1="20" y1="14" x2="23" y2="14"></line>
                                <line x1="1" y1="9" x2="4" y2="9"></line>
                                <line x1="1" y1="14" x2="4" y2="14"></line>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h3>List Your Property</h3>
                            <p>Reach thousands of potential buyers</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h3>Connect with Agents</h3>
                            <p>Professional guidance every step of the way</p>
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
                    <p class="mobile-subtitle">Join our real estate community</p>
                </div>

                <?php if (isset($_SESSION['signup_error'])): ?>
                    <div class="error-message" id="form-error"><?= htmlspecialchars($_SESSION['signup_error']) ?></div>
                    <?php unset($_SESSION['signup_error']); ?>
                <?php endif; ?>

                <h2 class="form-title">Create your account</h2>
                <form id="signup-form" action="/RealState/index.php?page=signup&action=signup" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

                    <div class="form-group">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" id="fullName" name="fullName" class="form-input" required>
                        <div class="error-message" id="fullName-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input" required>
                        <div class="error-message" id="email-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-input" required minlength="8">
                        <div class="error-message" id="password-error"></div>
                    </div>

                    <div class="form-group" id="admin-code-group" style="display:none;">
                        <label for="admin_code" class="form-label">Admin Verification Code</label>
                        <input type="password" id="admin_code" name="admin_code" class="form-input">
                        <div class="error-message" id="admin-code-error"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">I am a:</label>
                        <div class="user-types">
                            <label class="user-type-option" id="buyer-option">
                                <input type="radio" name="userType" value="buyer" class="user-type-radio" checked>
                                <span class="radio-custom"></span>
                                <div class="user-type-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </div>
                                <div class="user-type-details">
                                    <div class="user-type-title">Home Buyer</div>
                                    <div class="user-type-description">I'm looking to purchase a property</div>
                                </div>
                            </label>

                            <label class="user-type-option" id="agent-option">
                                <input type="radio" name="userType" value="agent" class="user-type-radio">
                                <span class="radio-custom"></span>
                                <div class="user-type-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <div class="user-type-details">
                                    <div class="user-type-title">Real Estate Agent</div>
                                    <div class="user-type-description">I help clients buy/sell properties</div>
                                </div>
                            </label>

                            <label class="user-type-option" id="admin-option">
                                <input type="radio" name="userType" value="admin" class="user-type-radio">
                                <span class="radio-custom"></span>
                                <div class="user-type-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <line x1="20" y1="8" x2="20" y2="14"></line>
                                        <line x1="23" y1="11" x2="17" y2="11"></line>
                                    </svg>
                                </div>
                                <div class="user-type-details">
                                    <div class="user-type-title">Administrator</div>
                                    <div class="user-type-description">I manage the platform</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="submit-button" id="submit-button">Create account</button>
                </form>

                <p class="login-link">
                    Already have an account? <a href="http://localhost/REALSTATE/index.php?page=login">Sign in</a>
                </p>
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show/hide admin code field based on user type selection
            const userTypeRadios = document.querySelectorAll('input[name="userType"]');
            const adminCodeGroup = document.getElementById('admin-code-group');
            const userTypeOptions = document.querySelectorAll('.user-type-option');
            
            // User type selection styling and functionality
            userTypeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Update visual styling
                    userTypeOptions.forEach(option => {
                        option.classList.remove('active');
                        // Remove highlighted circle
                        const radioCustom = option.querySelector('.radio-custom');
                        if (radioCustom) {
                            radioCustom.classList.remove('checked');
                        }
                    });
                    
                    // Add active class to selected option
                    this.closest('.user-type-option').classList.add('active');
                    
                    // Highlight the circle
                    const radioCustom = this.closest('.user-type-option').querySelector('.radio-custom');
                    if (radioCustom) {
                        radioCustom.classList.add('checked');
                    }
                    
                    // Show/hide admin code field
                    if (this.value === 'admin') {
                        adminCodeGroup.style.display = 'block';
                    } else {
                        adminCodeGroup.style.display = 'none';
                    }
                });
            });
            
            // Apply active class to initially selected option
            const initialSelectedRadio = document.querySelector('input[name="userType"]:checked');
            if (initialSelectedRadio) {
                initialSelectedRadio.closest('.user-type-option').classList.add('active');
                // Highlight the circle for initially selected option
                const radioCustom = initialSelectedRadio.closest('.user-type-option').querySelector('.radio-custom');
                if (radioCustom) {
                    radioCustom.classList.add('checked');
                }
                // Also check if admin is initially selected
                if (initialSelectedRadio.value === 'admin') {
                    adminCodeGroup.style.display = 'block';
                }
            }
            
            // Form validation
            const form = document.getElementById('signup-form');
            form.addEventListener('submit', function(e) {
                let hasError = false;
                
                // Clear previous errors
                document.querySelectorAll('.error-message').forEach(el => {
                    el.textContent = '';
                });
                
                // Validate name
                const nameInput = document.getElementById('fullName');
                if (nameInput.value.trim() === '') {
                    document.getElementById('fullName-error').textContent = 'Name is required';
                    hasError = true;
                }
                
                // Validate email
                const emailInput = document.getElementById('email');
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(emailInput.value)) {
                    document.getElementById('email-error').textContent = 'Please enter a valid email address';
                    hasError = true;
                }
                
                // Validate password
                const passwordInput = document.getElementById('password');
                if (passwordInput.value.length < 8) {
                    document.getElementById('password-error').textContent = 'Password must be at least 8 characters';
                    hasError = true;
                }
                
                // Validate admin code if admin is selected
                const adminRadio = document.querySelector('input[value="admin"]');
                if (adminRadio.checked) {
                    const adminCodeInput = document.getElementById('admin_code');
                    if (!adminCodeInput.value) {
                        document.getElementById('admin-code-error').textContent = 'Admin code is required';
                        hasError = true;
                    }
                }
                
                if (hasError) {
                    e.preventDefault();
                }
            });
        });
    </script>

    <style>
        /* Add styles for the highlighted radio button */
        .radio-custom {
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        
        .radio-custom.checked {
            border-color: #4CAF50;
        }
        
        .radio-custom.checked::after {
            content: '';
            width: 12px;
            height: 12px;
            background-color: #4CAF50;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse 0.3s ease-out;
        }
        
        .user-type-option.active {
            background-color: rgba(76, 175, 80, 0.1);
            border-color: #4CAF50;
        }
        
        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(0);
                opacity: 0;
            }
            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
        }
    </style>
</body>
</html>