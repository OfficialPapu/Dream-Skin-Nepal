<?php
@session_name('LoginSession');
@session_name('URLSession');
@session_start();
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/PHP/Database/Database Connection.php';
include $base_url . 'Assets/PHP/Email Management/PHPMailer/Exception.php';
include $base_url . 'Assets/PHP/Email Management/PHPMailer/PHPMailer.php';
include $base_url . 'Assets/PHP/Email Management/PHPMailer/SMTP.php';
if(isset($_POST['SendEmail'])){
    $Email=$_POST['Email'];
    $FindEmail="SELECT * FROM user_table WHERE Email='$Email'";
    $Query=mysqli_query($conn,$FindEmail);
    if($Query->num_rows>0){
        $Row=$Query->fetch_assoc();
        $password=$Row['Password'];
        include $base_url . 'Assets/PHP/Email Management/Forgot Password/Forgot Password Email.php';
        if(ForgotPassword($Email,$password)){
            echo 'Success';
        }else{
            echo 'Fail';
        }
    }else{
     echo "Email Not Found";   
    }
}
?>