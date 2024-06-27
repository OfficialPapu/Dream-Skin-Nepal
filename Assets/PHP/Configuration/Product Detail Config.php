<?php
include_once $base_url . 'Assets/Components/Navbar.php';
ChangeUrl();
$SlugUrl = $_SERVER['PATH_INFO'];
if ($SlugUrl == '/' || $SlugUrl=='' || $SlugUrl=='/Product/') {
    echo "<script>window.location.href='/'</script>";
}
$SlugUrl = str_replace("/Product/", "", $SlugUrl);
$query = "SELECT p.ID, p.`Product Title`, p.`Product Price`, p.`Product Quantity`,p.`Discount Price`, p.`Discount Percentage`, p.`Product Content`, pm1.`Product Meta Value` AS ProductBrand, pm2.`Product Meta Value` AS Thumbnail, p.`Product Content`, p.`Discount Price`,
CASE WHEN wishlist.`Product ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToWishlist
FROM posts p JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Brand ID'
JOIN postsmeta pm2 ON p.ID = pm2.`Product ID` AND pm2.`Product Meta Key` = 'Image 1'
LEFT JOIN `product_wishlist` wishlist ON p.ID = wishlist.`Product ID` AND wishlist.`User ID` = '$user_id'
WHERE p.`Slug Url` LIKE '%$SlugUrl%'";
$result = $conn->query($query);
if($result -> num_rows >0){
$row = $result->fetch_assoc();
$ProductTitle = $row['Product Title'];
$ProductImg = $row['Thumbnail'];
$ProductDescription = $row['Product Content'];
}else{
$ProductTitle = "Dream Skin Nepal - Best Korean Beauty & Skincare Products in Nepal | Authentic K-Beauty Store";
$ProductImg = "Assets/Product/Media/Images/Logo/Dream skin nepal.png";
$ProductDescription = "Dream Skin Nepal offers the best Korean beauty and skincare products in Nepal. Shop for authentic Korean cosmetics, cruelty-free and vegan options, and enjoy free shipping on orders over Rs. 5000. Find top Korean skincare brands, face cleansing products, and more.";
}
?>

