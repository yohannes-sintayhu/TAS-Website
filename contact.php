<?php
  require 'Admin/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TAS - Contact</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" type="image/png" href="assets/img/logo2.png" />
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
    .tooltip-inner {
      background-color: #fEc733; /* Tooltip background color */
      color: #fff; /* Tooltip text color */
    }
  </style>
</head>
<?php

                // Fetch statistics from the database
                $sql = "SELECT * FROM social_media LIMIT 1"; // Adjust according to your needs
                $result = $connection->query($sql);
                $socialll = $result->fetch_assoc(); // Fetch the first row
        ?>
<body>
  <?php include 'Header.php'; ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/CommonBarImage/NavBarImage.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Contact</h2>
        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Contact</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-map"></i>
              <h3>Our Address</h3>
              <p><?php echo htmlspecialchars($socialll['address']); ?></p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-envelope"></i>
              <h3>Email Us</h3>
              <p><?php echo htmlspecialchars($socialll['email']); ?></p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center">
              <h6>GET IN TOUCH (ያግኙን)</h6>
              <p>+251922984784</p>
              <div class="social-links d-flex mt-3">
                <a href="<?php echo htmlspecialchars($socialll['Twiter']); ?>" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Follow Us On Twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="<?php echo htmlspecialchars($socialll['facebook']); ?>" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Follow Us On Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="<?php echo htmlspecialchars($socialll['instagram']); ?>" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Follow Us On Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="<?php echo htmlspecialchars($socialll['linkidin']); ?>" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Follow Us On LinkedIn">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="<?php echo htmlspecialchars($socialll['youtube']); ?>" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Follow Us On Youtube">
                    <i class="bi bi-youtube"></i>
                </a>
            </div>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="row gy-4 mt-1">

          <div class="col-lg-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10656.302368193821!2d38.775206369054104!3d9.000209255153841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b84fbee9d819b%3A0x2198897002811488!2sAlem%20Cinema!5e0!3m2!1sen!2set!4v1709016106742!5m2!1sen!2set" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row gy-4">
                <div class="col-lg-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-lg-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <?php include 'footer.php'; ?>
  </footer>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>