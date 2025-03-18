<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../db.php'; // Initialize an array to hold error messages
// Check if an AJAX request is made to get data
if (isset($_GET['action']) && $_GET['action'] === 'get_data') {
    // Debugging output
    // Use this carefully; it can disrupt JSON output

    $sql = "SELECT Twiter, facebook, instagram, linkidin,youtube,email,Address,id  FROM social_media"; 
    $result = $connection->query($sql);

    $data = [];

    // Debugging output to check the number of rows
    // echo ($result->num_rows); // Uncomment for debugging

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    $connection->close(); // Close the connection
    exit; // Stop further execution
  
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAS-Scoail Media Link</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="icon" type="image/png" href="../../assets/img/logo2.png" />
</head>
<body>
<?php include '../layout.php'; ?>
<div class="content-wrapper">

<section class="content">
    <section class="content-header">
        <div class="container-fluid">
                <div class="col-sm-6">
                    <h1>Manage TAS Scoail Media link</h1>
                </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table id="socialMedia" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>X(Twiter)</th>
                            <th>Facebook</th>
                            <th>Instagram</th>
                            <th>Linkidin</th>
                            <th>Youtube</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        $('#socialMedia').DataTable({
            ajax: {
                url: '?action=get_data',
                type: 'GET', // Specify GET method
                dataSrc: ''
            },
            columns: [
                { data: 'Twiter' },
                { data: 'facebook' },
                { data: 'instagram' },
                { data: 'linkidin' },
                { data: 'youtube' },
                { data: 'email' },
                { data: 'Address' },
                {
                    data: 'status', // Assuming you have a 'status' field in your data
                    render: function (data, type, row) {
                        return '<a href="edit.php?id=' + row.id + '" class="btn btn-info btn-sm">Edit</a>' ;
                    }
                }
            ],
            order: [[0, 'desc']],
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: [
                "copy", "csv", "excel",
                { extend: 'pdf', title: 'Project Data - pdf' },
                { extend: 'print', title: 'Project Data - Print' },
                "colvis"
            ]
    }).buttons().container().appendTo('#socialMedia_wrapper .col-md-6:eq(0)');
});
</script>
</body>
</html>