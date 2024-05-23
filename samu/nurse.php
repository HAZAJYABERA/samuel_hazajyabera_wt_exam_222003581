<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nurse Form</title>
       <style>
    /* Normal link */
    a {
      padding: 5px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 1px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>
  </head>

  <header>

<body><body bgcolor="darkcyan">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 15px;">
    <img src="./images/samuel.png" width="90" height="60" alt="Logo">
  </li>
   
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">home</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./about.html">about</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./contact.html">contact</a></li>
      
      <li style="display: inline; margin-right: 10px;"><a href="./doctor.html">doctors</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./patient.html">patients</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./appointment.html">appointments</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./medical_records.html">medical_recoreds</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./pharmacy.html">pharmacy</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./lab_test.html">lab tests</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./billing.html">billing</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./inventory.html">inventory</a></li>
      
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./reports.html">reports</a></li>
  
  <li style="display: inline; margin-right: 10px;"><a href="./nurse.html">nurses</a></li>
  </li>
  
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section style=" color: orange;">
  <marquee><h1 style="color: brown;">WELCOME TO HOSPITAL MANAGEMENT SYSTEM </h1></marquee>
  <div class="container">



<h1>Nurse Form</h1>
<form method="post">

<label for="Nurse_id">Nurse Id:</label>
        <input type="number" id="Nurse_id" name="Nurse_id" required><br><br>
        <label for="medicine_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="Shift">Shift:</label>
        <input type="text" id="Shift" name="Shift" required><br><br>

        <label for="phone">Phone:</label>
        <input type="number" id="phone" name="phone" step="0.01" required><br><br>
        <label for="email">email:</label>
        <input type="email" id="Email" name="email" step="0.01" required><br><br>


        <input type="submit" name="add" value="Insert"><br><br>
    <marquee><h1 style="color: green;"> hazajyabera samuel:222003581 </h1></marquee>
        <!-- PHP code starts here -->

       <?php
include('database.php');

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO nurses (nurse_id, first_name, last_name, shift, phone, email) VALUES (?, ?, ?, ?, ?, ?)");
    
    // Initialize variables
    $nurse_id = $_POST['Nurse_id']; // Corrected variable name
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $shift = $_POST['Shift']; // Corrected variable name
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    
    $stmt->bind_param("isssis", $nurse_id, $first_name, $last_name, $shift, $phone, $email); // Corrected parameter types
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>
             <a href='nurse.php'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the nurses table
$sql = "SELECT * FROM nurses";
$result = $connection->query($sql);
?>

<!-- Displaying fetched data in a table -->
<table>
    <tr>
        <th>Nurse_Id</th>
        <th>First_Name</th>
        <th>Last_Name</th>
        <th>Shift</th>
        <th>Phone</th>
        <th>Email</th>
    </tr> 
    <?php 
    // Output data of each row
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["nurse_id"] . "</td>
                  <td>" . $row["first_name"] . "</td>
                  <td>" . $row["last_name"] . "</td> 
                  <td>" . $row["shift"] . "</td>
                  <td>" . $row["phone"] . "</td>
                  <td>" . $row["email"] . "</td>
                   <td><a style='padding:4px' href='delete_nurse.php?nurse_id=" . $row["nurse_id"] . "'>Delete</a></td>
                  <td><a style='padding:4px' href='update_nurse.php?nurse_id=" . $row["nurse_id"] . "'>Update</a></td>
              </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No data found</td></tr>";
    }
    ?>        
</table>

<?php
// Close connection
$connection->close();
?>  
<footer>
    <center> 
        <b>UR CBE BIT &copy; 2024 &reg;, Designed by: @HAZAJYABERA Samuel</b>
    </center>
</footer>
</body>
</html>
