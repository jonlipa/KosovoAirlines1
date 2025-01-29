<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations - Kosova Airlines</title>
    <link rel="stylesheet" href="css/destinations.css">
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="css/responsive.css">
    <style>
        a {
            color: #333; 
            text-decoration: none; 
        }
        a:hover {
            color: #555; /
        }
    </style>
</head>
<body class="destinations-page">
    <!-- Header -->
    <header class="page-header">
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
            </ul>
        </nav>
    </header>

    <!-- Destinations Section -->
    <section class="destinations">
        <h1>Our Destinations</h1>
        <p>Explore the world with Kosova Airlines. Discover top destinations around the globe.</p>

        <!-- Destination List -->
        <div class="destination-list">
            <!-- New York -->
            <div class="destination-item" onclick="loadDestinationDetails('newyork')">
                <a href="destinations/newyork.php">
                    <img src="images/newyork.jpg" alt="New York, USA">
                    <h3>New York, USA</h3>
                    <p>Discover the iconic landmarks of New York City.</p>
                </a>
            </div>
            <!-- London -->
            <div class="destination-item" onclick="loadDestinationDetails('london')">
                <a href="destinations/london.php">
                    <img src="images/london.jpg" alt="London, UK">
                    <h3>London, UK</h3>
                    <p>Experience the historic charm of London.</p>
                </a>
            </div>
            <!-- Paris -->
            <div class="destination-item" onclick="loadDestinationDetails('paris')">
                <a href="destinations/paris.php">
                    <img src="images/paris.jpg" alt="Paris, France">
                    <h3>Paris, France</h3>
                    <p>Visit the romantic city of Paris, home of the Eiffel Tower.</p>
                </a>
            </div>
            <!-- Makkah -->
            <div class="destination-item" onclick="loadDestinationDetails('makkah')">
                <a href="destinations/makkah.php">
                    <img src="images/makkah.jpg" alt="Makkah, Saudi Arabia">
                    <h3>Makkah, Saudi Arabia</h3>
                    <p>Experience the spiritual journey of Makkah.</p>
                </a>
            </div>
            <!-- Medina -->
            <div class="destination-item" onclick="loadDestinationDetails('medina')">
                <a href="destinations/medina.php">
                    <img src="images/medina.jpg" alt="Medina, Saudi Arabia">
                    <h3>Medina, Saudi Arabia</h3>
                    <p>Visit the historic and holy city of Medina.</p>
                </a>
            </div>
            <!-- Tokyo -->
            <div class="destination-item" onclick="loadDestinationDetails('tokyo')">
                <a href="destinations/tokyo.php">
                    <img src="images/tokyo.jpg" alt="Tokyo, Japan">
                    <h3>Tokyo, Japan</h3>
                    <p>Explore the bustling streets and vibrant culture of Tokyo.</p>
                </a>
            </div>
            <!-- Dubai -->
            <div class="destination-item" onclick="loadDestinationDetails('dubai')">
                <a href="destinations/dubai.php">
                    <img src="images/dubai.jpg" alt="Dubai, UAE">
                    <h3>Dubai, UAE</h3>
                    <p>Enjoy luxury and modernity in Dubai.</p>
                </a>
            </div>
            <!-- Maldives -->
            <div class="destination-item" onclick="loadDestinationDetails('maldives')">
                <a href="destinations/maldives.php">
                    <img src="images/maldives.jpg" alt="Maldives">
                    <h3>Maldives</h3>
                    <p>Relax on the beautiful beaches of the Maldives.</p>
                </a>
            </div>
            <!-- Sydney -->
            <div class="destination-item" onclick="loadDestinationDetails('sydney')">
                <a href="destinations/sydney.php">
                    <img src="images/sydney.jpg" alt="Sydney, Australia">
                    <h3>Sydney, Australia</h3>
                    <p>Visit the Sydney Opera House and beautiful beaches.</p>
                </a>
            </div>
            <!-- Rome -->
            <div class="destination-item" onclick="loadDestinationDetails('rome')">
                <a href="destinations/rome.php">
                    <img src="images/rome.jpg" alt="Rome, Italy">
                    <h3>Rome, Italy</h3>
                    <p>Discover the ancient ruins of Rome.</p>
                </a>
            </div>
            <!-- Cairo -->
            <div class="destination-item" onclick="loadDestinationDetails('cairo')">
                <a href="destinations/cairo.php">
                    <img src="images/cairo.jpg" alt="Cairo, Egypt">
                    <h3>Cairo, Egypt</h3>
                    <p>Marvel at the ancient pyramids in Cairo.</p>
                </a>
            </div>
            <!-- Istanbul -->
            <div class="destination-item" onclick="loadDestinationDetails('istanbul')">
                <a href="destinations/istanbul.php">
                    <img src="images/istanbul.jpg" alt="Istanbul, Turkey">
                    <h3>Istanbul, Turkey</h3>
                    <p>Explore the city that bridges Europe and Asia.</p>
                </a>
            </div>
            <!-- Hong Kong -->
            <div class="destination-item" onclick="loadDestinationDetails('hongkong')">
                <a href="destinations/hongkong.php">
                    <img src="images/hongkong.jpg" alt="Hong Kong">
                    <h3>Hong Kong</h3>
                    <p>Experience the vibrant energy of Hong Kong.</p>
                </a>
            </div>
            <!-- Amsterdam -->
            <div class="destination-item" onclick="loadDestinationDetails('amsterdam')">
                <a href="destinations/amsterdam.php">
                    <img src="images/amsterdam.jpg" alt="Amsterdam, Netherlands">
                    <h3>Amsterdam, Netherlands</h3>
                    <p>Discover the canals and culture of Amsterdam.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Booking Form -->
    <section class="booking-form" style="display: none;">
        <h2>Book Your Flight</h2>
        <form id="booking-form">
            <div class="form-group">
                <label for="passenger-name">Passenger Name:</label>
                <input type="text" id="passenger-name" required>
            </div>
            <div class="form-group">
                <label>Class:</label>
                <label><input type="radio" name="class" value="Economy" required> Economy</label>
                <label><input type="radio" name="class" value="Business"> Business</label>
            </div>
            <div class="form-group">
                <label for="contact-info">Contact Info:</label>
                <input type="text" id="contact-info" required>
            </div>
            <button type="submit">Book Now</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Kosova Airlines. All rights reserved.</p>
    </footer>

    <script src="js/booking.js"></script>
    <script src="js/global.js"></script>
    <script src="js/navigation.js"></script>
    <script src="js/search.js"></script>
    <script src="js/responsive.js"></script>
</body>
</html>
