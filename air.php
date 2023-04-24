<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0)
?>
<link rel="stylesheet" href="air.css">
<head>
    <script src="https://kit.fontawesome.com/758311ea8b.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Health Advice Group</title>
</head>
<body>
<nav class = "navigation-bar">
    <ul class="list-items">
        <li class="item active">
            <a class="link" href="air.php">
                <i class="fa-solid fa-wind"></i>
            </a>
        </li>
        <li class="item">
            <a class="link" href="weather.php">
                <i class="fa-solid fa-cloud"></i>
            </a>
        </li>
        <li class="item">
            <a class="link" href="home.php">
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
    let links = document.querySelectorAll('a');
    links.forEach(function(link) {
        link.addEventListener('click', function(e) {
            let href = this.getAttribute('href');
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
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <label>
        <select name = "area">
            <option value="latitude=51.5074&longitude=0.1278" name = "London">London</option>
            <option value="latitude=55.8642&longitude=4.2518" name ="Glasgow">Glasgow</option>
            <option value="latitude=53.4808&longitude=-2.2426" name="Manchester">Manchester</option>
            <option value="latitude=53.3498&longitude=-6.2603" name = "Dublin">Dublin</option>
            <option value="latitude=51.58&longitude=-0.47" name = "Basildon" >Basildon</option>
        </select>
            <input type="submit">
    </label></form>
<?php

$location =$place = " ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = "https://air-quality-api.open-meteo.com/v1/air-quality?".$_POST["area"]."&hourly=pm10,pm2_5,european_aqi";
    $place = $_POST["area"];
}

?>
<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $location);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$quality = json_decode($response, true);
?>
<div class = "aqi_box">
    <div class = "content">
        <?php
        if($quality["hourly"]["european_aqi"][0] < 20){
            $level = "Good";
            echo "<style>.aqi_box{background-color: #7be05f;}</style>";
            echo "<h1>AQI: ".($quality["hourly"]["european_aqi"][0])."</h1>";
            echo "<h2>Good</h2>";
            echo "<style>.aqi_box .content h2{color: #4da432;}</style>";
            $_SESSION["air"] = "Good";


        }
        elseif($quality["hourly"]["european_aqi"][0] < 40){
            $level = "Fair";
            echo "<style>.aqi_box{background-color: #5ff7e5;}</style>";
            echo "<h1>AQI: ".($quality["hourly"]["european_aqi"][0])."</h1>";
            echo "<h2>Fair</h2>";
            echo "<style>.aqi_box .content h2{color: #42a497;}</style>";
            $_SESSION["air"] = "Fair";
        }
        elseif($quality["hourly"]["european_aqi"][0] < 60){
            $level = "Moderate";
            echo "<style>.aqi_box{background-color: #f7cc5f;}</style>";
            echo "<h1>AQI: ".($quality["hourly"]["european_aqi"][0])."</h1>";
            echo "<h2>Moderate</h2>";
            echo "<style>.aqi_box .content h2{color: #a47f42;}</style>";
            $_SESSION["air"] = "Moderate";
        }
        elseif($quality["hourly"]["european_aqi"][0] < 80){
            $level = "Poor";
            echo "<style>.aqi_box{background-color: #f7765f;}</style>";
            echo "<h1>AQI: ".($quality["hourly"]["european_aqi"][0])."</h1>";
            echo "<h2>Poor</h2>";
            echo "<style>.aqi_box .content h2{color: #a44242;}</style>";
            $_SESSION["air"] = "Poor";
        }
        elseif($quality["hourly"]["european_aqi"][0] < 100){
            $level = "Very Poor";
            echo "<style>.aqi_box{background-color: #96001c;}</style>";
            echo "<h1>AQI: ".($quality["hourly"]["european_aqi"][0])."</h1>";
            echo "<h2>Very Poor</h2>";
            echo "<style>.aqi_box .content h2{color: #5e0a0a;}</style>";
            $_SESSION["air"] = "Very Poor";
        }
        else{
            $level = "Hazardous";
            echo "<style>.aqi_box{background-color: #5e35a5;}</style>";
            echo "<h1>AQI: ".($quality["hourly"]["european_aqi"][0])."</h1>";
            echo "<h2>Hazardous</h2>";
            echo "<style>.aqi_box .content h2{color: #3a1f5e;}</style>";
            $_SESSION["air"] = "Hazardous";
        }
        $london = "latitude=51.5074&longitude=0.1278";
        $london_name = "London";
        $glasgow = "latitude=55.8642&longitude=4.2518";
        $glasgow_name = "Glasgow";
        $manchester = "latitude=53.4808&longitude=-2.2426";
        $manchester_name = "Manchester";
        $dublin = "latitude=53.3498&longitude=-6.2603";
        $dublin_name = "Dublin";
        $basildon = "latitude=51.58&longitude=-0.47";
        $basildon_name = "Basildon";
        //echo date("Y/m/d");
       //echo "<h1>PM10: ".($quality["hourly"]["pm10"][0])."</h1>";
        //echo "<h1>PM2.5: ".($quality["hourly"]["pm2_5"][0])."</h1>";
        ?>
    </div>
</div>
<div class="overview">
     <h1>Overview</h1>
  <h2>What are the current Conditions near <?php if($place == $london){echo $london_name;}
      elseif ($place == $glasgow){echo $glasgow_name;}
      elseif ($place == $manchester){echo $manchester_name;}
      elseif ($place == $dublin){echo $dublin_name;}
      elseif ($place == $basildon){echo $basildon_name;}
      ?></h2>
    <div class="table">
        <table>
            <tr>
                <th>Air Pollution Level</th>
                <th>Air Quality Index</th>
                <th>Main Pollutant</th>
            </tr>
            <tr>
                <td><?php if($level == "Good"){echo "Good";}
                    elseif ($level == "Fair"){echo "Fair";}
                    elseif ($level == "Moderate"){echo "Moderate";}
                    elseif ($level == "Poor"){echo "Poor";}
                    elseif ($level == "Very Poor"){echo "Very Poor";}
                    elseif($level == "Hazardous") {echo "Hazardous";}
                    ?></td>
                <td><?php echo ($quality["hourly"]["european_aqi"][0]);?></td>
                <td><?php if(($quality["hourly"]["pm10"][0]) < ($quality["hourly"]["pm2_5"][0]) ){echo "PM 2.5";}
                    else{echo "PM 10";}
                    ?></td>
            </tr>
        </table>
    </div>
    <div class="bar-chart">
        <div class="bar">
            <div class="label">PM 2.5</div>
            <div class="bar-inner" style="width: <?php echo ($quality["hourly"]["pm2_5"][0])?>%;"></div>
            <div class="value"><?php echo ($quality["hourly"]["pm2_5"][0])?>%</div>
        </div>
        <div class="bar">
            <div class="label">PM 10</div>
            <div class="bar-inner" style="width: <?php echo ($quality["hourly"]["pm10"][0] )?>%;"></div>
            <div class="value"><?php echo ($quality["hourly"]["pm10"][0])?>%</div>
        </div>
    </div>
    <div class="advice">
        <h1>Health Recommendations</h1>
        <h2>How to protect from air pollution near <?php if($place == $london){echo $london_name;}
            elseif ($place == $glasgow){echo $glasgow_name;}
            elseif ($place == $manchester){echo $manchester_name;}
            elseif ($place == $dublin){echo $dublin_name;}
            elseif ($place == $basildon){echo $basildon_name;}
            ?></h2>
        <p>Stay indoors during times of high pollution: Check the Air Quality Index (AQI) in your area and try to stay inside during times when the levels are high.
            Use an air purifier: Purchase an air purifier for your home or office to help filter out pollutants from the air.
            Wear a mask: Consider wearing a mask when outdoors, especially if you are in a heavily polluted area or if you have respiratory issues.</p>


    </div>
</div>

    <div class="asthma">
        <p>5 top asthma tips for high pollution days<br>
            Stick to your preventer routine, so you can cope better with pollution, and your other triggers.<br>
            Carry your reliever inhaler with you to quickly deal with any symptoms.<br>
            Check the pollution forecast in your area with DEFRA's UK-wide forecasts, or on a weather app.<br>
            Avoid pollution hotspots like main roads, junctions, bus stations and car parks, and use quieter backstreets as much as possible. If you can, go out earlier before pollution levels have had a chance to build up.<br>
            See your GP if you’re getting symptoms three or more times a week whether it’s pollution or something else triggering them.</p>
    </div>


</body>
</html>