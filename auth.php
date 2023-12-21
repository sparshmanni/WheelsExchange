<?php
include('config.php');

session_start();

function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    include 'config.php';

    $userId = $_SESSION['user_id'];
    $result = $conn->query("SELECT * FROM users WHERE id = $userId");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user; // Store user data in the session
    } else {
        // Handle the case where user data is not found
        header("Location: login.php");
        exit();
    }
}

// Check if the user is logged in and retrieve user data
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $result = $conn->query("SELECT * FROM users WHERE id = $userId");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user; // Store user data in the session
    } else {
        // Handle the case where user data is not found
        header("Location: login.php");
        exit();
    }
}

?>
