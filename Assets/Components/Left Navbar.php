<?php
@session_name('LoginSession');
@session_name('URLSession');
@session_start();
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
?>
<?php
@session_name('LoginSession');
if (!isset($_SESSION['Logged In'])) {
    echo "<script>window.open('Account/Authentication/LoginInterface.php','_self');</script>";
}
if (isset($_SESSION['Logged In'])) {
$userID = $_SESSION['LoginSession']['user_id'];
$UserDataFeatch = "SELECT * FROM user_table WHERE ID='$userID'";
$RunQuery = mysqli_query($conn, $UserDataFeatch);
if ($RunQuery->num_rows > 0) {
    $row = $RunQuery->fetch_assoc();
    $UserPic = $row['User Picture'];
    $FirstName = $row['First Name'];
    $LastName = $row['Last Name'];
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Left Navbar.css">
</head>

<body>
    <?php
    if (isset($_SESSION['Logged In'])) {
    ?>
    <div class="account-container">

        <div class="account-side-bar">
            <div class="side-bar">

                <div class="my-account">
                    <div class="side-bar-account-title side-bar-title">
                        My Account
                    </div>
                    <div class="user-info-box hide-item-in-desktop">
                        <div class="user-info-img">
                            <?php
                            if ($UserPic == '') {
                                echo '<img src="Account/UserAccount/User Images/Default User.png" id="preview-img">';
                            } else {
                                echo "<img src='Account/UserAccount/User Images/$UserPic' id='preview-img'>";
                            }
                            ?>
                        </div>
                        <div class="user-info-name">
                            <?php echo $FirstName . "&nbsp;" . $LastName; ?>
                        </div>
                        <div class="hor-line"></div>
                    </div>
                    <div class="side-bar-account-section">
                        <ul>
                            <div class="side-bar-account-section side-bar-title hide-item-in-desktop ">Account</div>
                            <li><a href="Account/UserAccount/My Account.php" class="color-design-acc"><i class='bx bxs-user-circle'></i>My Account</a></li>
                            <li><a href="Account/UserAccount/Change Password.php" class="color-design-pass"><i class='bx bx-lock'></i>Change Password</a></li>
                            <li><a href="Account/UserAccount/Change Number.php" class="color-design-num"><i class='bx bx-phone'></i>Change Number</a></li>
                        </ul>
                    </div>
                </div>

                <div class="order">
                    <div class="side-bar-order-title side-bar-title">
                        Loyalty
                    </div>
                    <div class="side-bar-order-section">
                        <ul>
                            <li><a href="Account/UserAccount/DSN Point.php" class="color-design-num"><i class='bx bx-data'></i>DSN Point</a></li>
                        </ul>
                    </div>
                </div>
                <div class="order">
                    <div class="side-bar-order-title side-bar-title">
                        My Order
                    </div>
                    <div class="side-bar-order-section">
                        <ul>
                            <li><a href="Account/UserAccount/My Orders.php" class="color-design-order"><i class='bx bx-package'></i>My Orders</a></li>
                        </ul>
                    </div>
                </div>


                <div class="account-setting">
                    <div class="side-bar-account-setting-title side-bar-title">
                        Account Setting
                    </div>
                    <div class="side-bar-account-setting-section">
                        <ul>
                            <li><a href="Account/Authentication/Logout.php"><i class='bx bx-log-in-circle'></i>Logout</a></li>
                            <li><a href="#"><i class='bx bx-trash'></i>Delete Account</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php
}
?>
</body>
<script src="Assets/JS/Left Navbar.js"></script>

</html>