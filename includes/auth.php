<?php
require "db_connection.php";

$email = $_POST['email'];
$password = $_POST['password'];

$check_user = mysqli_query($db_connect, "SELECT * FROM `userdata` WHERE `Email` = '$email' AND `password` = '$password'");
$user = mysqli_fetch_assoc($check_user);
$id = $user['ID'];

if(mysqli_num_rows($check_user)>0 && !isset($_COOKIE['wrong_password']))
            if($user['Active']==0){
                header('HTTP/1.0 403 Forbidden');
            }else{
        $role = mysqli_fetch_assoc(mysqli_query($db_connect, "SELECT RoleID  FROM `userdata` WHERE Email = '$email'"));
        setcookie('role', md5($role['RoleID']), time() + 3600, "/");
        if ($role['RoleID'] == 'User') {
            setcookie('username', $user['FirstName'], time() + 3600, "/");
            $username = $_COOKIE['username'];
            $reason = 'System crash';
            $date = date('d/m/Y');
            $login_time = date('H:i:s');
            $session_query = "INSERT INTO `session` (user_id, date, login_time, reason)
                        VALUES ('$id', '$date', '$login_time', '$reason')";
            $result = mysqli_query($db_connect, $session_query) or die("Ошибка " . mysqli_error($db_connect));
    }
    sleep(2);
    header('Location: .././index.php');
}
else {
    setcookie('wrong_password', (1), time() + 30, "/");
    header('Location: .././index.php');
    header("Refresh:0");
}

