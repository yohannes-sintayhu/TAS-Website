
<?php
require 'db.php';
session_start(); // Start the session

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

echo($password);
    $stmt = $connection->prepare("SELECT * FROM user WHERE userName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    echo ($result->num_rows);
    // Check if a user is foundt
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password (assuming passwords are hashed in the database)
        if ($password===$user['password'] && $user['status'] === 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            $_SESSION['profile'] = $user['File_Path'];
            $_SESSION['name'] = $user['full_name'];
            // Store user ID in session
            header("Location: Dashboard/index.php"); // Redirect to admin page
            exit;
        } else {
            $_SESSION['LoginError'] = true;
        }
    } else {
        $_SESSION['LoginError'] = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TAS Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css" />
    <link rel="icon" type="image/png" href="../assets/img/logo.png" />
</head>
<body class="hold-transition login-page">
    <div class="login-box" style="width:400px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img alt="TAS Interior Design" style="width: 40%;" src="../assets/img/logo2.png" />
                <h5 style="text-align: center; font-size:1.2rem;">Admin Page</h5>
            </div>
            <div class="card-body">
           
                <form method="post" action="">
                    <div class="form-group">
                        <label class="form-label">User name *</label>
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" placeholder="user name" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password *</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in-alt"></i> Sign In</button>
                        </div>
                    </div>
                </form>
                <?php if (isset($_SESSION['LoginError'])): ?>
                    <p class="text-danger">Failed to login, incorrect username or password.</p>
                    <?php unset($_SESSION['LoginError']); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</body>
</html>