<?php
$db_connect = mysqli_connect("localhost", "root", "", "session1_xx")
or die("Ошибка " . mysqli_error($db_connect));
mysqli_set_charset($db_connect, "utf8");

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$db_connect2 = mysqli_connect("localhost", "root", "", "session2_xx")
or die("Ошибка " . mysqli_error($db_connect));
mysqli_set_charset($db_connect, "utf8");