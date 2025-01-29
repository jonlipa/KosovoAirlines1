<?php 
session_start();

// Lexo mesazhin nga URL-ja (nëse ekziston)
$message = '';
if (isset($_GET['message']) && !empty($_GET['message'])) {
    $message = htmlspecialchars(urldecode($_GET['message']));
}

// Kontrollo nëse përdoruesi është loguar
if (isset($_SESSION['user_id'])) {
    $username = htmlspecialchars($_SESSION['username']);
    $role = $_SESSION['role'];

    // Kontrollo nëse ka një URL për ridrejtim pas kyçjes
    if (isset($_SESSION['redirectAfterLogin'])) {
        $redirect_url = $_SESSION['redirectAfterLogin'];
        unset($_SESSION['redirectAfterLogin']); // E fshijmë pasi të përdoret
        header("Location: $redirect_url");
        exit();
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <div class="container">
            <h1>Welcome, <?php echo $username; ?>!</h1>
            <div class="actions">
                <a href="destinations.php" class="btn explore">Explore Destinations</a>
                <?php if ($role === 'admin'): ?>
                    <a href="admin_dashboard.php" class="btn admin">Go to Dashboard</a>
                <?php endif; ?>
                <a href="logout.php" class="btn logout">Logout</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Përpunimi i formularit të login-it
$error_message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli('localhost', 'root', '', 'kosovaairlines');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $sql = "SELECT id, password, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            // Kontrollo nëse ka një URL për ridrejtim pas kyçjes
            if (isset($_SESSION['redirectAfterLogin'])) {
                $redirect_url = $_SESSION['redirectAfterLogin'];
                unset($_SESSION['redirectAfterLogin']);
                header("Location: $redirect_url");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kosova Airlines</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h1>Login</h1>
            <?php if (!empty($message)): ?>
                <p class="info-message"><?php echo $message; ?></p>
            <?php endif; ?>

            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <form id="loginForm" action="login.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit">Login</button>
                <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
            </form>
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

