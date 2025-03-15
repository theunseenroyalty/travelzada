<?php
$package_name = "Bali Bliss with a Bonus Swing Adventure";
$company_name = "TravelJoy";
$price = 899;
$duration = "4 Nights 5 Days";
$highlights = [
    "Watch a spectacular sunset over Uluwatu Temple.",
    "Explore stunning rice terraces.",
    "Take Instagram-worthy shots on the Bali swing.",
    "Experience white water rafting at Ayung River.",
    "Relax at Padang Padang Beach, a top surfing hotspot."
];
$itinerary = [
    "Day 1" => "Arrival in Bali, transfer to hotel, leisure time.",
    "Day 2" => "Uluwatu Temple, Padang Padang Beach, sunset Kecak dance.",
    "Day 3" => "Ubud adventure: Bali Swing, Ayung River rafting, Quad biking.",
    "Day 4" => "Rice terraces, Sacred Monkey Forest, Tirta Empul Temple.",
    "Day 5" => "Leisure time for shopping and departure."
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $package_name; ?> | <?php echo $company_name; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: Arial, sans-serif; }
    .hero-image { position: relative; height: 60vh; overflow: hidden; }
    .hero-image img { width: 100%; height: 100%; object-fit: cover; }
    .hero-text { position: absolute; bottom: 20px; left: 20px; color: white; background: rgba(0, 0, 0, 0.5); padding: 15px; border-radius: 5px; }
    .enquiry-box { background: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    .price-tag { font-size: 1.5rem; font-weight: bold; color: #28a745; }
  </style>
</head>
<body class="bg-light">
  <header class="bg-white shadow-sm sticky-top">
    <div class="container py-3 d-flex justify-content-between align-items-center">
      <h1 class="text-primary"><?php echo $company_name; ?></h1>
      <nav class="d-none d-md-flex gap-3">
        <a href="#" class="text-dark text-decoration-none fw-semibold">Destinations</a>
        <a href="#" class="text-dark text-decoration-none fw-semibold">Itineraries</a>
        <a href="#" class="text-dark text-decoration-none fw-semibold">Deals</a>
        <a href="#" class="text-dark text-decoration-none fw-semibold">About</a>
        <a href="#" class="text-dark text-decoration-none fw-semibold">Contact</a>
      </nav>
    </div>
  </header>
  
  <div class="hero-image">
    <img src="https://api.travalot.com/attachment/016c7210-8b7a-11ef-8170-9b91e5e2b21e.webp" alt="Bali Bliss">
    <div class="hero-text">
      <h1 class="fw-bold"><?php echo $package_name; ?></h1>
      <p class="fs-5">Experience the magic of Bali with this perfectly curated <?php echo $duration; ?> adventure</p>
    </div>
  </div>
  
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8">
        <h2 class="text-secondary">Overview</h2>
        <p>Explore Bali’s culture, adventure, and breathtaking nature in our <?php echo $duration; ?> package. From Ubud’s greenery to Kuta’s nightlife, this trip is packed with unforgettable moments.</p>
        <p>Enjoy thrilling activities like Bali Swing, white water rafting, and Quad biking, along with visiting historical temples. Book now for an incredible adventure!</p>
      </div>
      <div class="col-md-4">
        <div class="enquiry-box text-center">
          <p class="price-tag">Starting from $<?php echo $price; ?> per person</p>
          <button class="btn btn-primary w-100">Send Enquiry</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container my-5">
    <h2 class="text-secondary">Highlights</h2>
    <ul>
      <?php foreach ($highlights as $highlight) { echo "<li>$highlight</li>"; } ?>
    </ul>
  </div>
  
  <div class="container my-5">
    <h2 class="text-secondary">Itinerary</h2>
    <ul>
      <?php foreach ($itinerary as $day => $detail) { echo "<li><strong>$day:</strong> $detail</li>"; } ?>
    </ul>
  </div>
  
  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
      <p class="mb-0">&copy; 2025 <?php echo $company_name; ?>. All Rights Reserved.</p>
    </div>
  </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
