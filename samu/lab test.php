<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Form</title>
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
        <h1>Lab Test Form</h1>
            <form method="post" action="lab test.php">
                <label for="test_id">Test ID:</label>
                <input type="number" id="test_id" name="test_id"><br><br>

                <label for="patient_id">Patient_Id:</label>
                <input type="text" id="patient_id" name="patient_id" required><br><br>

                <label for="test_name">Test_Name:</label>
                <input type="text" id="test_name" name="test_name" required><br><br>

                <label for="test_date">Test_Date:</label>
                <input type="date" id="test_date" name="test_date" required><br><br>

                <label for="result">Result:</label>
                <input type="text" id="result" name="result" required><br><br>

                <label for="patient_name">Patient_Name:</label>
                <input type="text" id="patient_name" name="patient name" required><br><br>

                <input type="submit" name="add" value="Insert"><br><br>
            <marquee><h1 style="color: green;"> hazajyabera samuel:222003581 </h1></marquee>


    <?php
include('database.php');


// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO lab_tests (test_id, patient_id, test_name, test_date, result, patient_name) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }

    // Set parameters from POST and execute
    $test_id = $_POST['test_id'];
    $patient_id = $_POST['patient_id'];
    $test_name = $_POST['test_name'];
    $test_date = $_POST['test_date'];
    $result = $_POST['result']; 
    $patient_name = $_POST['patient_name'];

    $stmt->bind_param("isssss", $test_id, $patient_id, $test_name, $test_date, $result, $patient_name);
    if (!$stmt->execute()) {
        die("Error inserting data: " . $stmt->error);
    }

    echo "New record has been added successfully.<br><br>
             <a href='labtest.html'>Back to Form</a>";

    $stmt->close();
}

// SQL query to fetch data from the lab_tests table
$sql = "SELECT * FROM lab_tests";
$result = $connection->query($sql);
?>

<!-- HTML content -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab test Form</title>
    <style>
        /* CSS styles */
    </style>
</head>
<body>
    <!-- HTML content -->

    <!-- Displaying fetched data in a table -->
    <table>
        <tr>
            <th>Test_ID</th>
            <th>patient_ID</th>
            <th>Test_Name</th>
            <th>Test_Date</th>
            <th>Result</th>
            <th>Patient_name</th>
        </tr>
        <?php 
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo"<tr><td>" . $row["test_id"] . "</td>
                      <td>" . $row["patient_id"] . "</td>
                      <td>" . $row["test_name"] . "</td> 
                      <td>" . $row["test_date"] . "</td>
                      <td>" . $row["result"] . "</td>
                      <td>" . $row["patient_name"] . "</td>
                      <td><a style='padding:4px' href='delete_lab test.php?test_id=" . $row["test_id"] . "'>Delete</a></td>
                      <td><a style='padding:4px' href='update_lab test.php?test_id=" . $row["test_id"] . "'>Update</a></td>
                  </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        ?>        
    </table>

    <?php
    // Close connection
    $connection->close();
    ?>  

    <!-- Footer -->
    <footer>
        <center> 
            <b>UR CBE BIT &copy; 2024 &reg;, Designed by: @HAZAJYABERA Samuel</b>
        </center>
    </footer>
</body>
</html>
