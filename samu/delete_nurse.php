<?php
include('database.php');



// Check if Doctor_id is set
if(isset($_REQUEST['nurse_id'])) {
    $billing_id = $_REQUEST['nurse_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM nurses WHERE nurse_id=?");
    $stmt->bind_param("i", $nurse_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "nurse_id is not set.";
}

$connection->close();
?>
