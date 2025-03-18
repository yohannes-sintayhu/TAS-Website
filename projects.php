<!DOCTYPE html>
<html lang="en">
<?php include("Admin/db.php");?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TAS-Projects</title>
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

        <h2>Projects</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Projects</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

        <!-- ======= Our Projects Section ======= -->
        <section id="projects" class="projects">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>COMPLETED PROJECTS</h2>
                    <p>Crafting Your Dream Space, Tailored to Perfection.</p>
                </div>
                
               
                <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">

                    <ul class="portfolio-flters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-residential_international">INTERNATIONAL RESIDENTIAL PROJECTS</li>
                        <li data-filter=".filter-residential_local">LOCAL RESIDENTIAL PROJECTS</li>
                        <!-- <li data-filter=".filter-repairs">Repairs</li>
                        <li data-filter=".filter-design">Design</li> -->
                    </ul><!-- End Projects Filters -->
 
                    <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    <?php
                        $sql = "SELECT * FROM project WHERE status = 1";
                        $result = $connection->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $project_catagory = $row['project_catagory'];
                                $File_Path = $row['File_Path'];
                                $Project_name = $row['Project_name'];
                                $Description = $row['Description'];
                                $Id=$row['id'];
            
                                ?>
                                <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $project_catagory?>">
                                    <div class="portfolio-content h-100">
                                        <?php echo '<img src="Admin/' . $File_Path . '" class="img-fluid"  alt="" style="height: auto; width:auto"> ';?>
                                        <div class="portfolio-info">
                                            <h4>Client Name: <?php echo $Project_name?></h4>
                                            <p><?php echo $Description?></p>
                                            <?php echo '<a href="Admin/'.$File_Path.'" title="Client Name: '.$Project_name.'<br>Description: '.$Description.'" data-gallery="portfolio-gallery-'.$project_catagory.'" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>'; ?>
                                           ?>
                                        </div>
                                    </div>
                                </div>
                               
                                <?php
                            }
                        } else {
                            echo "No project found.";
                        }
                ?>
                        <!-- End Projects Item -->

                    </div><!-- End Projects Container -->

                </div>

            </div>
        </section><!-- End Our Projects Section -->

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