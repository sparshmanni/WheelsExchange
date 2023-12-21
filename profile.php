<?php
// Include necessary files and start the session
include 'config.php';
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Fetch user details from the database
$user_id = $_SESSION["user_id"];
$result = $conn->query("SELECT * FROM users WHERE id = $user_id");

// Check if user details are fetched successfully
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Handle the case where user details are not found
    echo "Error: User details not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css"> <!-- Replace with your actual stylesheet -->
</head>

<body>
    <header>
        <h1>User Profile</h1>
    </header>
    <nav>
        <a href="dashboard.php">Home</a>
        <a href="#">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
    <section>
        <div class="user-details">
            <h2>Welcome, <?php echo $user['username']; ?>!</h2>
            <p>Email: <?php echo $user['email']; ?></p>
            <p>Registration Date: <?php echo $user['reg_date']; ?></p>
            <!-- Add more details as needed -->
        </div>
    </section>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> WheelsExchange. All rights reserved.</p>
    </footer>
</body>

</html>
