<?php
session_start();
include_once("config.php");

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
    if(isset($_POST['uLogin'])){
        $id = $_POST['uLogin'];
    }
    else{
        $login = $_SESSION['login'];
        $sql = "SELECT id FROM users WHERE login = '$login' ";
        $result = $conn->query($sql);
        $fetch = $result->fetch_row();

        if ($result->num_rows > 0) {
            $id = $fetch[0];
        }
    }




$index = 0;
$myValues = new \stdClass();
$sql = "SELECT * FROM dexc WHERE user_id = 36  ORDER BY datum ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $dat[$index] = $row["datum"];
        $gluk[$index] =  round(floatval($row["glukoza"])/18,2);
        $index = $index +1;
    }
}
$myValues->datum = $dat;
$myValues->glukoza = $gluk;
$jsonValues = json_encode($myValues);
echo $jsonValues;

?>