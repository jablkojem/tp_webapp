<?php
// if user is not logged in
session_start();
if(isset($_SESSION['login'])==null) {
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
        <div id="logged-user"><a><i class="fas fa-fw fa-user-circle"></i><?php echo $_SESSION['login'] ?></a></div>
        <div id="tittle"><a>Dexcom Web Application ∣ Patient Interface</a></div>
    </div>
    <div id="content-wrapper">
        <div id="left-panel">
            <div class="sidebar">
                <a href="interface.php"><i class="fa fa-fw fa-home"></i> Home</a>
                <a href="chart.php"><i class="fa fa-fw  fa-chart-line"></i> Chart</a>
                <a href="#contact"><i class="fa fa-fw fa-envelope"></i> Contact</a>
                <a href="logout.php"><i class="fa fa-fw fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        <div id="content">

            <div class="w3-animate-zoom" id="content-one">
                <div id="default-photo"><img src="imgs/user4.png" alt="user"></div>
                <div id="user-desc">
                    <div><h3><a><i class="far fa-fw fa-address-card"></i> User's informations:</a><h3></div>
                    <table>
                    <?php
                    $login = $_SESSION['login'];
                    $sql = "SELECT id,id_medics,name,surname,email FROM users WHERE login = '$login' ";
                    $result = $conn->query($sql);
                    $fetch = $result->fetch_row();

                    if ($result->num_rows > 0) {
                            $id = $fetch[0];
                            $id_medics = $fetch[1];
                            $name = $fetch[2];
                            $surname =  $fetch[3];
                            $email = $fetch[4];

                    }

                    ?>


                        <tr>
                            <td><a>Login:</a></td>
                            <td><a><?php echo $login;?></a></td>
                        </tr>
                        <tr>
                            <td>Firstname:</td>
                            <td><?php echo $name;?></td>
                        </tr>
                        <tr>
                            <td>Lastname:</td>
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
                <div id="default-photo"><img src="imgs/user4.png" alt="user"></div>
                <div id="user-desc2">
                    <div><h3><a><i class="fas fa-fw fa-user-md"></i> Doctor's informations:</a><h3></div>
                    <table>
                        <?php
                        $id_medic = $id_medics;
                        $sql = "SELECT name,surname,email FROM medics WHERE id = '$id_medic'";
                        $result = $conn->query($sql);
                        $fetch = $result->fetch_row();

                        if ($result->num_rows > 0) {
                            $name = $fetch[0];
                            $surname =  $fetch[1];
                            $email =  $fetch[2];

                        }
                        $conn->close();
                        ?>
                        <tr>
                            <td>Firstname:</td>
                            <td><?php echo $name;?></td>
                        </tr>
                        <tr>
                            <td>Lastname:</td>
                            <td><?php echo $surname;?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $email;?></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- nnn
<div id="myDiv"><!-- Plotly chart will be drawn inside this DIV </div>
<script src="main.js"></script>
-->
</body>
</html>