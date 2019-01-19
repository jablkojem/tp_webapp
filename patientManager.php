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
    <style>
        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=password], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }


        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

    </style>
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
        <div class="w3-animate-zoom" id="contentAdmin2">
            <h3>Create Patient</h3>
            <form method="post" action="createPatient.php">
                First name: <input type="text" name="fullname"><br>
                Last name: <input type="text" name="lastname"><br>
                Email: <input type="text" name="email"><br>
                Login: <input type="text" name="username"><br>
                Password: <input type="password" name="password"><br>
                Repeat-password: <input type="password" name=""><br>
                <input type="submit" value="Create patient">
            </form>

        </div>

        <div class="w3-animate-zoom" id="contentAdmin2">
            <h3>Create Doctor</h3>
            <form method="post" action="createDoctor.php">
                First name: <input type="text" name="fullname"><br>
                Last name: <input type="text" name="lastname"><br>
                Email: <input type="text" name="email"><br>
                Login: <input type="text" name="username"><br>
                Password: <input type="password" name="password"><br>
                Repeat-password: <input type="password" name=""><br>
                <input type="submit" value="Create doctor">
            </form>

        </div>

    </div>

</div>
<script src="admin.js"></script>
</body>
</html>