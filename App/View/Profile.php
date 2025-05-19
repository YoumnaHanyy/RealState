<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="/RealState/Public/css/profileee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link rel="stylesheet" href="/REALSTATE/Public/css/HomePageeee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="profile-page">
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
    <div class="container">

        <div class="user-info-header">
            <div class="user-avatar">
                <?php
                $avatarPath = isset($user['avatar_url']) && !empty($user['avatar_url'])
                                ? htmlspecialchars($user['avatar_url'])
                                : '/RealState/Public/images/default_avatar.png'; // Path to a default image
                ?>
                <img src="<?= $avatarPath ?>" alt="<?= htmlspecialchars($user['name'] ?? '') ?>'s Avatar">
            </div>
            <h1>
                <?= htmlspecialchars($user['name'] ?? '') ?>'s Profile
            </h1>
        </div>

        <div class="section user-details">
            <h2>User Details</h2>
            <div class="contact-info-line">
               <p><strong><i class="fas fa-envelope icon-spacing"></i> Email:</strong> <?= htmlspecialchars($user['email'] ?? 'Not available') ?></p>


                <?php if (isset($user['phone_number']) && !empty($user['phone_number'])): ?>
                    <p class="phone-number-detail"><strong><i class="fas fa-phone icon-spacing"></i> Phone:</strong> <?= htmlspecialchars($user['phone_number'] ?? '') ?></p>
                <?php endif; ?>
            </div>
            <?php if (isset($user['address']) && !empty($user['address'])): ?>
                <p><strong><i class="fas fa-map-marker-alt icon-spacing"></i> Address:</strong> <?= htmlspecialchars($user['address'] ?? '') ?></p>
            <?php endif; ?>
            <?php if (isset($user['user_type']) && !empty($user['user_type'])): ?>
                <p><strong><i class="fas fa-user-tag icon-spacing"></i> Account Type:</strong> <span class="user-type-badge"><?= htmlspecialchars(ucfirst($user['user_type'] ?? '')) ?></span></p>
            <?php endif; ?>
            </div>

        <?php if (isset($savedProperties) && !empty($savedProperties)): ?>
        <div class="section saved-properties">
            <h2>Saved Properties</h2>
            <ul>
                <?php foreach ($savedProperties as $property): ?>
                    <li>
                        <span class="title"><?= htmlspecialchars($property['title'] ?? '') ?></span> -
                        <span class="price"><?= htmlspecialchars($property['price'] ?? '') ?>$</span>
                        <a href="/RealState/index.php?page=details&id=<?= htmlspecialchars($property['id'] ?? '') ?>" class="view-link">View Property</a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if (count($savedProperties) >= 5): ?>
                <a href="#" class="btn-secondary view-all">View All Saved</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="section added-properties">
            <h2>Added Properties</h2>
            <?php if (isset($userProperties) && !empty($userProperties)): ?>
            <ul>
                <?php foreach ($userProperties as $property): ?>
                    <li>
                        <span class="title"><?= htmlspecialchars($property['title'] ?? '') ?></span> -
                        <span class="price"><?= htmlspecialchars($property['price'] ?? '') ?>$</span>
                       <a href="/RealState/index.php?page=details&id=<?= htmlspecialchars($property['id'] ?? '') ?>" class="view-link">View Property</a>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <p class="no-data">No properties added yet.</p>
            <?php endif; ?>
        </div>

        <div class="section requested-properties">
            <h2>Requested Properties</h2>
            <?php if (isset($requestedProperties) && !empty($requestedProperties)): ?>
            <ul>
                <?php foreach ($requestedProperties as $request): ?>
                    <li>
                        <span class="property-id">Property ID: <?= htmlspecialchars($request['property_id'] ?? '') ?></span>
                        (<span class="status <?= strtolower(htmlspecialchars($request['status'] ?? '')) ?>"><?= htmlspecialchars($request['status'] ?? '') ?></span>)
                        <a href="/RealState/index.php?page=details&id=<?= htmlspecialchars($request['property_id'] ?? '') ?>" class="view-link">View Property</a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <p class="no-data">No property requests made yet.</p>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>