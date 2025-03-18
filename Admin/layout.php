<?php
if (session_status() == PHP_SESSION_NONE) {
    // Start the session if it hasn't been started yet
    session_start();
}
// Check user session
$id = "";
$profile = "";
$name = "";
$baseUrl = '/Selam-Design/Admin/';
if (empty($_SESSION['loggedin']) || empty($_SESSION['user_id'])) {
    header("Location:".$baseUrl."login.php");
    exit;
} else {
    $id = $_SESSION['user_id'];
    $profile = $_SESSION['profile'];
    $name = $_SESSION['name'];
}

?>

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a  href="<?php echo htmlspecialchars($baseUrl."Dashboard/index.php"); ?>"  class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a class="brand-link" href="<?php echo htmlspecialchars($baseUrl."Dashboard/index.php"); ?>" >
                <img src="../../assets/img/logo.png" alt="TAS interior design Logo" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Page</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo htmlspecialchars('../'.$profile); ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?php echo htmlspecialchars($baseUrl."User/index.php"); ?>" class="d-block"><?= htmlspecialchars($name) ?></a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo htmlspecialchars($baseUrl."Dashboard/index.php"); ?>" class="nav-link <?= ($activeMenu == "Dashboard") ? "active" : "" ?>">
                                <i class="fa fas fa-tachometer-alt"></i>
                                <p> Dashboard </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-layer-group"></i>  
                                <p> Project <i class="fas fa-angle-left right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="<?php echo htmlspecialchars($baseUrl."Project/Create.php"); ?>" class="nav-link">
                                        <i class="fa fa-plus"></i>
                                        <p> Create Projects</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo htmlspecialchars($baseUrl."Project/manage.php"); ?>" class="nav-link">
                                        <i class="fas fa-clipboard"></i>
                                        <p> Manage Projects </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-list"></i>  
                                <p> Services <i class="fas fa-angle-left right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="<?php echo htmlspecialchars($baseUrl."Service/Create.php"); ?>" class="nav-link">
                                        <i class="fa fa-plus"></i>
                                        <p> Create Service</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo htmlspecialchars($baseUrl."Service/manage.php"); ?>" class="nav-link">
                                        <i class="fas fa-clipboard"></i>
                                        <p> Manage Services </p>
                                    </a>
                                </li>
                            </ul>
                        </li> 
                        <li class="nav-item">
                            <a href="<?php echo htmlspecialchars($baseUrl."Message/manage.php"); ?>"  class="nav-link">
                                <i class="fas fa-clipboard"></i>
                                <p> Message </p>
                             </a>
                         </li>
                        <li class="nav-item has-treeview">
                            <a href="<?php echo htmlspecialchars($baseUrl."Quote/manage.php"); ?>" class="nav-link">
                                <i class="fa fa-inbox"></i>  
                                <p>Quote</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-comments"></i>  
                                <p>Testimonials <i class="fas fa-angle-left right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="<?php echo htmlspecialchars($baseUrl."Testimonial/create.php"); ?>" class="nav-link">
                                        <i class="fa fa-plus"></i>
                                        <p> Create Testimonials</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo htmlspecialchars($baseUrl."Testimonial/manage.php"); ?>" class="nav-link">
                                        <i class="fas fa-clipboard"></i>
                                        <p> Manage Testimonials </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-users"></i>  
                                <p>Team <i class="fas fa-angle-left right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview pl-3">
                                <li class="nav-item">
                                    <a href="<?php echo htmlspecialchars($baseUrl."Team/Create.php"); ?>"  class="nav-link">
                                        <i class="fa fa-plus"></i>
                                        <p> Create Team</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo htmlspecialchars($baseUrl."Team/manage.php"); ?>"  class="nav-link">
                                        <i class="fas fa-clipboard"></i>
                                        <p> Manage Team </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo htmlspecialchars($baseUrl."SocialMedia/manage.php"); ?>" class="nav-link">
                                <i class="fa fa-link"></i>  
                                <p>Manage social media</p>
                            </a>
                           
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo htmlspecialchars($baseUrl."User/index.php"); ?>" class="nav-link <?= ($activeMenu == "Profile") ? "active" : "" ?>">
                                    <i class=" fa fas fa-user"></i>
                                    <p>Profile </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo htmlspecialchars($baseUrl."logout.php"); ?>" class="nav-link">
                                <i class="nav-icon fa fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

      
        
      