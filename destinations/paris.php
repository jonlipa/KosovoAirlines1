<?php
session_start();

class DestinationPage {
    private $conn;
    private $destination_id = 3; // ID e Paris-it në databazë
    private $successMessage = "";

    public function __construct() {
        $this->connectDatabase();
        $this->checkLogin();
        $this->checkReservationMessage();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processBooking();
        }
    }

    private function connectDatabase() {
        $this->conn = new mysqli('localhost', 'root', '', 'kosovaairlines');
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    private function checkLogin() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirectAfterLogin'] = $_SERVER['REQUEST_URI']; 
            header("Location: ../login.php?message=" . urlencode("Ju lutem kyçuni për të bërë rezervimin e biletës."));
            exit();
        }
    }

    private function checkReservationMessage() {
        if (isset($_SESSION['reservation_success'])) {
            $this->successMessage = $_SESSION['reservation_success'];
            unset($_SESSION['reservation_success']);
        }
    }

    private function processBooking() {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $departure_date = $_POST['departure_date'];
        $return_date = $_POST['return_date'];
        $travel_class = $_POST['travel_class'];

        $sql = "INSERT INTO reservations (destination_id, first_name, last_name, email, phone_number, departure_date, return_date, travel_class)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('isssssss', $this->destination_id, $first_name, $last_name, $email, $phone_number, $departure_date, $return_date, $travel_class);

        if ($stmt->execute()) {
            $_SESSION['reservation_success'] = "✅ Reservation successful for $first_name $last_name to Paris from $departure_date to $return_date in $travel_class class.";
            header("Location: paris.php"); 
            exit();
        }

        $stmt->close();
    }

    public function render() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Paris, France - Kosova Airlines</title>
            <link rel="stylesheet" href="../css/destinations/paris.css">
            <link rel="stylesheet" href="../css/responsive.css">
        </head>
        <body>
            <header class="page-header">
                <h1 class="logo">Kosova Airlines</h1>
                <nav>
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../destinations.php">Destinations</a></li>
                    </ul>
                </nav>
            </header>

            <?php if (!empty($this->successMessage)): ?>
                <div class="alert success">
                    <?php echo $this->successMessage; ?>
                </div>
            <?php endif; ?>

            <section class="destination-details">
                <h1>Paris, France</h1>
                <p>Paris, known as the City of Light, is a global center for art, fashion, gastronomy, and culture. It is home to famous landmarks such as the Eiffel Tower, Louvre Museum, and Notre-Dame Cathedral.</p>
                <p>Visitors can explore the charming streets of Montmartre, take a boat cruise along the River Seine, or enjoy a coffee at a Parisian café. Paris offers a unique blend of history, culture, and modern attractions.</p>
                <p>The city is renowned for its haute couture fashion, fine dining, and vibrant art scene. Don't miss iconic spots like the Champs-Élysées, Arc de Triomphe, and the stunning gardens of Versailles.</p>
                <p>Paris is also a hub for education and research, hosting some of the world's top universities and institutions.</p>
            </section>

            <section class="image-gallery">
                <div class="gallery">
                    <img src="../images/paris1.jpg" alt="Paris Image 1" class="gallery-item">
                    <img src="../images/paris2.jpg" alt="Paris Image 2" class="gallery-item">
                    <img src="../images/paris3.jpg" alt="Paris Image 3" class="gallery-item">
                </div>
            </section>

            <div id="imageModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="modalImage">
            </div>

            <section class="booking-form">
                <h2>Book Your Flight to Paris</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="first-name">First Name:</label>
                        <input type="text" name="first_name" id="first-name" required>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name:</label>
                        <input type="text" name="last_name" id="last-name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" name="phone_number" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="departure-date">Departure Date:</label>
                        <input type="date" name="departure_date" id="departure-date" required>
                    </div>
                    <div class="form-group">
                        <label for="return-date">Return Date:</label>
                        <input type="date" name="return_date" id="return-date">
                    </div>
                    <div class="form-group">
                        <label>Class:</label>
                        <div>
                            <label><input type="radio" name="travel_class" value="Economy" required> Economy - €500</label>
                            <label><input type="radio" name="travel_class" value="Business"> Business - €1100</label>
                            <label><input type="radio" name="travel_class" value="First Class"> First Class - €2500</label>
                        </div>
                    </div>
                    <button type="submit">Book Now</button>
                </form>
            </section>

            <footer>
                <p>&copy; 2024 Kosova Airlines. All rights reserved.</p>
            </footer>

            <script defer src="../js/destinations/paris.js"></script>
            <script defer src="../js/responsive.js"></script>
        </body>
        </html>
        <?php
    }
}

// Krijojmë dhe shfaqim faqen e destinacionit
$page = new DestinationPage();
$page->render();
?>
