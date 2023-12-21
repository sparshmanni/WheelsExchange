<?php
include 'auth.php'; // Include the authentication file to check if the user is logged in
requireLogin(); // Redirect to login page if not logged in

include 'config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $make = $_POST["make"];
    $model = $_POST["model"];
    $year = $_POST["year"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    // Handle image upload
    $targetDir = "car_images/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // If everything is ok, try to upload file
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now insert listing details into the database
            $sql = "INSERT INTO car (make, model, year, price, description, seller_id, image_filename)
                    VALUES ('$make', '$model', $year, $price, '$description', {$_SESSION['user_id']}, '" . basename($_FILES["image"]["name"]) . "')";

            if ($conn->query($sql) === TRUE) {
                echo "Listing created successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Listing - WheelsExchange</title>
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
        <a href="logout.php">Logout</a> <!-- Logout link -->

        <!-- Display user's profile picture and name -->
        <div class="user-info">
            <?php
            if (isset($profilePicture) && !empty($profilePicture)) {
                echo '<img src="profile_pics/' . $profilePicture . '" alt="Profile Picture">';
            } else {
                echo '<img src="default_profile_pic.jpg" alt="Default Profile Picture">';
            }
            ?>
            <span><?php echo $_SESSION["user_id"]; ?></span>
        </div>
    </nav>

    <section class="container">
        <h2>Create a Listing</h2>
        <form action="create_listing.php" method="post" enctype="multipart/form-data">
            <label for="make">Make:</label>
            <input type="text" name="make" required>

            <label for="model">Model:</label>
            <input type="text" name="model" required>

            <label for="year">Year:</label>
            <input type="number" name="year" required>

            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01" required>

            <label for="description">Description:</label>
            <textarea name="description" rows="4" required></textarea>

            <label for="image">Car Image:</label>
            <input type="file" name="image" accept="image/*" required>

            <input type="submit" value="Create Listing">
        </form>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> WheelsExchange. All rights reserved.</p>
    </footer>
</body>

</html>
