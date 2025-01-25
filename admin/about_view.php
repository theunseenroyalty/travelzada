<?php
include 'admin-database-connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $heading = $_POST['heading'];
    $content = $_POST['content'];
    $happy_customers = $_POST['happy_customers'];
    $tours_travels = $_POST['tours_travels'];
    $destinations = $_POST['destinations'];
    $experience_years = $_POST['experience_years'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO about_content (heading, content, image, happy_customers, tours_travels, destinations, experience_years) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiii", $heading, $content, $target_file, $happy_customers, $tours_travels, $destinations, $experience_years);

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
    <title>Upload About Content</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>
<body>
    <h2>Upload About Content</h2>
    <form action="upload-about-content.php" method="post" enctype="multipart/form-data">
        <label for="heading">Heading:</label>
        <input type="text" name="heading" id="heading" required><br><br>

        <label for="content">Content:</label>
        <textarea name="content" id="content" required></textarea><br><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required><br><br>

        <label for="happy_customers">Happy Customers:</label>
        <input type="number" name="happy_customers" id="happy_customers" required><br><br>

        <label for="tours_travels">Tours & Travels:</label>
        <input type="number" name="tours_travels" id="tours_travels" required><br><br>

        <label for="destinations">Destinations:</label>
        <input type="number" name="destinations" id="destinations" required><br><br>

        <label for="experience_years">Experience (Years):</label>
        <input type="number" name="experience_years" id="experience_years" required><br><br>

        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>