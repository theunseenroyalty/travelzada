<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $google_plus = $_POST['google_plus'];
    $linkedin = $_POST['linkedin'];
    $office_hours_weekdays = $_POST['office_hours_weekdays'];
    $office_hours_weekends = $_POST['office_hours_weekends'];

    // Save data to a file (or database)
    $data = [
        'location' => $location,
        'phone' => $phone,
        'email' => $email,
        'facebook' => $facebook,
        'twitter' => $twitter,
        'google_plus' => $google_plus,
        'linkedin' => $linkedin,
        'office_hours_weekdays' => $office_hours_weekdays,
        'office_hours_weekends' => $office_hours_weekends
    ];
    file_put_contents('contact_data.json', json_encode($data, JSON_PRETTY_PRINT), FILE_APPEND);

    echo "Contact content uploaded successfully!";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Contact Form</title>
</head>
<body>
    <form action="upload_contact.php" method="post">
        <h2>Upload Contact Content</h2>
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="facebook">Facebook:</label>
        <input type="url" id="facebook" name="facebook" required><br><br>

        <label for="twitter">Twitter:</label>
        <input type="url" id="twitter" name="twitter" required><br><br>

        <label for="google_plus">Google Plus:</label>
        <input type="url" id="google_plus" name="google_plus" required><br><br>

        <label for="linkedin">LinkedIn:</label>
        <input type="url" id="linkedin" name="linkedin" required><br><br>

        <label for="office_hours_weekdays">Office Hours (Weekdays):</label>
        <input type="text" id="office_hours_weekdays" name="office_hours_weekdays" required><br><br>

        <label for="office_hours_weekends">Office Hours (Weekends):</label>
        <input type="text" id="office_hours_weekends" name="office_hours_weekends" required><br><br>

        <button type="submit">Upload</button>
    </form>
</body>
</html>