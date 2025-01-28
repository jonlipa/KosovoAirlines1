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

    <!-- Main Content Section -->
    <header id="mainHeader" class="page-header">
        <div class="logo">
            <h1>Kosova Airlines</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="destinations.php">Destinations</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li>
                        <a href="admin_dashboard.php" title="Admin Panel">
                            <img src="images/admin_icon.png" alt="Admin Panel">
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="login.php" title="Login">
                            <img src="images/admin_icon.png" alt="Login">
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main id="mainContent">
        <video autoplay muted id="homeVideo">
            <source src="videos/VideoBackground1.mp4" type="video/mp4">
        </video>
        <div class="home-content">
            <h2>Fly with Kosova Airlines</h2>
            <p>Your journey begins here. Explore new destinations with comfort and convenience.</p>
            <a href="destinations.php" class="cta-btn">Explore Destinations</a>
        </div>
    </main>

    <script src="js/index.js"></script>
</body>
</html>


