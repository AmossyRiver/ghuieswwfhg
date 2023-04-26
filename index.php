<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="home.css">
<head>
    <script src="https://kit.fontawesome.com/758311ea8b.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Health Advice Group</title>
</head>
<body>
<nav class = "navigation-bar">
    <ul class="list-items">
        <span class="pointer"></span>
        <li class="item">
            <a itemid="home" class="link"  href="air.php">
                <i class="fa-solid fa-wind"></i>
            </a>
        </li>
        <li class="item ">
            <a class="link" href=weather.php>
                <i class="fa-solid fa-cloud"></i>
            </a>
        </li>
        <li class="item active">
            <a class="link" href="index.php">
                <i class="fa-solid fa-house"></i>
            </a>
        </li>
        <li class="item">
            <a class="link" href="fitness.php">
                <i class="fa-solid fa-heart-pulse"></i>
            </a>
        </li>
        <li class="item">
            <a class="link" href="archive.html">
                <i class="fa-solid fa-box-archive"></i>
            </a>
        </li>
    </ul>
</nav>
<script src="Navigation Bar.js"></script>
<script>
    var links = document.querySelectorAll('a');
    links.forEach(function(link) {
        link.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            if (href === "#") {
                e.preventDefault();
            }
            else {
                e.preventDefault();
                window.location.href = href;
            }
        });

    });
</script>
<img class="logo" src="logo.png" alt="logo" width="400" height="90">
<div class="topnav">

    <a href="account.php">
        <i class="fa-solid fa-user"></i>
    </a>
    <a href="settings.php">
        <i class="fa-solid fa-cog"></i>
    </a>
</div>
<div class="main">
    <?php
    session_start();
    error_reporting(0);
    $steps = $temp = $air = "";

    $temp = $_SESSION['temp'];
    $air = $_SESSION['air'];
    $steps = $_SESSION['steps'];

    $steps = "1000";
    $temp = "20";
    $air = "Good";

    ?>
    <div class="widget">
        <div class="widget-header">
            <h2 class="widget-title">Air Quality</h2>
        </div>
        <div class="widget-content">
            <div class="widget-content-text">
                <p>Current Air Quality</p>
                <p><?php echo $air ?></p>
            </div>
            <div class="widget-content-icon">
                <i class="fa-solid fa-smile-beam"></i>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-header">
            <h2 class="widget-title">Weather</h2>
        </div>
        <div class="widget-content">
            <div class="widget-content-text">
                <p>Current Weather</p>
                <p> <?php echo $temp ?></p>
            </div>
            <div class="widget-content-icon">
                <i class="fa-solid fa-cloud-sun"></i>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-header">
            <h2 class="widget-title">Fitness</h2>
        </div>
        <div class="widget-content">
            <div class="widget-content-text">
                <p>Steps Taken</p>
                <p><?php echo $steps ?></p>
            </div>
            <div class="widget-content-icon">
                <i class="fa-solid fa-shoe-prints"></i>
            </div>
        </div>
    </div>
</div>
</body>
</html>