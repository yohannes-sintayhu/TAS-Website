<?php
require '../db.php';
$errorMessages = []; // Initialize an array to hold error messages

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $title = $_POST['title'];
    $detail = $_POST['detail'];

    // Upload image file
    $targetDir = '../uploads/';
    $originalFileName = pathinfo($_FILES['serviceFile']['name'], PATHINFO_FILENAME); 
    $imageFileType = strtolower(pathinfo($_FILES['serviceFile']['name'], PATHINFO_EXTENSION));
    
    // Generate a unique file name using the current timestamp
    $uniqueSuffix = date('YmdHis'); // Format: YYYYMMDDHHMMSS
    $newFileName = $originalFileName . '_' . $uniqueSuffix . '.' . $imageFileType; // Append unique suffix
    $targetFile = $targetDir . $newFileName;
    $uploadOk = 1;

    // Check if the image file is a actual image or fake image
    $check = getimagesize($_FILES['serviceFile']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $errorMessages[] = 'Invalid image file.';
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        $errorMessages[] = 'Sorry, the file already exists.';
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['serviceFile']['size'] > 1000000) { // 1 MB = 1,000,000 bytes
        $errorMessages[] = 'Sorry, the file is too large. Maximum file size allowed is 1 MB.';
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType !== 'jpg' && $imageFileType !== 'png' && $imageFileType !== 'jpeg' && $imageFileType !== 'gif') {
        $errorMessages[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['serviceFile']['tmp_name'], $targetFile)) {
            // Use the unique file name for storage in the database
            $File_Path = '/uploads/'. $newFileName;

            // Check database connection
            if ($connection->connect_error) {
                $errorMessages[] = "Connection failed: " . $connection->connect_error;
            }
        
            // Prepare SQL statement
            $sql = "INSERT INTO services (title, detail, File_Path) VALUES (?, ?,  ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("sss", $title, $detail, $File_Path);
            
            // Execute the statement
            if ($stmt->execute()) {
                // Post inserted successfully
                $stmt->close();
                $connection->close();
                $successMessage = 'Services submitted successfully.';
            } else {
                // Error occurred while inserting the post
                $errorMessages[] = 'Error occurred while submitting the Service.';
            }
        } else {
            $errorMessages[] = 'Sorry, there was an error uploading your file.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TAS-Services</title>
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
                            <i class="fa fa-plus"></i> Create new Services
                        </h3>
                        <a href="manage.php" class="btn btn-outline-primary btn-sm ml-auto">Manage Services</a>
                    </div>
                    <div class="card-body">

                        <!-- Display error messages -->
                       

                        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="row">
                                <div class="form-group col-xl-12">
                                    <label class="control-label" for="title">Title <i class="text-danger">*</i></label>
                                    <div class="input-group" style="margin:0;">
                                        <input type="text" name="title" class="form-control" id="title" required>
                                    </div>
                                    <span class="text-danger"><?php echo isset($errors['title']) ? $errors['title'] : ''; ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xl-12">
                                    <label for="detail">Description <i class="text-danger">*</i></label>
                                    <textarea name="detail" class="form-control" id="detail" rows="4" required></textarea>
                                    <span id="detail-error" class="text-danger"><?php echo isset($errors['detail']) ? $errors['detail'] : ''; ?></span>
                                </div>
                            </div>
                            <div class="row" id="projectFile">
                                <div class="form-group col-lg-8">
                                    <label for="serviceFile">Picture <i class="text-danger">*</i></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="serviceFile" type="file" class="custom-file-input" id="exampleInputFile" required>
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="col-xl-4 btn btn-block btn-primary btn-sm">Register</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    // Update the file input label with the selected file name
    document.getElementById('exampleInputFile').addEventListener('change', function () {
        var fileName = this.files[0] ? this.files[0].name : 'Choose file';
        var nextSibling = this.nextElementSibling;
        nextSibling.innerText = fileName;
    });

    // Show error messages if any exist
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

    $(document).ready(function() {
        $('.swalDefaultSuccess').click(function() {
            toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
        });
    });
</script>
</body>
</html>