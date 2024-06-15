<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Configuration/User IP.php';
include_once $base_url . 'Assets/Components/Navbar.php';
$user_ip = get_ip();
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
} else {
    $user_id = $_SESSION['Cart']['user_id'];
}
$query = "SELECT p.ID, p.`Product Title`,p.`Slug Url` ,p.`Product Price`,p.`Discount Price`,p.`Discount Percentage`,
    wishlist.`Product ID` AS Wishlistproducts,
    wishlist.`User IP` AS UserIpWishlist,
    pm1.`Product Meta Value` AS ProductTmumbnail FROM posts p 
    JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Image 1'
    JOIN product_wishlist wishlist ON wishlist.`Product ID` = p.`ID` WHERE wishlist.`User ID`='$user_id'";
$result = $conn->query($query);
