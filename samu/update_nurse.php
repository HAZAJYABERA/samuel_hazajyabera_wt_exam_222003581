<?php
include('database.php');

// Check if nurse_id is set
if(isset($_REQUEST['nurse_id'])) {
    $nurse_id = $_REQUEST['nurse_id'];
   
    // Prepare and execute SELECT statement to retrieve nurse details
    $stmt = $connection->prepare("SELECT * FROM nurses WHERE nurse_id = ?");
    $stmt->bind_param("i", $nurse_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nurse_id = $row['nurse_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $shift = $row['shift'];
        $phone = $row['phone'];
        $email = $row['email'];
        
    } else {
        echo "Nurse not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="report_id">Nurse ID:</label>
        <input type="number" name="nurse_id" value="<?php echo isset($nurse_id) ? $nurse_id : ''; ?>">
        <br><br>

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>">
        <br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>">
        <br><br>
       
        <label for="report_date">Shift:</label>
        <input type="text" name="shift" value="<?php echo isset($shift) ? $shift : ''; ?>">
        <br><br>
       
        <label for="phone">Phone:</label>
        <input type="number" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
        <br><br>
        
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $nurse_id = $_POST['nurse_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $shift = $_POST['shift'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    

    // Update the nurse in the database
    $stmt = $connection->prepare("UPDATE nurses SET first_name=?, last_name=?, shift=?, phone=?, email=? WHERE nurse_id=?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $shift, $phone, $email, $nurse_id);
   
    if ($stmt->execute()) {
        // Redirect to nurse.php after successful update
        header('Location: nurse.php');
        exit();
    } else {
        echo "Error updating nurse: " . $stmt->error;
    }
}
?>
