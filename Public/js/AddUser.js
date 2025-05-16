document.addEventListener("DOMContentLoaded", () => {
  // Sidebar Toggle
  const sidebarToggle = document.getElementById("sidebarToggle")
  const sidebar = document.querySelector(".sidebar")

  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", () => {
      sidebar.classList.toggle("collapsed")
    })
  }

  // File Upload
  const fileInput = document.getElementById("profileImage")
  const fileName = document.querySelector(".file-name")
  const userAvatar = document.querySelector(".user-avatar img")

  if (fileInput && fileName) {
    fileInput.addEventListener("change", () => {
      if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name

        // Preview the image
        const reader = new FileReader()
        reader.onload = (e) => {
          userAvatar.src = e.target.result
        }
        reader.readAsDataURL(fileInput.files[0])
      } else {
        fileName.textContent = "No file chosen"
      }
    })
  }

  // Set default registration date to today
  const registrationDate = document.getElementById("registrationDate")
  if (registrationDate) {
    const today = new Date()
    const year = today.getFullYear()
    let month = today.getMonth() + 1
    let day = today.getDate()

    // Add leading zeros if needed
    month = month < 10 ? "0" + month : month
    day = day < 10 ? "0" + day : day

    registrationDate.value = `${year}-${month}-${day}`
  }

  // Form Validation and Submission
  const addUserForm = document.getElementById("addUserForm")
  const successModal = document.getElementById("successModal")
  const closeModal = document.querySelector(".close-modal")
  const successOkBtn = document.getElementById("successOkBtn")

  // Function to open modal
  function openModal() {
    if (successModal) {
      successModal.classList.add("active")
    }
  }

  // Function to close modal
  function closeModalFunc() {
    if (successModal) {
      successModal.classList.remove("active")
    }
  }

  // Close modal when clicking the close button
  if (closeModal) {
    closeModal.addEventListener("click", closeModalFunc)
  }

  // Handle OK button click
  if (successOkBtn) {
    successOkBtn.addEventListener("click", () => {
      closeModalFunc()
      // Redirect to dashboard
      window.location.href = "dashboard.php"
    })
  }

  // Update the form submission handler to ensure data is properly saved
  if (addUserForm) {
    addUserForm.addEventListener("submit", (e) => {
      e.preventDefault()

      // Validate form
      const password = document.getElementById("password")
      const confirmPassword = document.getElementById("confirmPassword")

      if (password.value !== confirmPassword.value) {
        alert("Passwords do not match!")
        return
      }

      // Collect form data
      const userData = {
        id: Math.floor(Math.random() * 1000) + 6, // Generate random ID for demo
        firstName: document.getElementById("firstName").value,
        lastName: document.getElementById("lastName").value,
        username: document.getElementById("username").value,
        email: document.getElementById("email").value,
        phone: document.getElementById("phone").value,
        role: document.getElementById("role").value,
        status: document.getElementById("status").value,
        registrationDate: document.getElementById("registrationDate").value,
        address: document.getElementById("address").value,
        city: document.getElementById("city").value,
        state: document.getElementById("state").value,
        zipCode: document.getElementById("zipCode").value,
        country: document.getElementById("country").value,
        profileImage:
          fileInput && fileInput.files.length > 0
            ? "https://randomuser.me/api/portraits/men/1.jpg" // Use a static URL for demo
            : "https://randomuser.me/api/portraits/men/1.jpg",
      }

      // Store the new user data in localStorage
      localStorage.setItem("newUser", JSON.stringify(userData))

      // Show success modal
      openModal()
    })
  }
})
