<?php 
session_start(); // Shtojmë session për të ruajtur mesazhin e suksesit

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
        $this->handleFormSubmission(); // Kthen mesazh suksesi nëse forma dërgohet
        $this->renderHeader();
        $this->renderNavigation();
        $this->renderContent();
        $this->renderFooter();
    }

    private function handleFormSubmission() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost"; 
            $username = "root"; 
            $password = ""; 
            $dbname = "kosovaairlines"; 

            // Lidhja me databazën
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Kontrollo lidhjen
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Merr të dhënat nga forma dhe pastro inputin
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $message = htmlspecialchars($_POST["message"]);

            // Përgatit dhe ekzekuto SQL query
            $stmt = $conn->prepare("INSERT INTO contactmessages (name, email, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $message);

            if ($stmt->execute()) {
                $_SESSION["success_message"] = "Your message has been sent successfully!";
                header("Location: contact.php"); // Rifresko faqen për të treguar mesazhin
                exit();
            } else {
                $_SESSION["error_message"] = "Error: " . $stmt->error;
            }

            // Mbyll lidhjen
            $stmt->close();
            $conn->close();
        }
    }

    private function renderHeader() {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo "<title>{$this->title}</title>";
        echo "<link rel='stylesheet' href='{$this->stylesheet}'>";
        echo "<link rel='stylesheet' href='{$this->responsiveStylesheet}'>";
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
        
        echo '<form id="contactForm" action="contact.php" method="post">';
        echo '<label for="name">Your Name</label>';
        echo '<input type="text" id="name" name="name" placeholder="Enter your name" required>';
        
        echo '<label for="email">Your Email</label>';
        echo '<input type="email" id="email" name="email" placeholder="Enter your email" required>';
        
        echo '<label for="message">Your Message</label>';
        echo '<textarea id="message" name="message" rows="5" placeholder="Write your message here" required></textarea>';
        
        echo '<button type="submit" class="submit-btn">Send Message</button>';

        if (isset($_SESSION["success_message"])) {
            echo "<p class='success-message'>{$_SESSION["success_message"]}</p>";
            unset($_SESSION["success_message"]);
        } elseif (isset($_SESSION["error_message"])) {
            echo "<p class='error-message'>{$_SESSION["error_message"]}</p>";
            unset($_SESSION["error_message"]);
        }

        echo '</form>';
        echo '</section>';
        echo '</main>';
    }

    private function renderFooter() {
        echo "<script src='{$this->script}'></script>";
        echo "<script src='{$this->responsiveScript}'></script>";
        echo '</body>';
        echo '</html>';
    }
}

$page = new ContactPage("Contact Us - Kosova Airlines");
$page->render();
?>
