<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0)
    ?>
<link rel="stylesheet" href="weather.css">
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
            <a class="link" href="air.php">
                <i class="fa-solid fa-wind"></i>
            </a>
        </li>
        <li class="item active">
            <a class="link" href="weather.php">
                <i class="fa-solid fa-cloud"></i>
            </a>
        </li>
        <li class="item">
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


    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label>
            <select name = "area">
                <option value="latitude=51.5074&longitude=0.1278">London</option>
                <option value="latitude=55.8642&longitude=4.2518">Glasgow</option>
                <option value="latitude=53.4808&longitude=-2.2426">Manchester</option>
                <option value="latitude=53.3498&longitude=-6.2603">Dublin</option>
                <option value="latitude=51.58&longitude=-0.47">Basildon</option>


            </select>

                <input type="submit">
        </label></form>

    <?php
    $location = $location2 = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $location = "https://api.open-meteo.com/v1/forecast?".$_POST["area"]."&hourly=relativehumidity_2m,precipitation_probability,windspeed_10m,winddirection_10m&daily=temperature_2m_max,temperature_2m_min&timezone=auto";
        $location2 = "https://air-quality-api.open-meteo.com/v1/air-quality?".$_POST["area"]."&hourly=alder_pollen,birch_pollen,grass_pollen,mugwort_pollen,olive_pollen,ragweed_pollen";

    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $location);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
    $temp = $data["hourly"]["temperature_2m"][0];
    session_start();
    $_SESSION["temp"] = $temp;
    ?>


    <div class = "boxes">
        <br>
        <div class = "temp-box">
          <i class="fas fa-temperature-high"></i>
            <h1>Temperature</h1>
            <h1><?php echo $data["daily"]["temperature_2m_max"][0]; ?>°C  /  <?php echo $data["daily"]["temperature_2m_min"][0]?>°C</h1>
        </div>
        <div class = "precipitation-box">
            <i class="fas fa-cloud-rain"></i>
            <h1>Precipitation</h1>
            <h1><?php echo $data["hourly"]["precipitation_probability"][0]; ?>%</h1>
        </div>
        <div class = "wind-box">
            <i class="fa-solid fa-water"></i>
            <h1>Wind</h1>
            <h1><?php echo $data["hourly"]["windspeed_10m"][0]; ?>m/s</h1>
        </div>
        <div class = "humidity-box">
            <i class="fas fa-tint"></i>
            <h1>Humidity</h1>
            <h1><?php echo $data["hourly"]["relativehumidity_2m"][0]; ?>%</h1>
        </div>
    </div>
    <div class="pollen">
        <?php
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $location2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        $pollen = $data["hourly"]["alder_pollen"][0] + $data["hourly"]["birch_pollen"][0] + $data["hourly"]["grass_pollen"][0] + $data["hourly"]["mugwort_pollen"][0] + $data["hourly"]["olive_pollen"][0] + $data["hourly"]["ragweed_pollen"][0];
        ?>
        <i class="fa-solid fa-tree"></i>
        <h1>PPM: <?php echo $pollen?></h1>

        <h2>Pollen Advice</h2>
        <?php
        if ($pollen < 96) {
            echo "<p> 
1.Keep track of pollen counts: Check the daily pollen count in your area, which can be found on various weather apps or websites. If the pollen count is high, try to limit your time outdoors.
2.Keep windows closed: Keep your windows and doors closed to prevent pollen from entering your home. If you need fresh air, use an air purifier or an air conditioner with a HEPA filter to trap pollen and other allergens.
3.Avoid outdoor activities during peak pollen hours: Pollen counts are usually highest in the early morning and late afternoon. Try to schedule your outdoor activities during midday when the pollen count is lower.
4.Wear a mask: If you need to be outside during peak pollen hours, wearing a mask can help reduce your exposure to pollen.
5.Practice good hygiene: After spending time outdoors, take a shower and change your clothes to remove any pollen that may have accumulated on your skin and clothes.
6.Consider allergy medication: If you are still experiencing allergy symptoms despite these measures, talk to your doctor about taking allergy medication. Antihistamines, decongestants, and nasal corticosteroids can help relieve symptoms such as sneezing, itching, and congestion.
    Remember, even during a low pollen season, there can still be some pollen in the air that can trigger allergies. By taking these steps, you can reduce your exposure to pollen and enjoy the season without the discomfort of allergy symptoms.
</p>";}
elseif ($pollen < 208) {
            echo "<p> 
Monitor pollen count: Keep an eye on the daily pollen count in your area, which can be found on various weather apps or websites. If the pollen count is moderate, take steps to limit your exposure.
Keep windows and doors closed: Keep your windows and doors closed to prevent pollen from entering your home. Use an air conditioner with a HEPA filter or an air purifier to filter out pollen and other allergens.
Limit outdoor activities: Try to limit your time outdoors during peak pollen hours, which are usually in the early morning and late afternoon. Consider rescheduling outdoor activities for a time when the pollen count is lower.
Wear protective clothing: If you must be outside during peak pollen hours, wear protective clothing such as a hat, sunglasses, and a mask to prevent pollen from getting into your eyes, nose, and mouth.
Practice good hygiene: After spending time outdoors, take a shower and change your clothes to remove any pollen that may have accumulated on your skin and clothes.
Consider allergy medication: If you are still experiencing allergy symptoms despite these measures, talk to your doctor about taking allergy medication. Antihistamines, decongestants, and nasal corticosteroids can help relieve symptoms such as sneezing, itching, and congestion.
Remember, even during a moderate pollen season, there can still be enough pollen in the air to trigger allergies. By taking these steps, you can reduce your exposure to pollen and enjoy the season without the discomfort of allergy symptoms.
</p>";}
elseif ($pollen < 704) {
            echo "<p>Stay indoors: Try to stay indoors as much as possible, especially during peak pollen hours. Keep windows and doors closed to prevent pollen from entering your home. If you need fresh air, use an air purifier or an air conditioner with a HEPA filter to trap pollen and other allergens.
Wear a mask: If you need to be outside, wear a mask to help reduce your exposure to pollen. Look for masks that are designed to filter out pollen and other allergens.
Change clothes: When you come inside, change your clothes and take a shower to remove any pollen that may have accumulated on your skin and clothes.
Avoid outdoor activities: Avoid outdoor activities such as gardening, mowing the lawn, or hiking during a high pollen season. If you must do these activities, wear a mask and take frequent breaks to go indoors and wash your hands and face.
Use allergy medication: If you are still experiencing allergy symptoms despite these measures, talk to your doctor about taking allergy medication. Antihistamines, decongestants, and nasal corticosteroids can help relieve symptoms such as sneezing, itching, and congestion.
Consider immunotherapy: If your allergies are severe and persistent, talk to your doctor about immunotherapy. This treatment involves getting regular injections of small amounts of the allergen to help your body build up a tolerance to it over time.
Remember, during a high pollen season, the pollen count can be very high and difficult to avoid entirely. By taking these steps, you can reduce your exposure to pollen and enjoy the season without the discomfort of allergy symptoms.</p>";}
elseif ($pollen > 704) {
            echo "<p></p>";}
        ?>

    </div>
</div>
</body>
</html>