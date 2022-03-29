<?php
require "includes/header.php"
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
                <button class="btn btn-outline-success open-popup" type="submit" >LOGIN</button>
                <div class="popup-bg">
                    <div class="popup">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>

                        <button style="color: #FFFACB; background-color: #196AA6" type="submit" class="btn btn-primary">Submit</button>
                        <button style="color: #FFFACB; background-color: #F79420" type="submit" class="btn btn close-popup">Close</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
</body>
</html>