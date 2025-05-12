<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
        <link rel="stylesheet" href="Signup.css" />
        <script src="Signup.js"></script>


    
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
                    <h1 class="mobile-title">EstateConnect</h1>
                    <p class="mobile-subtitle">Join our real estate community</p>
                </div>

                <h2 class="form-title">Create your account</h2>
                <form id="signup-form">
                    <div class="form-group">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" id="fullName" class="form-input" >
                        <div class="error-message" id="fullName-error">Full name must be at least 2 characters.</div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-input" >
                        <div class="error-message" id="email-error">Please enter a valid email address.</div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-input" >
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
                                    <div class="user-type-title">Real Estate Agent</div>
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
                                    <div class="user-type-title">Admin</div>
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

  
</body>
</html>