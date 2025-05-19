<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Messages</title>
  <link rel="stylesheet" href="/REALSTATE/Public/css/messages.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
:root {
  /* Color system */
  --primary-color: #bd8c4c;
  --primary-light: #e6c18a;
  --primary-lighter: #f0dfc0;
  --primary-dark: #96703c;
  --primary-darker: #6e512c;
  
  /* Text colors */
  --text-dark: #2a2a2a;
  --text-medium: #545454;
  --text-light: #ffffff;
  --text-muted: #888888;
  
  /* Background colors */
  --bg-dark: #121212;
  --bg-medium: #1e1e1e;
  --bg-light: #ffffff;
  --bg-lighter: #f8f8f8;
  
  /* Accent colors */
  --accent-blue: #3a7bd5;
  --accent-red: #d53a3a;
  --accent-green: #3ad55f;
  
  /* Shadow system */
  --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.05);
  --shadow-md: 0 8px 20px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 12px 28px rgba(0, 0, 0, 0.15);
  --shadow-xl: 0 25px 50px rgba(0, 0, 0, 0.2);
  
  /* Transitions */
  --transition-fast: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  --transition-medium: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  --transition-slow: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  
  /* Border radius */
  --border-radius-sm: 4px;
  --border-radius-md: 8px;
  --border-radius-lg: 16px;
  --border-radius-xl: 24px;
  --border-radius-circle: 50%;
  
  /* Layout */
  --container-padding: 5%;
  --container-max-width: 1440px;
  --section-spacing: 10rem;
  --element-spacing: 2rem;
  
  /* Effects */
  --blur-strength: 10px;
  --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
  --gradient-dark: linear-gradient(135deg, var(--bg-medium) 0%, var(--bg-dark) 100%);
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

