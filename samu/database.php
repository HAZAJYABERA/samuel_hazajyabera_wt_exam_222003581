  <?php
            // Database connection details
            $host = "localhost";
            $user = "samuel";
            $pass = "222003581";
            $database = "hospital_management_system";

            // Creating connection
            $connection = new mysqli($host, $user, $pass, $database);
            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

          ?>