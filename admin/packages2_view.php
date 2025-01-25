<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destination = $_POST['destination'];
    $rating = $_POST['rating'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Save data to a file (or database)
    $data = [
        'destination' => $destination,
        'image' => $target_file,
        'rating' => $rating
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
        
        <label for="destination">Destination:</label>
        <input type="text" id="destination" name="destination" required><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required><br><br>

        <button type="submit">Upload</button>
    </form>
</body>
</html>