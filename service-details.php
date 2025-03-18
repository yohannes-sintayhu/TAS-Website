<?php
require 'Admin/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

         <title>TAS-Service</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
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
  <link rel="icon" type="image/png" href="assets/img/logo2.png" />

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: UpConstruction
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include 'Header.php'; ?>  
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/CommonBarImage/NavBarImage.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">
      <?php
					$id = $_GET['id'];
					$sql = "SELECT * FROM services WHERE id = $id  And status =1";
						$result = $connection->query($sql);
						if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
										$title = $row['title'];
										$detail = $row['detail'];
										$File_Path = $row['File_Path'];
										$Id=$row['id'];
								}
								}else {
									echo "No services found.";

								}
										
        echo '<h2>'.$title .'  </h2>';
        ?>
        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Service Details</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Service Details Section ======= -->
    <section id="service-details" class="service-details">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row">
      <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM services WHERE id = $id ";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $detail = $row['detail'];
            $File_Path = $row['File_Path'];
            $Id=$row['id'];
          }
        } else {
          echo "No services found.";
        }
      ?>
            <div class="col-lg-4 col-lg-offset-2" data-aos="fade-up">
          <?php echo '<img src="Admin/' . $File_Path . '" class="img-fluid" alt="">';?>
        </div>
        <div class="col-lg-6 col-lg-offset-2 d-flex" data-aos="fade-up">
        <div class="content"  padding: 20px; display: inline-block; max-width: 100%;">
          <?php echo '<h3 >' . htmlspecialchars($title) . '</h3>';?>
          <?php 
            echo '<ul style="margin-bottom: 0;">
              <li><i class="bi bi-check-circle" ></i> <span >'. htmlspecialchars($detail) .'</span></li>
            </ul>';
          ?>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Service Details Section -->

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