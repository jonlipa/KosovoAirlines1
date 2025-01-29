<?php
session_start();

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php?message=" . urlencode("This page is restricted to admin users only."));
    exit();
}

// Add headers to prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Database connection
$conn = new mysqli('localhost', 'root', '', 'kosovaairlines');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Total number of users
$total_users_query = "SELECT COUNT(*) as total_users FROM users";
$total_users_result = $conn->query($total_users_query);
$total_users = $total_users_result->fetch_assoc()['total_users'];

// Number of users with the 'user' role
$total_users_role_query = "SELECT COUNT(*) as total_users_role FROM users WHERE role = 'user'";
$total_users_role_result = $conn->query($total_users_role_query);
$total_users_role = $total_users_role_result->fetch_assoc()['total_users_role'];

// Number of admins
$total_admins_query = "SELECT COUNT(*) as total_admins FROM users WHERE role = 'admin'";
$total_admins_result = $conn->query($total_admins_query);
$total_admins = $total_admins_result->fetch_assoc()['total_admins'];

// Fetch all users from the 'users' table
$sql_users = "SELECT id, username, email, role, created_at FROM users";
$result_users = $conn->query($sql_users);

// Fetch all reservations from the 'reservations' table
$sql_reservations = "SELECT r.id, d.name AS destination, r.first_name, r.last_name, r.email, r.phone_number, 
                           r.departure_date, r.return_date, r.travel_class
                    FROM reservations r
                    INNER JOIN destinations d ON r.destination_id = d.id
                    ORDER BY r.departure_date ASC";
$result_reservations = $conn->query($sql_reservations);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>
    <h1>Welcome to the Admin Panel!</h1>
    <div class="container">
        <h2>Statistics</h2>
        <ul>
            <li>Total number of users: <?php echo $total_users; ?></li>
            <li>Number of users with the 'user' role: <?php echo $total_users_role; ?></li>
            <li>Number of administrators: <?php echo $total_admins; ?></li>
        </ul>

        <h2>User List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_users->num_rows > 0): ?>
                    <?php while ($row = $result_users->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No users to display.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Reservations</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Destination</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Departure Date</th>
                    <th>Return Date</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_reservations->num_rows > 0): ?>
                    <?php while ($row = $result_reservations->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['destination']); ?></td>
                            <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['departure_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['return_date'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($row['travel_class']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No reservations to display.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="logout">
            <a href="logout.php">Log Out</a>
        </div>
    </div>

    <script>
        // Prevent the back button after logging out
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            history.go(1); // Go forward if the back button is used
        };
    </script>
</body>
</html>
