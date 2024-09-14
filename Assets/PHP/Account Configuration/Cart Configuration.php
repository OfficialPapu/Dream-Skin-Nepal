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
$FeatchTotalPrice = "SELECT pc.`Product_ID`, pc.`Product_Quantity`, p.`ID`, p.`Product Price`,p.`Discount Price`,p.`Discount Percentage`, pc.`Shipping Fee`
    FROM `product_cart` pc 
    JOIN `posts` p ON  pc.`Product_ID` = p.`ID`
    JOIN `postsmeta` pm1 ON pc.`Product_ID` = pm1.`Product ID`
    WHERE  pc.`User ID`='$user_id'";
$RunQuery = mysqli_query($conn, $FeatchTotalPrice);

$CheckPurchase="SELECT COUNT(*) AS PurchaseCount FROM `orders`
JOIN order_items ON `order_items`.`Order ID`=`orders`.`Order ID`
WHERE order_items.`Order Status` != 'Cancelled' AND order_items.`Order Status` != 'Rejected' AND `orders`.`User ID`='$user_id'";
$CheckPurchaseRun=mysqli_query($conn,$CheckPurchase);
$Row=$CheckPurchaseRun->fetch_assoc();
$PurchaseCount = $Row['PurchaseCount'];

$CartCount="SELECT * FROM `product_cart` WHERE `User ID`='$user_id'";
$CartCountRun=mysqli_query($conn,$CartCount);

$ReducePriceFromEachProduct = 0;
if ($PurchaseCount == 0) {
    $CartItemCount = mysqli_num_rows($CartCountRun);
    if ($CartItemCount > 0) {
        // $ReducePriceFromEachProduct = floor(100 / $CartItemCount);
    } else {
        $ReducePriceFromEachProduct = 0;
    }
}

while ($row = $RunQuery->fetch_assoc()) {
    $SavedPrice = $row["Product Price"];
    $price = $row["Product Price"];
    $DiscountPrice = $row['Discount Price'];
    $DiscountPercentage = $row['Discount Percentage'];
    if ($DiscountPrice != '') {
        $price = $DiscountPrice;
    } else if ($DiscountPercentage != '') {
        $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
        $DiscountValue = $price - $DiscountValueCalculate;
        $price = $DiscountValue;
    }
    $subtotal = ($row["Product_Quantity"] * $price) - $ReducePriceFromEachProduct;
    $SubTotalSavedPrice = $row["Product_Quantity"] * $SavedPrice;
    $totalPrice = $subtotal;
    $productID = $row['Product_ID'];
    $insertQuery = "UPDATE `product_cart` SET `Total Due`='$totalPrice',`Product Price`='$SubTotalSavedPrice' ,`Applied Promo Code`='' WHERE `Product_ID`='$productID'";
    $run = mysqli_query($conn, $insertQuery);
}


// Fetch product information from the database
$query = "SELECT p.ID, p.`Product Title`, p.`Product Price`, p.`Discount Price`,p.`Slug Url` ,p.`Discount Percentage`,
    cart.`Product_ID` AS cartproducts,
    cart.`User_IP` AS UserIpCart,
    cart.`Product_Quantity` AS CartQuantity,
    CASE WHEN wishlist.`Product ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToWishlist,
    pm1.`Product Meta Value` AS ProductTmumbnail FROM posts p 
    JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Image 1'
    LEFT JOIN `product_wishlist` wishlist ON p.ID = wishlist.`Product ID` AND wishlist.`User ID` = '$user_id'
    JOIN product_cart cart ON cart.`Product_ID` = p.`ID` WHERE cart.`User ID`='$user_id'";
$result = $conn->query($query);
$TotalDue = "SELECT `Total Due`, `Product Price` FROM `product_cart` WHERE `User ID`='$user_id'";
$TotalPrice = 0;
$TotalSaved=0;
$runquery = mysqli_query($conn, $TotalDue);
while ($rowcart = $runquery->fetch_assoc()) {
    $TotalPrice += $rowcart['Total Due'];
    $TotalSaved += $rowcart['Product Price'];
}
$SavedAmount = $TotalSaved - $TotalPrice;