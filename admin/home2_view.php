<?php
include 'admin-database-connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destination = $_POST['destination'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO destinations (destination, image) VALUES (?, ?)");
    $stmt->bind_param("ss", $destination, $target_file);

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
    <h2>Upload Destination</h2>
    <form action="upload-content.php" method="post" enctype="multipart/form-data">
        <label for="destination">Destination:</label>
        <input type="text" name="destination" id="destination" required><br><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required><br><br>

        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>