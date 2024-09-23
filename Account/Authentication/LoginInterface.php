<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Login Interface.css">
    <title>Login</title>
</head>

<body>
    <div class="login-container">
        <div class="img">
            <img src="Assets/Product/Media/Images/Logo/Background.png">
        </div>
        <div class="login-content">
            <form>
                <img src="Assets/Product/Media/Images/Logo/Dream skin nepal.png"><br>
                <p class="authentic-text-content">#<span class="pink-color">Genuinely</span><span class="blue-color bold-style-text">Authentic</span></p>
                <h2 class="title">Welcome</h2>
                <p class='slogan'>Journey to your <span class='pink-color'>Dream</span> <span class='blue-color'>Skin</span> starts here!</p>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="text" class="input email">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input password">
                        <div class="i" id="show-pass">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>
                <a href="Account/Authentication/Forgot Password.php" class="forgot-pass">Forgot Password?</a>
                <input type="submit" class="login-btn" value="Login">
                <p class="new-user">New to <span class='pink-color'>Dream</span> <span class='blue-color'>Skin</span>? <a href="Account/Authentication/RegisterInterface.php">Register</a></p>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Login Interface Codes.js"></script>

</html>