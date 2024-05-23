
       


<?php
// Include the database connection file
include("database.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve the form data
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement to insert the user's data
    $stmt = $connection->prepare("INSERT INTO users (user_id, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $email, $hashed_password);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect the user to the home.html page
        header("Location: home.html");
        exit();
    } else {
        // Display an error message
        echo "Error registering user.";
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
}
?>