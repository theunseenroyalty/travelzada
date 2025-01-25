<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $rating = $_POST['rating'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Save data to a file (or database)
    $data = [
        'image' => $target_file,
        'title' => $title,
        'rating' => $rating,
        'description' => $description,
        'duration' => $duration
    ];
    file_put_contents('service_data.json', json_encode($data, JSON_PRETTY_PRINT), FILE_APPEND);

    echo "Service content uploaded successfully!";
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
    <form action="upload_service.php" method="post" enctype="multipart/form-data">
        <h2>Upload Service Content</h2>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br><br>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="duration">Duration:</label>
        <input type="text" id="duration" name="duration" required><br><br>

        <button type="submit">Upload</button>
    </form>
</body>
</html>