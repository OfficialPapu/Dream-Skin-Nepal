<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
}else{
    $user_id = $_SESSION['Cart']['user_id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];
        
        $uploadDirectory = $base_url . "Account/UserAccount/User Images/" . date("Y/m");
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }
        
        $targetPath = $uploadDirectory ."/". $fileName;
        $UploadFileLocation=date("Y/m") ."/". $fileName;
        if (move_uploaded_file($fileTmpName, $targetPath)) {
            $sql = "UPDATE `user_table` SET `User Picture` = '$UploadFileLocation' WHERE `ID`='$user_id'";
            $UploadImages=mysqli_query($conn,$sql);
            if($UploadImages){
                echo "Success";
            }
            else{
                echo "Fail";
            }
        }
    }
} 
?>
