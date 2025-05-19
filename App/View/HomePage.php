
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Housing</title>
  <link rel="stylesheet" href="/REALSTATE/Public/css/HomePage2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
 <header class="navbar">
    <a href="http://localhost/REALSTATE/index.php?page=home" class="logo">HOUSOFT</a>
    <nav>
      
      <a href="/REALSTATE/index.php?page=properties"><i class="fas fa-building"></i> Properties</a>
      <a href="#"><i class="fas fa-concierge-bell"></i> Services</a>
    <?php if (isset($_SESSION['user_name'])): ?>
  <a href="/REALSTATE/index.php?page=profile"><i class="fa-solid fa-user"></i> Profile →</a>
<?php endif; ?>
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
  
  <section class="hero">
    <div class="dark-overlay"></div>
    <div class="hero-content">
      <h1>Find Your Dream Home Today</h1>
      <form class="search-bar">
        <input type="text" placeholder="Search for properties...">
        <button type="submit">Search</button>
      </form>
    </div>
  </section>
  
  <section class="property-match">
    <div class="property-match-content">
      <h2>Discover Your Perfect <span>Property Match</span></h2>
    </div>
    <div class="property-match-text">
      <p>Discover Your Perfect Property Match with our expert team, dedicated to finding the ideal investment in California, San Francisco, and Miami. We combine deep market knowledge with personalized service to ensure a seamless real estate experience as best as your needs. Trust us to guide you every step of the way.</p>
    </div>
  </section>



   <section class="most-viewed-section">
    <div class="section-header">
      <h2 class="section-title">Most Viewed</h2>
      <p class="section-subtitle">Discover our most popular properties that buyers like you are interested in. Browse these trending listings to find your dream home.</p>
    </div>

    <div class="properties-grid">
      <div class="property-card">
        <img src="/REALSTATE/Public/images/pic2.jpg" alt="Ocean Breeze Villa" class="property-image">
        <div class="property-details">
          <p class="property-type">Luxury Villa</p>
          <h3 class="property-name">Ocean Breeze Villa</h3>
          <div class="property-meta">
            <span class="property-price">$1,200,000</span>
            <div class="property-rating">
              <span class="star-icon">★</span>
              <span>4.8</span>
            </div>
          </div>
        </div>
      </div>

      <div class="property-card">
        <img src="/REALSTATE/Public/images/pic3.jpg" alt="Juliana House" class="property-image">
        <div class="property-details">
          <p class="property-type">Modern House</p>
          <h3 class="property-name">Juliana House</h3>
          <div class="property-meta">
            <span class="property-price">$755,000</span>
            <div class="property-rating">
              <span class="star-icon">★</span>
              <span>4.7</span>
            </div>
          </div>
        </div>
      </div>

      <div class="property-card">
        <img src="/REALSTATE/Public/images/pic4.jpg" alt="Lakeside Cottage" class="property-image">
        <div class="property-details">
          <p class="property-type">Cozy Cottage</p>
          <h3 class="property-name">Lakeside Cottage</h3>
          <div class="property-meta">
            <span class="property-price">$540,000</span>
            <div class="property-rating">
              <span class="star-icon">★</span>
              <span>4.9</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pagination">
      <div class="pagination-dot active"></div>
      <div class="pagination-dot"></div>
      <div class="pagination-dot"></div>
      <div class="pagination-dot"></div>
    </div>
  </section>
<section class="trusted-section">
    <div class="trusted-header">
      <h2 class="trusted-title">Trusted by</h2>
      <h1 class="trusted-subtitle">100 Million <span>buyers</span></h1>
      <p class="trusted-note">Only we connect you directly to the person that knows the most about a property for sale, the listing agent.</p>
    </div>

    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">01</div>
        <div class="feature-content">
          <h3 class="feature-title">Explore great neighborhoods</h3>
          <p class="feature-description">Explore neighborhoods, in-depth research, and insights on 20,000+ neighborhoods.</p>
          <a href="#" class="feature-link">
            Browse neighborhoods <span class="arrow-icon">→</span>
          </a>
        </div>
      </div>

      <div class="feature-card">
        <div class="feature-icon">02</div>
        <div class="feature-content">
          <h3 class="feature-title">Find highly rated best property</h3>
          <p class="feature-description">Find the very best schools with in-depth reviews and ratings from multiple experts.</p>
          <a href="#" class="feature-link">
            Discover properties <span class="arrow-icon">→</span>
          </a>
        </div>
      </div>
    </div>
  </section>
   <section class="cities-section">
    <div class="section-header">
      <h2 class="section-title">Find Properties in These Cities</h2>
    </div>

    <div class="cities-grid">


      <a href="index.php?page=properties&location=Cairo" class="city-card">
        <img src="/REALSTATE/Public/images/cairo.jpg" alt="Chicago" class="city-image">
        <div class="city-overlay">
          <h3 class="city-name">Cairo</h3>
          <p class="properties-count">1,245 Properties</p>
        </div>
