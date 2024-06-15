<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Navbar.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once $base_url . 'Assets/PHP/URL/Base URL.php';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Forgot Password.css">
</head>

<body>
<body>
    <div class="login-container">
        <div class="img">
            <img src="Assets/Product/Media/Images/Logo/Background.png">
        </div>
        <div class="login-content">
            <form>
                <img src="Assets/Product/Media/Images/Logo/Dream skin nepal.png">
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Enter you email</h5>
                        <input type="text" class="input email" id="forgot-pass">
                    </div>
                </div>
       
                <input type="submit" class="login-btn" value="Reset">
            </form>
        </div>
    </div>
</body>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Forgot Password.js"></script>

</html>