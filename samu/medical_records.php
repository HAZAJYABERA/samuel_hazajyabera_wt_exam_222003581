<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medical_record Form</title>
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
            <div class="container">
<h1>Medical_record Form</h1>
<form method="post" action="Medical_record.php">

<label for="record_id">record_id:</label>
<input type="number" id="record_id" name="record_id"><br><br>

<label for="patient_id">patient_id:</label>
<input type="number" id="patient_id" name="patient_id" required><br><br>

<label for="doctor_id">doctor_id:</label>
<input type="number" id="doctor_id" name="doctor_id" required><br><br>

<label for="record_date"> record_date:</label>
<input type="date" id="record_date" name="record_date" required><br><br>
<label for="diagnosis">diagnosis:</label>
<input type="text" id="diagnosis" name="diagnosis" required><br><br>
<label for="prescription">prescription:</label>
<input type="text" id="prescription" name="prescription" required><br><br>
<input type="submit" name="add" value="Insert"><br><br>
<marquee><h1 style="color: green;"> hazajyabera samuel:222003581 </h1></marquee>

            
            <?php
            include('database.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $record_id = $_POST['record_id'];
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $record_date = $_POST['record_date'];
    $diagnosis = $_POST['diagnosis'];
    $prescription = $_POST['prescription']; 

    $stmt = $connection->prepare("INSERT INTO medical_records (record_id, patient_id, doctor_id, record_date, diagnosis, prescription) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisss", $record_id, $patient_id, $doctor_id, $record_date, $diagnosis, $prescription);

    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>
            <a href='medical_records.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }
}

$sql = "SELECT * FROM medical_records";
$result = $connection->query($sql);
?>
<!-- Your form HTML here -->

    <table>
        <tr>
            <th>Record ID</th>
            <th>Patient ID</th>
            <th>Doctor ID</th>
            <th>Record Date</th>
            <th>Diagnosis</th>
            <th>Prescription</th>
        </tr>
        <?php 
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["record_id"] . "</td>
                      <td>" . $row["patient_id"] . "</td>
                      <td>" . $row["doctor_id"] . "</td>
                      <td>" . $row["record_date"] . "</td>
                      <td>" . $row["diagnosis"] . "</td>
                      <td>" . $row["prescription"] . "</td>
                      <td><a style='padding:4px' href='delete_medical_record.php?record_id=" . $row["record_id"] . "'>Delete</a></td>
                      <td><a style='padding:4px' href='update_medical_record.php?record_id=" . $row["record_id"] . "'>Update</a></td>
                  </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        ?>        
    </table>

    <!-- Footer -->
    <footer>
        <center> 
            <b>UR CBE BIT &copy; 2024 &reg;, Designed by: @HAZAJYABERA Samuel</b>
        </center>
    </footer>
</body>
</html>
