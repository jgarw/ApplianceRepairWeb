<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $firstName = $_GET['firstName'];
        $lastName = $_GET['lastName'];
        $date = $_GET['date'];

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

        $sql = "
        SELECT ... FROM CUSTOMERS c
        JOIN APPOINTMENTS a ON a.customerID = c.customerID
        JOIN TECHNICIANS t ON t.technicianID = a.technicianID
        JOIN CUSTOMER_APPLIANCES cap ON cap.customerID = a.customerID
        JOIN APPLIANCES ap ON ap.applianceID = cap.applianceID
        WHERE $enteredColumns = $enteredValues;
        "
            
        }
        // The select statement is not conditional: It will always return the whole appointment. The WHERE statement
    }
?>