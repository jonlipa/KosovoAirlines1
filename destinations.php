<?php
class DestinationsPage {
    private $title;
    private $stylesheets = [
        "css/destinations.css",
        "css/booking.css",
        "css/responsive.css"
    ];
    private $destinations = [
        ["id" => "newyork", "name" => "New York, USA", "img" => "images/newyork.jpg", "desc" => "Discover the iconic landmarks of New York City."],
        ["id" => "london", "name" => "London, UK", "img" => "images/london.jpg", "desc" => "Experience the historic charm of London."],
        ["id" => "paris", "name" => "Paris, France", "img" => "images/paris.jpg", "desc" => "Visit the romantic city of Paris, home of the Eiffel Tower."],
        ["id" => "makkah", "name" => "Makkah, Saudi Arabia", "img" => "images/makkah.jpg", "desc" => "Experience the spiritual journey of Makkah."],
        ["id" => "medina", "name" => "Medina, Saudi Arabia", "img" => "images/medina.jpg", "desc" => "Visit the historic and holy city of Medina."],
        ["id" => "tokyo", "name" => "Tokyo, Japan", "img" => "images/tokyo.jpg", "desc" => "Explore the bustling streets and vibrant culture of Tokyo."],
        ["id" => "dubai", "name" => "Dubai, UAE", "img" => "images/dubai.jpg", "desc" => "Enjoy luxury and modernity in Dubai."],
        ["id" => "maldives", "name" => "Maldives", "img" => "images/maldives.jpg", "desc" => "Relax on the beautiful beaches of the Maldives."],
        ["id" => "sydney", "name" => "Sydney, Australia", "img" => "images/sydney.jpg", "desc" => "Visit the Sydney Opera House and beautiful beaches."],
        ["id" => "rome", "name" => "Rome, Italy", "img" => "images/rome.jpg", "desc" => "Discover the ancient ruins of Rome."],
        ["id" => "cairo", "name" => "Cairo, Egypt", "img" => "images/cairo.jpg", "desc" => "Marvel at the ancient pyramids in Cairo."],
        ["id" => "istanbul", "name" => "Istanbul, Turkey", "img" => "images/istanbul.jpg", "desc" => "Explore the city that bridges Europe and Asia."],
        ["id" => "hongkong", "name" => "Hong Kong", "img" => "images/hongkong.jpg", "desc" => "Experience the vibrant energy of Hong Kong."],
        ["id" => "amsterdam", "name" => "Amsterdam, Netherlands", "img" => "images/amsterdam.jpg", "desc" => "Discover the canals and culture of Amsterdam."]
    ];

    public function render() {
        $this->renderHeader();
        $this->renderNavigation();
        $this->renderDestinations();
        $this->renderBookingForm();
        $this->renderFooter();
    }

    private function renderHeader() {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Destinations - Kosova Airlines</title>';

        foreach ($this->stylesheets as $stylesheet) {
            echo "<link rel='stylesheet' href='{$stylesheet}'>";
        }

        echo '<style>
            a { color: #333; text-decoration: none; }
            a:hover { color: #555; }
        </style>';

        echo '</head>';
        echo '<body class="destinations-page">';
    }

    private function renderNavigation() {
        echo '<header class="page-header">';
        echo '<div class="logo"><h1>Kosova Airlines</h1></div>';
        echo '<nav><ul>';
        echo '<li><a href="index.php">Home</a></li>';
        echo '<li><a href="about.php">About Us</a></li>';
        echo '<li><a href="destinations.php">Destinations</a></li>';
        echo '<li><a href="products.php">Products</a></li>';
        echo '<li><a href="contact.php">Contact</a></li>';
        echo '<li><a href="login.php">Login</a></li>';
        echo '</ul></nav>';
        echo '</header>';
    }

    private function renderDestinations() {
        echo '<section class="destinations">';
        echo '<h1>Our Destinations</h1>';
        echo '<p>Explore the world with Kosova Airlines. Discover top destinations around the globe.</p>';
        echo '<div class="destination-list">';

        foreach ($this->destinations as $destination) {
            echo '<div class="destination-item" onclick="loadDestinationDetails(\'' . $destination['id'] . '\')">';
            echo '<a href="destinations/' . $destination['id'] . '.php">';
            echo '<img src="' . $destination['img'] . '" alt="' . $destination['name'] . '">';
            echo '<h3>' . $destination['name'] . '</h3>';
            echo '<p>' . $destination['desc'] . '</p>';
            echo '</a></div>';
        }

        echo '</div>';
        echo '</section>';
    }

    private function renderBookingForm() {
        echo '<section class="booking-form" style="display: none;">';
        echo '<h2>Book Your Flight</h2>';
        echo '<form id="booking-form">';
        echo '<div class="form-group">';
        echo '<label for="passenger-name">Passenger Name:</label>';
        echo '<input type="text" id="passenger-name" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label>Class:</label>';
        echo '<label><input type="radio" name="class" value="Economy" required> Economy</label>';
        echo '<label><input type="radio" name="class" value="Business"> Business</label>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="contact-info">Contact Info:</label>';
        echo '<input type="text" id="contact-info" required>';
        echo '</div>';
        echo '<button type="submit">Book Now</button>';
        echo '</form>';
        echo '</section>';
    }

    private function renderFooter() {
        echo '<footer>';
        echo '<p>&copy; 2024 Kosova Airlines. All rights reserved.</p>';
        echo '</footer>';
        echo '<script src="js/booking.js"></script>';
        echo '<script src="js/global.js"></script>';
        echo '<script src="js/navigation.js"></script>';
        echo '<script src="js/search.js"></script>';
        echo '<script src="js/responsive.js"></script>';
        echo '</body>';
        echo '</html>';
    }
}

// Krijojmë dhe shfaqim faqen
$page = new DestinationsPage();
$page->render();
?>
