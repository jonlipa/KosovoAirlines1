<?php
session_start();

class AdminDashboard {
    private $conn;
    
    public function __construct() {
        $this->checkAdminAccess();
        $this->preventCaching();
        $this->connectDatabase();
        $this->handleReservationDeletion();
        $this->handleContactMessageDeletion();
    }

    private function checkAdminAccess() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error_message'] = "This page is restricted to admin users only.";
            header("Location: login.php");
            exit();
        }
    }
    
    private function preventCaching() {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    private function connectDatabase() {
        $this->conn = new mysqli('localhost', 'root', '', 'kosovaairlines');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function handleReservationDeletion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_reservation'])) {
            $email = $this->conn->real_escape_string($_POST['email']);
            $departure_date = $this->conn->real_escape_string($_POST['departure_date']);
            
            $delete_query = "DELETE FROM reservations WHERE email = '$email' AND departure_date = '$departure_date'";
            if ($this->conn->query($delete_query)) {
                $_SESSION['success_message'] = "Reservation successfully deleted.";
            } else {
                $_SESSION['error_message'] = "Failed to delete reservation. Please try again.";
            }
            header("Location: admin_dashboard.php");
            exit();
        }
    }

    private function handleContactMessageDeletion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_message'])) {
            $message_id = intval($_POST['message_id']);
            
            $delete_query = "DELETE FROM contactmessages WHERE id = ?";
            $stmt = $this->conn->prepare($delete_query);
            $stmt->bind_param("i", $message_id);
            
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Message successfully deleted.";
            } else {
                $_SESSION['error_message'] = "Failed to delete message. Please try again.";
            }
            $stmt->close();
            header("Location: admin_dashboard.php");
            exit();
        }
    }

    public function fetchStatistics() {
        return [
            'total_users' => $this->getSingleValue("SELECT COUNT(*) as total_users FROM users"),
            'total_users_role' => $this->getSingleValue("SELECT COUNT(*) as total_users_role FROM users WHERE role = 'user'"),
            'total_admins' => $this->getSingleValue("SELECT COUNT(*) as total_admins FROM users WHERE role = 'admin'"),
        ];
    }

    private function getSingleValue($query) {
        $result = $this->conn->query($query);
        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        $row = $result->fetch_assoc();
        if (!$row) {
            return 0; // Nëse nuk ka rezultat, kthe një vlerë default
        }

        return reset($row); // Merr vlerën e parë nga array
    }

    public function fetchUsers() {
        return $this->queryResult("SELECT username, email, role, created_at FROM users");
    }

    public function fetchReservations() {
        return $this->queryResult("SELECT d.name AS destination, r.first_name, r.last_name, r.email, r.phone_number, 
                                   r.departure_date, r.return_date, r.travel_class
                                   FROM reservations r
                                   INNER JOIN destinations d ON r.destination_id = d.id
                                   ORDER BY r.departure_date ASC");
    }

    public function fetchContactMessages() {
        return $this->queryResult("SELECT id, name, email, message, created_at FROM contactmessages ORDER BY created_at DESC");
    }


    private function queryResult($query) {
        $result = $this->conn->query($query);
        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
}

$adminDashboard = new AdminDashboard();
$statistics = $adminDashboard->fetchStatistics();
$users = $adminDashboard->fetchUsers();
$reservations = $adminDashboard->fetchReservations();
$ContactMessages = $adminDashboard->fetchContactMessages();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <link rel="stylesheet" href="css/responsive.css">

    <script>
        function confirmDelete(button) {
            const row = button.closest('tr');
            row.querySelector('.delete-message').style.display = 'block';
        }
    </script>
</head>
<body>
    <h1>Welcome to the Admin Panel!</h1>
    <div class="container">
        <h2>Statistics</h2>
        <ul>
            <li>Total number of users: <?php echo $statistics['total_users']; ?></li>
            <li>Number of users with the 'user' role: <?php echo $statistics['total_users_role']; ?></li>
            <li>Number of administrators: <?php echo $statistics['total_admins']; ?></li>
        </ul>

        <h2>User List</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $users->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Reservations</h2>
        <table>
            <thead>
                <tr>
                    <th>Destination</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Departure Date</th>
                    <th>Return Date</th>
                    <th>Class</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $reservations->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['destination']); ?></td>
                        <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['departure_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['return_date'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($row['travel_class']); ?></td>
                        <td>
                            <button type="button" onclick="confirmDelete(this)">Delete</button>
                            <div class="delete-message" style="display:none;">
                                <p>Are you sure you want to delete this reservation?</p>
                                <form method="POST">
                                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
                                    <input type="hidden" name="departure_date" value="<?php echo htmlspecialchars($row['departure_date']); ?>">
                                    <button type="submit" name="delete_reservation">Yes</button>
                                    <button type="button" onclick="this.parentElement.style.display='none'">No</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Contact Messages</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Received At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $ContactMessages->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td>
                    <button type="button" onclick="confirmDelete(this)">Delete</button>
                            <div class="delete-message" style="display:none;">
                                <p>Are you sure you want to delete this message?</p>
                                <form method="POST">
                                    <input type="hidden" name="message_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" name="delete_message">Yes</button>
                                    <button type="button" onclick="this.parentElement.style.display='none'">No</button>
                                </form>
                            </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

        
    


        <div class="logout">
            <a href="logout.php">Log Out</a>
        </div>
    </div>

    <script src="js/responsive.js"></script>

</body>
</html>