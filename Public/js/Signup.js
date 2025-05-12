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