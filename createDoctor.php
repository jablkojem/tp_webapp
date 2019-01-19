<?php

include_once("config.php");
// Create connection
// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$lastname = $_POST['lastname'];
$password = $_POST['password'];
$password = base64_encode($password);
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$conn->query("SET FOREIGN_KEY_CHECKS = 0");
$sql = "INSERT INTO medics (login,password,name,surname, email)
VALUES ('$username', '$password','$fullname','$lastname','$email')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header("location:admin.php");
$conn->query("SET FOREIGN_KEY_CHECKS = 1");
$conn->close();
?>