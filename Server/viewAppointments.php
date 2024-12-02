<!--
	Student Name: Aaron Renshaw
	Student Number: 041122937
	Date: April 4nd, 2024
	Prof: Alem Legesse
	Course: CST 8285
-->

<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Defines PHP variables equal to the value that the user inserted in the lookup.html fields.
        $firstName = $_GET['firstName'];
        $lastName = $_GET['lastName'];
        $date = $_GET['appointmentDate'];

        // Defines variables specifiying the details for the database we are connecting to.
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "WebAssignment2";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Strings for each column in the first part of the WHERE clause that will only be used if there was an entry made into that particular column
        $firstNameString = "c.firstName LIKE '%$firstName%'";
        $lastNameString = "c.lastName LIKE '%$lastName%'";
        $dateString = "a.appointmentDateTime LIKE '$date%'"; // The date must match exactly, but the LIKE operator will ignore the time.
        $sqlWhereString = "";

        // Checks which fields the user entered information into, and assigns a specific string to be used in the WHERE clause to match.
        if (empty($firstName) and empty($lastName)) {
            $sqlWhereString = $dateString;
        }
        elseif (empty($lastName) and empty($date)) {
            $sqlWhereString = $firstNameString;
        }
        elseif (empty($firstName) and empty($date)) {
            $sqlWhereString = $lastNameString;
        }
        elseif (empty($firstName)) {
            $sqlWhereString = $lastNameString . " AND " . $dateString;
        }
        elseif (empty($lastName)) {
            $sqlWhereString = $firstNameString . " AND " . $dateString;
        }
        elseif (empty($date)) {
            $sqlWhereString = $firstNameString . " AND " . $lastNameString;
        }
        else {
            $sqlWhereString = $firstNameString . " AND " . $lastNameString . " AND " . $dateString;
        }
        

        // Creates the variable "$sql" with a value equal to a query to return all appointment details that match what the user searched for.
        $sql = "
        SELECT c.firstName AS customerFirstName, c.lastName AS customerLastName, c.email, c.phone, 
        ap.applianceName, ap.applianceType, 
        t.firstName AS technicianFirstName, t.lastName AS technicianLastName, 
        a.appointmentDateTime, a.reason, a.quote
        FROM CUSTOMERS c
        JOIN APPOINTMENTS a ON a.customerID = c.customerID
        JOIN TECHNICIANS t ON t.technicianID = a.technicianID
        JOIN CUST_APPLIANCES cap ON cap.customerID = a.customerID
        JOIN APPLIANCES ap ON ap.applianceID = cap.applianceID
        WHERE $sqlWhereString;";

        // Stores the result of the customer appointment SELECT statement into the variable "$result"
        $result = mysqli_query($conn, $sql);

        // Error handling if the query has errors
        if (!$result) {
            $errorMsg = "Error executing SELECT query: " . mysqli_error($conn);
            error_log($errorMsg);
        }
        else {
            // Initializes an empty array: Each index stores one row of the retrieved SQL SELECT statement
            $appointments = [];

            // Verifies that there are more than 0 rows
            if ($result->num_rows > 0) {
                // Fetches each row of the returned query as long as there are rows to fetch.
                while ($row = $result->fetch_assoc()) {
                    $appointments[] = $row; // Appends each fetched row to the appointments array
                }
            }
        }

        // Receives a row from the SELECT statement and enters the result of each column into a variable. After this it echoes out an appointment with the correct info.
        function displayAppointment($appointment) {
            if ($GLOBALS['result']->num_rows > 0) {
                // Extract each column's value into a variable, use of htmlspecialchars for security
                $customerFirstName = htmlspecialchars($appointment["customerFirstName"]);
                $customerLastName = htmlspecialchars($appointment["customerLastName"]);
                $email = htmlspecialchars($appointment["email"]);
                $phone = htmlspecialchars($appointment["phone"]);
                $applianceName = htmlspecialchars($appointment["applianceName"]);
                $applianceType = htmlspecialchars($appointment["applianceType"]);
                $technicianFirstName = htmlspecialchars($appointment["technicianFirstName"]);
                $technicianLastName = htmlspecialchars($appointment["technicianLastName"]);
                $appointmentDateTime = htmlspecialchars($appointment["appointmentDateTime"]);
                $reason = htmlspecialchars($appointment["reason"]);
                $quote = htmlspecialchars($appointment["quote"]);
                
                // Use the variables to print out an HTML section for the appointment
                echo <<<HTML
                    <div class="appointment">
                        <h2>Appointment Details</h2>
                        <p><strong>Customer:</strong> $customerFirstName $customerLastName</p>
                        <p><strong>Email:</strong> $email</p>
                        <p><strong>Phone:</strong> $phone</p>
                        <p><strong>Appliance:</strong> $applianceName</p>
                        <p><strong>Appliance Type:</strong> $applianceType</p>
                        <p><strong>Technician:</strong> $technicianFirstName $technicianLastName</p>
                        <p><strong>Date & Time:</strong> $appointmentDateTime</p>
                        <p><strong>Reason:</strong> $reason</p>
                        <p><strong>Quote:</strong> $$quote</p>
                    </div>
                    <br>
                HTML;
            }
        }

        // Loops through the appointments[] array and displays each one to the user.
        function displayAllAppointments() {
            foreach ($GLOBALS['appointments'] as $appointment) {
                displayAppointment($appointment);
            }
        }
        
        // Closes the connection to the database
        mysqli_close($conn);
    }
?>        
<!-- Parts of the HTML document before the appointments are displayed -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Appointments Page</title>
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
        <!--A top navigation bar to jump to other pages-->
        <nav class="navbar">
            <a style="text-decoration:none" href="../Pages/lookup.html">EMPLOYEE PORTAL</a>
            <a style="text-decoration:none" href="../Pages/index.html">HOME</a>
            <a style="text-decoration:none" href="../Pages/registration.html">CUSTOMER PORTAL</a>
        </nav>

        <div class="header">
                <h1>Appointments</h1>
                <p> Total number of appointments found: <?php echo htmlspecialchars(count($appointments)); ?> </p>
        </div>

        <section class="appointmentsContainer"> 
            <?php displayAllAppointments(); ?>
        </section>
    </body>
</html>