<?php
include('database.php');

// Check if doctor_id is set
if(isset($_REQUEST['doctor_id'])) {
    $doctor_id = $_REQUEST['doctor_id'];
   
    // Prepare and execute SELECT statement to retrieve doctor's details
    $stmt = $connection->prepare("SELECT * FROM doctors WHERE doctor_id = ?");
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $doctor_id = $row['doctor_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $contact = $row['contact'];
        $specialization = $row['specialization'];
    } else {
        echo "Doctor not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="doctor_id">Doctor ID:</label>
        <input type="number" name="doctor_id" value="<?php echo isset($doctor_id) ? $doctor_id : ''; ?>">
        <br><br>

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>">
        <br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>">
        <br><br>
       
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>
       
        <label for="contact">Contact:</label>
        <input type="number" name="contact" value="<?php echo isset($contact) ? $contact : ''; ?>">
        <br><br>
       
        <label for="specialization">Specialization:</label>
        <input type="text" name="specialization" value="<?php echo isset($specialization) ? $specialization : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $doctor_id = $_POST['doctor_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $specialization = $_POST['specialization'];

    // Update the doctor in the database
    $stmt = $connection->prepare("UPDATE doctors SET first_name=?, last_name=?, email=?, contact=?, specialization=? WHERE doctor_id=?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $contact, $specialization, $doctor_id);
   
    if ($stmt->execute()) {
        // Redirect to doctor.php after successful update
        header('Location: doctor.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating doctor: " . $stmt->error;
    }
}
?>
