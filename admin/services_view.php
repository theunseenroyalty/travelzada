<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $heading = $_POST['heading'];
    $service_title = $_POST['service_title'];
    $service_description = $_POST['service_description'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Save data to a file (or database)
    $data = [
        'heading' => $heading,
        'image' => $target_file,
        'service_title' => $service_title,
        'service_description' => $service_description
    ];
    file_put_contents('services_data.json', json_encode($data, JSON_PRETTY_PRINT), FILE_APPEND);

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
    <form action="upload_services.php" method="post" enctype="multipart/form-data">
        <h2>Upload Service Content</h2>
        <label for="heading">Heading:</label>
        <input type="text" id="heading" name="heading" required><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br><br>

        <label for="service_title">Service Title:</label>
        <input type="text" id="service_title" name="service_title" required><br><br>

        <label for="service_description">Service Description:</label>
        <textarea id="service_description" name="service_description" required></textarea><br><br>

        <button type="submit">Upload</button>
    </form>
</body>
</html>