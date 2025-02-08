<?php
include 'dbconn.php';

// Set JSON response header
header('Content-Type: application/json');

try {
    // Check if "id" parameter is provided
    if (!isset($_GET['id'])) {
        http_response_code(400); // Bad Request
        echo json_encode(array("error" => "Missing ID parameter"));
        exit;
    }

    $id = $_GET['id'];

    // Prepare SQL statement
    $sql = "SELECT id, name, payment_status FROM table_the_iot_projects WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch result
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);
    } else {
        http_response_code(404); // Not Found
        echo json_encode(array("error" => "Not Found"));
    }
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(array("error" => "Database Error: " . $e->getMessage()));
}

$conn = null; // Close the connection
?>
