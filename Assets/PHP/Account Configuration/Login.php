<?php
@session_name('Cart');
@session_name('LoginSession');
@session_name('URLSession');
@session_start();
@session_start();
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
require_once $base_url . 'Assets/PHP/Database/Database Connection.php';
if (isset($_POST['DataSend'])) {
    $login_email = $_POST['Email'];
    $login_pass = $_POST['Password'];
    $check_user = "SELECT * FROM user_table WHERE BINARY Password='$login_pass' AND Email='$login_email'";
    $execute_login = mysqli_query($conn, $check_user);
    if ($execute_login->num_rows > 0) {
        @session_start();
        $row = $execute_login->fetch_assoc();
        $_SESSION['Logged In'] = true;
        $_SESSION['user_first_name'] = $row['First Name'];
        $_SESSION['user_last_name'] = $row['Last Name'];
        $_SESSION['user_email'] = $row['Email'];
        $_SESSION['LoginSession']['user_id'] = $row['ID'];
        if (isset($_SESSION['Cart']['user_id'])) {
            $GuestID = $_SESSION['Cart']['user_id'];
            $user_id = $_SESSION['LoginSession']['user_id'];
            $UpdateCartID = "UPDATE `product_cart` SET `User ID`='$user_id' WHERE `User ID`='$GuestID'";
            $SQL = mysqli_query($conn, $UpdateCartID);
            $UpdateWishlistID = "UPDATE `product_wishlist` SET `User ID`='$user_id' WHERE `User ID`='$GuestID'";
            $SQL = mysqli_query($conn, $UpdateWishlistID);
        }
        echo "Sucess";
    } else {
        echo "Fail";
    }
}
