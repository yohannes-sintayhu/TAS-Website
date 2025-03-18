<php>
<?php

                // Fetch statistics from the database
                $sql = "SELECT * FROM social_media LIMIT 1"; // Adjust according to your needs
                $result = $connection->query($sql);
                $sociall = $result->fetch_assoc(); // Fetch the first row
        ?>
<div class="footer-content position-relative">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>TAS Interior Design</h3>
                            <p>
                               Our Address <br>
                               <?php echo htmlspecialchars($sociall['address']); ?><br><br>
                                <strong>Phone:</strong> +251 911111111<br>
                                <strong>Email:</strong> <?php echo htmlspecialchars($sociall['email']); ?><br>
                            </p>
                            <div class="social-links d-flex mt-3">
                                <a href="<?php echo htmlspecialchars($sociall['Twiter']); ?>" class="d-flex align-items-center justify-content-center"><i class="bi bi-twitter"></i></a>
                                <a href="<?php echo htmlspecialchars($sociall['facebook']); ?>" class="d-flex align-items-center justify-content-center"><i class="bi bi-facebook"></i></a>
                                <a href="<?php echo htmlspecialchars($sociall['instagram']); ?>" class="d-flex align-items-center justify-content-center"><i class="bi bi-instagram"></i></a>
                                <a href="<?php echo htmlspecialchars($sociall['linkidin']); ?>" class="d-flex align-items-center justify-content-center"><i class="bi bi-linkedin"></i></a>
                                <a href="<?php echo htmlspecialchars($sociall['youtube']); ?>" class="d-flex align-items-center justify-content-center"><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div><!-- End footer info column-->

                    <div class="col-lg-4 col-md-3 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Terms of service</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div><!-- End footer links column-->
                    <?php
                        $sql = "SELECT * FROM services Where status = 1";
                        $result = $connection->query($sql);

                        $services = [];
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $services[] = $row; // Store each member in the array
                                }
                            }
                    ?>
                    <div class="col-lg-4 col-md-3 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <?php if (empty($services)): ?>
                                <div class="col-12 text-center">
                                    <p>No team members found.</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($services as $service): ?>
                                    <li><a href="/Selam-Design/service-details.php?id=<?php echo urlencode(htmlspecialchars($service['id'])); ?>"><?php echo htmlspecialchars($service['title']); ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div><!-- End footer links column-->
               </div>
            </div>
        </div>

        <div class="footer-legal text-center position-relative">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>TSA Interior Design</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                 
                    Designed by TAS</a>
                </div>
            </div>
        </div>
        </php>