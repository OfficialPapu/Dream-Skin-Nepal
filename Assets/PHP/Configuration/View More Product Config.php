<?php
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
} else {
    $user_id = $_SESSION['Cart']['user_id'];
}
include_once $base_url . 'Assets/Components/Navbar.php';
$GetValue = $_GET['Condition'];
if ($GetValue == 'NewArrivals') {
    $GetValue = $GetValue;
    $Condition = 'p.ID>=267';
    $featuredproduct=267;
} else if ($GetValue == 'BestSellers') {
    $featuredproduct=0;
    $Condition =  "1 ORDER BY Rand() LIMIT 0,100";
}else if ($GetValue == 'OFFER') {
    $featuredproduct=0;
    $Condition =  "p.ID=270 OR p.ID=128 OR p.ID=106 OR p.ID=233 OR p.ID=146 OR p.ID=76 OR p.ID=277 OR p.ID=253 OR p.ID=249 OR p.ID=248 OR p.ID=246 OR p.ID=122";
}
$query = "SELECT DISTINCT p.ID, p.`Product Title`,p.`Slug Url`, p.`Product Price`,p.`Discount Price`,p.`Discount Percentage`, pm1.`Product Meta Value` 
AS ProductBrand, pm2.`Product Meta Value` AS ProductThumbnail, pm3.`Product Meta Value` AS ProductType,
CASE WHEN wishlist.`Product ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToWishlist,
CASE WHEN ci.`Product_ID` IS NOT NULL AND ci.`User ID`='$user_id' THEN 'Added' ELSE 'Not Added' END AS IsAddedToCart,
CASE WHEN p.`Product Quantity` <= 0 THEN 'Out of Stock' ELSE 'In Stock'END AS StockStatus
FROM posts p 
LEFT JOIN `product_cart` ci ON p.ID = ci.`Product_ID`
LEFT JOIN `product_wishlist` wishlist ON p.ID = wishlist.`Product ID` AND wishlist.`User ID` = '$user_id'
JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Brand ID'
JOIN postsmeta pm2 ON p.ID = pm2.`Product ID` AND pm2.`Product Meta Key` = 'Image 1'
JOIN postsmeta pm3 ON p.ID = pm3.`Product ID` AND pm3.`Product Meta Key` = 'Product Type ID'
WHERE $Condition";
$result = $conn->query($query);
include_once $base_url . 'Assets/PHP/Configuration/Mobile Check.php';
