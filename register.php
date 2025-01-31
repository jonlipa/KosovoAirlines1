<?php
class RegisterHandler {
    private $conn;
    private $error_message = '';
    private $success_message = '';

    public function __construct() {
        $this->connectDatabase();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->processRegistration();
        }
    }

    private function connectDatabase() {
        $this->conn = new mysqli('localhost', 'root', '', 'kosovaairlines');
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    private function processRegistration() {
        $username = trim($_POST['reg-username']);
        $email = trim($_POST['reg-email']);
        $password = $_POST['reg-password'];
        $confirm_password = $_POST['reg-confirm-password'];

        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            $this->error_message = "Ju lutemi plotësoni të gjitha fushat!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error_message = "Ju lutemi shkruani një email valid!";
        } elseif ($password !== $confirm_password) {
            $this->error_message = "Fjalëkalimet nuk përputhen!";
        } else {
            $this->checkUserExists($username, $email, $password);
        }
    }

    private function checkUserExists($username, $email, $password) {
        $check_sql = "SELECT id FROM users WHERE username = ? OR email = ?";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->bind_param('ss', $username, $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $this->error_message = "Username ose email tashmë ekziston!";
        } else {
            $this->registerUser($username, $email, $password);
        }
        $check_stmt->close();
    }

    private function registerUser($username, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sss', $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Përdoruesi u regjistrua me sukses! Ju lutemi kyçuni.'); window.location.href='login.php';</script>";
            exit();
        } else {
            $this->error_message = "Gabim gjatë regjistrimit: " . $this->conn->error;
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
            <title>Register - Kosova Airlines</title>
            <link rel="stylesheet" href="css/register.css">
            <link rel="stylesheet" href="css/responsive.css">

        </head>
        <body>
            <div class="container">
                <h1>Register</h1>
                <form id="registerForm" method="POST" action="">
                    <p id="register-error-message" class="error-message"></p>
                    <p id="register-success-message" class="success-message"></p>
                    <div class="input-group">
                        <label for="reg-username">Username</label>
                        <input type="text" id="reg-username" name="reg-username" placeholder="Create a username" 
                            value="<?php echo htmlspecialchars($_POST['reg-username'] ?? ''); ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="reg-email">Email</label>
                        <input type="email" id="reg-email" name="reg-email" placeholder="Enter your email" 
                            value="<?php echo htmlspecialchars($_POST['reg-email'] ?? ''); ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="reg-password">Password</label>
                        <input type="password" id="reg-password" name="reg-password" placeholder="Create a password" required>
                    </div>
                    <div class="input-group">
                        <label for="reg-confirm-password">Confirm Password</label>
                        <input type="password" id="reg-confirm-password" name="reg-confirm-password" placeholder="Confirm your password" required>
                    </div>
                    <button type="submit">Register</button>
                </form>
            </div>

            <!-- Lidhja me skriptet -->
            <script src="js/register.js"></script>
            <script src="js/formvalidation.js"></script>
            <script src="js/responsive.js"></script>
        </body>
        </html>
        <?php
    }
}

// Krijojmë dhe ekzekutojmë objektin e regjistrimit
$register = new RegisterHandler();
$register->render();
?>
