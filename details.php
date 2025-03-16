<?php
include 'db_connection.php'; // Include database connection

// Get package ID from URL parameter (default to 1 if not set)
$package_id = isset($_GET['package_id']) ? (int)$_GET['package_id'] : 1;

// Prepare and execute SQL statement
$stmt = $conn->prepare("SELECT package_name, category, overview, duration, price, image FROM tour_packages WHERE package_id = ?");
$stmt->bind_param("i", $package_id);
$stmt->execute();
$result = $stmt->get_result();
$package = $result->fetch_assoc();

// Close statement
$stmt->close();
$conn->close(); // Close connection

$company_name = "TravelZada";

// Use database values or fallbacks
$package_name = $package['package_name'] ?? 'Singapore';
$category = $package['category'] ?? 'Family Tours';
$duration = $package['duration'] ?? '5N/6D';
$price = $package['price'] ?? 24999.00;

// If no highlights in DB, use these default ones for Singapore
$highlights = isset($package['highlights']) && !empty($package['highlights']) 
    ? explode("\n", $package['highlights']) 
    : [
        "Visit Gardens by the Bay and marvel at the Supertree Grove light show.",
        "Experience the thrill of Universal Studios Singapore with your family.",
        "Explore Sentosa Island's attractions including S.E.A. Aquarium.",
        "Take a night safari at the world's first nocturnal wildlife park.",
        "Enjoy a memorable family shopping experience on Orchard Road."
      ];

$image = htmlspecialchars($package['image'] ?? 'https://blog.novatr.com/hubfs/singapore.jpg');

// Default overview if none in database
$overview = $package['overview'] ?? "A vibrant city-state blending diverse cultures, modern architecture, lush greenery, and a rich culinary scene.";

// Convert overview text to bullet points
$overview_bullets = [];
$sentences = preg_split('/(?<=[.!?])\s+/', $overview, -1, PREG_SPLIT_NO_EMPTY);
foreach ($sentences as $sentence) {
    if (trim($sentence)) {
        $overview_bullets[] = trim($sentence);
    }
}

