<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_now']) ) {
    // Collect form data
    $destination = htmlspecialchars($_POST['destination']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $date = htmlspecialchars($_POST['date']);
    $adults = htmlspecialchars($_POST['adults']);
    $message = htmlspecialchars($_POST['message']);

	// // Validate email
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     echo "<script>alert('Invalid email format');</script>";
    //     exit;
    // }

    // // Validate phone number
    // if (!preg_match("/^[0-9]{10}$/", $phone)) {
    //     echo "<script>alert('Invalid phone number');</script>";
    //     exit;
    // }

    // Define the recipient email address
    $to = "info@travelzada.com";

    // Define the subject of the email
    $subject = "New Booking Request";

    // Construct the email body
    $body = "You have received a new booking request.\n\n" .
            "Destination: $destination\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $phone\n" .
            "Date: $date\n" .
            "Adults: $adults\n" .
            "Message: $message\n";

    // // Define additional headers
    // $headers = "From: $email\r\n" .
    //            "Reply-To: $email\r\n" .
    //            "X-Mailer: PHP/" . phpversion();

	try {
		//Server settings
		$mail->SMTPDebug = 0;                      // Enable verbose debug output
		$mail->isSMTP();                           // Send using SMTP
		$mail->Host       = 'smtp-relay.brevo.com';    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                  // Enable SMTP authentication
		$mail->Username   = '7c8cbc001@smtp-brevo.com'; // SMTP username
		$mail->Password   = 'y2wM4x6bSEXVO17f';       // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = 587;                   // TCP port to connect to
	
		//Recipients
		$mail->setFrom('theunseenroyalty@gmail.com', 'Mailer');
		$mail->addAddress('info@travelzada.com', 'Recipient'); // Add a recipient

		// Add custom headers
		// $mail->addCustomHeader('Reply-To', $email);
	
		// Content
		$mail->isHTML(true);                       // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $body;
		// $mail->AltBody = $body;                    // non HTML email
	
		$mail->send();
		echo "<script>alert('Email sent successfully!');</script>";
	} catch (Exception $e) {
		echo "<script>alert('Failed to send email.');".$e."</script>";
	}

}
?>


<html lang="en">
<head>
	<?php include 'head.php'; ?>
	<title>Booking</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="" />

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
	
	<!-- css files -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
    <link href="css/style.css" rel='stylesheet' type='text/css' /><!-- custom css -->
    <link href="css/font-awesome.min.css" rel="stylesheet"><!-- fontawesome css -->
	<!-- //css files -->
	
	<!-- google fonts --
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- //google fonts -->
	
</head>
<body>

<?php include 'header.php'; ?>

<!-- banner -->
<section class="banner_inner" id="home">
	<div class="banner_inner_overlay">
	</div>
</section>
<!-- //banner -->


<!-- Booking -->
<section class="contact py-5">
	<div class="container py-lg-5 py-sm-4">
		<h2 class="heading text-capitalize text-center mb-lg-5 mb-4"> Book Your Tour</h2>
		<div class="contact-grids">
			<div class="row">
				<div class="col-lg-7 contact-left-form">
					<!-- <form action="" method="post" class="row" onsubmit="return validateForm()"> -->
					<form action="" method="post" class="row">
						<div class="col-sm-6 form-group contact-forms">
						  <input type="text" class="form-control" placeholder="Destination" name="destination" required="">
						</div>
						<div class="col-sm-6 form-group contact-forms">
						  <input type="text" class="form-control" placeholder="Name" name="name" required="">
						</div>
						<div class="col-sm-6 form-group contact-forms">
						  <input type="email" class="form-control" placeholder="Email" name="email" required="">
						</div>
						<div class="col-sm-6 form-group contact-forms">
						  <input type="text" class="form-control" placeholder="Phone" name="phone" required=""> 
						</div>
						<div class="col-sm-6 form-group contact-forms">
						  <input type="text" class="form-control" placeholder="Date" name="date" required=""> 
						</div>
						<div class="col-sm-6 form-group contact-forms">
							<select class="form-control" id="adults" name="adults">
								<option>Adults</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5 or more</option>
							</select>
						</div>
						<div class="col-md-12 form-group contact-forms">
						  <textarea class="form-control" placeholder="Message" name="message" rows="3" required=""></textarea>
						</div>
						<div class="col-md-12 booking-button">
							<button class="btn btn-block sent-butnn" type="submit" name="book_now">Book Now</button>
						</div>
					</form>
				</div>

				<!-- <script>
					function validateForm() {
						var phone = document.forms[0]["phone"].value;
						// var date = document.forms[0]["date"].value;
						var phonePattern = /^[0-9]{10}$/;
						// var datePattern = /^\d{4}-\d{2}-\d{2}$/;

						if (!phonePattern.test(phone)) {
							alert("Please enter a valid 10-digit phone number.");
							return false;
						}

						// if (!datePattern.test(date)) {
						// 	alert("Please enter a valid date in YYYY-MM-DD format.");
						// 	return false;
						// }

						return true;
					}
					</script> -->

				<div class="col-lg-5 contact-right pl-lg-5">
				
					<div class="image-tour position-relative">
						<img src="images/banner1.jpg" alt="" class="img-fluid" />
						<!--<p><span class="fa fa-tags"></span> <span>20$ - 15% off</span></p>-->
					</div>
					
					<h4>Let us help!</h4>
					<p class="mt-3">Whether you're looking for exclusive hotel deals, customized travel packages, or expert guidance, simply fill out the form below. 
					Our team will get back to you promptly with tailored recommendations and solutions to meet your travel needs. Your adventure begins here—start planning today!</p>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //Booking -->

<?php include 'footer.php' ?>
	
</body>
</html>