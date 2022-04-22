<?php
require "includes/header.php";

if (isset($_GET['switch'])) {
    $userid = $_GET['switch'];
    $userinfo = mysqli_fetch_array(mysqli_query($db_connect,"SELECT * FROM `userdata` WHERE ID = '$userid'"));
    if($userinfo['Active'] == 1){$change = mysqli_query($db_connect, "UPDATE `userdata` SET Active = '0' WHERE ID = '$userid'");}
    if($userinfo['Active'] == 0){$change = mysqli_query($db_connect, "UPDATE `userdata` SET Active = '1' WHERE ID = '$userid'");}
}
if (isset($_GET['change_role'])) {
    $userid = $_GET['change_role'];
    $userinfo = mysqli_fetch_array(mysqli_query($db_connect,"SELECT * FROM `userdata` WHERE ID = '$userid'"));
    if($userinfo['RoleID'] == 'Administrator'){$change = mysqli_query($db_connect, "UPDATE `userdata` SET RoleID = 'User' WHERE ID = '$userid'");}
    if($userinfo['RoleID'] == 'User'){$change = mysqli_query($db_connect, "UPDATE `userdata` SET RoleID = 'Administrator' WHERE ID = '$userid'");}
}
?>
<body class="">
    <main class="container">
        <?php
        if ($_COOKIE['role']== '7b7bc2512ee1fedcd76bdc68926d4f7b'):
            $users = mysqli_query($db_connect,"SELECT * FROM `userdata` ORDER BY `ID` ASC");
            echo '      
            <table class="table  table-sm ">
            <thead>
            <tr>
                <th>Name</th>
                <th>Last Name</th>
                <th>Birthdate</th>
                <th>User Role</th>
                <th>Email Address</th>
                <th>Email Office</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>';
            while ($row = mysqli_fetch_array($users)) {

                echo '<tr "';
                if($row['Active'] == 0){echo ' style="background-color: red"';}
                echo '>';
                    echo '<td>' . $row['FirstName'] . '</td>';
                    echo '<td>' . $row['LastName'] . '</td>';
                    echo '<td>' . $row['Birthdate'] . '</td>';
                    echo '<td>' . $row['RoleID'] . '</td>';
                    echo '<td>' . $row['Email'] . '</td>';
                    echo '<td>' . $row['OfficeID'] . '</td>';
                    echo '<td> <a href="?switch='. $row['ID'] .'">';
                    if($row['Active'] ==1){echo '<img src="img/switch-off.png"></a></td>';}else{echo '<img src="img/switch-on.png"></a></td>';}
                    echo '<td> <a href="?change_role='. $row['ID'] .'">'. '<img src="img/changes.png">'. '</a>';
                echo '<tr>';
            }
            echo '</tbody>
        </table>' ;?>
        <?php endif; ?>
        <?php
        if ($_COOKIE['role']== '8f9bfe9d1345237cb3b2b205864da075'):
            $username = $_COOKIE['username'];
            $userinfo = mysqli_fetch_assoc(mysqli_query($db_connect, "SELECT * FROM `userdata` WHERE `FirstName` = '$username'"));
            $user_id = $userinfo['ID'];
            $sessions1 = mysqli_query($db_connect,"SELECT * FROM `session` WHERE `user_id` = '$user_id' AND `id` not in (select max(id) from session) ORDER BY `id` ASC");
            $time = mysqli_fetch_assoc(mysqli_query($db_connect, "SELECT SEC_TO_TIME(SUM(on_system)) FROM session WHERE `user_id` = '$user_id'"));
            $crushes = 0;
            while ($rows = mysqli_fetch_array($sessions1)) {
                if($rows['reason'] != ''){$crushes += 1;}
            }
                echo '<h2 class="h3"> Hi '. ($_COOKIE['username']) . ', Welcome to AMONIC Airlines.' . '</h2>';
                echo '<h3 class="h5">Time spent on system: '. $time["SEC_TO_TIME(SUM(on_system))"] .'</h3>';
                echo '<h3 class="h5">Number of crashes: '. $crushes .'</h3>';

            echo '      
            
            <table class="table  table-sm ">
            <thead>
            <tr>
                <th>Date</th>
                <th>Login time</th>
                <th>Logout time</th>
                <th>Time spent on system</th>
                <th>Unsuccessful logout reason</th>

            </tr>
            </thead>
            <tbody>';
            $sessions = mysqli_query($db_connect,"SELECT * FROM `session` WHERE `user_id` = '$user_id' AND `id` not in (select max(id) from session) ORDER BY `id` ASC");
            while ($row = mysqli_fetch_array($sessions)) {
                echo '<tr "';
                if($row['reason'] != ''){echo ' style="background-color: red"';}
                echo '>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['login_time'] . '</td>';
                echo '<td>' . $row['logout_time'] . '</td>';
                echo '<td>' . $row['on_system'] . '</td>';
                echo '<td>' . $row['reason'] . '</td>';;
                echo '<tr>';
            }
            echo '</tbody>
        </table>' ;?>
        <?php endif; ?>
    </main>

</body>
</html>

