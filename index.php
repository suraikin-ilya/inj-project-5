<?php
require "includes/header.php";


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
                    echo '<td> <input class="form-check-input" type="checkbox" value="'. $row['ID'] .'" id="changerole"></td>';
                echo '<tr>';
            }
            echo '</tbody>
        </table>' ;?>
        <?php endif; ?>
    </main>
</body>
</html>

