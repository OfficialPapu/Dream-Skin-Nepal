<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
include_once $base_url . 'Assets/PHP/Account Configuration/Change Number Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Number</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Change Number.css">

</head>

<body>
    <div class="number-container-data">
        <div class="left-nav-bar hide-item-small-screen">
            <?php
           include_once $base_url . 'Assets/Components/Left Navbar.php';
            ?>
        </div>
        <div class="right-number-data">
    <div class="change-number-container ">
        <form action="#" method="POST">
            <div class="change-number">
                <div class="profile-change-number">
                    <div class="account-title">
                        Change Number
                    </div>
                    <div class="old-num">
                        <p class="profile-title">Old Number</p>
                        <input type="text" value="<?php echo $OldNumber;?>" class="old-num" accept="none" readonly>
                    </div>
                    <div class="old-num">
                        <p class="profile-title">New Number</p>
                        <input type="text" value="+977-" maxlength="15" id="mobile-num" oninput="validateNumericInput(this)" name='NewMobileNum' required autocomplete="off">
                    </div>
                    <div class="sumit-box-num">
                        <input type="submit" value="Update" name='submitnumchange' id="submit"> 
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Change Number.js"></script>
</html>