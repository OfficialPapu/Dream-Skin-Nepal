<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
$RunQuery=0;
 if(isset($_SESSION['Logged In'])){
$userID = $_SESSION['LoginSession']['user_id'];

$UserDataFeatch="SELECT * FROM user_table WHERE ID='$userID'";
$RunQuery=mysqli_query($conn,$UserDataFeatch);
if($RunQuery->num_rows > 0){
        $row = $RunQuery->fetch_assoc();
        $user_first_name=$row['First Name'];
        $user_last_name=$row['Last Name'];
        $Mobile=$row['Mobile Number'];
        $Address=$row['User Address'];
        $UserPic=$row['User Picture'];
        $Gender=$row['User Gender'];
        $DOB=$row['Date Of Birth'];
}
if(isset($_POST['UpdateData'])){
$firstName=$_POST['FirstName'];
$lastName=$_POST['LastName'];
$address=$_POST['Address'];
$gender=$_POST['Gender'];
$dateofbirth=$_POST['DOB'];
$Query="UPDATE `user_table` SET `First Name`='$firstName',`Last Name`='$lastName',`User Address`='$address',`User Gender`='$gender',`Date Of Birth`='$dateofbirth' WHERE `ID`='$userID'";
$RunQuerys=mysqli_query($conn,$Query);
if($RunQuerys){
    echo "Success";
}
else{
    echo "Fail";
}
}
}
?>