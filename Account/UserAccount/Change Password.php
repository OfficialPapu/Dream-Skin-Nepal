<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
include_once $base_url . 'Assets/PHP/Account Configuration/Change Password Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Change Password.css">

</head>

<body>
    <?php
    ?>
    <div class="password-container-data">
        <div class="left-nav-bar hide-item-small-screen">
            <?php
            include_once $base_url . 'Assets/Components/Left Navbar.php';
            ?>
        </div>
        <div class="right-password-data">
            <div class="change-password-container ">
                <form action="#" method="POST">
                    <div class="change-password">
                        <div class="profile-change-password">
                            <div class="account-title">
                                Change Password
                            </div>
                            <div class="old-pass">
                                <p class="profile-title">Old Password</p>
                                <input type="password" required id="old_pass" autocomplete="off">
                            </div>
                            <div class="new-pass">
                                <p class="profile-title">New Password</p>
                                <input type="password" required id="first_new_pass" class="passwordbox" minlength="8" autocomplete="off">
                            </div>
                            <div class="new-pass">
                                <p class="profile-title">Confirm Password</p>
                                <input type="password" required id="last_new_pass" class="passwordbox" minlength="8" autocomplete="off">
                            </div>
                            <div class="sumit-box">
                                <input type="submit" value="Change" name='submitpasschange' id="submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Change Password.js"></script>
</html>