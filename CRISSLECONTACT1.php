<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = '';
$database = "webprogruba_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM registration_tbl WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email exists, proceed to send the message

        // Your code to send the message would go here
        // For demonstration purposes, we'll just display a success message
        echo "Message sent successfully!";
    } else {
        // Email does not exist in the database
        echo "Email not found in the database. Please sign up first.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>CONTACT</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- =======================================================
    * Template Name: Personal
    * Updated: Jan 29 2024 with Bootstrap v5.3.2
    * Template URL: https://bootstrapmade.com/personal-free-resume-bootstrap-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<body>
    <!-- ======= Header ======= -->
    <header id="header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <!-- Adjust column classes as needed -->
                    <a href="index.html">
                        <img src="loglog.png" alt="" class="img-fluid" style="display: block; margin: 0 auto;">
                    </a>
                </div>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link" href="index.html">Home</a></li>
                        <li><a class="nav-link active" href="CRISSLEABOUT.html#about">About</a></li>
                        <li><a class="nav-link" href="CRISSLEPORTFOLIO.html#portfolio">Portfolio</a></li>
                        <li><a class="nav-link" href="CRISSLECONTACT.html#contact">Contact</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
            </div>
        </div>
    </header><!-- End Header -->
  
    <section id="contact" class="contact">

<div class="container" style="background-image: url('nabi.png'); background-position: top right; background-size: cover; background-repeat: no-repeat;">

  <div class="section-title">
    <center><h2>Contact</h2></center>
    <center><p>Contact Me</p></center>
  </div>

  <div class="row mt-2">

    <div class="col-lg-3 col-md-4">
      <br>
      <div class="info-box" style="text-align: center;">
        <i class="bx bx-map"  style="color: #c08081; display: inline-block;"></i>
        <b><h3 style="color: #c08081;">My Address</h3></b>
        <p style="color: #c08081;">Quezon City, Metro Manila, Philippines</p>
      </div>
    </div>
    <br>

    <div class="col-lg-3 col-md-4">
      <br>
      <div class="info-box" style="text-align: center;">
        <i class="bx bx-share-alt" style="color: #c08081; display: inline-block;"></i>
        <h3 style="color: #c08081;">Social Profiles</h3>
        <div class="social-links">
          <a href="https://m.me/marycrissle" class="twitter"><i class="bi bi-messenger"  style="color: #c08081;"></i></a>
          <a href="https://t.me/shawarmaryce" class="telegram"><i class="bi bi-telegram"  style="color: #c08081;"></i></a>
          <a href="https://www.instagram.com/crissle13" class="instagram"><i class="bi bi-instagram"  style="color: #c08081;"></i></a>
          <a href="https://www.facebook.com/marycrissle" class="facebook"><i class="bi bi-facebook"  style="color: #c08081;"></i></a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-4">
      <br>
      <div class="info-box" style="text-align: center;">
        <i class="bx bx-envelope" style="color: #c08081; display: inline-block;"></i>
        <b><h3 style="color: #c08081;">Email Me</h3></b>
        <p style="color: #c08081;">crisslrba@gmail.com</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-4">
      <br>
      <div class="info-box" style="text-align: center;">
        <i class="bx bx-phone-call" style="color: #c08081; display: inline-block;"></i>
        <h3 style="color: #c08081;">Call Me</h3>
        <b><p style="color: #c08081;">+63 9453772341</p></b>
      </div>
    </div>
  </div>

  <form action="forms/contact.php" method="post" role="form" class="php-email-form mt-4" id="contactForm" disabled>
    <div class="row">
        <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
        </div>
        <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
        </div>
    </div>
    <div class="form-group mt-3">
        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
    </div>
    <div class="form-group mt-3">
        <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
    </div>
    <br>
    <div class="text-center"><button type="submit" style="color: #c08081; border-color: #c08081;">Send Message</button></div>
    <button style="color: #c08081; border-color: #c08081;"><a href="index.html">Log Out</a></button>
</form>
<br>
</div>
<br>
        </div>
    </section><!-- End Contact Section -->


    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main1.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const contactForm = document.getElementById('contactForm');

            contactForm.addEventListener('submit', function (event) {
                event.preventDefault();

                // Get form data
                const formData = new FormData(contactForm);

                // Send form data to PHP script using fetch API
                fetch('CRISSLECONTACT1.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    // Show alert with response message
                    alert(data);

                    // Reset form fields
                    contactForm.reset();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    </script>
</body>
</html>
