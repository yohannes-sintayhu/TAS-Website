<?php
// Include the database connection script
require 'Admin/db.php';

// Your page content here

// Close the database connection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TAS Interior Design</title>
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
</head>

<body>
    <!-- ======= Header ======= -->
    <?php include 'Header.php'; ?>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">

        <div class="info d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 data-aos="fade-down">Let your <span> Home speak!</span></h2>
                        <p data-aos="fade-up">satisfying, surprising, and delighting our customers and guests. </p>
                        <a data-aos="fade-up" data-aos-delay="200" href="#get-started" class="btn-get-started">Get Started</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

            <div class="carousel-item active" style="background-image: url(assets/img/LOCAL/BULIBULA/5.jpg)"></div>
            <div class="carousel-item" style="background-image: url(assets/img/INTERNATIONAL/UK/3.jpg)"></div>
            <div class="carousel-item" style="background-image: url(assets/img/INTERNATIONAL/DUBAI/10.jpg)"></div>
            <div class="carousel-item" style="background-image: url(assets/img/INTERNATIONAL/BELGIUM/3.jpg)"></div>
            <div class="carousel-item" style="background-image: url(assets/img/INTERNATIONAL/USA/SOFA\ FRONT.jpg)"></div>

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>

    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= Get Started Section ======= -->
        <section id="get-started" class="get-started section-bg">
            <div class="container">

                <div class="row  gy-4">

                    <div class="col-lg-6 col-md-12 d-flex align-items-center" data-aos="fade-up" style="margin: 10px;">
                        <div class="content" style="background-color: #31628B; padding: 50px;">
                            <h3 style="color: #FFFFFF;">About Us</h3>
                            <p style="color: #FFFFFF;">TAS Interiors was founded by 3 women Architects and lifelong friends who have a great passion for interior design.
                                Established in 2019 G.C., TAS Interiors is an international interior design firm based in Addis Ababa Ethiopia, specializing in customer-centric experience design. Creating spaces on Functional, aesthetic, sustainable philosophical bases that improve engagement between people and their surroundings. We believe in the power of physical space to bring people together for shared, sociable, sensory experiences. We work collaboratively with our clients to create brands, environments, and experiences that help them achieve their strategic and tactical goals by satisfying, surprising, and delighting their customers and guests. Our services include innovation, strategy, branding, interior design, and delivery.
                            </p>
                        </div>
                    </div>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                        // Retrieve form data
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $message = $_POST['message'];

                        // Prepare and execute the insert statement
                        $stmt = $connection->prepare("INSERT INTO quotes (name, email, phone, message) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $name, $email, $phone, $message);
                        $stmt->execute();

                        // Check if the insert was successful
                        if ($stmt->affected_rows > 0) {
                            echo "Data inserted successfully!";
                        } else {
                            echo "Error inserting data.";
                        }
                    }
                    ?>
                    <div class="col-lg-5 col-md-12 " data-aos="fade">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="php-email-form">
                            <h3>Get a quote</h3>
                            <p>Please fill out the form below to submit your quote request.</p>
                            <div class="row gy-3">

                                <div class="col-md-12">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>

                                <div class="col-md-12 ">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your quote request has been sent successfully. Thank you!</div>

                                    <button type="submit">Get a quote</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Quote Form -->

                </div>

            </div>
        </section><!-- End Get Started Section -->
        <!-- ======= Services Section ======= -->
        <section id="services" class="services ">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Services</h2>
                    <p>Bringing Imagination to Life, One Design at a Time.</p>
                </div>

                <div class="row gy-4">
                    <?php
                    $sql = "SELECT * FROM services Where status = 1";
                    $result = $connection->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $title = $row['title'];
                            $detail = $row['detail'];
                            $File_Path = $row['File_Path'];
                            $Id = $row['id'];
                            // Limit the number of characters in the detail
                            $limit = 150; // Define the character limit
                            $limitedDetail = strlen($detail) > $limit ? substr($detail, 0, $limit) . " . . ." : $detail;

                    ?>
                            <div class="col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="100">
                                <div class="service-item position-relative" style="height: auto;">
                                    <div class="post-img position-relative overflow-hidden">
                                        <?php echo '<img src="Admin/' . $File_Path . '" class="img-fluid services-img" style="height: 100%;" alt=""> '; ?>
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
        <!-- ======= Alt Services Section ======= -->
        <section id="alt-services" class="alt-services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="row justify-content-around gy-4">
                    <div class="col-md-6 img-bg" style="background-image: url(assets/img/INTERNATIONAL/BELGIUM/2.jpg);" data-aos="zoom-in" data-aos-delay="100"></div>

                    <div class="col-md-5 d-flex flex-column justify-content-center">
                        <h3>HOW WE MAKE IT STA!</h3>
                        <p>We work collaboratively with our clients to create brands, environments, and experiences that help them achieve their strategic and tactical goals by satisfying, surprising, and delighting their customers and guests. </p>

                        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="100">
                            <i class="bi bi-easel flex-shrink-0"></i>
                            <div>
                                <h4><a href="" class="stretched-link">INNOVATION</a></h4>
                                <p>We specialize in fostering creativity and developing innovative solutions to help businesses stand out in today's competitive landscape. Our team works closely with clients to identify opportunities, generate fresh ideas, and implement cutting-edge strategies.</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-patch-check flex-shrink-0"></i>
                            <div>
                                <h4><a href="" class="stretched-link">STRATEGY</a></h4>
                                <p>We provide strategic guidance and consulting services to help organizations achieve their goals. Our strategic approach involves analyzing market trends, identifying target audiences, and developing comprehensive plans to drive growth and maximize success.</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-brightness-high flex-shrink-0"></i>
                            <div>
                                <h4><a href="" class="stretched-link">BRANDING</a></h4>
                                <p>We understand the power of branding in creating a strong and memorable identity for businesses. Our branding services encompass logo design, brand positioning, brand messaging, and visual identity development. We help clients establish a cohesive brand presence that resonates with their target audience.</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-brightness-high flex-shrink-0"></i>
                            <div>
                                <h4><a href="" class="stretched-link">INTERIOR DESIGN</a></h4>
                                <p>Our interior design services focus on creating captivating and functional spaces. Whether it's residential or commercial projects, we bring expertise in space planning, material selection, color schemes, furniture arrangement, and overall aesthetics. Our goal is to transform environments into inspiring and harmonious settings.</p>
                            </div>
                        </div>
                        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-brightness-high flex-shrink-0"></i>
                            <div>
                                <h4><a href="" class="stretched-link"> DELIVERY</a></h4>
                                <p>We emphasize the importance of efficient project management and timely delivery. Our team ensures that every step of the process is meticulously planned and executed, keeping clients informed and involved throughout. We strive to meet deadlines and deliver exceptional results that exceed expectations.</p>
                            </div>
                        </div><!-- End Icon Box -->

                    </div>
                </div>

            </div>
        </section><!-- End Alt Services Section -->
        <!-- ======= Stats Counter Section ======= -->
        <section id="stats-counter" class="stats-counter section-bg">
            <div class="container">
                    <?php

                        // Fetch statistics from the database
                        $sql = "SELECT * FROM statistics LIMIT 1"; // Adjust according to your needs
                        $result = $connection->query($sql);
                        $stats = $result->fetch_assoc(); // Fetch the first row
                        ?>
            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo htmlspecialchars($stats['happyclient']); ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Happy Clients</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-journal-richtext color-orange flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo htmlspecialchars($stats['projects']); ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Projects</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-headset color-green flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo htmlspecialchars($stats['hourofsupport']); ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Hours Of Support</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-people color-pink flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo htmlspecialchars($stats['hardworkers']); ?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Hard Workers</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                </div>
            </div>
        </section><!-- End Stats Counter Section -->
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
                        $sql = "SELECT * FROM project where status = 1";
                        $result = $connection->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $project_catagory = $row['project_catagory'];
                                $File_Path = $row['File_Path'];
                                $Project_name = $row['Project_name'];
                                $Description = $row['Description'];
                                $Id = $row['id'];

                        ?>
                                <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $project_catagory ?>">
                                    <div class="portfolio-content h-100">
                                        <?php echo '<img src="Admin/' . $File_Path . '" class="img-fluid"  alt="" style="height: auto; width:auto"> '; ?>
                                        <div class="portfolio-info">
                                            <h4>Client Name: <?php echo $Project_name ?></h4>
                                            <p><?php echo $Description ?></p>
                                            <?php echo '<a href="Admin/' . $File_Path . '" title="Client Name: ' . $Project_name . '<br>Description: ' . $Description . '" data-gallery="portfolio-gallery-' . $project_catagory . '" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>'; ?>
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
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact section-bg">
        <?php
                // Fetch statistics from the database
                $sql = "SELECT * FROM social_media LIMIT 1"; // Adjust according to your needs
                $result = $connection->query($sql);
                $social = $result->fetch_assoc(); // Fetch the first row
        ?>
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="section-header">
                    <h2>Get In Touch(ያግኙን)</h2>
                    </hr>
                </div>
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="info-item  d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-map"></i>
                            <h3>Our Address</h3>
                            <p><?php echo htmlspecialchars($social['address']); ?></p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Us</h3>
                            <p><?php echo htmlspecialchars($social['email']); ?></p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item  d-flex flex-column justify-content-center align-items-center">
                            <h6>Contact and Follow Us In</h6>
                            <p>+251922984784</p>
                            <div class="social-links d-flex mt-3">
                                <a href="<?php echo htmlspecialchars($social['Twiter']); ?>" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Follow Us On Twitter" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter"></i></a>
                                <a href="<?php echo htmlspecialchars($social['facebook']); ?>" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Follow Us On Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
                                <a href="<?php echo htmlspecialchars($social['instagram']); ?>" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Follow Us On Instagram" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
                                <a href="<?php echo htmlspecialchars($social['linkidin']); ?>" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Follow Us On LinkedIn" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                                <a href="<?php echo htmlspecialchars($social['youtube']); ?>" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Follow Us On YouTube" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <div class="row gy-4 mt-1">

                    <div class="col-lg-6 ">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10656.302368193821!2d38.775206369054104!3d9.000209255153841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b84fbee9d819b%3A0x2198897002811488!2sAlem%20Cinema!5e0!3m2!1sen!2set!4v1709016106742!5m2!1sen!2set" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                    </div><!-- End Google Maps -->

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
        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials ">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Testimonials</h2>
                    </hr>
                </div>

                <div class="slides-2 swiper">
                    <div class="swiper-wrapper">
                        <?php
                      
                        $sql = "SELECT name, designation, testimonial, File_Path FROM testimonial WHERE status = 1";
                        $result = $connection->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $name = $row['name'];
                                $designation = $row['designation'];
                                $testimonial = $row['testimonial'];
                                $staticImage =  $row['File_Path'];
                        ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-wrap">
                                        <div class="testimonial-item">
                                            <img src="<?php echo 'Admin/' . $staticImage?>" class="testimonial-img" alt="">
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
        <?php

            // Fetch team members from the database
            $sql = "SELECT * FROM team where status=1"; // Adjust the table name as necessary
            $result = $connection->query($sql);

            // Check if there are any team members
            $teamMembers = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $teamMembers[] = $row; // Store each member in the array
                }
            }
            ?>
        <section id="team" class="team section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Our Team</h2>
                    <p>Our team specializes in creating beautiful and functional spaces that reflect your unique style and exceed your expectations.</p>
                </div>

                <div class="row gy-5">
                    <?php if (empty($teamMembers)): ?>
                        <div class="col-12 text-center">
                            <p>No team members found.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($teamMembers as $member): ?>
                            <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="400">
                                <div class="member-img">
                                    <img src="<?php echo htmlspecialchars('Admin/'.$member['File_Path']);?>" class="img-fluid" alt="">
                                    <div class="social">
                                        <a href="#" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter"></i></a>
                                        <a href="#" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
                                        <a href="#" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
                                        <a href="#" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                                <div class="member-info text-center">
                                    <h4><?php echo htmlspecialchars($member['name']); ?></h4>
                                    <span><?php echo htmlspecialchars($member['position']); ?></span>
                                    <p><?php echo htmlspecialchars($member['role']); ?></p>
                                </div>
                            </div><!-- End Team Member -->
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>
        </section><!-- End Our Team Section -->
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