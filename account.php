<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Health Advice Group/Account/sign in</title>
    <script src="https://kit.fontawesome.com/758311ea8b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="account-style.css">
</head>
<body style=" background-color: #ffffff">
<link rel="stylesheet" href="account-style.css">
<div class="back-button">
    <a href="index.php">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
</div>
<div class="main">
    <div class="login-container">
        <div class="bluebg">
            <div class="box signin active">
                <h2>Already Have an Account </h2>
                <button class="signinbtn">Sign In</button>
            </div>
            <div class="box signup ">
                <h2>Don't Have an Account </h2>
                <button class="signupbtn">Sign Up</button>
            </div>
        </div>
        <div class="formBx">
            <div class="form sign-inform">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <h3>Sign In</h3>
                    <label>
                        <input type="text" name="username" placeholder="Username" >
                <label>
                        <input type="password" name="password" placeholder="Password">
                    </label>
                    <input type="submit" class="btn" name="submit">

                    <a href="Forgotpassword.html" class = "forgot">Forgot Password?</a>
                </form>
            </div>
            <div class="form sign-upform">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <h3>Sign Up</h3>
                    <label>
                        <input type="text" name="new-username" placeholder="Username">
                    </label>
                    <label>
                        <input type="text" name="email" placeholder="Email Address">
                    </label>
                    <label>
                        <input type="password" name="new-password" placeholder="Password">
                    </label>
                    <label>
                        <input type="password" name="con-password" placeholder="Confirm Password">
                    </label>
                    <input type="submit" class="btn" name="submit" placeholder="Register">
                </form>
            </div>

        </div>
    </div>
    <?php
    $username = $password =$newpassword = $conpassword = $newusername = $email = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);
        $newusername = test_input($_POST["new-username"]);
        $email = test_input($_POST["email"]);
        $newpassword = test_input($_POST["new-password"]);
        $conpassword = test_input($_POST["con-password"]);


    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }


    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "healthadvicegroup";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header("location: profile.php");
        exit;
    }
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) ){
            header("Location: profile.php");
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
        }
        else{
            echo "Username or password is incorrect";
        }
    }
     if(isset($_POST['submit'])){
        if($newpassword==$conpassword) {
            if (isset($_POST['submit'])) {
                $newusername = $_POST['new-username'];
                $email = $_POST['email'];
                $newpassword = $_POST['new-password'];
                $conpassword = $_POST['con-password'];
                $query = "INSERT INTO users (username, email, password) VALUES ('$newusername', '$email', '$newpassword')";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $newusername;
                    header("Location: profile.php");
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Password does not match";

            }
        }
    }


    ?>

</div>



<script>
    let menutoggle = document.querySelector('.toggle');
    let navigation =document.querySelector('.navigation')
    menutoggle.onclick = function (){
        menutoggle.classList.toggle('active');
        navigation.classList.toggle('active');
    }
    let list = document.querySelectorAll('.list');
    for(let i=0;i<list.length; i++){
        list[i].onclick = function (){
            let j = 0;
            while(j<list.length){
                list[j++].className= 'list';
            }
            list[i].className = 'list active';
        }
    }
</script>
<script>
    const signinbtn = document.querySelector('.signinbtn')
    const signupbtn = document.querySelector('.signupbtn')
    const formBx = document.querySelector('.formBx')
    const main = document.querySelector('main')
    signupbtn.onclick = function(){
        formBx.classList.add('active')
        main.classList.add('active')
    }
    signinbtn.onclick = function(){
        formBx.classList.remove('active')
        main.classList.remove('active')
    }
</script>
</body>
</html>