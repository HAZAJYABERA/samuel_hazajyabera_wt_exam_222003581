<?php
include('database.php');


// Check if test_id is set
if(isset($_REQUEST['test_id'])) {
    $test_id = $_REQUEST['test_id'];
   
    // Prepare and execute SELECT statement to retrieve test details
    $stmt = $connection->prepare("SELECT * FROM lab_tests WHERE test_id = ?");
    $stmt->bind_param("i", $test_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $test_id = $row['test_id'];
        $patient_id = $row['patient_id'];
        $test_name = $row['test_name'];
        $test_date = $row['test_date'];
        $result = $row['result'];
        $patient_name = $row['patient_name'];
    } else {
        echo "Test not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="test_id">Test ID:</label>
        <input type="number" name="test_id" value="<?php echo isset($test_id) ? $test_id : ''; ?>">
        <br><br>

        <label for="patient_id">Patient ID:</label>
        <input type="number" name="patient_id" value="<?php echo isset($patient_id) ? $patient_id : ''; ?>">
        <br><br>

        <label for="test_name">Test Name:</label>
        <input type="text" name="test_name" value="<?php echo isset($test_name) ? $test_name : ''; ?>">
        <br><br>
       
        <label for="test_date">Test Date:</label>
        <input type="date" name="test_date" value="<?php echo isset($test_date) ? $test_date : ''; ?>">
        <br><br>
       
        <label for="result">Result:</label>
        <input type="text" name="result" value="<?php echo isset($result) ? $result : ''; ?>">
        <br><br>
        
        <label for="patient_name">Patient Name:</label>
        <input type="text" name="patient_name" value="<?php echo isset($patient_name) ? $patient_name : ''; ?>">
        <br><br>
       
        <input type="submit" name="update" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['update'])) {
    // Retrieve updated values from form
    $test_id = $_POST['test_id'];
    $patient_id = $_POST['patient_id'];
    $test_name = $_POST['test_name'];
    $test_date = $_POST['test_date'];
    $result = $_POST['result'];
    $patient_name = $_POST['patient_name'];

    // Update the lab test in the database
    $stmt = $connection->prepare("UPDATE lab_tests SET patient_id=?, test_name=?, test_date=?, result=?, patient_name=? WHERE test_id=?");
    $stmt->bind_param("issssi", $patient_id, $test_name, $test_date, $result, $patient_name, $test_id);
   
    if ($stmt->execute()) {
        // Redirect to lab_tests.php after successful update
        header('Location: lab_tests.php');
        exit();
    } else {
        echo "Error updating lab test: " . $stmt->error;
    }
}
?>
