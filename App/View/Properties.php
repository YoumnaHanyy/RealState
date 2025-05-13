<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Housing Listings</title>
    <link rel="stylesheet" href="/REALSTATE/Public/css/Properties.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>

/* Updated CSS to match reference image */
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


* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Arial', sans-serif;
  background-color: var(--bg-dark);
  
  color: var(--text-dark);
}

/* Navbar Styles */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem var(--container-padding);
  background-color: var(--bg-dark);
  position: fixed;
  width: 100%;
  z-index: 10;
  box-shadow: var(--shadow-sm);
  transition: all var(--transition-medium);
}

.logo {
  font-weight: 700;
  font-size: 1.5rem;
  color: white;
  position: relative;
  text-decoration: none;
  display: flex;
  align-items: center;
}

nav {
  display: flex;
  gap: 2rem;
  align-items: center;
}

nav a {
  text-decoration: none;
  color: var(--text-dark);
  font-size: 0.95rem;
  font-weight: 500;
  position: relative;
  transition: color var(--transition-fast);
}

nav a:hover {
  color: var(--primary-color);
}

.sign-up-btn {
  background-color: var(--primary-color);
  color: var(--text-light);
  padding: 0.6rem 1.2rem;
  border-radius: var(--border-radius-sm);
  text-decoration: none;
  font-weight: 600;
  font-size: 0.95rem;
  position: relative;
  overflow: hidden;
  z-index: 1;
  transition: all var(--transition-medium);
  box-shadow: 0 4px 12px rgba(255, 77, 77, 0.3);
}

.sign-up-btn:hover {
  background-color: var(--primary-dark);
  box-shadow: 0 6px 16px rgba(255, 77, 77, 0.5);
  transform: translateY(-2px);
}

/* Main Content */
.headdd {
  padding-top: 2rem;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

/* Search Form Styles - Completely restyled to match image */
.search-form {
  display: flex;
  background-color: var(--bg-card);
  border-radius: var(--border-radius-md);
  box-shadow: var(--shadow-sm);
  margin-bottom: 2rem;
  overflow: hidden;
}

.search-form > div {
  flex: 1;
  padding: 0;
  position: relative;
  border-right: 1px solid var(--border-color);
}

.search-form > div:last-child {
  border-right: none;
}

.search-form label {
  display: block;
  font-size: 0.75rem;
  font-weight: 600;
  color: var(--text-muted);
  margin-bottom: 0.25rem;
  padding: 0.75rem 1rem 0;
}

.search-form input {
  width: 100%;
  padding: 0.5rem 1rem 0.75rem;
  border: none;
  background: transparent;
  font-size: 0.9rem;
  color: var(--text-dark);
}

.search-form input:focus {
  outline: none;
}

.search-form input::placeholder {
  color: #aaa;
}

.search-form button {
  background-color: var(--primary-color);
  color: white;
  border: none;
  padding: 0 2rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  text-transform: uppercase;
  font-size: 0.85rem;
  height: 100%;
}

.search-form button:hover {
  background-color: var(--primary-dark);
}

/* Properties Grid */
.properties-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
}

.card {
  background-color:rgb(27, 27, 27);
  border-radius: var(--border-radius-md);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  position: relative;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-md);
}

/* Property tag styles */
.card::before {
  content: "FEATURED";
  position: absolute;
  top: 1rem;
  left: 1rem;
  background-color: var(--primary-color);
  color: white;
  padding: 0.25rem 0.75rem;
  font-size: 0.7rem;
  font-weight: bold;
  border-radius: 3px;
  z-index: 2;
}

.card:nth-child(even)::before {
  content: "NEW HOME";
  background-color: var(--secondary-color);
}

/* Image container */
.card-image {
  height: 200px;
  overflow: hidden;
  position: relative;
}

.card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.card:hover .card-image img {
  transform: scale(1.05);
}

/* Icons overlay */
.card-image::after {
  content: "";
  position: absolute;
  top: 1rem;
  right: 1rem;
  display: flex;
  gap: 0.5rem;
}

/* Content styling */
.card-content {
  padding: 1.25rem;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.card-content h3 {
  color: white;
  margin-bottom: 0.5rem;
  font-size: 1.1rem;
  font-weight: 600;
}

.card-content p {
  color: white;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
}

.card-content p i {
  margin-right: 0.5rem;
  color: white;
  font-size: 0.85rem;
}

/* Property details */
.property-details {
  display: flex;
  margin-top: 1rem;
  border-top: 1px solid var(--border-color);
  padding-top: 1rem;
  font-size: 0.85rem;
  color: var(--text-muted);
}

.property-details span {
  display: flex;
  align-items: center;
  margin-right: 1rem;
}

.property-details i {
  margin-right: 0.35rem;
}

/* Card footer */
.card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 1.25rem;
  background-color: rgb(27, 27, 27);
  border-top: 1px solid var(--border-color);
}

.price {
  font-weight: bold;
  color: var(--primary-light);
  font-size: 1.2rem;
}

.price small {
  font-size: 0.75rem;
  color: var(--primary-light);
  font-weight: normal;
}

.btn {
  text-decoration: none;
  background-color: var(--primary-color);
  color: white;
  padding: 0.5rem 1rem;
  border-radius: var(--border-radius-sm);
  transition: background-color 0.3s ease;
  font-size: 0.85rem;
  font-weight: 600;
}

.btn:hover {
  background-color: var(--primary-dark);
}

/* Agent info */
.agent-info {
  display: flex;
  align-items: center;
  margin-top: 1rem;
}

.agent-info img {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  margin-right: 0.75rem;
}

.agent-info span {
  font-size: 0.85rem;
  color: var(--text-muted);
}

/* Responsive */
@media (max-width: 992px) {
  .properties-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  }
}

@media (max-width: 768px) {
  .search-form {
    flex-direction: column;
  }
  
  .search-form > div {
    border-right: none;
    border-bottom: 1px solid var(--border-color);
  }
  
  .search-form button {
    height: 50px;
  }
  
  .properties-grid {
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  }
}

@media (max-width: 576px) {
  .properties-grid {
    grid-template-columns: 1fr;
  }
}
    </style>
</head>
<body>
    <section>
      <header class="navbar">
    <div class="logo">HOUSOFT</div>
    <nav>
      <a href="#">About Us</a>
      <a href="Poperties.php">Properties</a>
      <a href="#">Services</a>
      <a href="#">Blog →</a>
      <a href="#" class="sign-up-btn">Sign Up</a>

    </nav>
  </header>
    </section>
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
                        <a href="#" class="btn">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
                    </section>
</body>
</html>