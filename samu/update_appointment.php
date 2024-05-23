<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "hospital_management_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if appointment_id is set
if(isset($_REQUEST['appointment_id'])) {
    $appointment_id = $_REQUEST['appointment_id'];
   
    // Prepare and execute SELECT statement to retrieve appointment details
    $stmt = $connection->prepare("SELECT * FROM appointments WHERE appointment_id = ?");
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $appointment_id = $row['appointment_id'];
        $patient_id = $row['patient_id'];
        $doctor_id = $row['doctor_id'];
        $appointment_date = $row['appointment_date'];
        $appointment_time = $row['appointment_time'];
        $status = $row['status'];
    } else {
        echo "Appointment not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="appointment_id">Appointment ID:</label>
        <input type="number" name="appointment_id" value="<?php echo isset($appointment_id) ? $appointment_id : ''; ?>">
        <br><br>

        <label for="patient_id">Patient ID:</label>
        <input type="number" name="patient_id" value="<?php echo isset($patient_id) ? $patient_id : ''; ?>">
        <br><br>

        <label for="doctor_id">Doctor ID:</label>
        <input type="number" name="doctor_id" value="<?php echo isset($doctor_id) ? $doctor_id : ''; ?>">
        <br><br>
       
        <label for="appointment_date">Appointment Date:</label>
        <input type="date" name="appointment_date" value="<?php echo isset($appointment_date) ? $appointment_date : ''; ?>">
        <br><br>
       
        <label for="appointment_time">Appointment Time:</label>
        <input type="time" name="appointment_time" value="<?php echo isset($appointment_time) ? $appointment_time : ''; ?>">
        <br><br>
        
        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo isset($status) ? $status : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $appointment_id = $_POST['appointment_id'];
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = $_POST['status'];

    // Update the appointment in the database
    $stmt = $connection->prepare("UPDATE appointments SET patient_id=?, doctor_id=?, appointment_date=?, appointment_time=?, status=? WHERE appointment_id=?");
    $stmt->bind_param("iisssi", $patient_id, $doctor_id, $appointment_date, $appointment_time, $status, $appointment_id);
   
    if ($stmt->execute()) {
        // Redirect to some_page.php after successful update
        header('Location: appointments.php');
        exit();
    } else {
        echo "Error updating appointment: " . $stmt->error;
    }
}
?>
