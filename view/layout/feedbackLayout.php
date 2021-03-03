<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--bootstrap 5.0-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" defer
            integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" defer
            integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG"
            crossorigin="anonymous"></script>
    <!--bootstrap-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
          rel="stylesheet">
    <scrip src="./js/app.js" defer></scrip>
    <script src="https://kit.fontawesome.com/7faccaee77.js" defer crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Sports club D R E A M</title>
</head>
<body>

<!--<div id="page-container">-->
<!--    <div id="content-wrap">-->
<header class="">
    <div class="headerImg">
        <nav class="navbar navbar-expand-sm navbar-dark bgDarkHeight sticky-top">
            <div class="container">
                <a class="navbar-brand" href="#">Sports club <strong>DREAM </strong><img
                            width="50px"
                            src="https://icons.iconarchive.com/icons/icons-land/metro-raster-sport/256/Soccer-Ball-icon.png"
                            alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup"
                        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between p-2" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a class="nav-link fontColorSize <?php echo (isset($currentPage) && $currentPage === 'Home') ? 'active' : ''; ?>"
                           href="/">Home</a>
                        <a class="nav-link fontColorSize <?php echo (isset($currentPage) && $currentPage === 'Feedback') ? 'active' : ''; ?>"
                           href="/feedback">Feedback</a>
                    </div>

                    <!--when not logged in-->
                    <?php if (!\app\core\Session::isUserLoggedIn()): ?>
                        <div class="navbar-nav ">
                            <a class="nav-link fontColorSize <?php echo isset($currentPage) && $currentPage === 'login' ? 'active' : ''; ?>"
                               href="/login">Login</a>
                            <a class="nav-link fontColorSize <?php echo isset($currentPage) && $currentPage === 'register' ? 'active' : ''; ?>"
                               href="/register">Register</a>
                        </div>
                    <?php else: ?>
                        <!--when looged in-->
                        <div class="navbar-nav float-end">
                            <a class="nav-link fontColorSize" disabled
                               href="#"><?php echo $_SESSION['userEmail']; ?></a>
                            <!--                           href="#">-->
                            <?php //echo "Welcome -  " . $_SESSION['userName'] . " :  " . $_SESSION['userEmail']; ?><!--</a>-->
                            <a class="nav-link fontColorSize" href="/logout">Logout</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <!--                <img src="/assets/football-19115_1920.jpg" class="img-fluid mx-auto d-block" alt="" align="bottom">-->
    </div>
</header>

<main>
    <!--        <div class="container">-->
    {{content}}
    <!--        </div>-->
    <!--    </div>-->
</main>
<footer class="footer mt-auto" id="footer">
    <div class="text-center footerBg text-light p-4"> @ 2021 Laura, all rights reserved</div>
</footer>
<!--</div>-->
</body>
</html>