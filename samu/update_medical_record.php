<?php
include('database.php');

// Check if record_id is set
if(isset($_REQUEST['record_id'])) {
    $record_id = $_REQUEST['record_id'];
   
    // Prepare and execute SELECT statement to retrieve record details
    $stmt = $connection->prepare("SELECT * FROM medical_records WHERE record_id = ?");
    $stmt->bind_param("i", $record_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $record_id = $row['record_id'];
        $patient_id = $row['patient_id'];
        $doctor_id = $row['doctor_id'];
        $record_date = $row['record_date'];
        $diagnosis = $row['diagnosis'];
        $prescription = $row['prescription'];
    } else {
        echo "Medical record not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="record_id">Record ID:</label>
        <input type="number" name="record_id" value="<?php echo isset($record_id) ? $record_id : ''; ?>">
        <br><br>

        <label for="patient_id">Patient ID:</label>
        <input type="number" name="patient_id" value="<?php echo isset($patient_id) ? $patient_id : ''; ?>">
        <br><br>

        <label for="doctor_id">Doctor ID:</label>
        <input type="number" name="doctor_id" value="<?php echo isset($doctor_id) ? $doctor_id : ''; ?>">
        <br><br>
       
        <label for="record_date">Record Date:</label>
        <input type="date" name="record_date" value="<?php echo isset($record_date) ? $record_date : ''; ?>">
        <br><br>
       
        <label for="diagnosis">Diagnosis:</label>
        <input type="text" name="diagnosis" value="<?php echo isset($diagnosis) ? $diagnosis : ''; ?>">
        <br><br>
        
        <label for="prescription">Prescription:</label>
        <input type="text" name="prescription" value="<?php echo isset($prescription) ? $prescription : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $record_id = $_POST['record_id'];
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $record_date = $_POST['record_date'];
    $diagnosis = $_POST['diagnosis'];
    $prescription = $_POST['prescription'];

    // Update the medical record in the database
    $stmt = $connection->prepare("UPDATE medical_records SET patient_id=?, doctor_id=?, record_date=?, diagnosis=?, prescription=? WHERE record_id=?");
    $stmt->bind_param("iisssi", $patient_id, $doctor_id, $record_date, $diagnosis, $prescription, $record_id);
   
    if ($stmt->execute()) {
        // Redirect to medical_records.php after successful update
        header('Location: medical_records.php');
        exit();
    } else {
        echo "Error updating medical record: " . $stmt->error;
    }
}
?>
