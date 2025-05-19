<?php
require_once __DIR__ . '/../Config/Database.php';
use App\Config\Database;

$conn = Database::getInstance()->getConnection();

if (!isset($_GET['id'])) {
    echo "No property selected.";
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM properties WHERE id = :id");
$stmt->execute([':id' => $id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    echo "Property not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Property Details</title>
  <link rel="stylesheet" href="/REALSTATE/Public/css/Details.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
   <link rel="stylesheet" href="/REALSTATE/Public/css/HomePageeee.css">
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


.des {
    max-width: 1200px;
    margin: 20px auto;
    background:#121212;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 20px rgba(14, 14, 14, 0.2);
}

.property-container {
    padding: 20px;
}

/* Header Styles */
.property-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.property-address {
    font-size: 36px;
    font-weight: 700;
    color:white;
    margin-bottom: 5px;
}

.property-price-tag {
    font-size: 20px;
    font-weight: 600;
    color: #d9b078;
}

.purchase-button {
    background-color: #222;
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: background-color 0.3s;
}

.purchase-button:hover {
    background-color: #000;
}

/* Property Features */
.property-features {
    display: flex;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 15px 0;
    color:white;
    margin-bottom: 20px;
}

.feature {
    display: flex;
    color:white;
    align-items: center;
    margin-right: 30px;
}

.feature i {
    margin-right: 8px;
   
    font-size: 18px;
    color:#d9b078;
}

.feature span {
    font-size: 16px;
    color:white;
    font-weight: 500;
}

/* Property Content Layout */
.property-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

/* Property Image Section */
.property-image-container {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
}

.property-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
}

.image-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.7);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 20px;
    font-weight: bold;
    color: #444;
    transition: background 0.3s;
}

.image-nav:hover {
    background: rgba(255, 255, 255, 0.9);
}

.prev {
    left: 15px;
}

.next {
    right: 15px;
}

.image-dots {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
}

.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
}

.dot.active {
    background: white;
}

/* Property Details Section */
.property-details {
    display: flex;
    color:white;
    flex-direction: column;
}

.property-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 10px;
    color: white;
}
.property-description {
    
  
    margin-bottom: 20px;
    line-height: 1.6;
    font-size: 15px;
}
.read-more {
    color: #0066cc;
    text-decoration: none;
    font-weight: 500;
}

/* Property Statistics */
.property-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.stat-box {
    background-color:rgb(38, 38, 38);
    border-radius: 8px;
    color:white;
    padding: 15px;
}

.stat-title {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 5px;
    color:#bd8c4c;
    font-size: 14px;
}

.stat-title i {
    color: white;
}

.stat-value {
    font-size: 18px;
    font-weight: 600;
      color: white;
}

.stat-subvalue {
    font-size: 12px;
    color: #999;
    font-weight: normal;
}

/* Potential Value Section */
.potential-value {
    background-color:rgb(40, 40, 40);
    border-radius: 8px;
    padding: 15px;
    margin-top: 10px;
}

.potential-value-title {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 15px;
    font-size: 16px;
      color: white;
    font-weight: 600;
}

.confidence-tag {
    background-color: #4caf50;
    color: white;
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 4px;
    margin-left: 10px;
}

