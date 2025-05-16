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

</head>
<style>
  
  :root {
  /* Color variables */
  --primary-color: #bd8c4c;
  --primary-light: #d9b078;
  --primary-dark: #96703c;
  --text-dark: #333;
  --text-light: #fff;
  --text-muted: #666;
  --bg-light: #fff;
  --bg-dark: #121212;
  --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.05);
  --shadow-md: 0 8px 20px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 12px 28px rgba(0, 0, 0, 0.12);
  --transition-fast: 0.2s ease;
  --transition-medium: 0.3s ease;
  --transition-slow: 0.5s ease;
  --border-radius-sm: 4px;
  --border-radius-md: 8px;
  --border-radius-lg: 16px;
  --container-padding: 5%;
  --container-max-width: 1440px;
  --blur-strength: 10px;
}

/* Reset & Base Styles with Enhanced Typography */
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
  color: var(--text-dark);
  background-color: #121212;
  font-family: 'Poppins', 'Arial', sans-serif;
  font-size: 1.6rem;
  line-height: 1.6;
  overflow-x: hidden;
  position: relative;
}

/* Creating container classes for consistent layout */
.container {
  width: 100%;
  max-width: var(--container-max-width);
  padding: 0 var(--container-padding);
  margin: 0 auto;
}

/* Modern Navbar with Animation */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 2rem var(--container-padding);
  background-color: #121212;
  position: relative;
  width: 100%;
  z-index: 1000;
  backdrop-filter: blur(var(--blur-strength));
  -webkit-backdrop-filter: blur(var(--blur-strength));
  box-shadow: var(--shadow-sm);
  transition: all var(--transition-medium);
}

.navbar.scrolled {
  padding: 1.5rem var(--container-padding);
  box-shadow: var(--shadow-md);
}

.logo {
  font-weight: 700;
  font-size: 2.2rem;
  color: white;
  position: relative;
  text-decoration: none;
  display: flex;
  align-items: center;
}

.logo::before {
  content: "";
  position: absolute;
  width: 50%;
  height: 4px;
  background-color: var(--primary-color);
  bottom: -8px;
  left: 0;
  transform: scaleX(0);
  transform-origin: left;
  transition: transform var(--transition-medium);
}

.logo:hover::before {
  transform: scaleX(1);
}

nav {
  display: flex;
  gap: 3.5rem;
  align-items: center;
}

nav a {
  text-decoration: none;
  color: white;
  font-size: 1.5rem;
  font-weight: 500;
  position: relative;
  transition: color var(--transition-fast);
}

nav a::after {
  content: "";
  position: absolute;
  width: 100%;
  height: 2px;
  background-color: var(--primary-color);
  bottom: -4px;
  left: 0;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform var(--transition-fast);
}

nav a:hover {
  color: var(--primary-color);
}

nav a:hover::after {
  transform: scaleX(1);
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
  background-color: var(--text-dark);
  margin: 5px 0;
  transition: all var(--transition-fast);
}

.sign-up-btn {
  background-color: var(--primary-color);
  color: var(--text-light);
  padding: 1.2rem 2.4rem;
  border-radius: var(--border-radius-sm);
  text-decoration: none;
  font-weight: 600;
  font-size: 1.5rem;
  position: relative;
  overflow: hidden;
  z-index: 1;
  transition: all var(--transition-medium);
  box-shadow: 0 4px 12px rgba(189, 140, 76, 0.3);
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

  .property-container {
    max-width: 1200px;
    margin: 0 auto;
    font-family: 'Arial', sans-serif;
    color: #333;
    display: flex;
    flex-direction: column;
}


/* Header section with address and purchase button */
.property-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.property-address {
    margin: 0;
    font-size: 34px;
    font-weight: 600;
    color:#96703c;
}

.property-price-tag {
    margin: 0;
    color: #888;
    font-size: 20px;
    color:white;
}

.purchase-button {
    background-color: #96703c;
    color: white;
    border: none;
    margin-right:-6.3em;
    padding: 12px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    font-weight: 500;
    transition: background-color 0.3s;
}

.purchase-button:hover {
    background-color: #3e8e41;
}

.purchase-button::after {
    content: "→";
    margin-left: 8px;
}

/* Features section */
.property-features {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.feature {
    display: flex;
    align-items: center;
    gap: 5px;
   color:white;
    font-size: 14px;
}

.feature img {
    width: 20px;
    height: 20px;
    opacity: 0.7;
}

/* Main content area with image and details */
.property-content {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
}

.property-image-container {
    flex: 1;
    position: relative;
    border-radius: 10px;
    overflow: hidden;
}

.property-image {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 10px;
}

.image-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.8);
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.prev {
    left: 10px;
}

.next {
    right: 10px;
}

.image-dots {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 5px;
}

.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: white;
}

.dot.active {
    background-color: #4CAF50;
}

/* Property details section */
.property-details {
  color:white;
    flex: 1;
}

.property-title {
    font-size: 22px;
    margin: 0 0 15px 0;
    font-weight: 600;
}

.property-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
}

.read-more {
    color: #4CAF50;
    text-decoration: none;
}

/* Stats grid section */
.property-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.stat-box {
    padding: 15px 0;
}

.stat-title {
    display: flex;
    align-items: center;
    gap: 8px;
    color:#d9b078;
    font-size: 14px;
    margin-bottom: 8px;
}

.stat-title img {
    width: 16px;
    height: 16px;
    opacity: 0.7;
}

.stat-value {
    font-size: 22px;
    font-weight: 600;
    margin: 0;
}

.stat-subvalue {
    color: #888;
    font-size: 14px;
    margin: 0;
}

/* Potential value section */
.potential-value {
    margin-bottom: 20px;
}

.potential-value-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 16px;
    margin-bottom: 5px;
}

.confidence-tag {
    font-size: 12px;
    color: #888;
    margin-left: 10px;
}

.value-ranges {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
}

.range-box {
    text-align: center;
    width: 30%;
}

.range-label {
    font-size: 12px;
    color: #888;
    margin-bottom: 5px;
}

.range-value {
    font-size: 16px;
    font-weight: 600;
}
</style>
<body>
     <header class="navbar">
    <div class="logo">HOUSOFT</div>
    <nav>
     <a href="#">About Us</a>
    <a href="/REALSTATE/index.php?page=properties">Properties</a>
    <a href="#">Services</a>
    <a href="#">Blog →</a>
    <a href="/REALSTATE/App/View/AddProperty.php">Add Property</a>  <a href="#" class="sign-up-btn">Sign Up</a>
    </nav>
  </header>
  <section class="des">
      <div class="property-container">
        <!-- Header with address and purchase button -->
        <div class="property-header">
            <div>
                <h2 class="property-address"><?= htmlspecialchars($property['location']) ?></h2>
                <p class="property-price-tag">Offers from $<?= number_format($property['price']) ?></p>
            </div>
            <a href="#" class="purchase-button">PURCHASE THIS PROPERTY</a>
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
</body>
</html>
