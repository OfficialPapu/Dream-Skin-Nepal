<?php

include_once $base_url . 'Assets/Components/Navbar.php';
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
} else {
    echo "<script>window.open('Account/Authentication/LoginInterface.php','_self');</script>";
    $user_id = $_SESSION['Cart']['user_id'];
}
if ($_SESSION['NavigationPath'] == "BundlePath") {
    $query = "SELECT p.ID, p.`Product Title`, p.`Slug Url`, p.`Product Price`, bc.`Product ID` AS Cartproducts, bc.`Product Quantity` AS CartQuantity, bc.`Total Due`, pm1.`Product Meta Value` AS ProductTmumbnail FROM posts p JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Image 1' JOIN bundle_cart bc ON bc.`Product ID` = p.`ID` JOIN product_bundles pb ON pb.`Bundle ID` = bc.`Bundle ID` WHERE pb.`User ID` = '$user_id'";
    $result = $conn->query($query);
$TotalDue = "SELECT * FROM `bundle_cart` bc JOIN product_bundles pb ON pb.`Bundle ID` = bc.`Bundle ID` WHERE `User ID`='$user_id'";
$shippingFeeQuery = "SELECT `Shipping Fee` AS totalShippingFee FROM `bundle_cart` bc JOIN product_bundles pb ON pb.`Bundle ID` = bc.`Bundle ID` WHERE `User ID`='$user_id'";

} else if ($_SESSION['NavigationPath'] == "CartPath") {
    $query = "SELECT p.ID, p.`Product Title`,p.`Slug Url` ,p.`Product Price`,p.`Discount Price`,p.`Discount Percentage`,
cart.`Product_ID` AS cartproducts,
cart.`User_IP` AS UserIpCart,
cart.`Product_Quantity` AS CartQuantity,
pm1.`Product Meta Value` AS ProductTmumbnail FROM posts p 
JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Image 1'
JOIN product_cart cart ON cart.`Product_ID` = p.`ID` WHERE cart.`User ID`='$user_id'";
$result = $conn->query($query);
$TotalDue = "SELECT * FROM `product_cart` WHERE `User ID`='$user_id'";
$shippingFeeQuery = "SELECT `Shipping Fee` AS totalShippingFee FROM `product_cart` WHERE `User ID`='$user_id'";
}
$runquery = $conn->query($TotalDue);
$TotalPrice = 0;
$AddedShippingFee = false;
while ($row = $runquery->fetch_assoc()) {
    $TotalPrice += $row['Total Due'];
}
$TotalPrice =ceil($TotalPrice);

if (isset($_POST['check'])) {
    $name = $_POST['user_name_data'];
    $phone = $_POST['user_number_data'];
    $city = $_POST['user_city_data'];
    $address = $_POST['user_address_data'];
    $checkExistingRowQuery = "SELECT * FROM delivery_info WHERE `User ID`='$user_id'";
    $existingRowResult = mysqli_query($conn, $checkExistingRowQuery);
    $user_found = mysqli_num_rows($existingRowResult);
    if ($user_found > 0) {
        $UpdateData = "UPDATE `delivery_info` SET `Full Name`='$name',`Phone`='$phone',`City`='$city',`Address`='$address',`Order Date`=CONVERT_TZ(NOW(), '+00:00', '+05:45')  WHERE `User ID`='$user_id'";
        $execute = mysqli_query($conn, $UpdateData);
        $_SESSION['user_data_confirm-name'] = $name;
        $_SESSION['user_data_confirm-add'] = $city . ', ' . $address;
    } else {
        $SendData = "INSERT INTO delivery_info VALUES('','$user_id','$user_ip','$name','$phone','$city','$address',NOW())";
        $execute = mysqli_query($conn, $SendData);
        if ($execute) {
            $_SESSION['user_data_confirm-name'] = $name;
            $_SESSION['user_data_confirm-add'] = $city . ', ' . $address;
        }
    }
}
