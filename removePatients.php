<?php
include_once("config.php");
// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
$patientId = $_POST['patientId'];
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

$sql = "UPDATE users SET id_medics=NULL WHERE id=$patientId";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error ;
}
$conn->query("SET FOREIGN_KEY_CHECKS = 1");
$conn->close();