.value-ranges {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.range-box {
    flex: 1;
    text-align: center;
    background-color:#121212;
    border-radius: 6px;
    padding: 10px;
    
    
    
}

.range-label {
    font-size: 14px;
   color:white;
    margin-bottom: 5px;
}

.range-value {
    font-size: 16px;
    font-weight: 600;
    color:rgb(220, 169, 42);
}

/* For the Airbnb-like design from the image */
/* Additional styles to match more closely to the image */
.property-container {
    border-radius: 12px;
    overflow: hidden;
}

/* Modern property listing style similar to image */
.property-address {
    font-size: 26px;
    font-weight: 700;
}

.property-features {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    border: none;
    gap: 10px;
    margin: 20px 0;
}

.feature {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 15px 10px;
    border: 1px solid #eee;
    border-radius: 8px;
    margin-right: 0;
}

.feature i {
    font-size: 20px;
    margin-right: 0;
    margin-bottom: 8px;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    .property-content {
        grid-template-columns: 1fr;
    }
    
    .property-stats {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .property-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .purchase-button {
        margin-top: 15px;
    }
    
    .property-features {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .property-stats {
        grid-template-columns: 1fr;
    }
    
    .value-ranges {
        flex-direction: column;
    }
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.84);
  backdrop-filter: blur(5px);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  opacity: 0;
  visibility: hidden;
  transition: var(--transition);
}

.modal-overlay.active {
  opacity: 1;
  visibility: visible;
}

/* Modal Content */
.modal-content {
  background-color:rgba(18, 18, 18, 0.81);
  width: 90%;
  max-width: 500px;
  border-radius: var(--border-radius);
  overflow: hidden;
  box-shadow: var(--shadow-lg);
  transform: translateY(20px);
  transition: var(--transition);
  position: relative;
  animation: modalSlideIn 0.4s ease forwards;
}

@keyframes modalSlideIn {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Modal Header */
.modal-content h2 {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
  color: var(--white);
  padding: 20px;
  font-size: 24px;
  font-weight: 600;
  margin: 0;
  text-align: center;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  position: relative;
}

.modal-content h2::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 50px;
  height: 3px;
  background-color: var(--accent-color);
  border-radius: 3px 3px 0 0;
}

/* Close Button */
.close-btn {
  position: absolute;
  top: 15px;
  right: 15px;
  font-size: 24px;
  color: rgba(255, 255, 255, 0.8);
  cursor: pointer;
  transition: var(--transition);
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background-color: rgb(255, 0, 0);
}

.close-btn:hover {
  color: var(--white);
  background-color: rgba(255, 255, 255, 0.2);
  transform: rotate(90deg);
}

/* Form Styling */
.modal-content form {
  padding: 25px;
  display: grid;
  gap: 18px;
}

.modal-content label {
  font-weight: 500;
  display: block;
  margin-bottom: 6px;
  color: var(--primary-color);
  font-size: 14px;
  transition: var(--transition);
}

.modal-content input,
.modal-content textarea {
  width: 100%;
  padding: 12px 15px;
  border: 1px solid #dcdfe6;
  border-radius: var(--border-radius);
  font-family: 'Poppins', sans-serif;
  transition: var(--transition);
  background-color:#121212;
  color: var(--text-color);
  font-size: 15px;
}

.modal-content input:focus,
.modal-content textarea:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(44, 62, 80, 0.1);
  background-color: var(--white);
}

.modal-content input:focus + label,
.modal-content textarea:focus + label {
  color: var(--primary-color);
}

.modal-content input::placeholder,
.modal-content textarea::placeholder {
  color: var(--text-light);
  opacity: 0.7;
}

/* Date and Time Inputs Styling */
input[type="date"],
input[type="time"] {
  appearance: none;
  -webkit-appearance: none;
  background-image: url("data:image/svg+xml;utf8,<svg fill='%232c3e50' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
  background-repeat: no-repeat;
  background-position: right 10px center;
  padding-right: 30px;
}

/* Submit Button */
.modal-submit-btn {
  background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
  color: var(--white);
  border: none;
  padding: 14px 20px;
  border-radius: var(--border-radius);
  cursor: pointer;
  font-weight: 600;
  font-size: 16px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: var(--transition);
  position: relative;
  overflow: hidden;
  margin-top: 10px;
}

.modal-submit-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: 0.5s;
}

.modal-submit-btn:hover {
  box-shadow: 0 7px 15px rgba(231, 76, 60, 0.3);
  transform: translateY(-2px);
}

.modal-submit-btn:hover::before {
  left: 100%;
}

.modal-submit-btn:active {
  transform: translateY(1px);
}

/* Form Group Animation */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.modal-content form > * {
  animation: fadeIn 0.5s ease forwards;
  opacity: 0;
}

.modal-content form > *:nth-child(1) { animation-delay: 0.1s; }
.modal-content form > *:nth-child(2) { animation-delay: 0.15s; }
.modal-content form > *:nth-child(3) { animation-delay: 0.2s; }
.modal-content form > *:nth-child(4) { animation-delay: 0.25s; }
.modal-content form > *:nth-child(5) { animation-delay: 0.3s; }
.modal-content form > *:nth-child(6) { animation-delay: 0.35s; }
.modal-content form > *:nth-child(7) { animation-delay: 0.4s; }
.modal-content form > *:nth-child(8) { animation-delay: 0.45s; }
.modal-content form > *:nth-child(9) { animation-delay: 0.5s; }
.modal-content form > *:nth-child(10) { animation-delay: 0.55s; }

/* Textarea Styling */
textarea {
  resize: vertical;
  min-height: 80px;
  max-height: 150px;
  line-height: 1.5;
  transition: height 0.2s ease;
}

/* Custom Focus Effect for Fields */
input:not(:placeholder-shown),
textarea:not(:placeholder-shown) {
  border-color: #a0aec0;
}

/* Success State */
input.valid,
textarea.valid {
  border-color: var(--success-color);
  background-image: url("data:image/svg+xml;utf8,<svg fill='%2327ae60' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M0 0h24v24H0z' fill='none'/><path d='M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z'/></svg>");
  background-repeat: no-repeat;
  background-position: right 10px center;
  background-size: 20px 20px;
  padding-right: 40px;
}

/* Error State */
input.error,
textarea.error {
  border-color: var(--accent-color);
  background-image: url("data:image/svg+xml;utf8,<svg fill='%23e74c3c' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M0 0h24v24H0z' fill='none'/><path d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z'/></svg>");
  background-repeat: no-repeat;
  background-position: right 10px center;
  background-size: 20px 20px;
  padding-right: 40px;
}

/* Error Message */
.error-message {
  color: var(--accent-color);
  font-size: 12px;
  margin-top: 5px;
  display: none;
}

input.error + .error-message,
textarea.error + .error-message {
  display: block;
  animation: fadeIn 0.3s ease forwards;
}

/* Responsive Styles */
@media (max-width: 768px) {
  .modal-content {
    width: 95%;
    max-width: 450px;
  }
  
  .modal-content h2 {
    font-size: 20px;
    padding: 15px;
  }
  
  .modal-content form {
    padding: 20px;
  }
  
  .modal-submit-btn {
    padding: 12px 18px;
    font-size: 15px;
  }
}

@media (max-width: 480px) {
  .modal-content {
    width: 100%;
    height: 100%;
    max-width: none;
    border-radius: 0;
    display: flex;
    flex-direction: column;
  }
  
  .modal-content form {
    flex-grow: 1;
    overflow-y: auto;
    padding: 20px 15px;
  }
  
  .modal-content h2 {
    font-size: 18px;
    padding: 15px 10px;
  }
  
  .close-btn {
    top: 10px;
    right: 10px;
  }
}

/* Animation for Modal Showing */
@keyframes modalFadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.modal-overlay.show {
  animation: modalFadeIn 0.3s ease forwards;
}

/* Loading State for Submit Button */
.modal-submit-btn.loading {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
  pointer-events: none;
  position: relative;
}

.modal-submit-btn.loading::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 20px;
  height: 20px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  border-top-color: var(--white);
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}

