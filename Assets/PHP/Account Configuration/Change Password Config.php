<?php
@session_name('URLSession');
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
    $row = $RunQuery->fetch_assoc();
    $OldPasswordDB = $row['Password'];
}


if (isset($_POST['ChangePass'])) {
    $OldPass = $_POST['OldPass'];
    $firstNewPass = $_POST['NewFirstPass'];
    $LastNewPass = $_POST['NewSecondPass'];
    if ($OldPass == $OldPasswordDB) {
        $Query = "UPDATE `user_table` SET `Password`='$LastNewPass' WHERE `ID`='$userID'";
        $RunQuerys = mysqli_query($conn, $Query);
        if ($RunQuerys) {
            echo "PassChangedSucessfully";
        }
    } else {
        echo "IncorrectPass";
    }
}
?>