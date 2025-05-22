<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Housing Listings</title>
    <link rel="stylesheet" href="/REALSTATE/Public/css/Properties.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

/* Header Section */
.headdd {
  position: relative;
  padding: 4rem 0;
  background: linear-gradient(135deg, #121212 0%, #121212 100%);
  background-size: cover;
  background-position: center;
  min-height: 80vh;
  overflow: hidden;
}

.headdd::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiBwYXR0ZXJuVW5pdHM9InVzZXJTcGFjZU9uVXNlIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxwYXRoIGQ9Ik0tMTAgLTEwIEw1MCA1ME0tNTAgLTUwIEwxMCAxMCIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjEiIG9wYWNpdHk9IjAuMSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==');
  z-index: 0;
  opacity: 0.3;
}

.container {
  width: 90%;
  max-width: 1400px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

/* Search Form */
.search-form {
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem;
  padding: 2rem;
  background: var(--glass-bg);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-radius: var(--border-radius);
  border: var(--glass-border);
  box-shadow: var(--glass-shadow);
  margin-bottom: 3rem;
  transform: translateY(0);
  transition: transform var(--transition-bounce), box-shadow var(--transition-fast);
}

.search-form:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.5);
}

.search-form > div {
  flex: 1 1 200px;
  position: relative;
}

.search-form label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: var(--light-text);
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  letter-spacing: 0.5px;
  transform: translateY(0);
  transition: var(--transition-fast);
}

.search-form div:hover label {
  transform: translateY(-2px);
  color: var(--secondary-color);
}

.search-form input {
  width: 100%;
  padding: 1rem 1.5rem;
  border: none;
  border-radius: calc(var(--border-radius) - 2px);
  background: var(--input-bg);
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.08);
  font-size: 1rem;
  color: var(--text-color);
  transition: var(--transition-fast);
}

.search-form input:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(42, 65, 232, 0.3), inset 0 2px 4px rgba(0, 0, 0, 0.08);
}

.search-form input::placeholder {
  color: rgba(74, 74, 74, 0.6);
}

.search-form button {
  flex: 0 0 120px;
  padding: 1rem 1.5rem;
  background: var(--primary-color);
  border: none;
  border-radius: var(--border-radius);
  color: white;
  font-weight: 600;
  cursor: pointer;
  box-shadow: 0 4px 15px rgba(42, 65, 232, 0.3);
  transition: var(--transition-fast);
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
}

.search-form button::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: var(--transition-fast);
}

.search-form button:hover {
  background: var(--primary-dark);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(42, 65, 232, 0.4);
}

.search-form button:hover::before {
  left: 100%;
  transition: 0.7s;
}

.search-form button i {
  font-size: 1.1rem;
}

/* Properties Grid */
.properties-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2.5rem;
  margin-top: 2rem;
}

/* Property Card */
.card {
  background: var(--card-bg);
  border-radius: var(--border-radius);
  overflow: hidden;
  box-shadow: var(--card-shadow);
  transition: var(--transition-bounce);
  transform: translateY(0) scale(1);
  position: relative;
  will-change: transform;
}

.card::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: var(--border-radius);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  opacity: 0;
  transition: var(--transition-fast);
  z-index: -1;
}

.card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: var(--card-hover-shadow);
}

.card:hover::after {
  opacity: 1;
}

.card-image {
  height: 220px;
  overflow: hidden;
  position: relative;
}

.card-image::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.5) 100%);
  z-index: 1;
  opacity: 0.7;
  transition: var(--transition-fast);
}

.card:hover .card-image::before {
  opacity: 0.4;
}

.card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.8s cubic-bezier(0.2, 1, 0.3, 1);
}

.card:hover .card-image img {
  transform: scale(1.1);
}

.card-content {
  padding: 1.5rem;
  position: relative;
}

.card-content h3 {
  margin: 0 0 1rem;
  font-size: 1.4rem;
  font-weight: 600;
  color: var(--text-color);
  line-height: 1.3;
  transition: var(--transition-fast);
}

.card:hover .card-content h3 {
  color: var(--primary-color);
}

.card-content p {
  margin: 0.5rem 0;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.95rem;
  color: #717171;
}

.card-content p i {
  color: var(--primary-color);
  font-size: 1rem;
  transition: var(--transition-fast);
}

.card:hover .card-content p i {
  transform: translateX(3px);
}

.card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 1.5rem;
  background-color: #f9fafc;
  border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.price {
  font-size: 1.2rem;
  font-weight: 700;
  color: var(--primary-color);
  position: relative;
  display: inline-block;
}

.price::before {
  content: '';
  position: absolute;
  bottom: -3px;
  left: 0;
  width: 0;
  height: 2px;
  background-color: var(--primary-color);
  transition: width var(--transition-fast);
}

.card:hover .price::before {
  width: 100%;
}

