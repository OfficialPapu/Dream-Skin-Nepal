<?php
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
}else{
    $user_id = $_SESSION['Cart']['user_id'];
}
include_once $base_url . 'Assets/Components/Navbar.php';
ChangeUrl();
$SlugUrl = $_SERVER['PATH_INFO'];
if ($SlugUrl == '/' || $SlugUrl=='') {
    echo "<script>window.location.href='/'</script>";
}
$SlugUrl = str_replace("/", "", $SlugUrl);
$FindProductType = "SELECT * FROM `product_category` WHERE `Slug Url` LIKE '%$SlugUrl%'";
$Find = mysqli_query($conn, $FindProductType);
$Row = $Find->fetch_assoc();
$ProductTypeName = $Row['Product Category Attribute'];
$ProductTypeID = $Row['Product Category ID'];
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
WHERE pm3.`Product Meta Value`='$ProductTypeID'";
$result = $conn->query($query);
include_once $base_url . 'Assets/PHP/Configuration/Mobile Check.php';
?>