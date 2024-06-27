<?php
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
}else{
    $user_id = $_SESSION['Cart']['user_id'];
}
$query = "SELECT p.ID, p.`Product Title`, p.`Slug Url`, p.`Product Price`,p.`Discount Price`, p.`Discount Percentage`, pm1.`Product Meta Value` AS ProductBrand, pm2.`Product Meta Value` AS ProductThumbnail,
CASE WHEN ci.`Product_ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToCart,
CASE WHEN wishlist.`Product ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToWishlist,
CASE WHEN p.`Product Quantity` <= 0 THEN 'Out of Stock' ELSE 'In Stock'END AS StockStatus
FROM posts p 
JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Brand ID'
JOIN postsmeta pm2 ON p.ID = pm2.`Product ID` AND pm2.`Product Meta Key` = 'Image 1'
LEFT JOIN `product_cart` ci ON p.ID = ci.`Product_ID` AND ci.`User ID` = '$user_id'
LEFT JOIN `product_wishlist` wishlist ON p.ID = wishlist.`Product ID` AND wishlist.`User ID` = '$user_id'
WHERE p.ID>=292 ORDER BY Rand() LIMIT 0,10";
$result = $conn->query($query);
include $base_url . "Assets/PHP/Configuration/Mobile Check.php";
?>