.btn {
  display: inline-block;
  padding: 0.6rem 1.2rem;
  background-color: var(--primary-color);
  color: white;
  border-radius: calc(var(--border-radius) - 4px);
  text-decoration: none;
  font-weight: 500;
  transition: var(--transition-fast);
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 0;
  height: 100%;
  background-color: var(--secondary-color);
  transition: 0.5s ease;
  z-index: -1;
}

.btn:hover::before {
  width: 100%;
}

.btn:hover {
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 5px 10px rgba(255, 94, 91, 0.4);
}

/* Featured Property Badge */
.card::before {
  content: '';
  position: absolute;
  top: 20px;
  right: -60px;
  background-color: var(--secondary-color);
  color: white;
  padding: 0.5rem 4rem;
  font-size: 0.8rem;
  font-weight: 500;
  transform: rotate(45deg);
  z-index: 2;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
  opacity: 0;
  transition: var(--transition-fast);
}

.card.featured::before {
  content: 'FEATURED';
  opacity: 1;
}

/* Loading Animation for Images */
.card-image::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  animation: loading 1.5s infinite;
  z-index: 2;
}

@keyframes loading {
  0% {
    transform: translateX(-100%);
  }
  100% {
    transform: translateX(100%);
  }
}

.card-image.loaded::after {
  display: none;
}

/* Advanced Animations */
@keyframes float {
  0% {
    transform: translateY(0) rotate(0);
  }
  50% {
    transform: translateY(-10px) rotate(2deg);
  }
  100% {
    transform: translateY(0) rotate(0);
  }
}

@keyframes pulse {
  0% {
    box-shadow: 0 0 0 0 rgba(42, 65, 232, 0.4);
  }
  70% {
    box-shadow: 0 0 0 10px rgba(42, 65, 232, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(42, 65, 232, 0);
  }
}

/* Decorative Elements */
.headdd::after {
  content: '';
  position: absolute;
  bottom: -100px;
  left: 0;
  width: 100%;
  height: 150px;
  background-color: var(--light-bg);
  border-radius: 50% 50% 0 0 / 100% 100% 0 0;
  z-index: 0;
}

/* Responsive Design */
@media screen and (max-width: 992px) {
  .search-form {
    padding: 1.5rem;
    gap: 1rem;
  }
  
  .properties-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
  }
  
  .card-image {
    height: 180px;
  }
}

@media screen and (max-width: 768px) {
  .headdd {
    padding: 3rem 0;
  }
  
  .search-form > div {
    flex: 1 1 100%;
  }
  
  .search-form button {
    flex: 1 1 100%;
    margin-top: 0.5rem;
  }
  
  .properties-grid {
    grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
    gap: 1.5rem;
  }
  
  .card-image {
    height: 200px;
  }
}

@media screen and (max-width: 480px) {
  .card-footer {
    flex-direction: column;
    gap: 1rem;
    align-items: flex-start;
  }
  
  .btn {
    width: 100%;
    text-align: center;
  }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
  :root {
    --light-bg: #121212;
    --card-bg: #1e1e1e;
    --text-color: #e0e0e0;
    --input-bg: rgba(255, 255, 255, 0.1);
    --card-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
  }
  
  .card-footer {
    background-color: #262626;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
  }
  
  .search-form input {
    color: var(--light-text);
  }
  
  .search-form input::placeholder {
    color: rgba(255, 255, 255, 0.5);
  }
  
  .card-content p {
    color: #b0b0b0;
  }
}

/* Advanced 3D Card Effect with Mouse Movement */
.card.advanced-hover {
  transform-style: preserve-3d;
  perspective: 1000px;
}

.card.advanced-hover .card-content,
.card.advanced-hover .card-footer {
  transform: translateZ(20px);
}

.card.advanced-hover .card-image {
  transform: translateZ(30px);
}

/* Image Lazy Loading Animation */
img[loading="lazy"] {
  opacity: 0;
  transition: opacity 0.5s ease-in-out;
}

img[loading="lazy"].loaded {
  opacity: 1;
}

