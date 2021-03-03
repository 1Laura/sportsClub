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
    <scrip src="./js/app.js" defer></scrip>
    <link rel="stylesheet" href="./css/style.css">
    <title>Sports club D R E A M</title>
</head>
<body>

<!--<div id="page-container">-->
<!--    <div id="content-wrap">-->
<header class="">
    <nav class="navbar navbar-expand-sm navbar-dark bgDarkHeight sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Sports club <strong>DREAM</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between p-2" id="navbarNavAltMarkup">
                <div class="navbar-nav ">
                    <a class="nav-link <?php echo (isset($currentPage) && $currentPage === 'home') ? 'active' : ''; ?>"
                       href="/">Home</a>
                    <a class="nav-link <?php echo (isset($currentPage) && $currentPage === 'feedback') ? 'active' : ''; ?>"
                       href="/feedback">Feedback</a>
                </div>

                <!--when not logged in-->
                <?php if (!\app\core\Session::isUserLoggedIn()): ?>
                    <div class="navbar-nav ">
                        <a class="nav-link <?php echo isset($currentPage) && $currentPage === 'login' ? 'active' : ''; ?>"
                           href="/login">Login</a>
                        <a class="nav-link <?php echo isset($currentPage) && $currentPage === 'register' ? 'active' : ''; ?>"
                           href="/register">Register</a>
                    </div>
                <?php else: ?>
                    <!--when looged in-->
                    <div class="navbar-nav float-end">
                        <a class="nav-link" disabled
                           href="#"><?php echo $_SESSION['userEmail']; ?></a>
                        <!--                           href="#">-->
                        <?php //echo "Welcome -  " . $_SESSION['userName'] . " :  " . $_SESSION['userEmail']; ?><!--</a>-->
                        <a class="nav-link" href="/logout">Logout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="headerImg">
        <!--                <img src="/assets/football-19115_1920.jpg" class="img-fluid mx-auto d-block" alt="" align="bottom">-->
    </div>
</header>


<!--        <div class="container">-->
{{content}}
<!--        </div>-->
<!--    </div>-->
<footer class="footer mt-auto" id="footer">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2304.219602283874!2d25.335691251882515!3d54.72335198019398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd96e7d814e149%3A0xdd7887e198efd4c7!2sSaul%C4%97tekio%20al.%2015%2C%20Vilnius%2010224!5e0!3m2!1slt!2slt!4v1614700121497!5m2!1slt!2slt"
            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    <div class="text-center bg-dark text-light p-4"> @ 2021 Laura, all rights reserved</div>
</footer>
<!--</div>-->
</body>
</html>