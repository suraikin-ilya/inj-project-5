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
    <main class="ml-sm-auto ">
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
                if($row['Active'] == 1){echo ' style="background-color: green"';} else echo ' style="background-color: red"';
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
    </main>
</body>
</html>

