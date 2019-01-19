<?php
// if user is not logged in
session_start();
if(isset($_SESSION['doctor'])==null) {
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
        <div id="logged-user"><a><i class="fas fa-fw fa-user-circle"></i><?php echo $_SESSION['doctor'] ?></a></div>
    <div id="tittle"><a>Dexcom Web Application ∣ Doctor Interface</a></div>
    </div>
    <div id="content-wrapper">
        <div id="left-panel">
            <div class="sidebar">
                <a href="Dinterface.php"><i class="fa fa-fw fa-home"></i> Home</a>
                <a href="#contact"><i class="fa fa-fw fa-envelope"></i> Contact</a>
                <a href="logout.php"><i class="fa fa-fw fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        <div id="content">

            <div class="w3-animate-zoom" id="content-one">
                <div id="default-photo"><img src="imgs/user4.png" alt="user"></div>
                <div id="user-desc">
                    <div><h3><a><i class="fas fa-fw fa-user-md"></i>Doctor's informations:</a><h3><hr></div>
                    <table>
                        <?php
                        $login = $_SESSION['doctor'];
                        $sql = "SELECT id,name,surname,email FROM medics WHERE login = '$login' ";
                        $result = $conn->query($sql);
                        $fetch = $result->fetch_row();

                        if ($result->num_rows > 0) {
                            $id = $fetch[0];
                            $name = $fetch[1];
                            $surname =  $fetch[2];
                            $email = $fetch[3];

                        }

                        ?>


                        <tr>
                            <td><a>Login:</a></td>
                            <td><a><?php echo $login;?></a></td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td><?php echo $name;?></td>
                        </tr>
                        <tr>
                            <td>Surname:</td>
                            <td><?php echo $surname;?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $email;?></td>
                        </tr>
                    </table>


                </div>
            </div>

            <div class="w3-animate-zoom" id="content-one">
                <div id="patient-desc">
                    <div><h3><a><i class="fas fa-user-injured"></i> My Patients:</a><h3><hr></div>
                    <div style="overflow-y:auto;height: 250px;margin-top: 10px">
                    <table id="patients">
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        <?php
                            $sql = "SELECT users.id,users.login,users.name,users.surname,users.email
                                    FROM users
                                    INNER JOIN medics ON medics.id = users.id_medics
                                    WHERE users.id_medics = $id";
                            $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()){
                                        $pId = $row["id"];
                                        $pLogin = $row["login"];
                                        $pName = $row["name"];
                                        $pSurname = $row["surname"];
                                        $pEmail = $row["email"];
                                        echo "<tr onclick='showChart($pId)'>
                                               <td>$pName</td>
                                               <td>$pSurname</td>
                                               <td>$pEmail</td>
                                               <td class='rmv'><i class=\"fas fa-chart-line\"></i></td>
                                               </tr>";
                                                                        }
                                 }
                        ?>
                    </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<div class="chart2" id="chart2">
    <span onclick="closeChart()" style="float: right;font-size: 20px;cursor: pointer">&#10006</span>
    <div class="chart w3-animate-zoom" id="myDiv"></div>

</div>
<div class="" id="chartShow"></div>
<script src="chartShowing.js"></script>

<!-- nnn
<div id="myDiv"><!-- Plotly chart will be drawn inside this DIV </div>
<script src="main.js"></script>
-->
</body>
</html>