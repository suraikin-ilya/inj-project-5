<?php
$db_connect = mysqli_connect("localhost", "root", "", "session1_xx")
or die("Ошибка " . mysqli_error($db_connect));
mysqli_set_charset($db_connect, "utf8");