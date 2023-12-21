<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];

    // Use the $conn variable from config.php for database connection
    $conn->query("INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')");

    // Redirect to login page after successful signup
    header("Location: login.php");
    exit();
}
?>
