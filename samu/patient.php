<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Form</title>
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
        <h1>Patient Form</h1>
    
        <form method="post" action="patient.php">

            <label for="patient_id">patient_id:</label>
            <input type="number" id="patient_id" name="patient_id"><br><br>

            <label for="first_name">first_name:</label>
            <input type="text" id="first_name" name="first_name" required><br><br>

            <label for="last_name">last_name:</label>
            <input type="text" id="last_name" name="last_name" required><br><br>

            <label for="gender">gender:</label>
            <input type="text" id="gender" name="gender" required><br><br>

            <label for="date_of_birth">date_of_birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

            <label for="contact">contact:</label>
            <input type="number" id="contact" name="contact" required><br><br>

            <label for="address">address:</label>
            <input type="text" id="address" name="address" required><br><br>

            <input type="submit" name="add" value="Insert"><br><br>
            </form>
            <marquee><h1 style="color: green;"> hazajyabera samuel:222003581 </h1></marquee>



        <!-- PHP code starts here -->

        <?php
        include('database.php');

        // Check if the form is submitted for insert
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
            // Insert section
            $stmt = $connection->prepare("INSERT INTO patients (patient_id, first_name, last_name, gender, date_of_birth, contact, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssss", $patient_id, $first_name, $last_name, $gender, $date_of_birth, $contact, $address);

            // Set parameters from POST and execute
            $patient_id = $_POST['patient_id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $gender = $_POST['gender'];
            $date_of_birth = $_POST['date_of_birth'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];

            if ($stmt->execute()) {
                echo "New record has been added successfully.<br><br>
                     <a href='patient.html'>Back to Form</a>";
            } else {
                echo "Error inserting data: " . $stmt->error;
            }

            $stmt->close();
        }

        // SQL query to fetch data from the patients table
        $sql = "SELECT * FROM patients";
        $result = $connection->query($sql);
        ?>

        <!-- Displaying fetched data in a table -->
        <table>
            <tr>
                <th>patient_ID</th>
                <th>First_Name</th>
                <th>Last_Name</th>
                <th>Gender</th>
                <th>Date_of_birth</th>
                <th>Contact</th>
                <th>Address</th>
            </tr> 
            <?php 
            // Output data of each row
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["patient_id"] . "</td>
                          <td>" . $row["first_name"] . "</td>
                          <td>" . $row["last_name"] . "</td> 
                          <td>" . $row["gender"] . "</td>
                          <td>" . $row["date_of_birth"] . "</td>
                          <td>" . $row["contact"] . "</td>
                          <td>" . $row["address"] . "</td>
                          <td><a style='padding:4px' href='delete_patient.php?patient_id=" . $row["patient_id"] . "'>Delete</a></td>
                          <td><a style='padding:4px' href='update_patient.php?patient_id=" . $row["patient_id"] . "'>Update</a></td>
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
    </div>

    <!-- Footer -->
    <footer>
        <center> 
            <b>UR CBE BIT &copy; 2024 &reg;, Designed by: @HAZAJYABERA Samuel</b>
        </center>
    </footer>
</body>
</html>
