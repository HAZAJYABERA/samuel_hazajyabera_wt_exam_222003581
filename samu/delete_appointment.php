<?php
include('database.php');


// Check if Doctor_id is set
if(isset($_REQUEST['appointment_id'])) {
    $appointment_id = $_REQUEST['appointment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM appointments WHERE appointment_id=?");
    $stmt->bind_param("i", $appointment_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "appointment_id is not set.";
}

$connection->close();
?>
