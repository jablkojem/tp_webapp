<?php
/**
 * Created by PhpStorm.
 * User: Miro
 * Date: 11/20/2018
 * Time: 18:54
 */
session_start();
session_destroy();
header("location:index.php");