@keyframes slideIn {
  from { transform: translateX(-20px); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}

@keyframes glow {
  0% { box-shadow: 0 0 5px rgba(189, 140, 76, 0.5); }
  50% { box-shadow: 0 0 20px rgba(189, 140, 76, 0.8); }
  100% { box-shadow: 0 0 5px rgba(189, 140, 76, 0.5); }
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  font-size: 62.5%; /* For easy rem calculations - 1rem = 10px */
  scroll-behavior: smooth;
}

body {
  color: var(--text-light);
  background: var(--gradient-dark);
  font-family: 'Poppins', 'Arial', sans-serif;
  font-size: 1.6rem;
  line-height: 1.6;
  overflow-x: hidden;
  position: relative;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

body::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('https://api.placeholder.com/400/320') center/cover no-repeat;
  opacity: 0.03;
  z-index: -1;
}

.container {
  width: 90%;
  max-width: var(--container-max-width);
  margin: 0 auto;
  padding: 2rem 0;
}

/* Navbar Styles */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 2rem var(--container-padding);
  background-color: rgba(18, 18, 18, 0.95);
  position: sticky;
  top: 0;
  width: 100%;
  z-index: 1000;
  backdrop-filter: blur(var(--blur-strength));
  -webkit-backdrop-filter: blur(var(--blur-strength));
  box-shadow: var(--shadow-md);
  transition: all var(--transition-medium);
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.navbar.scrolled {
  padding: 1.5rem var(--container-padding);
  background-color: rgba(18, 18, 18, 0.98);
  box-shadow: var(--shadow-lg);
}

.logo {
  font-weight: 700;
  font-size: 2.4rem;
  color: var(--text-light);
  position: relative;
  text-decoration: none;
  display: flex;
  align-items: center;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.logo::before {
  content: "";
  position: absolute;
  width: 50%;
  height: 4px;
  background: var(--gradient-primary);
  bottom: -8px;
  left: 0;
  transform: scaleX(0);
  transform-origin: left;
  transition: transform var(--transition-medium);
  border-radius: var(--border-radius-sm);
}

.logo:hover::before {
  transform: scaleX(1);
}

.logo::after {
  content: "";
  display: inline-block;
  width: 8px;
  height: 8px;
  background-color: var(--primary-color);
  border-radius: var(--border-radius-circle);
  margin-left: 5px;
  animation: pulse var(--transition-slow) infinite;
}

nav {
  display: flex;
  gap: 3.5rem;
  align-items: center;
}

nav a {
  text-decoration: none;
  color: var(--text-light);
  font-size: 1.5rem;
  font-weight: 500;
  position: relative;
  transition: color var(--transition-fast);
  padding: 0.5rem 0;
}

nav a::after {
  content: "";
  position: absolute;
  width: 100%;
  height: 2px;
  background: var(--gradient-primary);
  bottom: -4px;
  left: 0;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform var(--transition-fast);
  border-radius: var(--border-radius-sm);
}

nav a:hover {
  color: var(--primary-light);
}

nav a:hover::after {
  transform: scaleX(1);
}

nav span {
  padding: 0.5rem 1rem;
  background-color: rgba(255, 255, 255, 0.05);
  border-radius: var(--border-radius-md);
  font-weight: 500;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.hamburger {
  display: none;
  cursor: pointer;
  background: none;
  border: none;
}

.hamburger span {
  display: block;
  width: 25px;
  height: 3px;
  background-color: var(--text-light);
  margin: 5px 0;
  transition: all var(--transition-fast);
}

.sign-up-btn {
  background: var(--gradient-primary);
  color: var(--text-light);
  padding: 1.2rem 2.4rem;
  border-radius: var(--border-radius-md);
  text-decoration: none;
  font-weight: 600;
  font-size: 1.5rem;
  position: relative;
  overflow: hidden;
  z-index: 1;
  transition: all var(--transition-medium);
  box-shadow: 0 4px 12px rgba(189, 140, 76, 0.3);
  letter-spacing: 0.5px;
  text-transform: uppercase;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.sign-up-btn::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: var(--primary-dark);
  z-index: -1;
  transform: scaleX(0);
  transform-origin: right;
  transition: transform var(--transition-medium);
}

.sign-up-btn:hover {
  box-shadow: 0 6px 16px rgba(189, 140, 76, 0.5);
  transform: translateY(-2px);
}

.sign-up-btn:hover::before {
  transform: scaleX(1);
  transform-origin: left;
}

.sign-up-btn:active {
  transform: translateY(0);
  box-shadow: 0 4px 8px rgba(189, 140, 76, 0.3);
}

/* Main content */
main {
  flex: 1;
  padding: 4rem var(--container-padding);
  display: flex;
  flex-direction: column;
  align-items: center;
}

h1 {
  font-size: 3.6rem;
  font-weight: 700;
  color: var(--primary-light);
  margin-bottom: 3rem;
  text-align: center;
  position: relative;
  display: inline-block;
  animation: fadeIn var(--transition-slow) forwards;
}

h1::after {
  content: "";
  position: absolute;
  width: 60%;
  height: 4px;
  background: var(--gradient-primary);
  bottom: -10px;
  left: 20%;
  border-radius: var(--border-radius-sm);
}

.messages-container {
  width: 100%;
  max-width: 800px;
  background-color: rgba(30, 30, 30, 0.7);
  border-radius: var(--border-radius-lg);
  padding: 3rem;
  box-shadow: var(--shadow-lg);
  backdrop-filter: blur(5px);
  border: 1px solid rgba(255, 255, 255, 0.05);
  animation: fadeIn var(--transition-medium) forwards;
  animation-delay: 0.2s;
  opacity: 0;
}

.notification {
  background: rgba(255, 255, 255, 0.05);
  padding: 2rem;
  margin-bottom: 1.5rem;
  border-radius: var(--border-radius-md);
  box-shadow: var(--shadow-sm);
  transition: all var(--transition-medium);
  position: relative;
  overflow: hidden;
  border-left: 4px solid var(--accent-blue);
  animation: slideIn var(--transition-medium) forwards;
  animation-delay: calc(var(--i, 0) * 0.1s);
  opacity: 0;
}

.notification:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-md);
  background: rgba(255, 255, 255, 0.08);
}

.notification::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 4px;
  height: 100%;
  background: var(--accent-blue);
  opacity: 0.7;
}

.notification.read {
  border-left-color: var(--text-muted);
  opacity: 0.7;
}

.notification.read::before {
  background: var(--text-muted);
}

.notification p {
  margin-bottom: 1rem;
  font-size: 1.6rem;
  line-height: 1.6;
}

.notification small {
  display: block;
  color: var(--text-muted);
  font-size: 1.2rem;
  font-style: italic;
}

.notification-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.notification-time {
  font-size: 1.2rem;
  color: var(--text-muted);
}

.notification.unread::after {
  content: '';
  position: absolute;
  top: 2rem;
  right: 2rem;
  width: 10px;
  height: 10px;
  background-color: var(--accent-blue);
  border-radius: var(--border-radius-circle);
  animation: glow var(--transition-slow) infinite;
}

.empty-message {
  text-align: center;
  padding: 4rem;
  color: var(--text-muted);
  font-style: italic;
  font-size: 1.8rem;
}

