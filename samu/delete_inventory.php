<?php
include('database.php');

// Check if Doctor_id is set
if(isset($_REQUEST['item_id'])) {
    $item_id = $_REQUEST['item_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM inventory WHERE item_id=?");
    $stmt->bind_param("i", $item_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "item_id is not set.";
}

$connection->close();
?>
