<?php
class ProductsPage {
    private $title;
    private $stylesheets = ["css/products.css"];
        private $scripts = ["js/responsive.js"];

    private $seatClasses = [
        ["id" => "economy", "name" => "Economy Class", "img" => "images/economyclass.jpg", "desc" => "Enjoy affordable travel with essential comfort and amenities."],
        ["id" => "premium", "name" => "Premium Economy", "img" => "images/premiumeconomy.jpg", "desc" => "More legroom, enhanced meals, and priority boarding for extra comfort."],
        ["id" => "business", "name" => "Business Class", "img" => "images/businessclass.jpg", "desc" => "Relax in luxurious seating with exceptional service and gourmet dining."],
        ["id" => "first", "name" => "First Class", "img" => "images/firstclass.jpg", "desc" => "Experience unparalleled luxury, private suites, and the finest amenities."]
    ];

    public function render() {
        $this->renderHeader();
        $this->renderNavigation();
        $this->renderProducts();
        $this->renderFooter();
    }

    private function renderHeader() {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo "<title>Products - Kosova Airlines</title>";

        foreach ($this->stylesheets as $stylesheet) {
            echo "<link rel='stylesheet' href='{$stylesheet}'>";
        }

        echo '</head>';
        echo '<body class="products-page">';
    }

    private function renderNavigation() {
        echo '<header>';
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

    private function renderProducts() {
        echo '<main>';
        echo '<section class="product-classes">';
        echo '<h1>Our Seat Classes</h1>';
        echo '<p>Choose the class that best fits your travel needs and experience unparalleled comfort.</p>';
        echo '<div class="class-list">';

        foreach ($this->seatClasses as $class) {
            echo '<div class="class-item">';
            echo '<img src="' . $class["img"] . '" alt="' . $class["name"] . '">';
            echo '<h2>' . $class["name"] . '</h2>';
            echo '<p>' . $class["desc"] . '</p>';
            echo '</div>';
        }

        echo '</div>';
        echo '</section>';
        echo '</main>';
    }

    private function renderFooter() {
        echo '<footer>';
        echo '<p>&copy; 2024 Kosova Airlines. All rights reserved.</p>';
        echo '</footer>';

        foreach ($this->scripts as $script) {
            echo "<script src='{$script}'></script>";
        }

        echo '</body>';
        echo '</html>';
    }
}

// Krijojmë dhe shfaqim faqen
$page = new ProductsPage();
$page->render();
?>

