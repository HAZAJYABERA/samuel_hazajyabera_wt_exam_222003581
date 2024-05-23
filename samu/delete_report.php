<?php
include('database.php');

// Check if report_id is set
if(isset($_REQUEST['report_id'])) {
    $report_id = $_REQUEST['report_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM reports WHERE report_id=?");
    $stmt->bind_param("i", $report_id);
    
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "report_id is not set.";
}

$connection->close();
?>
