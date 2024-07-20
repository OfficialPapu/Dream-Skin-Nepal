<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
if (isset($_POST['DataSend'])) {
    require_once $base_url . 'Assets/PHP/Database/Database Connection.php';
    require_once $base_url . 'Assets/PHP/Configuration/User IP.php';
    $ip = get_ip();
    $first_name = $_POST['FirstName'];
    $last_name = $_POST['LastName'];
    $email = $_POST['Email'];
    $mobile_number = $_POST['MobileNumber'];
    $password = $_POST['Password'];

    if (empty($first_name) || empty($last_name) || empty($email) || empty($mobile_number) || empty($password)) {
        echo "Empty";
    } else {
        $email_already_exist = "SELECT * FROM `user_table` WHERE Email='$email' OR `Mobile Number`='$mobile_number'";
        $already_exist_query = mysqli_query($conn, $email_already_exist);
        if ($already_exist_query->num_rows > 0) {
            echo "Exists";
        } else {
            $send_form_data = "INSERT INTO `user_table`(`ID`, `First Name`, `Last Name`, `Email`, `Mobile Number`, `Password`, `DSN Point`, `User Address`, `User Picture`, `User IP`, `User Gender`, `Date Of Birth`,`Account Signup Date`) VALUES ('','$first_name','$last_name','$email','$mobile_number','$password','','','','$ip','','',CONVERT_TZ(NOW(), '+00:00', '+05:45'))";
            $ex = mysqli_query($conn, $send_form_data);
            if ($ex) {
                echo "Sucess";
            } else {
                echo "Error";
            }
        }
    }
}

?>