<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EstateConnect - Sign Up</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Main container */
        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Left side - Image and content */
        .image-side {
            display: none;
            position: relative;
            width: 50%;
            background-color: #000;
            color: white;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
            z-index: 1;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.8;
        }

        .image-content {
            position: relative;
            z-index: 2;
            padding: 3rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .brand-subtitle {
            font-size: 1.2rem;
            max-width: 400px;
            margin-bottom: 3rem;
        }

        .features {
            width: 100%;
            max-width: 400px;
        }

        .feature-card {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            text-align: left;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            margin-right: 1rem;
            background-color: #d97706;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feature-icon svg {
            width: 20px;
            height: 20px;
        }

        .feature-text h3 {
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .feature-text p {
            font-size: 0.9rem;
            color: #e5e5e5;
        }

        /* Right side - Form */
        .form-side {
            width: 100%;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: white;
        }

        .form-container {
            width: 100%;
            max-width: 450px;
        }

        .mobile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .mobile-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .mobile-subtitle {
            color: #666;
            margin-top: 0.5rem;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #555;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #d97706;
            box-shadow: 0 0 0 2px rgba(217, 119, 6, 0.2);
        }

        .error-message {
            color: #e11d48;
            font-size: 0.85rem;
            margin-top: 0.25rem;
            display: none;
        }

        .user-types {
            margin-top: 0.5rem;
        }

        .user-type-option {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 0.75rem;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .user-type-option:hover {
            background-color: #f9f9f9;
        }

        .user-type-option.selected {
            border-color: #d97706;
            background-color: rgba(217, 119, 6, 0.05);
        }

        .user-type-radio {
            position: absolute;
            opacity: 0;
        }

        .radio-custom {
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            border-radius: 50%;
            margin-right: 1rem;
            position: relative;
            display: inline-block;
        }

        .user-type-option.selected .radio-custom {
            border-color: #d97706;
        }

        .user-type-option.selected .radio-custom:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #d97706;
        }

        .user-type-icon {
            margin-right: 0.75rem;
            color: #d97706;
        }

        .user-type-details {
            flex: 1;
        }

        .user-type-title {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .user-type-description {
            font-size: 0.85rem;
            color: #666;
        }

        .submit-button {
            width: 100%;
            padding: 0.75rem;
            background-color: #d97706;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #b45309;
        }

        .submit-button:disabled {
            background-color: #d9770680;
            cursor: not-allowed;
        }

        .login-link {
            text-align: center;
            margin-top: 2rem;
            color: #666;
        }

        .login-link a {
            color: #d97706;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #10b981;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            transform: translateX(150%);
            transition: transform 0.3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }

        /* Responsive styles */
        @media (min-width: 768px) {
            .image-side {
                display: block;
            }

            .form-side {
                width: 50%;
            }

            .mobile-header {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left side - Image and content -->
        <div class="image-side">
            <div class="image-overlay"></div>
            <div class="background-image"></div>
            <div class="image-content">
                <h1 class="brand-title">EstateConnect</h1>
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
                    <h1 class="mobile-title">EstateConnect</h1>
                    <p class="mobile-subtitle">Join our real estate community</p>
                </div>

                <h2 class="form-title">Create your account</h2>
                <form id="signup-form">
                    <div class="form-group">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" id="fullName" class="form-input" placeholder="John Doe">
                        <div class="error-message" id="fullName-error">Full name must be at least 2 characters.</div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-input" placeholder="you@example.com">
                        <div class="error-message" id="email-error">Please enter a valid email address.</div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-input" placeholder="••••••••">
                        <div class="error-message" id="password-error">Password must be at least 8 characters.</div>
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

                            <label class="user-type-option" id="seller-option">
                                <input type="radio" name="userType" value="seller" class="user-type-radio">
                                <span class="radio-custom"></span>
                                <div class="user-type-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                <div class="user-type-details">
                                    <div class="user-type-title">Property Seller</div>
                                    <div class="user-type-description">I want to list my property for sale</div>
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
                                    <div class="user-type-description">I'm a professional in real estate</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="submit-button" id="submit-button">Create account</button>
                </form>

                <p class="login-link">
                    Already have an account? <a href="#">Sign in</a>
                </p>
            </div>
        </div>
    </div>

    <div class="toast" id="toast">Account created successfully!</div>

    <script>
        // Form validation and interaction
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('signup-form');
            const fullNameInput = document.getElementById('fullName');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const submitButton = document.getElementById('submit-button');
            const toast = document.getElementById('toast');

            // User type selection
            const userTypeOptions = document.querySelectorAll('.user-type-option');
            userTypeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options
                    userTypeOptions.forEach(opt => opt.classList.remove('selected'));
                    // Add selected class to clicked option
                    this.classList.add('selected');
                    // Check the radio button
                    const radio = this.querySelector('.user-type-radio');
                    radio.checked = true;
                });
            });

            // Initial selection
            document.getElementById('buyer-option').classList.add('selected');

            // Validate full name
            function validateFullName() {
                const value = fullNameInput.value.trim();
                const error = document.getElementById('fullName-error');
                
                if (value.length < 2) {
                    error.style.display = 'block';
                    fullNameInput.style.borderColor = '#e11d48';
                    return false;
                } else {
                    error.style.display = 'none';
                    fullNameInput.style.borderColor = '#ddd';
                    return true;
                }
            }

            // Validate email
            function validateEmail() {
                const value = emailInput.value.trim();
                const error = document.getElementById('email-error');
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (!emailRegex.test(value)) {
                    error.style.display = 'block';
                    emailInput.style.borderColor = '#e11d48';
                    return false;
                } else {
                    error.style.display = 'none';
                    emailInput.style.borderColor = '#ddd';
                    return true;
                }
            }

            // Validate password
            function validatePassword() {
                const value = passwordInput.value;
                const error = document.getElementById('password-error');
                
                if (value.length < 8) {
                    error.style.display = 'block';
                    passwordInput.style.borderColor = '#e11d48';
                    return false;
                } else {
                    error.style.display = 'none';
                    passwordInput.style.borderColor = '#ddd';
                    return true;
                }
            }

            // Add input event listeners
            fullNameInput.addEventListener('input', validateFullName);
            emailInput.addEventListener('input', validateEmail);
            passwordInput.addEventListener('input', validatePassword);

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const isFullNameValid = validateFullName();
                const isEmailValid = validateEmail();
                const isPasswordValid = validatePassword();
                
                if (isFullNameValid && isEmailValid && isPasswordValid) {
                    // Get selected user type
                    const userType = document.querySelector('input[name="userType"]:checked').value;
                    
                    // Simulate form submission
                    submitButton.disabled = true;
                    submitButton.textContent = 'Creating account...';
                    
                    // Collect form data
                    const formData = {
                        fullName: fullNameInput.value.trim(),
                        email: emailInput.value.trim(),
                        password: passwordInput.value,
                        userType: userType
                    };
                    
                    console.log('Form data:', formData);
                    
                    // Simulate API call with timeout
                    setTimeout(function() {
                        // Show success message
                        toast.classList.add('show');
                        
                        // Reset form
                        form.reset();
                        document.getElementById('buyer-option').classList.add('selected');
                        document.getElementById('seller-option').classList.remove('selected');
                        document.getElementById('agent-option').classList.remove('selected');
                        
                        // Reset button
                        submitButton.disabled = false;
                        submitButton.textContent = 'Create account';
                        
                        // Hide toast after 3 seconds
                        setTimeout(function() {
                            toast.classList.remove('show');
                        }, 3000);
                    }, 1500);
                }
            });
        });
    </script>
</body>
</html>