/* JavaScript Helper Classes */
.hidden {
  display: none !important;
}

.show-modal {
  opacity: 1;
  visibility: visible;
}

/* Confirmation Message Animation */
.confirmation-message {
  background-color: var(--success-color);
  color: var(--white);
  text-align: center;
  padding: 15px;
  border-radius: var(--border-radius);
  margin-top: 15px;
  transform: translateY(-10px);
  opacity: 0;
  transition: var(--transition);
}

.confirmation-message.show {
  transform: translateY(0);
  opacity: 1;
}

/* Additional Hover Effects */
input:hover,
textarea:hover {
  border-color: #a0aec0;
}

/* Custom Scrollbar for Textarea */
textarea::-webkit-scrollbar {
  width: 8px;
}

textarea::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 4px;
}

textarea::-webkit-scrollbar-thumb {
  background: #cbd5e0;
  border-radius: 4px;
}

textarea::-webkit-scrollbar-thumb:hover {
  background: #a0aec0;
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
  



  <?php if (!empty($_SESSION['tour_error'])): ?>
  <div class="error-message" style="color: red; font-weight: bold; margin: 1rem 0;">
    <?= htmlspecialchars($_SESSION['tour_error']) ?>
  </div>
  <?php unset($_SESSION['tour_error']); ?>
<?php endif; ?>

  <section class="des">
      <div class="property-container">
        <!-- Header with address and purchase button -->
        <div class="property-header">
            <div>
                <h2 class="property-address"><?= htmlspecialchars($property['location']) ?></h2>
                <p class="property-price-tag">Offers from $<?= number_format($property['price']) ?></p>
            </div>
            <a href="#" class="purchase-button">SCHEDULE A TOUR</a>
        </div>
        
        
        <!-- Property features -->
        <div class="property-features">
            <div class="feature">
                	<i class="fas fa-bed"></i>
                <span>4 Beds</span>
            </div>
            <div class="feature">
                   <i class="fas fa-bath"></i>
                <span>4 Baths</span>
            </div>
            <div class="feature">
               <i class="fas fa-car"></i>
                <span>4 Parks</span>
            </div>
            <div class="feature">
                 <i class="fas fa-ruler-combined"></i>
                <span>579 sqm</span>
            </div>
        </div>
        
        <!-- Main content - image and property details -->
        <div class="property-content">
            <!-- Property image section with navigation -->
            <div class="property-image-container">
                <?php if (!empty($property['image'])): ?>
                <img class="property-image" src="/REALSTATE/Public/images/<?= htmlspecialchars($property['image']) ?>" alt="Property Image">
                <?php else: ?>
                <img class="property-image" src="default-property.jpg" alt="Property Image">
                <?php endif; ?>
                
                <!-- Image navigation arrows -->
                <div class="image-nav prev">❮</div>
                <div class="image-nav next">❯</div>
                
                <!-- Image pagination dots -->
                <div class="image-dots">
                    <div class="dot active"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
            
            <!-- Property details section -->
            <div class="property-details">
                <h3 class="property-title">Snap Up This Great Investment</h3>
                <p class="property-description">
                    <?= nl2br(htmlspecialchars($property['details'])) ?>
                    <a href="#" class="read-more">Read more</a>
                </p>
                
                <!-- Property statistics -->
                <div class="property-stats">
                    <!-- Median Price -->
                    <div class="stat-box">
                        <div class="stat-title">
                           <i class="fas fa-dollar-sign"></i>
                            <span>Median Price</span>
                        </div>
                        <p class="stat-value">$410,000</p>
                    </div>
                    
                    <!-- Weekly Median Rent -->
                    <div class="stat-box">
                        <div class="stat-title">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>Weekly median rent</span>
                        </div>
                        <p class="stat-value">$390</p>
                    </div>
                    
                    <!-- Potential Cashflow -->
                    <div class="stat-box">
                        <div class="stat-title">
                           <i class="fas fa-chart-line"></i>
                            <span>Potential cashflow</span>
                        </div>
                        <p class="stat-value">$20,280</p>
                    </div>
                    
                    <!-- Potential Gross Yield -->
                    <div class="stat-box">
                        <div class="stat-title">
                            <i class="fas fa-percentage"></i>
                            <span>Potential gross yield</span>
                        </div>
                        <p class="stat-value">5.2 %</p>
                    </div>
                    
                    <!-- Vacancy Rate -->
                    <div class="stat-box">
                        <div class="stat-title">
                           <i class="fas fa-home"></i>
                            <span>Vacancy rate</span>
                        </div>
                        <p class="stat-value">0.6%</p>
                    </div>
                    
                    <!-- Listed Date -->
                    <div class="stat-box">
                        <div class="stat-title">
                            <i class="fas fa-clock"></i>
                            <span>Listed</span>
                        </div>
                        <p class="stat-value">31 <span class="stat-subvalue">DAYS AGO</span></p>
                    </div>
                </div>
                
                <!-- Potential Value Section -->
                <div class="potential-value">
                    <div class="potential-value-title">
                          <i class="fas fa-bullseye"></i>
                        <span>Potential value</span>
                        <span class="confidence-tag">High Confidence</span>
                    </div>
                    
                    <div class="value-ranges">
                        <div class="range-box">
                            <div class="range-label">Low Range</div>
                            <div class="range-value">$340,000</div>
                        </div>
                        <div class="range-box">
                            <div class="range-label">Mid Range</div>
                            <div class="range-value">$365,000</div>
                        </div>
                        <div class="range-box">
                            <div class="range-label">High Range</div>
                            <div class="range-value">$396,000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Schedule Tour Modal -->
<div class="modal-overlay" id="scheduleModal">
  <div class="modal-content">
    <span class="close-btn" id="closeModal">&times;</span>
    <h2>Schedule a Property Tour</h2>

    <form action="index.php?page=scheduleTour" method="POST">
        <input type="hidden" name="property_id" value="<?= $property['id'] ?>">
        <input type="hidden" name="user_name" value="<?= htmlspecialchars($_SESSION['user_name'] ?? 'Guest') ?>">

        <label for="tour_date">Select Date:</label>
        <input type="date" id="tour_date" name="tour_date" required>

        <label for="tour_time">Preferred Time:</label>
        <input type="time" id="tour_time" name="tour_time" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" placeholder="e.g. +20 123 456 7890" required>

        <label for="notes">Additional Notes:</label>
        <textarea id="notes" name="notes" rows="3" placeholder="Anything you'd like us to know..."></textarea>

        <button type="submit" class="modal-submit-btn">Confirm Tour</button>
    </form>
  </div>
</div>

<script>
document.querySelector('.purchase-button').addEventListener('click', function (e) {
  e.preventDefault();
  document.getElementById('scheduleModal').classList.add('active');
});

document.getElementById('closeModal').addEventListener('click', function () {
  document.getElementById('scheduleModal').classList.remove('active');
});

window.addEventListener('click', function (e) {
  const modal = document.getElementById('scheduleModal');
  if (e.target === modal) {
    modal.classList.remove('active');
  }
});

</script>

</body>
</html>
