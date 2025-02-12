<?php
session_start();

// Include the database connection
require 'dbconn.php';

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

// Check if the user ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];

    try {
        // Begin a transaction
        $conn->beginTransaction();

        // Delete related reports from the report table
        $sqlDeleteReports = "DELETE FROM report WHERE sid = :id";
        $stmtDeleteReports = $conn->prepare($sqlDeleteReports);
        $stmtDeleteReports->bindParam(':id', $userId, PDO::PARAM_STR);
        $stmtDeleteReports->execute();

        // Fetch the user's photo
        $sqlPhoto = "SELECT photo FROM table_the_iot_projects WHERE id = :id";
        $stmtPhoto = $conn->prepare($sqlPhoto);
        $stmtPhoto->bindParam(':id', $userId, PDO::PARAM_STR);
        $stmtPhoto->execute();
        $user = $stmtPhoto->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Delete the photo file if it exists
            if (!empty($user['photo']) && file_exists('uploads/' . $user['photo'])) {
                unlink('uploads/' . $user['photo']);
            }

            // Delete the user from the database
            $sqlDelete = "DELETE FROM table_the_iot_projects WHERE id = :id";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bindParam(':id', $userId, PDO::PARAM_STR);

            if ($stmtDelete->execute()) {
                // Commit the transaction
                $conn->commit();
                header("Location: students.php");
                exit();
            } else {
                // Rollback on failure
                $conn->rollBack();
                header("Location: students.php");
                exit();
            }
        } else {
            header("Location: students.php");
            exit();
        }
    } catch (Exception $e) {
        // Rollback on exception
        $conn->rollBack();
        header("Location: students.php?error=An error occurred: " . $e->getMessage());
        exit();
    }
} else {
    header("Location: students.php?error=Invalid request");
    exit();
}
?>
