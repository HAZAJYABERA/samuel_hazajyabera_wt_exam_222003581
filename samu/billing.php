

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>billing Form</title>
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
    <ul style="list-style-type: none; padding: 2px;">
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
      <li style="display: inline; margin-right: 10px;"><a href="./reports.html">reports</a></li>
  
  <li style="display: inline; margin-right: 10px;"><a href="./nurse.html">nurses</a></li>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 5px;">
      <a href="#" style="padding: 5px; color: blue; background-color: skyblue; text-decoration: none; margin-right: 5px;">Settings</a>
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
  <marquee><h1 style="color: brown;">WELCOME TO OUR WEBSITE OF HOSPITAL MANAGEMENT SYSTEM </h1></marquee>
        <div class="container">
            <form method="post">

<label for="billing_id">Billing_id:</label>
<input type="text" id="billing_id" name="billing_id"><br><br>

<label for="patient_id">Patient_id:</label>
<input type="text" id="patient_id" name="patient_id" required><br><br>

<label for="doctor_id">Doctor_id:</label>
<input type="number" id="doctor_id" name="doctor_id" required><br><br>

<label for="amout">Amount:</label>
<input type="number" id="amount" name="amount" required><br><br>
<label for="date">Date:</label>
<input type="date" id="date" name="date" required><br><br>
<label for="status">Status:</label>
<input type="text" id="status" name="status" required><br><br>
<input type="submit" name="add" value="Insert"><br><br>
<marquee><h1 style="color: bisque;"> hazajyabera samuel:222003581 </h1></marquee>

            <!-- Your PHP code for inserting and displaying data -->
            <?php
            include('database.php');
            

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
                $billing_id = $_POST['billing_id'];
                $patient_id = $_POST['patient_id'];
                $doctor_id = $_POST['doctor_id'];
                $amount = $_POST['amount']; // Corrected variable name
                $date = $_POST['date'];
                $status= $_POST['status'];
                

                $stmt = $connection->prepare("INSERT INTO billing (billing_id, patient_id, doctor_id, amount, date, status) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssi", $billing_id, $patient_id, $doctor_id, $amount, $date, $status);

                if ($stmt->execute()) {
                    echo "New record has been added successfully.<br><br>
                        <a href='billing.html'>Back to Form</a>";
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }

                $stmt->close();
            }

            $sql = "SELECT * FROM billing";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Billing ID</th>
                            <th>Patient_ID</th>
                            <th>Doctor_ID</th>
                            <th>Amount</th>
                            <th>Dade</th>
                            <th>Status</th>
                            
                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["billing_id"] . "</td>
                            <td>" . $row["patient_id"] . "</td>
                            <td>" . $row["doctor_id"] . "</td>
                            <td>" . $row["amount"] . "</td>
                            <td>" . $row["date"] . "</td>
                            <td>" . $row["status"] . "</td>
                            <td><a style='padding:4px' href='delete_billing.php?billing_id=" . $row["billing_id"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_billing.php?billing_id=" . $row["billing_id"] . "'>Update</a></td>
                </tr>";
            
                }

            } else {
                echo "<tr><td colspan='5'>No data found</td></tr>";
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
</body>
</html>
