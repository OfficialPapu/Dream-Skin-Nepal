<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
} else {
    $user_id = $_SESSION['Cart']['user_id'];
}

// Fetch product information from the database
$query = "SELECT
    p.ID,
    p.`Product Title`,
    p.`Product Price`,
    p.`Discount Price`,
    p.`Slug Url`,
    p.`Discount Percentage`,
    bc.`Product ID` AS cartproducts,
    bc.`Product Quantity` AS CartQuantity,
    bc.`Total Due` As TotalDue,
    pm1.`Product Meta Value` AS ProductTmumbnail
FROM
    posts p
JOIN postsmeta pm1 ON
    p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Image 1'
JOIN bundle_cart bc ON
    bc.`Product ID` = p.`ID`
JOIN product_bundles pb ON
    pb.`Bundle ID` = bc.`Bundle ID`
WHERE
    pb.`User ID` = '$user_id'";
$result = $conn->query($query);
$TotalDue = "SELECT `Total Due`, `Product Price` FROM `bundle_cart` bc JOIN product_bundles pb ON pb.`Bundle ID` = bc.`Bundle ID` WHERE `User ID` = '$user_id'";
$TotalPrice = 0;
$TotalSaved = 0;
$runquery = mysqli_query($conn, $TotalDue);
while ($rowcart = $runquery->fetch_assoc()) {
    $TotalPrice += $rowcart['Total Due'];
    $TotalSaved += $rowcart['Product Price'];
}
$TotalPrice = ceil($TotalPrice);
$SavedAmount = ceil($TotalSaved - $TotalPrice);
