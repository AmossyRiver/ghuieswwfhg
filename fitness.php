<!DOCTYPE html>
<html lang="en">
<?php error_reporting(0) ?>
<link rel="stylesheet" href="fitness.css">
<head>
    <script src="https://kit.fontawesome.com/758311ea8b.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Health Advice Group</title>
</head>
<body>
<script>document.getElementById('btn').style.left = '0%';</script>
<nav class = "navigation-bar">
    <ul class="list-items">
        <li class="item">
            <a class="link" href="air.php">
                <i class="fa-solid fa-wind"></i>
            </a>
        </li>
        <li class="item">
            <a class="link" href="home.php">
                <i class="fa-solid fa-cloud"></i>
            </a>
        </li>
        <li class="item">
            <a class="link" href="home.php">
                <i class="fa-solid fa-house"></i>
            </a>
        </li>
        <li class="item active">
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
<img class="logo" src="logo.png" alt="logo" width="890" height="50">
<div class="topnav">

    <a href="account.php">
        <i class="fa-solid fa-user"></i>
    </a>
    <a href="settings.php">
        <i class="fa-solid fa-cog"></i>
    </a>

</div>
<div class="main">
 <div class="steps">
        <div class="btn" id="btn">
        <button class="add"  onclick="addSteps()">Add Steps</button>
          <div id="addSteps" style="display: none;" >
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type="number" name="steps" placeholder="Steps">
                <input type="submit" name="submit" value="Submit">
            </form>
         </div>
        <script>
            function addSteps() {
                let addSteps = document.getElementById("addSteps");
                if (addSteps.style.display === "none") {
                    addSteps.style.display = "block"

                } else {
                    addSteps.style.display = "none";
                }
            }
        </script>
        </div>

            <?php
            session_start();
            $steps = "";
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "steps";


            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            

            $query = "SELECT SUM(steps) FROM steps";
            $result = mysqli_query($conn, $query);
            $result = mysqli_fetch_assoc($result);
            $result = $result['SUM(steps)'];
            if (isset($_POST['submit'])) {
                $steps = ($_POST['steps']);
                $sql = "INSERT INTO steps (steps) VALUES ('$steps')";
                $conn->query($sql);
                echo "<script>document.getElementById('btn').style.left = '50%';</script>";
            }

            $steps = $result + $steps;
            $per = $steps / 100;
           $cal = $steps * 0.04;
           $km = $steps / 1400;
           $km = number_format($km, 2);
           $cal = number_format($cal, 2);
            $_SESSION["steps"] = $steps;




            ?>
            <div class="circle-goal">
                <div class="chart" id="graph" data-percent="<?php echo $per ?>"></div>
                <script src="Chart.js"></script>
            </div>

     <div class = "boxes">
         <br>
         <div class = "steps-box">
             <i class="fa-solid fa-shoe-prints"></i>
             <h1>Steps</h1>
             <h1><?php echo $steps?></h1>
         </div>
         <div class = "calories-box">
             <i class="fas fa-cloud-rain"></i>
             <h1>Calories Burned</h1>
             <h1><?php echo $cal; ?></h1>
         </div>
         <div class = "km-box">
             <i class="fa-solid fa-water"></i>
             <h1>km</h1>
             <h1><?php echo $km ?></h1>
         </div>

     </div>



 </div>

</div>
</body>
</html>