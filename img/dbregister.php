<?php
// Connect to the database
$servername = "your_servername";
$username = "root";
$password = "";
$dbname = "aiphp";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the submitted data
$email = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phone = $_POST['phone'];
$salary = $_POST['salary'];
$gender = $_POST['gender'];
$dateOfBirth = $_POST['dateOfBirth'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Insert the data into the database
$sql = "INSERT INTO employee (email, firstName, lastName, phone, salary, gender, dateOfBirth, password, confirmPassword)
        VALUES ('$email', '$firstName', '$lastName', '$phone', '$salary', '$gender', '$dateOfBirth', '$password', '$confirmPassword')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>