<?php
    require '../db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            switch ($action) {
                case 'delete_data':
                    handleDelete( $connection);
                    break;

                case 'deactivate_data':
                    handleDeactivate($connection);
                    break;

                case 'activate_data':
                    handleActivate($connection);
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
            $stmt = $connectionn->prepare("DELETE FROM project WHERE id = ?");
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

    // Function to handle deactivation
    function handleDeactivate($connection) {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        if ($id > 0) {
            $stmt = $connection->prepare("UPDATE project SET status = 0 WHERE id = ?");
            $stmt->bind_param("i", $id); // "i" means the parameter is an integer

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Record deactivated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to deactivate record.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
        }
    }

    function handleActivate($connection) {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        if ($id > 0) {
            $stmt = $connection->prepare("UPDATE project SET status = 1 WHERE id = ?");
            $stmt->bind_param("i", $id); // "i" means the parameter is an integer

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Record activated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to activate record.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID.']);
        }
    }
?>