<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="/RealState/Public/css/profilee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="profile-page">
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

      <?php if (empty($scheduledTours)): ?>
    <p><em>No tours scheduled yet.</em></p>
<?php else: ?>
    <ul>
        <?php foreach ($scheduledTours as $tour): ?>
            <li>
                <?= htmlspecialchars($tour['property_title']) ?> — 
                <?= htmlspecialchars($tour['scheduled_date']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


    </div>
</body>
</html>