</a>

   <a href="index.php?page=properties&location=New%20Cairo" class="city-card">
  <img src="/REALSTATE/Public/images/new.jpg" alt="New Cairo" class="city-image">
  <div class="city-overlay">
    <h3 class="city-name">New Cairo</h3>
    <p class="properties-count">867 Properties</p>
  </div>
</a>

      <a href="index.php?page=properties&location=Giza" class="city-card">
        <img src="/REALSTATE/Public/images/giza.jpg" alt="Los Angeles" class="city-image">
        <div class="city-overlay">
          <h3 class="city-name">Giza</h3>
          <p class="properties-count">1,032 Properties</p>
        </div>
</a>

      <a href="index.php?page=properties&location=Maadi" class="city-card">
        <img src="/REALSTATE/Public/images/maadi.jpg" alt="San Francisco" class="city-image">
        <div class="city-overlay">
          <h3 class="city-name">Maadi</h3>
          <p class="properties-count">754 Properties</p>
        </div>
</a>

      <div class="city-card">
        <img src="/REALSTATE/Public/images/sheikh.jpg" alt="Seattle" class="city-image">
        <div class="city-overlay">
          <h3 class="city-name">Sheikh Zayed</h3>
          <p class="properties-count">623 Properties</p>
        </div>
      </div>
    </div>

    <div class="pagination">
      <div class="pagination-dot active"></div>
      <div class="pagination-dot"></div>
      <div class="pagination-dot"></div>
    </div>
  </section>
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-top">
        <div class="footer-logo">
          
            <a href="http://localhost/REALSTATE/index.php?page=home" class="logo">HOUSOFT</a>
        </div>
        <div class="social-links">
          <a href="#" class="social-link">
            <i>fb</i>
          </a>
          <a href="#" class="social-link">
            <i>tw</i>
          </a>
          <a href="#" class="social-link">
            <i>ig</i>
          </a>
          <a href="#" class="social-link">
            <i>li</i>
          </a>
          <a href="#" class="social-link">
            <i>yt</i>
          </a>
        </div>
      </div>

      <div class="footer-content">
        <div class="footer-col">
          <div class="contact-info">
            <div class="contact-item">
              <i>📍</i>
              <p>1234 Main St, San Diego, CA 92101, US</p>
            </div>
            <div class="contact-item">
              <i>📞</i>
              <p>1-800-456-7890</p>
            </div>
            <div class="contact-item">
              <i>✉️</i>
              <p>support@homazon.com</p>
            </div>
          </div>
        </div>

        <div class="footer-col">
          <h3>Categories</h3>
          <a href="#">Luxury Homes</a>
          <a href="#">Apartments</a>
          <a href="#">Condos</a>
          <a href="#">Land</a>
          <a href="#">Commercial</a>
        </div>

        <div class="footer-col">
          <h3>Our Company</h3>
          <a href="#">About Us</a>
          <a href="#">Careers</a>
          <a href="#">Blog</a>
          <a href="#">Contact Us</a>
          <a href="#">Sitemap</a>
        </div>

        <div class="footer-col">
          <h3>Newsletter</h3>
          <p>Stay updated with our latest news and properties.</p>
          <div class="newsletter">
            <div class="newsletter-form">
              <input type="email" placeholder="Your email address" class="newsletter-input">
              <button class="newsletter-button">→</button>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>© 2025 Homazon. All rights reserved.</p>
        <div class="footer-bottom-links">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
          <a href="#">Cookie Policy</a>
        </div>
      </div>
    </div>
  </footer>
  <script src="/REALSTATE/Public/js/HomePagee.js"></script>
</body>
</html>