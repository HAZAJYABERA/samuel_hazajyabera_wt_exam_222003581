<?php
include('database.php');


// Check if doctor_id is set
if(isset($_REQUEST['doctor_id'])) {
    $doctor_id = $_REQUEST['doctor_id'];
    
    // Delete related records in appointments table first
    $stmt_delete_appointments = $connection->prepare("DELETE FROM appointments WHERE doctor_id=?");
    $stmt_delete_appointments->bind_param("i", $doctor_id);
    if ($stmt_delete_appointments->execute()) {
        // If related appointments are deleted successfully, then delete the doctor record
        $stmt_delete_doctor = $connection->prepare("DELETE FROM doctors WHERE doctor_id=?");
        $stmt_delete_doctor->bind_param("i", $doctor_id);
        if ($stmt_delete_doctor->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting doctor data: " . $stmt_delete_doctor->error;
        }
        $stmt_delete_doctor->close();
    } else {
        echo "Error deleting appointments data: " . $stmt_delete_appointments->error;
    }
    $stmt_delete_appointments->close();
} else {
    echo "doctor_id is not set.";
}

$connection->close();
?>
