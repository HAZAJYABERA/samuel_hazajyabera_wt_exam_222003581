<?php
include('database.php');

// Check if billing_id is set
if(isset($_REQUEST['billing_id'])) {
    $billing_id = $_REQUEST['billing_id'];
   
    // Prepare and execute SELECT statement to retrieve billing details
    $stmt = $connection->prepare("SELECT * FROM billing WHERE billing_id = ?");
    $stmt->bind_param("i", $billing_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $billing_id = $row['billing_id'];
        $patient_id = $row['patient_id'];
        $amount = $row['amount'];
        $date = $row['date'];
        $status = $row['status'];
    } else {
        echo "Billing not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="billing_id">Billing ID:</label>
        <input type="number" name="billing_id" value="<?php echo isset($billing_id) ? $billing_id : ''; ?>">
        <br><br>

        <label for="patient_id">Patient ID:</label>
        <input type="number" name="patient_id" value="<?php echo isset($patient_id) ? $patient_id : ''; ?>">
        <br><br>

        <label for="amount">Amount:</label>
        <input type="number" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>">
        <br><br>
       
        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
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
    $billing_id = $_POST['billing_id'];
    $patient_id = $_POST['patient_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    // Update the billing in the database
    $stmt = $connection->prepare("UPDATE billing SET patient_id=?, amount=?, date=?, status=? WHERE billing_id=?");
    $stmt->bind_param("iisss", $patient_id, $amount, $date, $status, $billing_id);
   
    if ($stmt->execute()) {
        // Redirect to billing.php after successful update
        header('Location: billing.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating billing: " . $stmt->error;
    }
}
?>
