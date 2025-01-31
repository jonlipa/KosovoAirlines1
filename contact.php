<?php 
class ContactPage {
    private $title;
    private $stylesheet = "css/contact.css";
    private $responsiveStylesheet = "css/responsive.css";
    private $script = "js/contact.js";
    private $responsiveScript = "js/responsive.js";

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
        echo "<link rel='stylesheet' href='{$this->responsiveStylesheet}'>"; // Shtohet responsive.css
        echo '</head>';
        echo '<body class="contact-page">';
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
        echo '<main>';
        echo '<section class="contact-info">';
        echo '<h1>Contact Us</h1>';
        echo '<p>We’d love to hear from you! Reach out to us for any inquiries, feedback, or assistance.</p>';

        echo '<div class="info-grid">';
        echo '<div class="info-item">';
        echo '<h2>Address</h2>';
        echo '<p>123 Kosova Airlines Blvd, Pristina, Kosovo</p>';
        echo '</div>';
        echo '<div class="info-item">';
        echo '<h2>Phone</h2>';
        echo '<p>+383 38 555 555</p>';
        echo '</div>';
        echo '<div class="info-item">';
        echo '<h2>Email</h2>';
        echo '<p>support@kosovaairlines.com</p>';
        echo '</div>';
        echo '</div>';
        echo '</section>';

        echo '<section class="contact-form">';
        echo '<h2>Get in Touch</h2>';
        echo '<form id="contactForm" action="#" method="post">';
        echo '<label for="name">Your Name</label>';
        echo '<input type="text" id="name" name="name" placeholder="Enter your name" required>';
        
        echo '<label for="email">Your Email</label>';
        echo '<input type="email" id="email" name="email" placeholder="Enter your email" required>';
        
        echo '<label for="message">Your Message</label>';
        echo '<textarea id="message" name="message" rows="5" placeholder="Write your message here" required></textarea>';
        
        echo '<button type="submit" class="submit-btn">Send Message</button>';
        echo '</form>';
        
        // Div për mesazhin e konfirmimit
        echo '<p id="successMessage" class="hidden">Your message has been sent successfully!</p>';
        echo '</section>';
        echo '</main>';
    }

    private function renderFooter() {
        echo "<script src='{$this->script}'></script>";
        echo "<script src='{$this->responsiveScript}'></script>"; // Shtohet responsive.js
        echo '</body>';
        echo '</html>';
    }
}

// Krijojmë objektin dhe shfaqim faqen
$page = new ContactPage("Contact Us - Kosova Airlines");
$page->render();
?>
