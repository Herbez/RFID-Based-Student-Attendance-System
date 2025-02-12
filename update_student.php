<?php

require 'dbconn.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $year_of_study = $_POST['year_of_study'];
    $class = $_POST['class'];
    $payment_status = $_POST['payment_status'];

    // Handle File Upload
    if (!empty($_FILES['photo']['name'])) {
        $target_dir = "uploads/";
        $photo = basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $photo;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate File Type
        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                // Update with photo
                $sql = "UPDATE table_the_iot_projects SET name = ?, year_of_study = ?, class = ?, payment_status = ?, photo = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name, $year_of_study, $class, $payment_status, $photo, $id]);
            }
        } else {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');</script>";
        }
    } else {
        // Update without changing the photo
        $sql = "UPDATE table_the_iot_projects SET name = ?, year_of_study = ?, class = ?, payment_status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $year_of_study, $class, $payment_status, $id]);
    }

    echo "<script>alert('Record updated successfully!'); window.location.href='students.php';</script>";
}
?>
