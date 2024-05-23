<?php
include('database.php');

// Check if Doctor_id is set
if(isset($_REQUEST['medicine_id'])) {
    $medicine_id = $_REQUEST['medicine_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM pharmacy WHERE medicine_id=?");
    $stmt->bind_param("i", $medicine_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "medicine_id is not set.";
}

$connection->close();
?>
