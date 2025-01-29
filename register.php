<?php
$conn = new mysqli('localhost', 'root', '', 'kosovaairlines');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['reg-username']);
    $email = trim($_POST['reg-email']);
    $password = $_POST['reg-password'];
    $confirm_password = $_POST['reg-confirm-password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "Ju lutemi plotësoni të gjitha fushat!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Ju lutemi shkruani një email valid!";
    } elseif ($password !== $confirm_password) {
        $error_message = "Fjalëkalimet nuk përputhen!";
    } else {
        $check_sql = "SELECT id FROM users WHERE username = ? OR email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param('ss', $username, $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $error_message = "Username ose email tashmë ekziston!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $success_message = "Përdoruesi u regjistrua me sukses!";
                $_POST = array();
            } else {
                $error_message = "Gabim gjatë regjistrimit: " . $conn->error;
            }

            $stmt->close();
        }
        $check_stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kosova Airlines</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form id="registerForm" method="POST" action="">
            <div class="input-group">
                <label for="reg-username">Username</label>
                <input type="text" id="reg-username" name="reg-username" placeholder="Create a username" value="<?php echo htmlspecialchars($_POST['reg-username'] ?? ''); ?>">
            </div>
            <div class="input-group">
                <label for="reg-email">Email</label>
                <input type="email" id="reg-email" name="reg-email" placeholder="Enter your email" value="<?php echo htmlspecialchars($_POST['reg-email'] ?? ''); ?>">
            </div>
            <div class="input-group">
                <label for="reg-password">Password</label>
                <input type="password" id="reg-password" name="reg-password" placeholder="Create a password">
            </div>
            <div class="input-group">
                <label for="reg-confirm-password">Confirm Password</label>
                <input type="password" id="reg-confirm-password" name="reg-confirm-password" placeholder="Confirm your password">
            </div>
            <button type="submit">Register</button>
        </form>
        <?php if (!empty($error_message)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
            <p class="success-message"><?php echo htmlspecialchars($success_message); ?> <a href="login.php">Shko te Login</a></p>
        <?php endif; ?>
    </div>
</body>
</html>
