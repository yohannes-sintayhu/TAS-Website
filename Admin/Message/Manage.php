<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../db.php'; // Initialize an array to hold error messages
// Check if an AJAX request is made to get data
if (isset($_GET['action']) && $_GET['action'] === 'get_data') {
    // Debugging output
    // Use this carefully; it can disrupt JSON output

    $sql = "SELECT created_at , name, email, subject,message, id  FROM message"; 
    $result = $connection->query($sql);

    $data = [];

    // Debugging output to check the number of rows
    // echo ($result->num_rows); // Uncomment for debugging

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    // header('Content-Type: application/json');
    foreach ($data as &$entry) {
        $entry['name'] = mb_convert_encoding($entry['name'], 'UTF-8');
        $entry['email'] = mb_convert_encoding($entry['email'], 'UTF-8');
        $entry['subject'] = mb_convert_encoding($entry['subject'], 'UTF-8');
        $entry['message'] = mb_convert_encoding($entry['message'], 'UTF-8');
    }
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
    <title>TAS-Message</title>
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
                        <h1>Manage Messages</h1>
                    </div>
            </div>
        </section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table id="MessageTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
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
            $('#MessageTable').DataTable({
                ajax: {
                    url: '?action=get_data',
                    type: 'GET', // Specify GET method
                    dataSrc: ''
                },
                columns: [
                    {
                            data: 'created_at',
                            width: '15%',
                            render: function (data, type, row, meta) {
                                var date = new Date(data);
                                return date.toLocaleString();
                            }
                    },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'subject' },
                    { data: 'message' },
                    {
                        data: 'id',
                        render: function (data) {
                            return '<button class="btn btn-danger btn-sm delete-action" data-id="' + data + '">Delete</button>';
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
            }).buttons().container().appendTo('#MessageTable_wrapper .col-md-6:eq(0)');

            // Handle delete action
            $('#MessageTable tbody').on('click', '.delete-action', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log(id);

                // Confirm before deletion
                if (confirm('Are you sure you want to delete this item?')) {
                    // Perform AJAX request to delete
                    $.ajax({
                        url: 'delete.php/?action=delete_data', // Corrected URL
                        type: 'POST',
                        data: {
                            id: id,
                            action: 'delete_data' // Include the action parameter
                        },
                        success: function (response) {
                            try {
                                var result = JSON.parse(response);
                                if (result.success) {
                                    toastr.success('Item deleted successfully!');
                                    $('#MessageTable').DataTable().ajax.reload(); // Refresh the table
                                } else {
                                    toastr.error('Error: ' + result.message); // Show error message from server
                                }
                            } catch (e) {
                                toastr.error('Error parsing response: ' + e.message); // Handle parsing error
                            }
                        },
                        error: function () {
                            toastr.error('Error deleting item!');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>