<?php
require "includes/db_connection.php";

if($_GET['action'] == 'logout') {

    setcookie('role', $role['RoleID'], time() - 3600, "/");
    if(isset($_COOKIE['username'])){
        setcookie('username', $user['FirstName'], time() - 3600, "/");
        $last_session = mysqli_fetch_array(mysqli_query($db_connect,"SELECT * FROM `session` ORDER BY id DESC LIMIT 1"));
        $last_session_id = $last_session['id'];
        $logout_time = date('H:i:s');
        $last_login_time = $last_session['login_time'];
        $reason = NULL;
       $session_query = mysqli_query($db_connect, "UPDATE `session` SET logout_time = '$logout_time', on_system = TIMEDIFF('$logout_time', '$last_login_time'), reason = '$reason' WHERE id = '$last_session_id'");
    }
    header('Location: ./index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/tex-gyre-adventor" type="text/css"/>
    <link href="//db.onlinewebfonts.com/c/8050e6017c3b848b20a6324507cfba88?family=LTC+Twentieth+Century" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top ">

        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img class="img-fluid" src="./img/DS2017_TP09_mono.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <?php
                if ($_COOKIE['role']== '7b7bc2512ee1fedcd76bdc68926d4f7b'):
                    $office = mysqli_query($db_connect,"SELECT Title  FROM `offices`");
                    echo '<button class="btn btn-outline-success open-popup" type="submit" >Add user</button>
                <div class="popup-bg">
                    <div class="popup">
                    <form action="includes/add_user.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="Office" class="form-label">Office</label>
                            <select class="form-select" aria-label="Default select example" id="office" name="office" required>                         
                                                   
                              <option selected>Office name</option>';
                    while($row = mysqli_fetch_array($office)) {
                        echo '<option value="' . $row['Title'] . '">' . $row['Title'] . '</option>';
                    }
                    echo '
                        </select>
                        </div>
                        <div class="mb-3">
                            <label for="birthdate" class="form-label" >Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-check form-switch mb-3">
                          <input class="form-check-input" type="checkbox" id="role" name="role" required>
                          <label class="form-check-label" for="checkbox">Administrator</label>
                        </div>
                        <button style="color: #FFFACB; background-color: #196AA6" type="submit" class="btn btn-primary">Save</button>
                        <a style="color: #FFFACB; background-color: #F79420" type="" class="btn btn close-popup">Cancel</a>
                    </form>
                    </div>
                </div>                          ';
                    ?>
                <?php else: ?>
                <?php endif; ?>
                <?php
                if($_COOKIE['role']== ''):
                    echo '<button class="btn btn-outline-success open-popup" type="submit" >LOGIN</button>
                <div class="popup-bg">
                    <div class="popup">
                    <form action="includes/auth.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>';
                           if(isset($_COOKIE['wrong_password'])){
                               echo '<div> Wrong password</div>';
                               echo '<div id="countdown"></div>';
                           }
                        echo '<button style="color: #FFFACB; background-color: #196AA6" type="submit" class="btn btn-primary">Submit</button>
                        <a style="color: #FFFACB; background-color: #F79420" type="" class="btn btn close-popup">Close</a>
                    </form>
                    </div>
                </div>';
                    ?>
                <?php else: ?>
                    <a href="?action=logout" class="btn btn-outline-success " type="submit" >EXIT</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>