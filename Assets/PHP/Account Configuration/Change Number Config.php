<?php
@session_name('LoginSession');
@session_name('URLSession');
@session_start();
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
require_once $base_url . 'Assets/PHP/Database/Database Connection.php';
if (isset($_SESSION['Logged In'])) {
    $userID = $_SESSION['LoginSession']['user_id'];
}else{
    $userID = $_SESSION['Cart']['user_id'];
}
$UserDataFeatch = "SELECT * FROM user_table WHERE ID='$userID'";
$RunQuery = mysqli_query($conn, $UserDataFeatch);
if ($RunQuery->num_rows > 0) {
    while ($row = $RunQuery->fetch_assoc()) {
        $OldNumber = $row['Mobile Number'];
    }
}

if (isset($_POST['ChangeNumber'])) {
    $NewMonileNum = $_POST['NewNumber'];
    $Query = "UPDATE `user_table` SET `Mobile Number`='$NewMonileNum' WHERE `ID`='$userID'";
    $RunQuerys = mysqli_query($conn, $Query);
    if ($RunQuerys) {
      echo "NumberUpdatedSucessfully";
    }
    else{
        echo"FailedToUpdate";
    }
}
?>