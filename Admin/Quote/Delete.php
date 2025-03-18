<?php
    require '../db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            switch ($action) {
                case 'delete_data':
                    handleDelete( $connection);
                    break;
                default:
                    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
                    break;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No action specified.']);
        }
        $connection->close();
    } 
    function handleDelete($connectionn) {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        if ($id > 0) {
            $stmt = $connectionn->prepare("DELETE FROM quotes WHERE id = ?");
            if ($stmt === false) {
                echo json_encode(['success' => false, 'message' => 'Failed to prepare statement.']);
                return;
            }

            $stmt->bind_param("i", $id); // "i" means the parameter is an integer

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Record deleted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete record: ' . $stmt->error]);
            }

            $stmt->close(); // Close the statement
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
        }
    }
?>