<?php
require('dbconn.php');

// Retrieve form data
$name = $_POST['name'] ?? '';
$id = $_POST['id'] ?? '';
$year_of_study = $_POST['year_of_study'] ?? '';
$class = $_POST['class'] ?? '';
$payment_status = $_POST['payment_status'] ?? '';
$photo = $_FILES['photo']['name'] ?? '';
$photo_tmp = $_FILES['photo']['tmp_name'] ?? ''; 

// Validate fields
if (empty($name) || empty($id) || empty($year_of_study) || empty($class) || empty($payment_status) || empty($photo)) {
    echo "<script type='text/javascript'>alert('Please fill all fields');</script>";
} else {
    // Check if ID already exists in the database
    $checkSql = "SELECT id FROM table_the_iot_projects WHERE id = :id";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bindParam(':id', $id);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        // ID already exists
        echo "<script type='text/javascript'>alert('Student Card ID already exists');
        window.location.href = 'register.php';</script>";
    } else {
        // Upload photo to the server (ensure the 'uploads' directory exists and is writable)
        if (move_uploaded_file($photo_tmp, "uploads/" . $photo)) {
            // Use a prepared statement for security
            $sql = "INSERT INTO table_the_iot_projects (name, id, year_of_study, class, photo,payment_status) VALUES (:name, :id, :year_of_study, :class, :photo, :payment_status)";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':year_of_study', $year_of_study);
            $stmt->bindParam(':class', $class);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':payment_status', $payment_status);

            // Execute and check
            if ($stmt->execute()) {
                echo "<script type='text/javascript'>
                    alert('Student added successfully');
                    window.location.href = 'students.php';
                </script>";
                exit(); // Stop further execution
            } else {
                echo "<script type='text/javascript'>alert('Failed to save data to the database');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Failed to upload photo');</script>";
        }
    }
}
?>
