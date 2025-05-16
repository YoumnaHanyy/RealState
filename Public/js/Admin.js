document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin.js loaded - Version 2.0');
    
    // Sidebar Toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
        });
    }
    
    // IMPORTANT: Check if we're on the dashboard page and if there's a user table
    const isOnDashboard = document.querySelector('.dashboard-content') !== null;
    const userTable = document.querySelector('.data-table tbody');
    
    console.log('Is on dashboard:', isOnDashboard);
    console.log('User table found:', userTable !== null);
    
    // Check for edited user data in localStorage
    checkForEditedUser();
    
    // Check for new user data in localStorage - only if we're on the dashboard
    if (isOnDashboard && userTable) {
        checkForNewUser();
    }
    
    // Delete Modal
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const deleteModal = document.getElementById('deleteModal');
    const closeModal = document.querySelector('.close-modal');
    const cancelButton = document.querySelector('.btn-cancel');
    const confirmButton = document.querySelector('.btn-confirm');
    const deleteUserBtn = document.getElementById('deleteUserBtn');
    
    // Variable to store the ID of the user to be deleted
    let userToDeleteId = null;
    let userToDeleteRow = null;
    
    // Function to open modal
    function openModal(userId, userRow) {
        if (deleteModal) {
            // Store the user ID and row to be deleted
            userToDeleteId = userId;
            userToDeleteRow = userRow;
            
            // Update modal message with user name if available
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
            userToDeleteId = null;
            userToDeleteRow = null;
        }
    }
    
    // Add event listeners to delete buttons
    if (deleteButtons) {
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Get the user ID from the data-id attribute
                const userId = this.getAttribute('data-id');
                
                // Get the table row (tr) that contains this button
                const tableRow = this.closest('tr');
                
                // Open the modal with this user's ID and row
                openModal(userId, tableRow);
            });
        });
    }
    
    // Add event listener to delete user button on profile page
    if (deleteUserBtn) {
        deleteUserBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the user ID from the URL if available
            const urlParams = new URLSearchParams(window.location.search);
            const userId = urlParams.get('id');
            
            // Open the modal with this user's ID
            openModal(userId, null);
        });
    }
    
    // Close modal when clicking the close button
    if (closeModal) {
        closeModal.addEventListener('click', closeModalFunc);
    }
    
    // Close modal when clicking the cancel button
    if (cancelButton) {
        cancelButton.addEventListener('click', closeModalFunc);
    }
    
    // Handle confirm delete
    if (confirmButton) {
        confirmButton.addEventListener('click', function() {
            // Check if we have a user ID to delete
            if (userToDeleteId) {
                // In a real application, this would send an AJAX request to delete the user
                // For example:
                // fetch(`delete-user.php?id=${userToDeleteId}`, {
                //     method: 'POST'
                // })
                // .then(response => response.json())
                // .then(data => {
                //     if (data.success) {
                //         // Remove the user from the table
                //         if (userToDeleteRow) {
                //             userToDeleteRow.remove();
                //         }
                //         // Show success message
                //         alert('User deleted successfully!');
                //     } else {
                //         alert('Error: ' + data.message);
                //     }
                // })
                // .catch(error => {
                //     console.error('Error:', error);
                //     alert('An error occurred while deleting the user.');
                // });
                
                // For now, we'll just simulate the deletion
                if (userToDeleteRow) {
                    // Remove the row from the table
                    userToDeleteRow.remove();
                    
                    // Show success message
                    alert('User deleted successfully!');
                    
                    // Close the modal
                    closeModalFunc();
                } else {
                    // If we're on the user profile page, redirect to the dashboard
                    alert('User deleted successfully!');
                    closeModalFunc();
                    window.location.href = 'dashboard.php';
                }
            }
        });
    }
    
    // File Upload
    const fileInput = document.getElementById('profileImage');
    const fileName = document.querySelector('.file-name');
    
    if (fileInput && fileName) {
        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                fileName.textContent = fileInput.files[0].name;
            } else {
                fileName.textContent = 'No file chosen';
            }
        });
    }
    
    // Filter Buttons
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    if (filterButtons) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // In a real application, this would filter the data
                const filter = this.getAttribute('data-filter');
                console.log('Filter by:', filter);
            });
        });
    }
    
    // Form Validation
    const addUserForm = document.getElementById('addUserForm');
    const editUserForm = document.getElementById('editUserForm');
    
    function validateForm(form) {
        const password = form.querySelector('#password');
        const confirmPassword = form.querySelector('#confirmPassword');
        
        if (password && confirmPassword && password.value !== '' && password.value !== confirmPassword.value) {
            alert('Passwords do not match!');
            return false;
        }
        
        return true;
    }
    
    // Add User Form Handling - Updated to store data in localStorage
    if (addUserForm) {
        console.log('Add User Form found');
        
        addUserForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Add User Form submitted');
            
            if (!validateForm(this)) {
                console.log('Form validation failed');
                return;
            }
            
            // Collect form data
            const userData = {
                id: Math.floor(Math.random() * 1000) + 6, // Generate random ID for demo
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                role: document.getElementById('role').value,
                status: document.getElementById('status').value,
                registrationDate: document.getElementById('registrationDate').value,
                address: document.getElementById('address').value,
                city: document.getElementById('city').value,
                state: document.getElementById('state').value,
                zipCode: document.getElementById('zipCode').value,
                country: document.getElementById('country').value,
                profileImage: fileInput && fileInput.files.length > 0 
                    ? "https://randomuser.me/api/portraits/men/1.jpg" // Use a static URL for demo
                    : "https://randomuser.me/api/portraits/men/1.jpg"
            };
            
            console.log('User data collected:', userData);
            
            // Store the new user data in localStorage
            localStorage.setItem('newUser', JSON.stringify(userData));
            console.log('User data saved to localStorage');
            
            // Show success message
            alert('User added successfully!');
            
            // Redirect to dashboard - IMPORTANT: Make sure this matches your actual dashboard page name
            window.location.href = 'dashboard.php';
        });
    }
    
    // Edit User Form Handling
    if (editUserForm) {
        // Capture the user ID being edited
        const urlParams = new URLSearchParams(window.location.search);
        const userId = urlParams.get('id');
        
        // Handle password validation
        const password = editUserForm.querySelector('#password');
        const confirmPassword = editUserForm.querySelector('#confirmPassword');
        
        if (password && confirmPassword) {
            confirmPassword.addEventListener('input', function() {
                if (password.value && password.value !== confirmPassword.value) {
                    confirmPassword.classList.add('error');
                } else {
                    confirmPassword.classList.remove('error');
                }
            });
        }
        
        // Handle form submission
        editUserForm.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            } else {
                // For demo purposes, prevent actual form submission
                e.preventDefault();
                
                // Capture all the edited user data
                const userData = {
                    id: userId,
                    firstName: document.getElementById('firstName').value,
                    lastName: document.getElementById('lastName').value,
                    email: document.getElementById('email').value,
                    role: document.getElementById('role').value,
                    status: document.getElementById('status').value,
                    phone: document.getElementById('phone').value,
                    // Capture profile image if changed
                    profileImageChanged: fileInput && fileInput.files.length > 0
                };
                
                // Store the edited user data in localStorage to use it on the dashboard
                localStorage.setItem('editedUser', JSON.stringify(userData));
                
                // Show success message
                alert('User updated successfully!');
                
                // Redirect to dashboard
                window.location.href = 'dashboard.php';
            }
        });
    }
    
    // Function to check for edited user data and update the table
    function checkForEditedUser() {
        const editedUserData = localStorage.getItem('editedUser');
        
        if (editedUserData) {
            console.log('Found edited user data:', editedUserData);
            
            try {
                const userData = JSON.parse(editedUserData);
                
                // Find the user row in the table
                const userRows = document.querySelectorAll('tr');
                let userRow = null;
                
                userRows.forEach(row => {
                    const idCell = row.querySelector('td:first-child');
                    if (idCell && idCell.textContent === userData.id) {
                        userRow = row;
                    }
                });
                
                if (userRow) {
                    // Update the user information in the table
                    const userNameElement = userRow.querySelector('.user-info span');
                    if (userNameElement) {
                        userNameElement.textContent = `${userData.firstName} ${userData.lastName}`;
                    }
                    
                    const emailCell = userRow.querySelector('td:nth-child(3)');
                    if (emailCell) {
                        emailCell.textContent = userData.email;
                    }
                    
                    const roleCell = userRow.querySelector('td:nth-child(4) .badge');
                    if (roleCell) {
                        // Update role badge
                        roleCell.className = ''; // Clear existing classes
                        roleCell.classList.add('badge');
                        
                        // Add appropriate badge class based on role
                        switch (userData.role) {
                            case 'admin':
                                roleCell.classList.add('badge-admin');
                                roleCell.textContent = 'Administrator';
                                break;
                            case 'agent':
                                roleCell.classList.add('badge-agent');
                                roleCell.textContent = 'Agent';
                                break;
                            case 'premium':
                                roleCell.classList.add('badge-premium');
                                roleCell.textContent = 'Premium User';
                                break;
                            case 'regular':
                                roleCell.classList.add('badge-regular');
                                roleCell.textContent = 'Regular User';
                                break;
                        }
                    }
                    
                    const statusCell = userRow.querySelector('td:nth-child(5) .badge');
                    if (statusCell) {
                        // Update status badge
                        statusCell.className = ''; // Clear existing classes
                        statusCell.classList.add('badge');
                        
                        // Add appropriate badge class based on status
                        switch (userData.status) {
                            case 'active':
                                statusCell.classList.add('badge-active');
                                statusCell.textContent = 'Active';
                                break;
                            case 'inactive':
                                statusCell.classList.add('badge-inactive');
                                statusCell.textContent = 'Inactive';
                                break;
                            case 'suspended':
                                statusCell.classList.add('badge-suspended');
                                statusCell.textContent = 'Suspended';
                                break;
                        }
                    }
                    
                    // If profile image was changed, we would update it here
                    // In a real application, you would have the new image URL
                    
                    console.log('Updated edited user in table');
                    
                    // Clear the edited user data from localStorage
                    localStorage.removeItem('editedUser');
                } else {
                    console.log('Could not find user row to update');
                }
            } catch (error) {
                console.error('Error processing edited user data:', error);
            }
        }
    }
    
    // Function to check for new user data and update the table
    function checkForNewUser() {
        const newUserData = localStorage.getItem('newUser');
        
        if (newUserData) {
            console.log('Found new user data:', newUserData);
            
            try {
                const userData = JSON.parse(newUserData);
                
                // Get the table body - IMPORTANT: Make sure this selector matches your actual table
                const tableBody = document.querySelector('.data-table tbody');
                console.log('Table body found:', tableBody !== null);
                
                if (tableBody) {
                    // Create a new row for the user
                    const newRow = document.createElement('tr');
                    
                    // Format the registration date
                    let formattedDate = 'N/A';
                    try {
                        const regDate = new Date(userData.registrationDate);
                        formattedDate = regDate.toLocaleDateString('en-US', {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric'
                        });
                    } catch (e) {
                        console.error('Error formatting date:', e);
                    }
                    
                    // Set the role badge class and text
                    let roleBadgeClass = 'badge-regular';
                    let roleText = 'Regular';
                    
                    switch (userData.role) {
                        case 'admin':
                            roleBadgeClass = 'badge-admin';
                            roleText = 'Administrator';
                            break;
                        case 'agent':
                            roleBadgeClass = 'badge-agent';
                            roleText = 'Agent';
                            break;
                        case 'premium':
                            roleBadgeClass = 'badge-premium';
                            roleText = 'Premium';
                            break;
                    }
                    
                    // Set the status badge class and text
                    let statusBadgeClass = 'badge-active';
                    let statusText = 'Active';
                    
                    switch (userData.status) {
                        case 'inactive':
                            statusBadgeClass = 'badge-inactive';
                            statusText = 'Inactive';
                            break;
                        case 'suspended':
                            statusBadgeClass = 'badge-suspended';
                            statusText = 'Suspended';
                            break;
                    }
                    
                    // Set the row HTML
                    newRow.innerHTML = `
                        <td>${userData.id}</td>
                        <td>
                            <div class="user-info">
                                <img src="${userData.profileImage}" alt="${userData.firstName} ${userData.lastName}">
                                <span>${userData.firstName} ${userData.lastName}</span>
                            </div>
                        </td>
                        <td>${userData.email}</td>
                        <td><span class="badge ${roleBadgeClass}">${roleText}</span></td>
                        <td><span class="badge ${statusBadgeClass}">${statusText}</span></td>
                        <td>${formattedDate}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="EditUser.php?id=${userData.id}" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn-delete" title="Delete" data-id="${userData.id}"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    `;
                    
                    console.log('New row created');
                    
                    // Insert the new row at the top of the table
                    if (tableBody.firstChild) {
                        tableBody.insertBefore(newRow, tableBody.firstChild);
                    } else {
                        tableBody.appendChild(newRow);
                    }
                    
                    console.log('New row added to table');
                    
                    // Update the total users count in the stats card
                    const totalUsersElement = document.querySelector('.stat-card:first-child .stat-details h3');
                    if (totalUsersElement) {
                        const currentCount = parseInt(totalUsersElement.textContent);
                        totalUsersElement.textContent = (currentCount + 1).toString();
                        console.log('Updated user count to:', currentCount + 1);
                    } else {
                        console.log('Could not find total users element');
                    }
                    
                    // Add event listener to the new delete button
                    const newDeleteBtn = newRow.querySelector('.btn-delete');
                    if (newDeleteBtn) {
                        newDeleteBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            
                            // Get the user ID from the data-id attribute
                            const userId = this.getAttribute('data-id');
                            
                            // Get the table row (tr) that contains this button
                            const tableRow = this.closest('tr');
                            
                            // Open the delete modal
                            openModal(userId, tableRow);
                        });
                        console.log('Added delete event listener to new row');
                    }
                    
                    // Clear the new user data from localStorage AFTER we've used it
                    localStorage.removeItem('newUser');
                    console.log('Cleared new user data from localStorage');
                } else {
                    console.error('Could not find table body element');
                }
            } catch (error) {
                console.error('Error processing new user data:', error);
            }
        } else {
            console.log('No new user data found in localStorage');
        }
    }
    
    // Search Functionality
    const searchInput = document.getElementById('userSearch');
    
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                // In a real application, this would search for users
                console.log('Search for:', this.value);
            }
        });
    }
    
    // Property Form Specific Functions
    const addPropertyForm = document.getElementById('addPropertyForm');
    if (addPropertyForm) {
        // Handle property form submission
        addPropertyForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            const requiredFields = addPropertyForm.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                } else {
                    field.classList.remove('error');
                }
            });
            
            if (isValid) {
                // For demo purposes
                alert('Property added successfully!');
                window.location.href = 'dashboard.php';
            } else {
                alert('Please fill in all required fields.');
            }
        });
    }
    
    // Handle image preview for profile image upload
    const profileImageInput = document.getElementById('profileImage');
    if (profileImageInput) {
        profileImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                const profileImage = document.querySelector('.user-avatar img');
                
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
    
    // Message form handling
    const messageForm = document.querySelector('.message-form');
    if (messageForm) {
        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const subject = document.getElementById('messageSubject');
            const content = document.getElementById('messageContent');
            
            if (!subject.value.trim() || !content.value.trim()) {
                alert('Please fill in all message fields.');
                return;
            }
            
            // For demo purposes
            alert('Message sent successfully!');
            subject.value = '';
            content.value = '';
        });
    }
});