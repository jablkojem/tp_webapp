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


// call the register() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
    login($conn);
}

function login($conn){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $tables = array("admins", "users");


    $sql = "SELECT login,password FROM admins WHERE login = '$login' ";
    $result = $conn->query($sql);
    $fetch = $result->fetch_row();

    if($result->num_rows > 0) // IF ADMIN
    {
        if($login == $fetch[0] && $password == $fetch[1]  )
        {
            $_SESSION['admin'] = $login;
            header("location:admin.php");
        }
        else  {
            echo '<div class="position">Nesprávne heslo.</div>';
        }
    }
    else {

        $sql = "SELECT login,password FROM medics WHERE login = '$login' ";
        $result = $conn->query($sql);
        $fetch = $result->fetch_row();

        if ($result->num_rows > 0) {   // IF DOCTOR
            if ($login == $fetch[0] && $password === base64_decode($fetch[1])) {
                $_SESSION['doctor'] = $login;
                header("location:Dinterface.php");
            } else {
                echo '<div class="position">Nesprávne heslo.</div>';
            }
        } else {


            $sql = "SELECT login,password FROM users WHERE login = '$login' ";
            $result = $conn->query($sql);
            $fetch = $result->fetch_row();

            if ($result->num_rows > 0) {  // IF PATIENT
                if ($login == $fetch[0] && $password === base64_decode($fetch[1])) {
                    $_SESSION['login'] = $login;
                    header("location:interface.php");
                } else {
                    echo '<div class="position">Nesprávne heslo.</div>';
                }
            } else {
                echo '<div class="position">Tento uživateľ neexistuje.</div>';
            }
            $conn->close();

        }
    }


}