<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WheelsExchange - Your Car Marketplace</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>WheelsExchange</h1>
    </header>
    
    <nav>
        <a href="index.html">Home</a>
        <a href="listings.html">Listings</a>
        <a href="dashboard.html">Dashboard</a>
        <!-- Add more navigation links as needed -->
    </nav>

    <section class="container">
        <h2 class="welcome">Welcome to WheelsExchange</h2>

        <!-- Add more content or dynamic elements as needed -->

<!-- Signup Form -->
<form action="signup_process.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <button type="submit">Sign Up</button>
    <p><a href="login.html">Already have account?? Login</a>
</form>
<!-- End Signup Form -->

<!-- Add more content or dynamic elements as needed -->

    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> WheelsExchange. All rights reserved.</p>
    </footer>
</body>

</html>
