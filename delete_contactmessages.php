<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(["success" => false, "message" => "Unauthorized access"]);
    exit();
}

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !is_numeric($data['id'])) {
    echo json_encode(["success" => false, "message" => "Invalid message ID"]);
    exit();
}

$message_id = intval($data['id']);

$conn = new mysqli('localhost', 'root', '', 'kosovaairlines');

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit();
}

// Kontrollo nëse mesazhi ekziston
$stmt = $conn->prepare("SELECT id FROM contactmessages WHERE id = ?");
$stmt->bind_param("i", $message_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "Message not found"]);
    exit();
}

// Fshije mesazhin
$stmt = $conn->prepare("DELETE FROM contactmessages WHERE id = ?");
$stmt->bind_param("i", $message_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Message deleted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error deleting message"]);
}

$stmt->close();
$conn->close();
exit();
?>
