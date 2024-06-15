<?php
@session_name('AdminSession');
@session_name('LoginSession');
@session_start();
@session_start();
if(!isset($_SESSION['AdminLoggedIn'])){
    echo "<script>window.location='../Account/Authentication/Admin Login Interface.php'</script>";
}
include_once $base_url . 'Assets/PHP/Configuration/Common Function.php';
?>