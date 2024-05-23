<?php
include('database.php');

// Check if Doctor_id is set
if(isset($_REQUEST['billing_id'])) {
    $billing_id = $_REQUEST['billing_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM billing WHERE billing_id=?");
    $stmt->bind_param("i", $billing_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "billing_id is not set.";
}

$connection->close();
?>
