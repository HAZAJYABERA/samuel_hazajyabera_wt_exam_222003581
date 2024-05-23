<?php
include('database.php');


// Check if test_id is set
if(isset($_REQUEST['test_id'])) {
    $test_id = $_REQUEST['test_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM lab_tests WHERE test_id=?");
    if (!$stmt) {
        echo "Error preparing statement: " . $connection->error;
    } else {
        $stmt->bind_param("i", $test_id);
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo "test_id is not set.";
}

$connection->close();
?>
