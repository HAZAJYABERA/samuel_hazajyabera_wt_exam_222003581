<?php
include('database.php');


// Check if medicine_id is set
if(isset($_REQUEST['medicine_id'])) {
    $id = $_REQUEST['medicine_id'];
   
    // Prepare and execute SELECT statement to retrieve pharmacy details
    $stmt = $connection->prepare("SELECT * FROM pharmacy WHERE  medicine_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['medicine_id'];
        $y = $row['medicine_name'];
        $z = $row['manufacturer'];
        $q = $row['quantity']; // Corrected variable name from 'z' to 'q'
        $v = $row['unit_price'];
    
    } else {
        echo "pharmacy not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="medicine_id">medicine_id:</label>
        <input type="number" name="medicine_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="medicine_name">medicine_name:</label>
        <input type="text" name="medicine_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="manufacturer">manufacturer:</label>
        <input type="text" name="manufacturer" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
       
        <label for="quantity">quantity:</label>
        <input type="quantity" name="quantity" value="<?php echo isset($q) ? $q : ''; ?>"> <!-- Corrected input type -->
        <br><br>
        <label for="unit_price">unit_price:</label>
        <input type="number" name="unit_price" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
    
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $medicine_id = $_POST['medicine_id'];
    $medicine_name = $_POST['medicine_name'];
    $manufacturer= $_POST['manufacturer'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    

    // Update the pharmacy in the database
    $stmt = $connection->prepare("UPDATE pharmacy SET medicine_name=?, manufacturer=?, quantity=?, unit_price=? WHERE medicine_id=?");
    $stmt->bind_param("sssdi", $medicine_name, $manufacturer, $quantity, $unit_price, $medicine_id); // Corrected parameter order
   
    if ($stmt->execute()) {
        // Redirect to payment.php after successful update
        header('Location: pharmacy.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating pharmacy: " . $stmt->error;
    }
}
?>
