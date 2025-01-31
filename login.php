<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Kontrollon nëse është ardhur nga logout.php
if (isset($_SESSION['just_logged_out']) && $_SESSION['just_logged_out'] === true) {
    unset($_SESSION['just_logged_out']); // Heq këtë flag që të mos përsëritet
    echo "<script>
            sessionStorage.setItem('loggedOut', 'true');
            window.location.href = 'login.php';
          </script>";
    exit();
}

class LoginHandler {
    private $conn;
    private $error_message = '';
    private $message = '';

    public function __construct() {
        $this->connectDatabase();
        $this->checkMessage();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->processLogin();
        }
    }

    private function connectDatabase() {
        $this->conn = new mysqli('localhost', 'root', '', 'kosovaairlines');
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    private function checkMessage() {
        if (isset($_GET['message']) && !empty($_GET['message'])) {
            $this->message = htmlspecialchars(urldecode($_GET['message']));
        }
    }

    private function processLogin() {
        $username = htmlspecialchars(trim($_POST['username']));
        $password = trim($_POST['password']);

        $stmt = $this->conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];

                $redirect_url = $_SESSION['redirectAfterLogin'] ?? 'index.php';
                unset($_SESSION['redirectAfterLogin']);
                header("Location: $redirect_url");
                exit();
            } else {
                $this->error_message = "Invalid username or password.";
            }
        } else {
            $this->error_message = "Invalid username or password.";
        }

        $stmt->close();
    }

    public function render() {
        if (isset($_SESSION['user_id'])) {
            $this->renderWelcomePage();
        } else {
            $this->renderLoginPage();
        }
    }

    private function renderWelcomePage() {
        $username = htmlspecialchars($_SESSION['username']);
        $role = $_SESSION['role'];
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Welcome</title>
            <link rel="stylesheet" href="css/login.css">
            <link rel="stylesheet" href="css/responsive.css">

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

    private function renderLoginPage() {
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
                    <?php if (!empty($this->message)): ?>
                        <p class="info-message"> <?php echo $this->message; ?> </p>
                    <?php endif; ?>

                    <p id="error-message" class="error-message" style="display: <?php echo empty($this->error_message) ? 'none' : 'block'; ?>;"> 
                        <?php echo htmlspecialchars($this->error_message); ?>
                    </p>

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

            <script src="js/login.js"></script>
            <script src="js/formvalidation.js"></script>
            <script src="js/responsive.js"></script>
        </body>
        </html>
        <?php
    }
}

$login = new LoginHandler();
$login->render();
?>
