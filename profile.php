<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
    <style src="profile.css"></style>
    <script src="https://kit.fontawesome.com/758311ea8b.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="back-button">
    <a href="home.php">
        <i class="fa-solid fa-arrow-left"></i>
    </a>

    <div class="main">


        <div class="card-container">
            <img class="round" src="pfp.jpg" alt="user" />
            <h3><?php
                session_start();
                $username = $_SESSION['username'];
                echo $username;
                ?></h3>
            <h6>Personal Info</h6>
            <p>Medical Info<br/> e.g Height and blood type </p>

            <div class="med">
                <h6>Medical Conditions</h6>
                <ul>
                    <li>Hayfever</li>
                    <li>Other Allergies  </li>
                    <li>Musculoskeletal disorders </li>
                    <li> Chronic Illness</li>
                    <li>Long Term Conditions</li>
                    <li>Diabetes</li>
                </ul>
            </div>
        </div>

        <div class="log-out">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="submit" name="logout" value="Logout">
            </form>
            <?php
            if(isset($_POST['logout'])){
                session_destroy();
                header("Location: account.php");
            }
            ?>
        </div>


</body>
</html>


