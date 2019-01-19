<?php
// if user is not logged in
session_start();
if(isset($_SESSION['admin'])==null) {
    header("location:index.php");
}

include_once("config.php");

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Timák</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div id="logged-user"><a><i class="fas fa-fw fa-user-circle"></i><?php echo $_SESSION['admin'] ?></a></div>
        <div id="tittle"><a>Dexcom Web Application ∣ Admin Interface</a></div>
    </div>
    <div id="content-wrapper">
        <div id="left-panel">
            <div class="sidebar">
                <a href="admin.php"><i class="fa fa-fw fa-home"></i> Home</a>
                <a href="patientManager.php"><i class="fa fa-fw fa-envelope"></i> Manager</a>
                <a href="logout.php"><i class="fa fa-fw fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        <div id="contentAdmin">
                    <?php
                        $sql = "SELECT id,name,surname FROM medics";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                $pId = $row["id"];
                                $pName = $row["name"];
                                $pSurname = $row["surname"];
                               echo "<div onclick='showPatiants($pId)' class=\"w3-animate-zoom\" id=\"content-admin\">
                                 <div id=\"default-photoDoctor\"><img src=\"imgs/user4.png\" alt=\"user\"></div>
                                <div id=\"doctor-desc\"><a>Doctor:</a> <br>  <i class=\"fas fa-angle-double-right\"></i> $pName $pSurname </div>
                                </div>";
                            }
                        }

                        ?>




        </div>

    </div>

</div>

<!-- nnn
<div id="myDiv"><!-- Plotly chart will be drawn inside this DIV </div>
<script src="main.js"></script>
-->
<div class="" id="modal"></div>
<div class="" id="DoctorsPatients">

</div>
<div id="addPatient">
    <select>
        <?php
        $sql = "SELECT id,name,surname FROM users WHERE id_medics = 0 ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $pId = $row["id"];
                $pName = $row["name"];
                $pSurname = $row["surname"];
                echo "<option value='$pId'>$pName $pSurname</option>";
            }
        }

        ?>
    </select>


</div>
<script src="admin.js"></script>
</body>
</html>