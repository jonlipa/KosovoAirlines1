<?php
session_start();

class ReservationDeleter {
    private $conn;
    private $reservation_id;

    public function __construct() {
        // Kontrollo nëse përdoruesi është admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->sendResponse(false, "Unauthorized access");
        }

        // Lidhu me databazën
        $this->connectDatabase();

        // Merr të dhënat nga kërkesa JSON
        $this->parseRequestData();
    }

    private function connectDatabase() {
        $this->conn = new mysqli('localhost', 'root', '', 'kosovaairlines');

        if ($this->conn->connect_error) {
            $this->sendResponse(false, "Database connection failed");
        }
    }

    private function parseRequestData() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id']) || !is_numeric($data['id'])) {
            $this->sendResponse(false, "Invalid reservation ID");
        }

        $this->reservation_id = intval($data['id']);
    }

    public function deleteReservation() {
        // Kontrollo nëse ekziston rezervimi përpara fshirjes
        if (!$this->reservationExists()) {
            $this->sendResponse(false, "Reservation not found");
        }

        // Kryej fshirjen
        $stmt = $this->conn->prepare("DELETE FROM reservations WHERE id = ?");
        $stmt->bind_param("i", $this->reservation_id);

        if ($stmt->execute()) {
            $this->sendResponse(true, "Reservation deleted successfully");
        } else {
            $this->sendResponse(false, "Error deleting reservation");
        }

        $stmt->close();
        $this->conn->close();
    }

    private function reservationExists() {
        $check_query = $this->conn->prepare("SELECT id FROM reservations WHERE id = ?");
        $check_query->bind_param("i", $this->reservation_id);
        $check_query->execute();
        $result = $check_query->get_result();
        $check_query->close();

        return $result->num_rows > 0;
    }

    private function sendResponse($success, $message) {
        echo json_encode(["success" => $success, "message" => $message]);
        exit();
    }
}

// Krijo dhe ekzekuto objektin për fshirjen e rezervimit
$deleter = new ReservationDeleter();
$deleter->deleteReservation();
?>
