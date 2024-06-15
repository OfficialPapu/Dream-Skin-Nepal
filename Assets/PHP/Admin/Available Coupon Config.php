<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/PHP/Database/Database Connection.php';
if (isset($_POST['ListAvaliableCouponcode'])) {
    $AvaliableCouponQuery = "SELECT * FROM `coupon_code`";
    $AvaliableCouponRun = mysqli_query($conn, $AvaliableCouponQuery);
    $Array = [];
    if ($AvaliableCouponRun->num_rows > 0) {
        while ($Row = $AvaliableCouponRun->fetch_assoc()) {
            $Array[] = $Row;
        }
        $Data = json_encode($Array);
        echo $Data;
    } else {
        $Array['Message'] = "Not found";
        $Data = json_encode($Array);
        echo $Data;
    }
}
?>

<?php
if (isset($_POST['DeleteCouponCode'])) {
    $CouponID = $_POST['CouponID'];
    $DeleteCouponCodeQuery="DELETE FROM `coupon_code` WHERE `ID`='$CouponID'";
    $DeleteCouponCodeRun=mysqli_query($conn,$DeleteCouponCodeQuery);
    if($DeleteCouponCodeRun){
        echo "Success";
    }
}
?>
