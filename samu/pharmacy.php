<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pharmacy Form</title>
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



<h1>Pharmacy Form</h1>
<form method="post">

<label for="medicine_name">Medicine Id:</label>
        <input type="number" id="medicine_id" name="medicine_id" required><br><br>
        <label for="medicine_name">Medicine Name:</label>
        <input type="text" id="medicine_name" name="medicine_name" required><br><br>
        <label for="manufacturer">Manufacturer:</label>
        <input type="text" id="manufacturer" name="manufacturer" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <label for="unit_price">Unit Price:</label>
        <input type="number" id="unit_price" name="unit_price" step="0.01" required><br><br>
        <input type="submit" name="add" value="Insert"><br><br>
<marquee><h1 style="color: green;"> hazajyabera samuel:222003581 </h1></marquee>
        <!-- PHP code starts here -->

        <?php
        include('database.php');

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO pharmacy (medicine_id, medicine_name, manufacturer, quantity, unit_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $medicine_id, $medicine_name, $manufacturer, $quantity, $unit_price);
    // Set parameters from POST and execute
    $medicine_id = $_POST['medicine_id'];
    $medicine_name = $_POST['medicine_name'];
    $manufacturer = $_POST['manufacturer']; // Corrected here
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>
             <a href='pharmacy.php'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the pharmacy table
$sql = "SELECT * FROM pharmacy";
$result = $connection->query($sql);
?>

<!-- Displaying fetched data in a table -->
<table>
    <tr>
        <th>Medicine_Id</th>
        <th>Medicine_Name</th>
        <th>Manufacturer</th>
        <th>Quantity</th>
        <th>Unit_Price</th>
    </tr> 
    <?php 
    // Output data of each row
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["medicine_id"] . "</td>
                  <td>" . $row["medicine_name"] . "</td>
                  <td>" . $row["manufacturer"] . "</td> <!-- Corrected here -->
                  <td>" . $row["quantity"] . "</td>
                  <td>" . $row["unit_price"] . "</td>
                  <td><a style='padding:4px' href='delete_pharmacy.php?medicine_id=" . $row["medicine_id"] . "'>Delete</a></td>
                  <td><a style='padding:4px' href='update_pharmacy.php?medicine_id=" . $row["medicine_id"] . "'>Update</a></td>
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
