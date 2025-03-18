<?php
require '../db.php';
$errorMessages = []; // Initialize an array to hold error messages
session_start();

// Check user session
$id = "";
$profile = "";
$name = "";
if (empty($_SESSION['loggedin']) || empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
} else {
    $id = $_SESSION['user_id'];
    $profile = $_SESSION['profile'];
    $name = $_SESSION['name'];
}

// Fetch existing project data
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die('Project not found.');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TAS-Projects</title>
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        <link rel="icon" type="image/png" href="../../assets/img/logo2.png" />
        <style>
            .hide {
                display: none;
            }
        </style>
    </head>
<body>
    <?php include '../layout.php'; ?>
    <div class="content-wrapper">
       
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>My Profile</h1>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless" style="width: auto;">
                    <tbody>
                        <tr>
                            <th rowspan="5" style="width:50%; text-align: center;">
                                <img style="width:250px;" src="<?php echo htmlspecialchars('../'.$user['File_Path']); ?>" class="img-circle elevation-2" alt="User Image" >
                            </th>
                            <th colspan="2" style="width: auto;">General Information</th>
                        </tr>
                        <tr>
                            <td>Full Name:</td>
                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($user['email']); ?></td>
                        </tr>
                        <tr>
                            <td>Mobile No:</td>
                            <td><i class="fas fa-phone-alt"></i> <?php echo htmlspecialchars($user['phoneNumber']); ?></td>
                        <tr>
                            <td>User Name:</td>
                            <td><?php echo htmlspecialchars($user['userName']); ?></td>
                        </tr>
                        <tr>
                            <td style="width: auto; text-align: center;"><?php echo htmlspecialchars($user['full_name']); ?></td>
                            <td style="width: 25%;">Position:</td>
                            <td style="width: 50%;"><?php echo htmlspecialchars('Admin'); ?></td>
                        </tr>
                    </tbody>
                </table>
                <hr />
                <div>
                    <a href="edit.php" class="btn btn-outline-primary btn-sm ml-auto">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</section>
    </div>
    <footer class="main-footer">
        <div>
                &copy; <?= date("Y") ?> | <i class="fa fa-code"></i> Tas interior Design
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    // Update the file input label with the selected file name
    document.getElementById('exampleInputFile').addEventListener('change', function () {
        var fileName = this.files[0] ? this.files[0].name : 'Choose file';
        var nextSibling = this.nextElementSibling;
        nextSibling.innerText = fileName;
    });
    <?php if (!empty($errorMessages)): ?>
        $(document).ready(function() {
            <?php foreach ($errorMessages as $error): ?>
                toastr.error('<?php echo htmlspecialchars($error); ?>');
            <?php endforeach; ?>
        });
    <?php endif; ?>

    // Display success message
    <?php if (isset($successMessage)): ?>
        $(document).ready(function() {
            toastr.success('<?php echo htmlspecialchars($successMessage); ?>');
        });
    <?php endif; ?>
    </script>
</body>
</html>