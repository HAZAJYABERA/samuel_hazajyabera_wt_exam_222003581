<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Form</title>
       <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
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
    section{
    padding:33px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:darkgray;
    }
  </style>
  </head>

<header>

<body bgcolor="darkcyan">
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


<h1>Appointment Form</h1>
<form method="post" action="appointment.php">

<label for="appointment_id">appointment_id:</label>
<input type="number" id="appointment_id" name="appointment_id"><br><br>

<label for="patient_id">patient_id:</label>
<input type="number" id="patient_id" name="patient_id" required><br><br>

<label for="doctor_id">doctor_id:</label>
<input type="number" id="doctor_id" name="pdoctor_id" required><br><br>

<label for="appointment_date">appointment_date:</label>
<input type="date" id="appointment_date" name="user_type" required><br><br>
<label for="appointment_time">appointment_time:</label>
<input type="time" id="appointment_time" name="appointment_time" required><br><br>
<label for="status">status:</label>
<input type="text" id="astatus" name="astatus" required><br><br>
<input type="submit" name="add" value="Insert"><br><br>
<marquee><h1 style="color: green;"> hazajyabera samuel:222003581 </h1></marquee>
</form>
           

            <?php
            include('database.php');

            // SQL query to fetch appointment data
            $sql = "SELECT appointment_id, patient_id, doctor_id, appointment_date, appointment_time, status FROM appointments";
            $result = $connection->query($sql);
            ?>

            <table>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient ID</th>
                    <th>Doctor ID</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                </tr> 
                <?php
                // Output data of each row
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["appointment_id"] . "</td>
                                <td>" . $row["patient_id"] . "</td>
                                <td>" . $row["doctor_id"] . "</td> 
                                <td>" . $row["appointment_date"] . "</td>
                                <td>" . $row["appointment_time"] . "</td>
                                <td>" . $row["status"] . "</td>
                                <td><a style='padding:4px' href='delete_appointment.php?appointment_id=" . $row["appointment_id"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_appointment.php?appointment_id=" . $row["appointment_id"] . "'>Update</a></td>
                </tr>";
            
                }
                    
            
                } else {
                    echo "<tr><td colspan='6'>No appointments found</td></tr>";
                }
                ?>        
            </table>

            <?php
            // Close connection
            $connection->close();
            ?>  
        </div>

        <footer>
            <center> 
                <b>UR CBE BIT &copy; 2024 &reg;, Designed by: @HAZAJYABERA Samuel</b>
            </center>
        </footer>
    </section>
</body>
</html>
