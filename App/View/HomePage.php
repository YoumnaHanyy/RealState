<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Housing</title>
  <link rel="stylesheet" href="/REALSTATE/Public/css/HomePagee.css">

</head>
<body>
  <header class="navbar">
    <div class="logo">HOUSOFT</div>
    <nav>
      <a href="#">About Us</a>
      <a href="#">Properties</a>
      <a href="#">Services</a>
      <a href="#">Blog →</a>
      <a href="/index.php?page=signup" class="sign-up-btn">Sign Up</a>
    </nav>
  </header>
  
  <?php if (isset($_SESSION['home_message'])): ?>
  <div class="success-alert">
    <div class="success-content">
      <?= htmlspecialchars($_SESSION['home_message']) ?>
      <button class="close-button" onclick="this.parentElement.parentElement.style.display='none';">×</button>
    </div>
  </div>
  <style>
    .success-alert {
      position: fixed;
      top: 80px;
      left: 0;
      right: 0;
      display: flex;
      justify-content: center;
      z-index: 1000;
    }
    .success-content {
      background-color: #bd8c4c;
      color: white;
      padding: 15px 25px;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      display: flex;
      align-items: center;
      animation: fadeIn 0.5s;
    }
    .close-button {
      background: none;
      border: none;
      color: white;
      font-size: 20px;
      cursor: pointer;
      margin-left: 15px;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
  <script>
    // Auto-hide the message after 5 seconds
    setTimeout(function() {
      var alert = document.querySelector('.success-alert');
      if (alert) {
        alert.style.display = 'none';
      }
    }, 5000);
  </script>
  <?php 
    // Clear the message after displaying it
    unset($_SESSION['home_message']); 
  ?>
  <?php endif; ?>
  
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
      <div class="city-card">
        <img src="/REALSTATE/Public/images/pic5.jpg" alt="Chicago" class="city-image">
        <div class="city-overlay">
          <h3 class="city-name">Chicago</h3>
          <p class="properties-count">1,245 Properties</p>
        </div>
      </div>

      <div class="city-card">
        <img src="/REALSTATE/Public/images/pic6.png" alt="Miami" class="city-image">
        <div class="city-overlay">
          <h3 class="city-name">Miami</h3>
          <p class="properties-count">867 Properties</p>
        </div>
      </div>

      <div class="city-card">
        <img src="/REALSTATE/Public/images/pic7.jpg" alt="Los Angeles" class="city-image">
        <div class="city-overlay">
          <h3 class="city-name">Los Angeles</h3>
          <p class="properties-count">1,032 Properties</p>
        </div>
      </div>

      <div class="city-card">
        <img src="/REALSTATE/Public/images/pic8.jpg" alt="San Francisco" class="city-image">
        <div class="city-overlay">
          <h3 class="city-name">San Francisco</h3>
          <p class="properties-count">754 Properties</p>
        </div>
      </div>

      <div class="city-card">
        <img src="/REALSTATE/Public/images/pic9.jpg" alt="Seattle" class="city-image">
        <div class="city-overlay">
          <h3 class="city-name">Seattle</h3>
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
          <div class="logo-icon">H</div>
          <div class="logo-text">Homazon</div>
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