.empty-message i {
  display: block;
  font-size: 5rem;
  margin-bottom: 2rem;
  color: var(--primary-color);
  opacity: 0.5;
}

/* Footer */
footer {
  background-color: rgba(18, 18, 18, 0.95);
  padding: 2rem var(--container-padding);
  text-align: center;
  border-top: 1px solid rgba(255, 255, 255, 0.05);
}

footer p {
  color: var(--text-muted);
  font-size: 1.4rem;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}

::-webkit-scrollbar-track {
  background: var(--bg-medium);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  background: var(--primary-color);
  border-radius: 10px;
  transition: var(--transition-fast);
}

::-webkit-scrollbar-thumb:hover {
  background: var(--primary-dark);
}

/* Media Queries */
@media (max-width: 992px) {
  html {
    font-size: 60%;
  }
  
  nav {
    gap: 2.5rem;
  }
}

@media (max-width: 768px) {
  html {
    font-size: 58%;
  }
  
  .navbar {
    padding: 1.5rem var(--container-padding);
  }
  
  nav {
    gap: 2rem;
  }
  
  .sign-up-btn {
    padding: 1rem 2rem;
  }
  
  .messages-container {
    padding: 2rem;
  }
}

@media (max-width: 576px) {
  html {
    font-size: 55%;
  }
  
  .navbar {
    padding: 1rem var(--container-padding);
  }
  
  nav {
    display: none;
  }
  
  .hamburger {
    display: block;
  }
  
  .messages-container {
    padding: 1.5rem;
  }
  
  .notification {
    padding: 1.5rem;
  }
}
</style>
<body>
<header class="navbar">
    <a href="http://localhost/REALSTATE/index.php?page=home" class="logo">HOUSOFT</a>
    <nav>
      
      <a href="/REALSTATE/index.php?page=properties"><i class="fas fa-building"></i> Properties</a>
      <a href="#"><i class="fas fa-concierge-bell"></i> Services</a>
      <a href="/REALSTATE/index.php?page=profile"><i class="fa-solid fa-user"></i> Profile →</a>
      <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'agent'): ?>
        <a href="/REALSTATE/index.php?page=agentMessages"><i class="fas fa-envelope"></i> Messages</a>
      <?php endif; ?>
      <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'agent'): ?>
        <a href="/REALSTATE/App/View/AddProperty.php"><i class="fas fa-plus-circle"></i> Add Property</a> 
      <?php endif; ?>
      <?php if (isset($_SESSION['user_name'])): ?>
        <span><i class="fas fa-user-circle"></i> Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
        <a href="index.php?page=login&action=logout" class="sign-up-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
      <?php else: ?>
        <a href="index.php?page=signup" class="sign-up-btn"><i class="fas fa-user-plus"></i> Sign Up</a>
      <?php endif; ?>
    </nav>
    <button class="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </header>
  
  <main>
    <h1>Your Messages</h1>
    
    <div class="messages-container">
      <?php if (empty($notifications)): ?>
        <div class="empty-message">
          <i class="fas fa-inbox"></i>
          <p>No new notifications yet.</p>
        </div>
      <?php else: ?>
        <?php foreach ($notifications as $index => $note): ?>
          <div class="notification <?= $note['is_read'] ? 'read' : 'unread' ?>" style="--i: <?= $index ?>">
            <div class="notification-header">
              <div class="notification-status">
                <?php if (!$note['is_read']): ?>
                  <span><i class="fas fa-circle" style="color: var(--accent-blue); font-size: 0.8rem;"></i> New</span>
                <?php else: ?>
                  <span><i class="far fa-check-circle" style="color: var(--text-muted);"></i> Read</span>
                <?php endif; ?>
              </div>
              <div class="notification-time">
                <i class="far fa-clock"></i> <?= htmlspecialchars($note['created_at']) ?>
              </div>
            </div>
            <p><?= htmlspecialchars($note['message']) ?></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>

  <footer>
    <p>&copy; <?= date('Y') ?> HOUSOFT. All rights reserved.</p>
  </footer>

  <script>
    // Simple JavaScript for navbar scrolling effect
    document.addEventListener('DOMContentLoaded', function() {
      const navbar = document.querySelector('.navbar');
      
      window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
      });
      
      // Add animation delay to notifications
      const notifications = document.querySelectorAll('.notification');
      notifications.forEach((notification, index) => {
        notification.style.setProperty('--i', index);
      });
    });
  </script>
</body>
</html>