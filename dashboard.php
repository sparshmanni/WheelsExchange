<?php

include 'auth.php'; // Include the authentication file to check if the user is logged in
requireLogin(); // Redirect to login page if not logged in

include 'config.php';
// Use the $conn variable from config.php for database connection
$result = $conn->query("SELECT * FROM car");

// Fetch all listings into an array
$listings = [];
while ($row = $result->fetch_assoc()) {
    $listings[] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - WheelsExchange</title>
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
         <!-- Logout link -->

        <!-- Display user's profile picture and name -->
        <div class="user-dropdown">
        <div class="user-logo"> <!-- Add your user profile logo here -->
            <!-- You can use an image or an icon for the user profile logo -->
            <img src="https://logodix.com/logo/1984203.png" alt="User Logo">
        </div>
        <div class="user-menu">
            <span class="username"><?php echo $user['username']; ?></span>
            <div class="dropdown-content">
                <a href="profile.php">Profile</a>
                <a href="logout.php">Logout</a>
                <a href="create_listing.php">List your Car</a>
            </div>
        </div>
    </div>
</nav>
    </nav>

    <section class="container">

        <h2 class="listhead">Available Listings</h2>
        <div class="listing-container">
            <?php
             if (empty($listings)) {
                echo '<p>No listings available at this moment.</p>';
            } else {
            // Loop through each car listing and display information
            foreach ($listings as $listing) {
                echo '<div class="listing-card">';
                echo '<img src="car_images/' . $listing['image_filename'] . '" alt="Car Image">';
                echo '<div class="listing-details">';
                echo '<h3>' . $listing['make'] . ' ' . $listing['model'] . ' (' . $listing['year'] . ')</h3>';
                echo '<p>Price: $' . $listing['price'] . '</p>';
                echo '<p>Description: ' . $listing['description'] . '</p>';
                // Add more details if needed
                echo '</div>';
                echo '</div>';
            }}
            ?>
        </div>

        <!-- Add more content or dynamic elements as needed -->
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> WheelsExchange. All rights reserved.</p>
    </footer>
</body>

</html>
