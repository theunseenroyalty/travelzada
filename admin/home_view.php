<?php
include 'admin-database-connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location = $_POST['location'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO tour_packages (image, location, title, description, duration, price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $target_file, $location, $title, $description, $duration, $price);

    if ($stmt->execute()) {
        echo "Content uploaded successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Content</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>
<body>
    <h2>Upload Tour Package</h2>
    <form action="upload-content.php" method="post" enctype="multipart/form-data">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required><br><br>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required><br><br>

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br><br>

        <label for="duration">Duration:</label>
        <input type="text" name="duration" id="duration" required><br><br>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required><br><br>

        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>


