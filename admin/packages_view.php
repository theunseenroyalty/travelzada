

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $price = $_POST['price'];
    $location = $_POST['location'];
    $package_type = $_POST['package_type'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Save data to a file (or database)
    $data = [
        'image' => $target_file,
        'price' => $price,
        'location' => $location,
        'package_type' => $package_type,
        'description' => $description,
        'duration' => $duration
    ];
    file_put_contents('package_data.json', json_encode($data, JSON_PRETTY_PRINT), FILE_APPEND);

    echo "Package content uploaded successfully!";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Form</title>
</head>
<body>
    <form action="upload_package.php" method="post" enctype="multipart/form-data">
        <h2>Upload Package Content</h2>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br><br>

        <label for="price">Price (INR):</label>
        <input type="text" id="price" name="price" required><br><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>

        <label for="package_type">Package Type:</label>
        <input type="text" id="package_type" name="package_type" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="duration">Duration:</label>
        <input type="text" id="duration" name="duration" required><br><br>

        <button type="submit">Upload</button>
    </form>
</body>
</html>