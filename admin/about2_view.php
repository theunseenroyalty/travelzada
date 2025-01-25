<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $testimonial = $_POST['testimonial'];
    $customer_name = $_POST['customer_name'];
    $image = $_FILES['image'];

    // Directory where images will be saved
    $target_dir = "images/";
    $target_file = $target_dir . basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($image["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($image["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            // Save testimonial data to a file or database
            $data = [
                'testimonial' => $testimonial,
                'customer_name' => $customer_name,
                'image' => $target_file
            ];
            // Here you can save $data to a database or a file
            // For simplicity, let's save it to a JSON file
            $json_data = json_encode($data);
            file_put_contents('testimonials.json', $json_data . PHP_EOL, FILE_APPEND);
            echo "The file ". htmlspecialchars(basename($image["name"])). " has been uploaded.";
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
    <title>Admin Panel - Upload Testimonial</title>
</head>
<body>
    <h2>Upload Customer Testimonial</h2>
    <form action="upload_testimonial.php" method="post" enctype="multipart/form-data">
        <label for="testimonial">Testimonial:</label><br>
        <textarea id="testimonial" name="testimonial" rows="4" cols="50" required></textarea><br><br>
        
        <label for="customer_name">Customer Name:</label><br>
        <input type="text" id="customer_name" name="customer_name" required><br><br>
        
        <label for="image">Upload Image:</label><br>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>
        
        <input type="submit" value="Upload">
    </form>
</body>
</html>
