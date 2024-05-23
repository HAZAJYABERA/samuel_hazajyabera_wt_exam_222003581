<?php
include('database.php');

// Check if Doctor_id is set
if(isset($_REQUEST['patient_id'])) {
    $patient_id = $_REQUEST['patient_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM patients WHERE patient_id=?");
    $stmt->bind_param("i", $patient_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "patient_id is not set.";
}

$connection->close();
?>
