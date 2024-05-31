<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the database
$servername = "your_servername";
$username = "root";
$password = "";
$dbname = "aiphp";

// Generate a random password
function generatePassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }

    return $password;
}

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " );
}

// Get the submitted data
$email = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phone = $_POST['phone'];
$salary = $_POST['salary'];
$gender = $_POST['gender'];
$dateOfBirth = $_POST['dateOfBirth'];
$password = generatePassword();

// Insert the data into the database
$sql = "INSERT INTO employee (email, firstName, lastName, phone, salary, gender, dateOfBirth, password)
        VALUES ('$email', '$firstName', '$lastName', '$phone', '$salary', '$gender', '$dateOfBirth', '$password')";
try {
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
} catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
        header('Location:register.php?error');
        exit();

    } else {
        echo "Error: " . $e->getMessage();
    }
}


// Close the database connection
$conn->close();

?>