<?php
class AboutPage {
    private $title;
    private $stylesheet = "css/about.css";

    public function __construct($title) {
        $this->title = $title;
    }

    public function render() {
        $this->renderHeader();
        $this->renderNavigation();
        $this->renderContent();
        $this->renderFooter();
    }

    private function renderHeader() {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo "<title>{$this->title}</title>";
        echo "<link rel='stylesheet' href='{$this->stylesheet}'>";
        echo "<link rel='stylesheet' href='css/responsive.css'>"; 
        echo '</head>';
        echo '<body class="about-page">';
    }

    private function renderNavigation() {
        echo '<header>';
        echo '<div class="logo">';
        echo '<h1>Kosova Airlines</h1>';
        echo '</div>';
        echo '<nav>';
        echo '<ul>';
        echo '<li><a href="index.php">Home</a></li>';
        echo '<li><a href="about.php">About Us</a></li>';
        echo '<li><a href="destinations.php">Destinations</a></li>';
        echo '<li><a href="products.php">Products</a></li>';
        echo '<li><a href="contact.php">Contact</a></li>';
        echo '<li><a href="login.php">Login</a></li>';
        echo '</ul>';
        echo '</nav>';
        echo '</header>';
    }

    private function renderContent() {
        echo '<section class="about">';
        echo '<div class="about-container">';
        echo '<h1>About Kosova Airlines</h1>';
        echo '<p>Welcome to Kosova Airlines, the premier airline offering exceptional travel experiences to destinations across the globe.</p>';
        echo '<h2>Our Vision</h2>';
        echo '<p>Our vision is to be the most trusted airline, providing the best in service, safety, and value for travelers.</p>';
        echo '<h2>Our Mission</h2>';
        echo '<p>We aim to deliver superior air travel experiences while fostering growth and innovation.</p>';
        echo '<h2>Why Should You Choose Us?</h2>';
        echo '<ul>';
        echo '<li>Exceptional customer service</li>';
        echo '<li>Affordable flight options</li>';
        echo '<li>Modern fleet with state-of-the-art facilities</li>';
        echo '<li>Commitment to safety and sustainability</li>';
        echo '<li>Wide range of destinations to choose from</li>';
        echo '</ul>';
        echo '</div>';
        echo '</section>';
    }

    private function renderFooter() {
        echo "<script src='js/responsive.js'></script>"; 
        echo '</body>';
        echo '</html>';
    }
}

// Krijojmë objektin dhe shfaqim faqen
$page = new AboutPage("About Us - Kosova Airlines");
$page->render();
?>