/* Property Badge Styles */
.badge {
  position: absolute;
  top: 20px;
  left: 20px;
  padding: 0.4rem 1rem;
  font-size: 0.8rem;
  font-weight: 500;
  border-radius: 20px;
  z-index: 2;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.badge-sale {
  background-color: var(--secondary-color);
  color: white;
}

.badge-rent {
  background-color: var(--accent-color);
  color: white;
}

.badge-sold {
  background-color: #717171;
  color: white;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  margin: 2rem 0;
  background-color: rgba(255, 255, 255, 0.5);
  border-radius: var(--border-radius);
  box-shadow: var(--card-shadow);
}

.empty-state i {
  font-size: 3rem;
  color: var(--primary-color);
  margin-bottom: 1rem;
}

.empty-state h3 {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.empty-state p {
  color: #717171;
  max-width: 500px;
  margin: 0 auto 1.5rem;
}

/* Helper Classes */
.animate-float {
  animation: float 3s ease-in-out infinite;
}

.animate-pulse {
  animation: pulse 2s infinite;
}

/* Advanced card hover interaction */
.card {
  transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.card:hover .card-content {
  transform: translateY(-10px);
  transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* Tooltip styles */
[data-tooltip] {
  position: relative;
  cursor: help;
}

[data-tooltip]::before {
  content: attr(data-tooltip);
  position: absolute;
  bottom: 125%;
  left: 50%;
  transform: translateX(-50%);
  padding: 0.5rem 1rem;
  background-color: var(--dark-bg);
  color: var(--light-text);
  border-radius: var(--border-radius);
  font-size: 0.8rem;
  white-space: nowrap;
  visibility: hidden;
  opacity: 0;
  transition: var(--transition-fast);
  z-index: 100;
}

[data-tooltip]::after {
  content: '';
  position: absolute;
  bottom: 125%;
  left: 50%;
  transform: translateX(-50%) translateY(8px);
  border-width: 5px;
  border-style: solid;
  border-color: var(--dark-bg) transparent transparent transparent;
  visibility: hidden;
  opacity: 0;
  transition: var(--transition-fast);
  z-index: 100;
}

[data-tooltip]:hover::before,
[data-tooltip]:hover::after {
  visibility: visible;
  opacity: 1;
  transform: translateX(-50%) translateY(-5px);
}

/* Print styles */
@media print {
  .search-form {
    display: none;
  }
  
  .properties-grid {
    display: block;
  }
  
  .card {
    page-break-inside: avoid;
    break-inside: avoid;
    margin-bottom: 20px;
    box-shadow: none;
    border: 1px solid #ddd;
  }
  
  .btn {
    display: none;
  }
}

/* Add JavaScript hook class */
.js-loaded .card {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.5s ease, transform 0.5s ease;
}

.js-loaded .card.visible {
  opacity: 1;
  transform: translateY(0);
}

/* Media query for ultra-wide screens */
@media screen and (min-width: 1920px) {
  .container {
    max-width: 1800px;
  }
  
  .properties-grid {
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  }
}

/* Focus styles for accessibility */
:focus {
  outline: 3px solid var(--primary-color);
  outline-offset: 3px;
}

:focus:not(:focus-visible) {
  outline: none;
}

:focus-visible {
  outline: 3px solid var(--primary-color);
  outline-offset: 3px;
}

/* Advanced focus styles for the search form */
.search-form input:focus-visible {
  outline: none;
  box-shadow: 0 0 0 3px var(--primary-color), inset 0 2px 4px rgba(0, 0, 0, 0.08);
}

/* Reduced motion preference */
@media (prefers-reduced-motion: reduce) {
  *, ::before, ::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}
    </style>
</head>
<body>
  <header class="navbar">
    <a href="http://localhost/REALSTATE/index.php?page=home" class="logo">HOUSOFT</a>
    <nav>
      
      <a href="/REALSTATE/index.php?page=properties"><i class="fas fa-building"></i> Properties</a>
      <a href="#"><i class="fas fa-concierge-bell"></i> Services</a>
      <a href="#"><i class="fas fa-blog"></i> Blog →</a>
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
    <section class="headdd">
    <div class="container">
        <form class="search-form" method="get" action="index.php">
            <input type="hidden" name="page" value="properties">
            
            <div>
                <label>Location</label>
                <input type="text" name="location" value="<?= htmlspecialchars($_GET['location'] ?? '') ?>" placeholder="Enter location">
            </div>
            
            <div>
                <label>Min Price</label>
                <input type="number" name="min_price" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>" placeholder="Minimum price">
            </div>
            
            <div>
                <label>Max Price</label>
                <input type="number" name="max_price" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>" placeholder="Maximum price">
            </div>
            
            <button type="submit">
                <i class="fas fa-search"></i> Search
            </button>
        </form>

        <div class="properties-grid">
            <?php foreach ($properties as $property): ?>
                <div class="card">
                    <?php if (!empty($property['image'])): ?>
                        <div class="card-image">
                            <img src="/REALSTATE/Public/images/<?= htmlspecialchars($property['image']) ?>" alt="Property Image">
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-content">
                        <h3><?= htmlspecialchars($property['name']) ?></h3>
                        <p><i class="fas fa-map-marker-alt"></i><?= htmlspecialchars($property['location']) ?></p>
                        <p><i class="fas fa-building"></i><?= htmlspecialchars($property['developer']) ?></p>
                    </div>
                    
                    <div class="card-footer">
                        <span class="price">$<?= htmlspecialchars($property['price']) ?></span>
                      <a href="index.php?page=details&id=<?= $property['id'] ?>" class="btn">View Details</a>


                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
                    </section>
</body>
</html>