<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . "Assets/Vendor/autoload.php";
require_once $base_url . 'Assets/PHP/Database/Database Connection.php';
require_once $base_url . 'Assets/PHP/Configuration/User IP.php';
$ip = get_ip();
$clientID = '1045855137406-0q0k1c86gvcuo33utakmpc7q1icafaql.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://dreamskinnepal.com/Account/User%20Account/Cart.php';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);

$client->addScope("email");
$client->addScope("profile");
function LoginThroughGoogle($FirstName, $LastName, $Email, $ProfilePic,$GoogleUserID)

{
    global $conn;
    global $base_url;
    global $ip;
    function downloadAndSaveFile($fileUrl, $savePath, $fileName)
    {
        $fileData = file_get_contents($fileUrl);
        if ($fileData !== false) {
            $contentType = get_headers($fileUrl, 1)["Content-Type"];
            $fileExtension = getFileExtensionFromContentType($contentType);
            if (!$fileExtension) {
                return false;
            }
            $fullFilePath = $savePath . $fileName . '.' . $fileExtension;
            if (file_put_contents($fullFilePath, $fileData) !== false) {
                return $fullFilePath;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
        return $randomString;
    }


    function getFileExtensionFromContentType($contentType)
    {
        switch ($contentType) {
            case 'image/jpeg':
                return 'jpg';
            case 'image/png':
                return 'png';
            default:
                return false;
        }
    }

    $fileUrl = $ProfilePic;
    $savePath = $base_url . "Account/User Account/User Images/";
    $fileName = "profile_picture-" . $GoogleUserID;
    $filePath = downloadAndSaveFile($fileUrl, $savePath, $fileName);

    $emailalreadyexist = "SELECT * FROM `user_table` WHERE Email='$Email'";
    $alreadyexistquery = mysqli_query($conn, $emailalreadyexist);

    $fileUrl = $ProfilePic;
    $contentType = get_headers($fileUrl, 1)["Content-Type"];
    $fileExtension = getFileExtensionFromContentType($contentType);
    $userImg=$fileName.".".$fileExtension;
    $passwod=generateRandomString(10);

    if ($alreadyexistquery->num_rows > 0) {
        @session_start();
        $UpdateQuery="UPDATE `user_table` SET `First Name`='$FirstName',`Last Name`='$LastName',`User Picture`='$userImg',`User IP`='$ip'WHERE `Email`='$Email'";
        $UpdateQueryRun=mysqli_query($conn,$UpdateQuery);
        $row = $alreadyexistquery->fetch_assoc();
        $_SESSION['Logged In'] = true;
        $_SESSION['user_first_name'] = $row['First Name'];
        $_SESSION['user_last_name'] = $row['Last Name'];
        $_SESSION['user_email'] = $row['Email'];
        $_SESSION['LoginSession']['user_id'] = $row['ID'];
    } else {

        $NewUser = "INSERT INTO `user_table` VALUES('', '$FirstName', '$LastName', '$Email', '', '$passwod','','$userImg','$ip','','')";
        $Sql = mysqli_query($conn, $NewUser);
        if ($Sql) {
            $UserLogin = "SELECT * FROM `user_table` WHERE Email='$Email'";
            $UserLoginRun = mysqli_query($conn, $UserLogin);
            if ($UserLoginRun->num_rows > 0) {
                @session_start();
                $row = $UserLoginRun->fetch_assoc();
                $_SESSION['Logged In'] = true;
                $_SESSION['user_first_name'] = $row['First Name'];
                $_SESSION['user_last_name'] = $row['Last Name'];
                $_SESSION['user_email'] = $row['Email'];
                $_SESSION['LoginSession']['user_id'] = $row['ID'];
            }
        }
    }
}

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $Email =  $google_account_info->email;
    $GivenName =  $google_account_info->givenName;
    $FamilyName = $google_account_info->familyName;
    $profilePictureUrl = $google_account_info->picture;
    $GoogleUserID= $google_account_info->id;
    LoginThroughGoogle($GivenName, $FamilyName, $Email, $profilePictureUrl,$GoogleUsesrID);        
}
?>
