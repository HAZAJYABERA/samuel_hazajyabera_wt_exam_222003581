<?php
include('database.php');

// Check if item_id is set
if(isset($_REQUEST['item_id'])) {
    $item_id = $_REQUEST['item_id'];
   
    // Prepare and execute SELECT statement to retrieve item details
    $stmt = $connection->prepare("SELECT * FROM inventory WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $item_id = $row['item_id'];
        $item_name = $row['item_name'];
        $quantity = $row['quantity'];
        $location = $row['location'];
        $category = $row['category'];
    } else {
        echo "Item not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="item_id">Item ID:</label>
        <input type="number" name="item_id" value="<?php echo isset($item_id) ? $item_id : ''; ?>">
        <br><br>

        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" value="<?php echo isset($item_name) ? $item_name : ''; ?>">
        <br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>">
        <br><br>
       
        <label for="location">Location:</label>
        <input type="text" name="location" value="<?php echo isset($location) ? $location : ''; ?>">
        <br><br>
       
        <label for="category">Category:</label>
        <input type="text" name="category" value="<?php echo isset($category) ? $category : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
       
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $location = $_POST['location'];
    $category = $_POST['category'];

    // Update the inventory in the database
    $stmt = $connection->prepare("UPDATE inventory SET item_name=?, quantity=?, location=?, category=? WHERE item_id=?");
    $stmt->bind_param("sissi", $item_name, $quantity, $location, $category, $item_id);
   
    if ($stmt->execute()) {
        // Redirect to some_page.php after successful update
        header('Location: inventory.php');
        exit();
    } else {
        echo "Error updating inventory: " . $stmt->error;
    }
}
?>
