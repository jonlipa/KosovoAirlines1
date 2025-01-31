<?php
session_start();

class DestinationPage {
    private $conn;
    private $destination_id = 2; // ID e London në databazë
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
            $_SESSION['reservation_success'] = "✅ Reservation successful for $first_name $last_name to London from $departure_date to $return_date in $travel_class class.";
            header("Location: london.php"); 
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
            <title>London, UK - Kosova Airlines</title>
            <link rel="stylesheet" href="../css/destinations/london.css">
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
                <h1>London, UK</h1>
                <p>London is a historic city known for its iconic landmarks such as Tower Bridge, Buckingham Palace, and the British Museum. Experience the rich culture and traditions of one of the world’s most visited cities.</p>
                <p>The city is home to famous attractions like the London Eye, Big Ben, and the Houses of Parliament. Visitors can explore the vibrant streets of Camden, take a walk along the River Thames, or enjoy a show in the West End.</p>

            </section>

            <section class="image-gallery">
                <div class="gallery">
                    <img src="../images/london1.jpg" alt="London Image 1" class="gallery-item">
                    <img src="../images/london2.jpg" alt="London Image 2" class="gallery-item">
                    <img src="../images/london3.jpg" alt="London Image 3" class="gallery-item">
                </div>
            </section>

            <div id="imageModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="modalImage">
            </div>

            <section class="booking-form">
                <h2>Book Your Flight to London</h2>
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
                            <label><input type="radio" name="travel_class" value="Economy" required> Economy - €400</label>
                            <label><input type="radio" name="travel_class" value="Business"> Business - €900</label>
                            <label><input type="radio" name="travel_class" value="First Class"> First Class - €2000</label>
                        </div>
                    </div>
                    <button type="submit">Book Now</button>
                </form>
            </section>

            <footer>
                <p>&copy; 2024 Kosova Airlines. All rights reserved.</p>
            </footer>

            <script defer src="../js/destinations/london.js"></script>
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
