<?php
include('database.php');


// Check if patient_id is set
if(isset($_REQUEST['patient_id'])) {
    $patient_id = $_REQUEST['patient_id'];
   
    // Prepare and execute SELECT statement to retrieve patients details
    $stmt = $connection->prepare("SELECT * FROM patients WHERE patient_id = ?");
    $stmt->bind_param("i", $patient_id); // Corrected variable name
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['patient_id'];
        $y = $row['first_name'];
        $z = $row['last_name'];
        $v = $row['date_of_birth'];
        $w = $row['gender']; // Corrected variable name
        $v = $row['contact'];
        $w = $row['address'];
    } else {
        echo "Patient not found."; // Corrected spelling
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="patient_id">Patient ID:</label>
        <input type="number" name="patient_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
       
        <label for="gender">Gender:</label>
        <input type="text" name="gender" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <label for="contact">Contact:</label>
        <input type="number" name="contact" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $patient_id = $_POST['patient_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $Gender = $_POST['Gender'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Update the patient in the database
    $stmt = $connection->prepare("UPDATE patients SET first_name=?, last_name=?, date_of_birth=?, gender=?, contact=?, address=? WHERE patient_id=?");
    $stmt->bind_param("ssssisi", $first_name, $last_name, $date_of_birth, $gender, $contact, $address, $patient_id); // Corrected data types and parameter order
   
    if ($stmt->execute()) {
        // Redirect to patient.php after successful update
        header('Location: patient.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating patient: " . $stmt->error;
    }
}
?>
