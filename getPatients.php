<?php
include_once("config.php");

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
$dId = $_POST['Did'];
$index = 0;
$sql = "SELECT id,name,surname,email FROM users WHERE id_medics = $dId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='patients'><tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                           <th></th>
                        </tr>";
    while($row = $result->fetch_assoc()){
        $id[$index] = $row["id"];
        $name[$index] = $row["name"];
        $surname[$index] =  $row["surname"];
        $email[$index] =  $row["email"];
        echo"<tr>
             <td>$id[$index]</td>
             <td>$name[$index]</td>
             <td>$surname[$index]</td>
             <td>$email[$index]</td>
             <td onclick='removePatient($id[$index])' class='rmv'><a><i class=\"fa fa-fw fa-user-slash\"></i></a></td>
             </tr>";
        $index = $index +1;


    }
    echo "</table>";
}
echo "<select id='choosedPatient'>";
        $sql = "SELECT id,name,surname FROM users WHERE id_medics is NULL";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $pId = $row["id"];
                $pName = $row["name"];
                $pSurname = $row["surname"];
                echo "<option value='$pId'>$pName $pSurname</option>";
            }
        }
echo "</select>";

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