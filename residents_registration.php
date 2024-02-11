<?php
// Check if form data exists
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Display the form data for debugging
    echo "Form Data:";
    var_dump($_GET);

    // Retrieve form data
    $fullName = $_GET['fullName'];
    $address = $_GET['address'];
    $phoneNumber = $_GET['phoneNumber'];
    $emailAddress = $_GET['emailAddress'];
    $numberOfMembers = $_GET['numberOfMembers'];
    $emergencyContactName = $_GET['emergencyContactName'];
    $occupation = $_GET['occupation'];
    $communication = $_GET['communication'];
    $acknowledgeCheckbox = isset($_GET['acknowledgeCheckbox']) ? $_GET['acknowledgeCheckbox'] : '';

    // Escape form data
    $fullName = htmlspecialchars($fullName);
    $address = htmlspecialchars($address);
    // Escape other form fields similarly

    // Insert data into MySQL database
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = " "; // Replace with your MySQL password
    $dbname = "residents_registration"; // Replace with your database name

    // Create connection
    $conn = new mysqli("localhost", "root"," ", "residents_registration");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement with parameters
    $sql = "INSERT INTO form_submissions (full_name, address, phone_number, email_address, number_of_members, emergency_contact_name, occupation, communication, acknowledged) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssissss", $fullName, $address, $phoneNumber, $emailAddress, $numberOfMembers, $emergencyContactName, $occupation, $communication, $acknowledgeCheckbox);

    // Execute the statement
    if ($stmt->execute()) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No data received from the form.";
}
?>