<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Use the $conn variable from config.php for database connection
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $savedPassword = $row['password'];

        if (password_verify($password, $savedPassword)) {
            // Set session variables and redirect to dashboard after successful login
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $row['id'];

            header("Location: dashboard.php");
            exit();
        }
    }

    // Redirect to login page with an error if login fails
    $loginError = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WheelsExchange</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>WheelsExchange</h1>
    </header>
    
    <nav>
        <a href="index.php">Home</a>
        <a href="listings.php">Listings</a>
        <a href="dashboard.php">Dashboard</a>
        <!-- Add more navigation links as needed -->
    </nav>

    <section class="container">
        <h2 class="welcome">Login</h2>

        <?php if (isset($loginError) && $loginError) : ?>
            <p style="color: red;">Invalid username or password. Please try again.</p>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
            <p>Don't have an account? <a href="index.php">Sign up here</a>.</p>
        </form>
        <!-- End Login Form -->

        <!-- Add more content or dynamic elements as needed -->
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> WheelsExchange. All rights reserved.</p>
    </footer>
</body>

</html>
