<!--
	Student Name: Aaron Renshaw
	Student Number: 041122937
	Date: April 4nd, 2024
	Prof: Alem Legesse
	Course: CST 8285
-->

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $appType = $_POST['appType'];
        $appName = $_POST['appName'];
        $reason = $_POST['reason'];
        $appointmentDate = $_POST['appointmentDate'];
        $appointmentTime = $_POST['appointmentTime'];
        $appointmentDateTime = $appointmentDate . ' ' . $appointmentTime. ':00';
        // Minimum and maximum values for random quote generation
        $min = 100.00;
        $max = 300.00;
        
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


        // Performing insert statements with error handling that doesn't present information to the user.

        // Creating the insert statement for the CUSTOMERS table
        $customersInsert = "INSERT INTO CUSTOMERS (firstName, lastName, email, phone)
        VALUES ('$firstName', '$lastName', '$email', '$phone')";

        // Completes the CUSTOMERS insert, if command fails writes the errors to the log
        if (mysqli_query($conn, $customersInsert)) {
            // Retrieves the generated customerID from the last query
            $generatedCustomerID = mysqli_insert_id($conn);
        }
        else {
            $customerInsertErrorMsg = "Error inserting into the customers table: " . mysqli_error($conn);
            error_log($customerInsertErrorMsg);
        }        


        // Creating the insert statement for the APPLIANCES table
        $appliancesInsert = "INSERT INTO APPLIANCES (applianceName, applianceType)
        VALUES ('$appName', '$appType')";
        
        // Completes the APPLIANCES insert, if command fails writes the errors to the log
        if (mysqli_query($conn, $appliancesInsert)) {
            // Retrieves the generated applianceID from the last query
            $generatedApplianceID = mysqli_insert_id($conn);
        }
        else {
            $applaincesInsertErrorMsg = "Error inserting into the appliances table: " . mysqli_error($conn);
            error_log($appliancesInsertErrorMsg);
        }

        // Creating the insert statement for the CUST_APPLIANCES table
        $cust_appliancesInsert = "INSERT INTO CUST_APPLIANCES (customerID, applianceID)
        VALUES ($generatedCustomerID, $generatedApplianceID)";

        // Completes the CUST_APPLIANCES insert, if command fails writes the errors to the log
        if (!mysqli_query($conn, $cust_appliancesInsert)) {
            $cust_appliancesInsertErrorMsg = "Error inserting into the cust_appliances table: " . mysqli_error($conn);
            error_log($cust_appliancesInsertErrorMsg);
        }


        // Selects all technicianID values so that the program can randomly choose one
        $technicianQuery = "SELECT technicianID FROM TECHNICIANS";
        $technicianResult = mysqli_query($conn, $technicianQuery);

        // Creates an array of technicianIDs
        $technicianIDs = [];
        if ($technicianResult && mysqli_num_rows($technicianResult) > 0) {
            // Fetch all technician IDs into an array
            while ($row = mysqli_fetch_assoc($technicianResult)) {
                $technicianIDs[] = $row['technicianID'];
            }
        }
        
        // Generate a random technicianID based off of what exists in the array
        if (!empty($technicianIDs)) {
            $randomTechnicianID = $technicianIDs[array_rand($technicianIDs)];
        }

        // Creating the query to retrieve the technician's first name
        $technicianFirstNameQuery = "SELECT firstName FROM TECHNICIANS WHERE technicianID = '$randomTechnicianID'";
        // Running the query and storing the result as a mysqli object
        $technicianFirstNameResult = mysqli_query($conn, $technicianFirstNameQuery);
        
        // Retrieving the first name from the row
        if ($technicianFirstNameResult) {
            $firstNameRow = mysqli_fetch_assoc($technicianFirstNameResult);
            $technicianFirstName = $firstNameRow['firstName'];
        }
        else {
            $technicianFirstName = "Unknown";
        }

        // Doing the same for techncian's last name
        $technicianLastNameQuery = "SELECT lastName FROM TECHNICIANS WHERE technicianID = '$randomTechnicianID'";
        $technicianLastNameResult = mysqli_query($conn, $technicianLastNameQuery);
        if ($technicianFirstNameResult) {
            $lastNameRow = mysqli_fetch_assoc($technicianLastNameResult);
            $technicianLastName = $lastNameRow['lastName'];
        }
        else {
            $technicianLastName = "Unknown";
        }
        
        
        // Generates a random quote with dollars and cents.
        function generateRandomQuote ($min, $max) {
            $dollars = rand(100, 300);
            $cents = (rand(0, 100)/100);
            return $dollars + $cents;
        }

        // Generates a random quote for the appliance repair cost with the min and max specified at the top of the page.
        $randomQuote = generateRandomquote($min, $max);
    
        
        // Creating the insert statement for the APPOINTMENTS table
        $appointmentsInsert = "INSERT INTO APPOINTMENTS (applianceID, technicianID, customerID, appointmentDateTime, reason, quote)
        VALUES ('$generatedApplianceID', '$randomTechnicianID', '$generatedCustomerID', '$appointmentDateTime', '$reason', '$randomQuote')";
       
        // Completes the APPOINTMENTS insert, if the command fails writes the errors to the log
        if (!mysqli_query($conn, $appointmentsInsert)) {
            $appointmentsInsertErrorMsg = "Error inserting into the appointments table. " . mysqli_error($conn);
            error_log($appointmentsInsertErrorMsg);
        }

        // Closes the connection after all of the insert statements are completed.
        mysqli_close($conn);
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Appointment confirmed!</title>
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
                <h1>Your appointment has been confirmed!</h1>
        </div>
        <div class="appointmentConfirmation">
            <p><strong>Customer:</strong> <?php echo $firstName . " " . $lastName; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
            <p><strong>Appliance:</strong> <?php echo $appName; ?></p>
            <p><strong>Appliance Type:</strong> <?php echo $appType; ?></p>
            <p><strong>Technician:</strong> <?php echo $technicianFirstName . " " . $technicianLastName; ?></p>
            <p><strong>Date & Time:</strong> <?php echo $appointmentDateTime; ?></p>
            <p><strong>Reason:</strong> <?php echo $reason; ?></p>
            <p><strong>Quote:</strong> <?php echo '$' . $randomQuote; ?></p>
        </div>
    </body>
</html>
