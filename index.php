<?php
require "includes/header.php";

if($_GET['action'] == 'logout') {

    setcookie('role', $role['RoleID'], time() - 3600, "/");
    header('Location: ./index.php');
}
?>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/main.js"></script>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img class="img-fluid" src="./img/DS2017_TP09_mono.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="#">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ссылка</a>
                    </li>
                </ul>
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
                        </div>

                        <button style="color: #FFFACB; background-color: #196AA6" type="submit" class="btn btn-primary">Submit</button>
                        <a style="color: #FFFACB; background-color: #F79420" type="" class="btn btn close-popup">Close</a>
                    </form>
                    </div>
                </div>';
                    ?>
                <?php else: ?>
                <a href="?action=logout" class="btn btn-outline-success " type="submit" >EXIT</a>
                <?php endif; ?>
            </div>
            <?php
            if ($_COOKIE['role']== '7b7bc2512ee1fedcd76bdc68926d4f7b'):
                echo "admin";
                ?>
            <?php else: ?>
            <?php endif; ?>
        </div>
    </nav>
</header>
</body>
</html>

