<?php
require "db_connection.php";
$email = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$office = $_POST['office'];
$birthdate = $_POST['birthdate'];
$password = $_POST['password'];
$role = $_POST['role'];
$active = 1;
$birthdate = str_replace("-", "/", $birthdate);
if($role == ''){
    $role = 'User';
}
else{
    $role = 'Administrator';
}

$user_query="INSERT INTO `userdata` (RoleID, Email, Password, FirstName, LastName, OfficeID, Birthdate, Active)
                        VALUES ('$role', '$email', '$password', '$firstname', '$lastname', '$office', '$birthdate', '$active')";
$result = mysqli_query($db_connect, $user_query) or die("Ошибка " . mysqli_error($db_connect));

header('Location: .././index.php');