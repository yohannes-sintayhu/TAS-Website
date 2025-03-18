<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../db.php'; // Initialize an array to hold error messages
// Check if an AJAX request is made to get data
if (isset($_GET['action']) && $_GET['action'] === 'get_data') {
    // Debugging output
    // Use this carefully; it can disrupt JSON output

    $sql = "SELECT happyclient, projects, hourofsupport, hardworkers,id  FROM Statistics"; 
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
$counts = [
    'direct_messages' => 0,
    'quotes' => 0,
    'projects' => 0,
    'team_members' => 0,
];

// Fetch the counts from the database
$directMessageQuery = "SELECT COUNT(*) AS count FROM message"; // Replace with your actual table name
$quotesQuery = "SELECT COUNT(*) AS count FROM quotes"; // Replace with your actual table name
$projectsQuery = "SELECT COUNT(*) AS count FROM project"; // Replace with your actual table name
$teamMembersQuery = "SELECT COUNT(*) AS count FROM team"; // Replace with your actual table name

// Execute the queries and fetch results
if ($result = $connection->query($directMessageQuery)) {
    $row = $result->fetch_assoc();
    $counts['direct_messages'] = $row['count'];
}

if ($result = $connection->query($quotesQuery)) {
    $row = $result->fetch_assoc();
    $counts['quotes'] = $row['count'];
}

if ($result = $connection->query($projectsQuery)) {
    $row = $result->fetch_assoc();
    $counts['projects'] = $row['count'];
}

if ($result = $connection->query($teamMembersQuery)) {
    $row = $result->fetch_assoc();
    $counts['team_members'] = $row['count'];
}
$baseUrl = '/Selam-Design/Admin/';
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
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php echo htmlspecialchars($counts['direct_messages']); ?></h3>
                                    <p>Direct Message</p>
                                </div>
                                <div class="icon"> <i class="fa fa-comments"></i> </div>
                                <a href="<?php echo htmlspecialchars($baseUrl."message/manage.php"); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo htmlspecialchars($counts['quotes']); ?></h3>
                                    <p>Quotes</p>
                                </div>
                                <div class="icon"> <i class="fa fa-inbox"></i> </div>
                                <a href="<?php echo htmlspecialchars($baseUrl."Quote/manage.php"); ?>"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3><?php echo htmlspecialchars($counts['projects']); ?></h3>
                                    <p>Projects</p>
                                </div>
                                <div class="icon"> <i class="fa fa-layer-group"></i>   </div>
                                <a href="<?php echo htmlspecialchars($baseUrl."Project/manage.php"); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                <h3><?php echo htmlspecialchars($counts['team_members']); ?></h3>
                                    <p>Team Member</p>
                                </div>
                                <div class="icon"><i class="fa fa-users"></i>  </div>
                                <a href="<?php echo htmlspecialchars($baseUrl."Team/manage.php"); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Latest Cases Table -->
                    <div class="row col-12">
                        <div class="card col-12">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Statistics</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="staticsTable" class=" table m-0 table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>HappyClients</th>
                                                <th>Projects</th>
                                                <th>Hour of Support</th>
                                                <th>Hard Workers</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
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
        $('#staticsTable').DataTable({
            ajax: {
                url: '?action=get_data',
                type: 'GET', // Specify GET method
                dataSrc: ''
            },
            columns: [
                { data: 'happyclient' },
                { data: 'projects' },
                { data: 'hourofsupport' },
                { data: 'hardworkers' },
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