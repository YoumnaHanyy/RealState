

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Housing</title>
  <link rel="stylesheet" href="/REALSTATE/Public/css/Properties.css">
<style>
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            margin: 15px;
            width: 300px;
            display: inline-block;
            vertical-align: top;
            box-shadow: 2px 2px 10px #ddd;
        }
        </style>
</head>
<body>
     
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
  <?php foreach ($properties as $property): ?>
    <div class="card">
        <?php if (!empty($property['image'])): ?>
            <img src="/REALSTATE/Public/images/<?= htmlspecialchars($property['image']) ?>" alt="Property Image" width="100%" style="border-radius: 10px 10px 0 0;">
        <?php endif; ?>
        <h3><?= htmlspecialchars($property['name']) ?></h3>
        <p><strong>Price:</strong> $<?= htmlspecialchars($property['price']) ?></p>
        <p><strong>Developer:</strong> <?= htmlspecialchars($property['developer']) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($property['location']) ?></p>
    </div>
<?php endforeach; ?>

     </body>