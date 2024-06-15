<?php
@session_name('LoginSession');
@session_start();
$user_id = $_SESSION['LoginSession']['user_id'];
include_once $base_url . 'Assets/Components/Navbar.php';
include_once $base_url . 'Assets/PHP/Configuration/User IP.php';
include $base_url . 'Assets/PHP/Email Management/Orders Email/Admin Notify Email.php';
include $base_url . 'Assets/PHP/Email Management/Orders Email/User Notify Email.php';
?>