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

    // Insert into the CUSTOMERS table
    $customersInsert = "INSERT INTO CUSTOMER (firstName, lastName, email, phone)
    VALUES ($firstName, $lastName, $email, $phone)";

    if (mysqli_query($conn, $customersInsert)) {
        echo "New customers record created successfully";
    } 
    else {
        echo "Error: " . $customersInsert . "<br>" . mysqli_error($conn);
    }
    // Retrieves the generated customerID from the last query
    $generatedCustomerID = mysqli_insert_id($conn);


    // Insert into the APPLIANCES table
    $appliancesInsert = "INSERT INTO APPLIANCES (applianceName, applianceType)
    VALUES ($appName, $appType)";

    if (mysqli_query($conn, $appliancesInsert)) {
        echo "New customers record created successfully";
    } 
    else {
        echo "Error: " . $appliancesInsert . "<br>" . mysqli_error($conn);
    }
    // Retrieves the generated applianceID from the last query
    $generatedApplianceID = mysqli_insert_id($conn);

    
    // Insert into the APPOINTMENTS table
    // How do we retrieve technicianID and quote?
    $appointmentsInsert = "INSERT INTO APPOINTMENTS (applianceID, technicianID, customerID, appointmentDateTime, reason, quote)
    VALUES ($generatedApplianceID, /*???*/, $generatedCustomerID, $appointmentDateTime, $reason, /*???*/)";

    if (mysqli_query($conn, $appointmentsInsert)) {
        echo "New appointments record created successfully";
    } 
    else {
        echo "Error: " . $appointmentsInsert . "<br>" . mysqli_error($conn);
    }

    // Closes the connection after the insert statements are completed.
    mysqli_close($conn);
}
?>