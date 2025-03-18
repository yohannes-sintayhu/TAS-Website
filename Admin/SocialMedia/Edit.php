<?php
require '../db.php';
$errorMessages = []; // Initialize an array to hold error messages

// Get the project ID from the URL
$SocialId = $_GET['id'] ?? null;

if (!$SocialId) {
    die('Social Media Id is required.');
}

// Fetch existing project data
$sql = "SELECT * FROM social_media WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $SocialId);
$stmt->execute();
$result = $stmt->get_result();
$social = $result->fetch_assoc();

if (!$social) {
    die('social not found.');
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $Twiter = $_POST['Twiter'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $linkidin = $_POST['linkidin'];
    $youtube = $_POST['youtube'];
    $email = $_POST['email'];
    $address = $_POST['address'];
   

    // Check database connection
    if ($connection->connect_error) {
        $errorMessages[] = "Connection failed: " . $connection->connect_error;
    }

    // Prepare SQL statement for update
    $sql = "UPDATE social_media SET Twiter = ?, facebook = ?, instagram = ?, linkidin = ?, youtube = ?, email = ?, address = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssssi", $Twiter, $facebook, $instagram, $linkidin, $youtube, $email, $address, $SocialId);

    // Execute the statement
    if ($stmt->execute()) {
        // Post updated successfully
        $stmt->close();
        $connection->close();
        $successMessage = 'Social Media Link updated successfully.';
    } else {
        // Error occurred while updating the post
        $errorMessages[] = 'Error occurred while updating the Social Media link.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TAS-Social Media Link</title>
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
        <section class="content">
            <section class="col-xl-10 offset-xl-1 connectedSortable" style="padding-top:1rem;">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fa fa-edit"></i> Edit Social Media Link
                        </h3>
                        <a href="manage.php" class="btn btn-outline-primary btn-sm ml-auto">Manage Social Media Link</a>
                    </div>
                    <div class="card-body">

                        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $SocialId; ?>">
                            <div class="row">
                                <div class="form-group col-xl-12">
                                    <label class="control-label" for="Twiter">Twiter <i class="text-danger">*</i></label>
                                    <div class="input-group" style="margin:0;">
                                        <input type="text" name="Twiter" class="form-control" id="Twiter" value="<?php echo htmlspecialchars($social['Twiter']); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xl-12">
                                    <label class="control-label" for="facebook">Facebook <i class="text-danger">*</i></label>
                                    <div class="input-group" style="margin:0;">
                                        <input type="text" name="facebook" class="form-control" id="facebook" value="<?php echo htmlspecialchars($social['facebook']); ?>" required>
                                    </div>
                                </div>
                            </div> <div class="row">
                                <div class="form-group col-xl-12">
                                    <label class="control-label" for="instagram">Instagram <i class="text-danger">*</i></label>
                                    <div class="input-group" style="margin:0;">
                                        <input type="text" name="instagram" class="form-control" id="instagram" value="<?php echo htmlspecialchars($social['instagram']); ?>" required>
                                    </div>
                                </div>
                            </div> <div class="row">
                                <div class="form-group col-xl-12">
                                    <label class="control-label" for="linkidin">Linkidin <i class="text-danger">*</i></label>
                                    <div class="input-group" style="margin:0;">
                                        <input type="text" name="linkidin" class="form-control" id="linkidin" value="<?php echo htmlspecialchars($social['linkidin']); ?>" required>
                                    </div>
                                </div>
                            </div> <div class="row">
                                <div class="form-group col-xl-12">
                                    <label class="control-label" for="youtube">Youtube <i class="text-danger">*</i></label>
                                    <div class="input-group" style="margin:0;">
                                        <input type="text" name="youtube" class="form-control" id="youtube" value="<?php echo htmlspecialchars($social['youtube']); ?>" required>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group col-xl-12">
                                    <label class="control-label" for="email">Email <i class="text-danger">*</i></label>
                                    <div class="input-group" style="margin:0;">
                                        <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($social['email']); ?>" >
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="form-group col-xl-12">
                                    <label class="control-label" for="address">Address <i class="text-danger">*</i></label>
                                    <div class="input-group" style="margin:0;">
                                        <input type="text" name="address" class="form-control" id="address" value="<?php echo htmlspecialchars($social['address']); ?>" required>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row">
                                <button type="submit" class="col-xl-4 btn btn-block btn-primary btn-sm">Update</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </section>
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