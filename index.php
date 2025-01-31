<?php
session_start();

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function renderNavigation() {
    ?>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="destinations.php">Destinations</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php">Login</a></li>
            <li>
                <a href="<?= isAdmin() ? 'admin_dashboard.php' : 'login.php' ?>" title="<?= isAdmin() ? 'Admin Panel' : 'Login' ?>">
                    <img src="images/admin_icon.png" alt="<?= isAdmin() ? 'Admin Panel' : 'Login' ?>">
                </a>
            </li>
        </ul>
    </nav>
    <?php
}

function renderHeader() {
    ?>
    <header id="mainHeader" class="page-header">
        <div class="logo">
            <h1>Kosova Airlines</h1>
        </div>
        <?php renderNavigation(); ?>
    </header>
    <?php
}

function renderMainContent() {
    ?>
    <main id="mainContent">
        <video autoplay muted id="homeVideo">
            <source src="videos/VideoBackground1.mp4" type="video/mp4">
            <source src="videos/Videobackground2.mp4" type="video/mp4">
            <source src="videos/Videobackground3.mp4" type="video/mp4">
        </video>
        <div class="home-content">
            <h2>Fly with Kosova Airlines</h2>
            <p>Your journey begins here. Explore new destinations with comfort and convenience.</p>
            <a href="destinations.php" class="cta-btn">Explore Destinations</a>
        </div>
    </main>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosova Airlines - Home</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body class="home-page">

    <?php renderHeader(); ?>
    <?php renderMainContent(); ?>

    <script src="js/index.js"></script>
</body>
</html>
