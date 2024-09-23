<?php
    @session_name('AdminSession');
    @session_name('URLSession');
    @session_start();
    @session_start();
if (isset($_POST['LoginAdmin'])) {
    $base_url = $_SESSION['URLSession']['Base Path'];
    include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Pass = mysqli_real_escape_string($conn, $_POST['Pass']);
    $AdminVerifyQuery="SELECT * FROM `admin` WHERE `Email`='$Email' && BINARY `Password`='$Pass'";
    $AdminVerifyRun=mysqli_query($conn,$AdminVerifyQuery);
    if($AdminVerifyRun->num_rows>0){
        $_SESSION['AdminLoggedIn'] = true;
        echo "Success";
    }else{
        echo "Fail";
    }
}
?>