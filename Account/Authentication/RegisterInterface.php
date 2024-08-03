<?php
@session_name('registerSession');
@session_name('URLSession');
@session_start();
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Register Interface.css">
</head>

<body>
<div class="register-container">
        <div class="img">
            <img src="Assets/Product/Media/Images/Logo/Background.png">
        </div>
        <div class="register-content">
            <form>
                <img src="Assets/Product/Media/Images/Logo/Dream skin nepal.png">
                <p class="authentic-text-content">#<span class="pink-color">Genuinely</span><span class="blue-color bold-style-text">Authentic</span></p>
                <h2 class="title">Welcome</h2>
                <p class='slogan'>Journey to your <span class='pink-color'>Dream</span> <span class='blue-color'>Skin</span> starts here!</p>
                <div class="general-info-box">                
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Full Name</h5>
                        <input type="text" class="input fullname">
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                    <i class="fa fa-phone"></i>
                    </div>
                    <div class="div">
                        <h5>Mobile</h5>
                        <input type="text" class="input mobile">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="email" class="input email">
                    </div>
                </div>
                </div>
                <div class="password-box">
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input password NewPass" autocomplete="off">
                        <div class="i show-pass">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Confirm Password</h5>
                        <input type="password" class="input password ConfirmPass" autocomplete="off">
                        <div class="i show-pass">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>
                </div>
                <input type="submit" class="register-btn" value="Register">
                <p class="new-user">Already registered? <a href="Account/Authentication/LoginInterface.php">Login</a></p>
            </form>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Register Interface.js"></script>
</html>