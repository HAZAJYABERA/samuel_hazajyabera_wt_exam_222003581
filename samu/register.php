
        <?php
include('database.php');

// Define variables and initialize with empty values
$user_id = $first_name = $last_name = $email = $telephone = $username = $gender = $password = "";

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    
    
    // Preparing SQL query
    $sql = "INSERT INTO users (user_id, first_name, last_name, email, telephone, username, gender, password) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare statement
    $stmt = $connection->prepare($sql);
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("isssssss", $user_id, $first_name, $last_name, $email, $telephone, $username, $gender, $password);
        
        // Execute statement
        if ($stmt->execute()) {
            // Redirecting to login page on successful registration
            header("Location: login.html");
            exit();
        } else {
            // Displaying error message if query execution fails
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        // Displaying error message if preparation fails
        echo "Error: Unable to prepare statement.";
    }
}

// Closing database connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
</head>
<body bgcolor="blue">
    <center>
        <h1>User Registration Form</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            User_id: <input type="number" name="user_id" required><br><br>
            First Name: <input type="text" name="first_name" required><br><br>
            Last Name: <input type="text" name="last_name" required><br><br>
            Email: <input type="email" name="email" required><br><br>
            Telephone: <input type="tel" name="telephone" required><br><br>
            Username: <input type="text" name="username" required><br><br>
            password: <input type="password" name="password" required><br><br>
            Gender:
            <input type="radio" name="gender" value="male" required>Male
            <input type="radio" name="gender" value="female" required>Female
        
            <input type="submit" name="submit" value="Register">
        </form>
    </center>
</body>
</html>
