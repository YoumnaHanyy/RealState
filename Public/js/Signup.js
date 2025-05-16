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
            });
            
            // Add active class to selected option
            this.closest('.user-type-option').classList.add('active');
            
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
        // Also check if admin is initially selected
        if (initialSelectedRadio.value === 'admin') {
            adminCodeGroup.style.display = 'block';
        }
    }
    
    // Create a toast container if it doesn't exist
    if (!document.getElementById('toast-container')) {
        const toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        `;
        document.body.appendChild(toastContainer);
    }
    
    // Function to show toast message
    function showToast(message, type = 'error') {
        const toastContainer = document.getElementById('toast-container');
        const toast = document.createElement('div');
        
        toast.className = 'toast-notification ' + type;
        toast.innerHTML = message;
        
        // Style the toast based on type
        if (type === 'error') {
            toast.style.cssText = `
                background-color: #f44336;
                color: white;
                padding: 16px;
                border-radius: 4px;
                margin-bottom: 10px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.2);
                font-weight: bold;
                max-width: 300px;
                word-break: break-word;
            `;
        } else {
            toast.style.cssText = `
                background-color: #4CAF50;
                color: white;
                padding: 16px;
                border-radius: 4px;
                margin-bottom: 10px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.2);
                font-weight: bold;
                max-width: 300px;
                word-break: break-word;
            `;
        }
        
        toastContainer.appendChild(toast);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.5s';
            setTimeout(() => {
                toastContainer.removeChild(toast);
            }, 500);
        }, 5000);
    }
    
    // Basic form validation
    const form = document.getElementById('signup-form');
    form.addEventListener('submit', function(e) {
        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
        });
        
        let hasError = false;
        let errorMessages = [];
        
        // Validate name - letters only
        const nameInput = document.getElementById('fullName');
        const nameValue = nameInput.value.trim();
        if (nameValue === '') {
            document.getElementById('fullName-error').textContent = 'Name is required';
            errorMessages.push('Name is required');
            nameInput.style.borderColor = '#f44336';
            hasError = true;
        } else if (!/^[A-Za-z\s]+$/.test(nameValue)) {
            document.getElementById('fullName-error').textContent = 'Name must contain letters only';
            errorMessages.push('Name must contain letters only');
            nameInput.style.borderColor = '#f44336';
            hasError = true;
        } else {
            nameInput.style.borderColor = '#4CAF50';
        }
        
        // Validate email - just check if it's filled
        const emailInput = document.getElementById('email');
        if (emailInput.value.trim() === '') {
            document.getElementById('email-error').textContent = 'Email is required';
            errorMessages.push('Email is required');
            emailInput.style.borderColor = '#f44336';
            hasError = true;
        } else {
            emailInput.style.borderColor = '#4CAF50';
        }
        
        // Validate password - just check if it's filled
        const passwordInput = document.getElementById('password');
        if (passwordInput.value === '') {
            document.getElementById('password-error').textContent = 'Password is required';
            errorMessages.push('Password is required');
            passwordInput.style.borderColor = '#f44336';
            hasError = true;
        } else if (passwordInput.value.length < 8) {
            document.getElementById('password-error').textContent = 'Password must be at least 8 characters';
            errorMessages.push('Password must be at least 8 characters');
            passwordInput.style.borderColor = '#f44336';
            hasError = true;
        } else {
            passwordInput.style.borderColor = '#4CAF50';
        }
        
        // Validate admin code if admin is selected
        const adminRadio = document.querySelector('input[value="admin"]:checked');
        if (adminRadio) {
            const adminCodeInput = document.getElementById('admin_code');
            if (adminCodeInput.value.trim() === '') {
                document.getElementById('admin-code-error').textContent = 'Admin code is required';
                errorMessages.push('Admin code is required');
                adminCodeInput.style.borderColor = '#f44336';
                hasError = true;
            } else {
                adminCodeInput.style.borderColor = '#4CAF50';
            }
        }
        
        if (hasError) {
            e.preventDefault(); // Prevent form submission if there are errors
            
            // Show the first error message as a toast
            if (errorMessages.length > 0) {
                if (errorMessages.length === 1) {
                    showToast(errorMessages[0], 'error');
                } else {
                    // If multiple errors, show a summary
                    showToast('<strong>Please fix the following errors:</strong><br>' + 
                        errorMessages.map(msg => '• ' + msg).join('<br>'), 'error');
                }
            }
            
            // Highlight the first error field
            const firstErrorField = document.querySelector('.error-message:not(:empty)');
            if (firstErrorField) {
                firstErrorField.parentElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
});