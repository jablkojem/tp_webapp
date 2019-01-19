<?php
/**
 * Created by PhpStorm.
 * User: Miro
 * Date: 11/23/2018
 * Time: 02:23
 */

include_once("config.php");

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
$patientId = $_POST['patiantId'];
$dId = $_POST['dId'];

$sql = "UPDATE users SET id_medics=$dId WHERE id=$patientId";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

//$myValues->id= $id;
/*
$myValues->firstname= $name;
$myValues->lastname= $surname;
//$myValues->email= $email;
//return json_decode(json_encode($myValues),true);
$jsonValues = json_encode($myValues);
echo $jsonValues;
*/
?>