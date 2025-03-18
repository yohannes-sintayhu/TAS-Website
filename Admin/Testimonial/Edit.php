<?php
require '../db.php';
$errorMessages = []; // Initialize an array to hold error messages

// Get the project ID from the URL
$testimonialId = $_GET['id'] ?? null;

if (!$testimonialId) {
    die('Testimonial ID is required.');
}

// Fetch existing project data
$sql = "SELECT * FROM testimonial WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $testimonialId);
$stmt->execute();
$result = $stmt->get_result();
$testimoniall = $result->fetch_assoc();

if (!$testimoniall) {
    die('Testimonial not found.');
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $testimonial = $_POST['testimonial'];

    // Upload image file if a new file is provided
    $targetDir = '../uploads/';
    $File_Path = $testimoniall['File_Path']; // Keep existing file path initially

    if (!empty($_FILES['testimonialFile']['name'])) {
        $originalFileName = pathinfo($_FILES['testimonialFile']['name'], PATHINFO_FILENAME); 
        $imageFileType = strtolower(pathinfo($_FILES['testimonialFile']['name'], PATHINFO_EXTENSION));
        
        // Generate a unique file name using the current timestamp
        $uniqueSuffix = date('YmdHis'); // Format: YYYYMMDDHHMMSS
        $newFileName = $originalFileName . '_' . $uniqueSuffix . '.' . $imageFileType; // Append unique suffix
        $targetFile = $targetDir . $newFileName;
        $uploadOk = 1;

        // Check if the image file is a actual image or fake image
        $check = getimagesize($_FILES['testimonialFile']['tmp_name']);
        if ($check === false) {
            $errorMessages[] = 'Invalid image file.';
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['testimonialFile']['size'] > 1000000) { // 1 MB = 1,000,000 bytes
            $errorMessages[] = 'Sorry, the file is too large. Maximum file size allowed is 1 MB.';
            $uploadOk = 0;
        }

        // Allow only certain file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $errorMessages[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['testimonialFile']['tmp_name'], $targetFile)) {
                // Update File_Path for the database
                $File_Path = '/uploads/'. $newFileName;
            } else {
                $errorMessages[] = 'Sorry, there was an error uploading your file.';
            }
        }
    }

    // Check database connection
    if ($connection->connect_error) {
        $errorMessages[] = "Connection failed: " . $connection->connect_error;
    }

    // Prepare SQL statement for update
    $sql = "UPDATE testimonial SET name = ?, File_Path = ?, designation = ?, testimonial = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $name, $File_Path, $designation, $testimonial, $testimonialId);

    // Execute the statement
    if ($stmt->execute()) {
        // Post updated successfully
        $stmt->close();
        $connection->close();
        $successMessage = 'Testimonial updated successfully.';
    } else {
        // Error occurred while updating the post
        $errorMessages[] = 'Error occurred while updating the Testimonial.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TAS-Testimonial</title>
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
                            <i class="fa fa-edit"></i> Edit Testimonial
                        </h3>
                        <a href="manage.php" class="btn btn-outline-primary btn-sm ml-auto">Manage Testimonial</a>
                    </div>
                    <div class="card-body">

                        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $testimonialId; ?>">
                            <div class="row">
                                <div class="form-group col-xl-12">
                                    <label class="control-label" for="name">Name <i class="text-danger">*</i></label>
                                    <div class="input-group" style="margin:0;">
                                        <input type="text" name="name" class="form-control" id="name" value="<?php echo htmlspecialchars($testimoniall['name']); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xl-12">
                                    <label class="control-label" for="designation">Position <i class="text-danger">*</i></label>
                                    <div class="input-group" style="margin:0;">
                                        <input type="text" name="designation" class="form-control" id="designation" value="<?php echo htmlspecialchars($testimoniall['designation']); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xl-12">
                                    <label for="testimonial">Testimonial <i class="text-danger">*</i></label>
                                    <textarea name="testimonial" class="form-control" id="testimonial" rows="4" required><?php echo htmlspecialchars($testimoniall['testimonial']); ?></textarea>
                                </div>
                            </div>
                            <div class="row" id="testimonialFile">
                                <div class="form-group col-lg-8">
                                    <label for="testimonialFile"> Picture (Leave blank to keep existing)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="testimonialFile" type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <Label>Current file: <a href="<?php echo htmlspecialchars('../'.$testimoniall['File_Path']); ?>" target="_blank">View <i class="fas fa-eye" aria-hidden="true"></i></a></Label>
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