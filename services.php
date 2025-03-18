<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TAS - Services</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
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
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include 'Header.php'; ?>  
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/CommonBarImage/NavBarImage.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Services</h2>
        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Services</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <?php
          require '<Admin/db.php';

          $sql = "SELECT * FROM services WHERE status=1";
          $result = $connection->query($sql);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $title = $row['title'];
                  $detail = $row['detail'];
                  $File_Path=$row['File_Path'];
                  $Id=$row['id'];
                //   $filePathFromDB = '../uploads/Logo.jpg';

                // // Trim the '../' part from the file path
                // $trimmedFilePath = str_replace('../', '', $filePathFromDB);

                // // Output the trimmed file path
                // echo $trimmedFilePath;
                          // Limit the number of characters in the detail
                  $limit = 150; // Define the character limit
                  $limitedDetail = strlen($detail) > $limit ? substr($detail, 0, $limit) . " . . ." : $detail;
                  ?>
                    <div class="col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative" style="height: auto;">
                        <div class="post-img position-relative overflow-hidden">
                        <?php echo '<img src="Admin/' . $File_Path . '" class="img-fluid" alt="">';?>

                        </div>

                            <?php
                            // Generate the HTML markup for each service
                            echo '<h3>' . htmlspecialchars($title) . '</h3>';
                            echo '<p>' . htmlspecialchars($limitedDetail) . '</p>';

                            echo '<a href="service-details.php?id=' . $Id . '" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>';

                            ?>
                        </div>
                    </div><!-- End Service Item -->
                  <?php
              }
          } else {
              echo "No services found.";
          }
          ?>

        </div>

      </div>
    </section><!-- End Services Section -->
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Testimonials</h2>
                    </hr>
                </div>

                <div class="slides-2 swiper">
                    <div class="swiper-wrapper">
                    <?php
                $staticImage = "assets/img/testimonial/avatar.jpg"; // Static image path
                $sql = "SELECT name, designation, testimonial FROM testimonial";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $designation = $row['designation'];
                        $testimonial = $row['testimonial'];
                        ?>
                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="<?php echo $staticImage; ?>" class="testimonial-img" alt="">
                                    <h3><?php echo htmlspecialchars($name); ?></h3>
                                    <h4><?php echo htmlspecialchars($designation); ?></h4>
                                    <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <?php echo htmlspecialchars($testimonial); ?>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->
                        <?php
                    }
                } else {
                    echo "No testimonials found.";
                }
                ?>
            </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->

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