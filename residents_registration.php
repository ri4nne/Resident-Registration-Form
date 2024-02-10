<?php
// Check if form data exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST['fullName'];
    // Retrieve other form fields similarly

    // Validate the data (e.g., check for empty fields, format validation)

    // Escape form data
    $fullName = htmlspecialchars($fullName);
    // Escape other form fields similarly

    // Output form data for debugging using var_dump()
    echo "Form Data:";
    var_dump($_POST);

    // Insert data into MySQL database
    $servername = "localhost";
    $username = "username"; // Replace with your MySQL username
    $password = "password"; // Replace with your MySQL password
    $dbname = "residents_registration"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to insert data into the database
    $sql = "INSERT INTO form_submissions (id, full_name, address, phone_number, email_address, number_of_members, emergency_contact_name, occupation, communication, acknowledged) VALUES (null, '$fullName', '$address', '$phoneNumber', '$emailAddress', '$numberOfMembers', '$emergencyContactName', '$occupation', '$communication', '$acknowledgeCheckbox')";

    // Output SQL query for debugging
    echo "SQL Query:";
    var_dump($sql);

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "No data received from the form.";
}

