<?php
require "db_connection.php";

$email = $_POST['email'];
$password = $_POST['password'];

$check_user = mysqli_query($db_connect, "SELECT * FROM `userdata` WHERE `Email` = '$email' AND `password` = '$password'");
$user = mysqli_fetch_assoc($check_user);

if (mysqli_num_rows($check_user)>0){
    $role = mysqli_fetch_assoc(mysqli_query($db_connect,"SELECT RoleID  FROM `userdata` WHERE Email = '$email'"));
    setcookie('role', md5($role['RoleID']), time() + 3600, "/");
    header('Location: .././index.php');
}
else{
    header("HTTP/1.0 401 Not Found");
}