// Add additional points if overview was too short
if (count($overview_bullets) < 3) {
    $overview_bullets[] = "Perfect for families with attractions suitable for all ages.";
    $overview_bullets[] = "Safe, clean environment with excellent public transportation.";
    $overview_bullets[] = "Enjoy world-class dining from hawker centers to fine restaurants.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php'; ?>
    <title>TravelZada - <?php echo $package_name; ?> Family Tour Package</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="description" content="Explore <?php echo $package_name; ?> with TravelZada's family tour package. <?php echo $overview; ?>">
    <meta name="keywords" content="travel, book, packages, <?php echo strtolower($package_name); ?>, family tours">
    <meta property="og:title" content="TravelZada - <?php echo $package_name; ?> Family Tour Package">
    <meta property="og:description" content="Explore <?php echo $package_name; ?> with TravelZada. <?php echo $overview; ?>">
    <meta property="og:url" content="https://www.travelzada.com/">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://www.travelzada.com/images/logo.png">
    <link rel="canonical" href="https://www.travelzada.com/">
    <link rel="icon" href="https://www.travelzada.com/images/logo.png" type="image/x-icon">

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
  <link href="css/style.css" rel='stylesheet' type='text/css' /><!-- custom css -->
  <link href="css/font-awesome.min.css" rel="stylesheet"><!-- fontawesome css -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/css_slider.css" type="text/css" rel="stylesheet" media="all">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      color: #333;
      font-size: 0.95rem;
    }
    
    /* Header specific style */
    header {
      background-color: #0a2351 !important; /* Dark blue background for header */
    }
    
    /* Content wrapper to create space after header */
    .content-wrapper {
      padding-top: 80px; /* Adjust this value based on your header height */
    }
    
    /* Hero Image Section */
    .package-hero-image { 
      position: relative; 
      height: 70vh; 
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      border-radius: 0 0 15px 15px;
    }
    
    .package-hero-image img { 
      width: 100%; 
      height: 100%; 
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .package-hero-image:hover img {
      transform: scale(1.05);
    }
    
    .package-hero-text { 
      position: absolute; 
      bottom: 40px; 
      left: 40px; 
      color: white; 
      background: rgba(0, 0, 0, 0.6); 
      padding: 25px 30px; 
      border-radius: 10px;
      max-width: 500px; 
      backdrop-filter: blur(5px);
    }
    
    .package-hero-text h1 {
      font-size: 2.2rem;
      margin-bottom: 10px;
      font-weight: 700;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
    }
    
    .package-hero-text p {
      font-size: 1rem;
      margin-bottom: 0;
    }
    
    .package-category {
      display: inline-block;
      background-color: #ff6b6b;
      color: white;
      padding: 5px 12px;
      border-radius: 30px;
      font-size: 0.8rem;
      margin-bottom: 10px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    /* Overview Section */
    .overview-section {
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }
    
    .section-title {
      color: #0a2351;
      position: relative;
      padding-bottom: 15px;
      margin-bottom: 20px;
      font-weight: 600;
      font-size: 1.4rem;
    }
    
    .section-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 3px;
      background: #0a2351;
    }
    
    /* Bullet points styling */
    .bullet-list {
      list-style-type: none;
      padding-left: 0;
    }
    
    .bullet-list li {
      position: relative;
      padding-left: 25px;
      margin-bottom: 12px;
      line-height: 1.6;
    }
    
    .bullet-list li:before {
      content: "•";
      color: #0a2351;
      font-size: 1.2rem;
      position: absolute;
      left: 0;
      top: -2px;
    }
    
    /* Enquiry Box */
    .enquiry-box { 
      background: #ffffff; 
      padding: 25px; 
      border-radius: 15px; 
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      position: sticky;
      top: 100px;
      transition: transform 0.3s;
    }
    
    .enquiry-box:hover {
      transform: translateY(-5px);
    }
    
    .price-tag { 
      font-size: 1.8rem; 
      font-weight: 700; 
      color: #0a2351;
      margin-bottom: 20px;
    }
    
    .price-prefix {
      font-size: 1rem;
      color: #666;
      font-weight: normal;
    }
    
    .duration-badge {
      background-color: #f8f9fa;
      color: #666;
      padding: 8px 15px;
      border-radius: 50px;
      font-weight: 500;
      display: inline-block;
      margin-bottom: 20px;
      font-size: 0.9rem;
    }
    
    .book-btn {
      padding: 10px 20px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s;
      border-radius: 50px;
    }
    
    .book-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }
    
    /* Highlights Section */
    .highlights-section {
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    /* Responsive tweaks */
    @media (max-width: 767px) {
      .package-hero-image {
        height: 50vh;
      }
      
      .package-hero-text {
        bottom: 20px;
        left: 20px;
        padding: 15px 20px;
      }
      
      .package-hero-text h1 {
        font-size: 1.6rem;
      }
      
      .overview-section, .highlights-section {
        padding: 20px;
      }
      
      .enquiry-box {
        margin-top: 30px;
        position: static;
      }
    }
  </style>
</head>
<body class="bg-light">
  <?php include 'header.php'; ?>
  
  <!-- Content wrapper div to create separation from header -->
  <div class="content-wrapper">
    <!-- Hero Image Section -->
    <div class="package-hero-image">
      <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($package_name); ?> Package">
      <div class="package-hero-text">
        <div class="package-category"><?php echo htmlspecialchars($category); ?></div>
        <h1>Experience <?php echo htmlspecialchars($package_name); ?></h1>
        <p><?php echo htmlspecialchars($duration); ?> of family fun and adventure</p>
      </div>
    </div>
    
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <!-- Overview Section -->
          <div class="overview-section">
            <h2 class="section-title">Package Overview</h2>
            <ul class="bullet-list">
              <?php foreach ($overview_bullets as $bullet) { ?>
                <li><?php echo htmlspecialchars(trim($bullet)); ?></li>
              <?php } ?>
            </ul>
          </div>
          
          <!-- Highlights Section -->
          <div class="highlights-section">
            <h2 class="section-title">Package Highlights</h2>
            <ul class="bullet-list">
              <?php foreach ($highlights as $highlight) { ?>
                <li><?php echo htmlspecialchars(trim($highlight)); ?></li>
              <?php } ?>
            </ul>
          </div>
        </div>
        
        <div class="col-lg-4">
          <!-- Booking Box -->
          <div class="enquiry-box text-center">
            <p class="price-tag"><span class="price-prefix">Starting from </span>₹<?php echo number_format($price, 0); ?></p>
            <div class="duration-badge">
              <i class="fa fa-clock-o me-2"></i><?php echo htmlspecialchars($duration); ?>
            </div>
            <a href="booking.php" class="btn btn-primary w-100 book-btn">Book Now</a>

          </div>
        </div>
      </div>
    </div>
  </div>
  
  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
      <p class="mb-0">&copy; 2025 <?php echo $company_name; ?>. All Rights Reserved.</p>
    </div>
  </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>