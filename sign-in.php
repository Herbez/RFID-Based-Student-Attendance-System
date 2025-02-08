<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>
<?php
session_start();
$message = "";

require 'dbconn.php';

try {
    if (isset($_POST["sign-in"])) {
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            $message = 'Email and Password are required!';
        } else {
            $query = "SELECT * FROM users WHERE email = :email AND password = :password";
            $statement = $conn->prepare($query);
            $statement->execute(
                array(
                    'email'     =>     $_POST["email"],
                    'password'  =>     $_POST["password"]
                )
            );
            $count = $statement->rowCount();
            if ($count > 0) {
                $user = $statement->fetch(PDO::FETCH_ASSOC);
                $_SESSION["email"] = $_POST['email'];

                if ($user['type'] == 1) {
                    header("location:admin.php");
                } else {
                    header("#");
                }
            } else {
                $message = 'Invalid Email or Password ';
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>