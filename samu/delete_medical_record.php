<?php
include('database.php');

// Check if Doctor_id is set
if(isset($_REQUEST['record_id'])) {
    $record_id = $_REQUEST['record_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM medical_records WHERE record_id=?");
    $stmt->bind_param("i", $record_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "record_id is not set.";
}

$connection->close();
?>
