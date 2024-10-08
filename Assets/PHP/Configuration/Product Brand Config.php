<?php
@session_name('Cart');
@session_start();
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
} else {
    $user_id = $_SESSION['Cart']['user_id'];
}
include_once $base_url . 'Assets/Components/Navbar.php';
ChangeUrl();
if (isset($_SERVER['PATH_INFO'])) {
    $SlugUrl = $_SERVER['PATH_INFO'];
    if ($SlugUrl == '/') {
        echo "<script>window.location.href='Category/Brands.php'</script>";
    }
    $SlugUrl = str_replace("/", "", $SlugUrl);
    $FindBrand = "SELECT * FROM `product_category` WHERE `Slug Url` LIKE '%$SlugUrl%'";
    $Find = mysqli_query($conn, $FindBrand);
    $Row = $Find->fetch_assoc();
    $BrandName = $Row['Product Category Attribute'];
    $BrandImage = $Row['Image Url'];
    $BrandID = $Row['Product Category ID'];
    $query = "SELECT DISTINCT p.ID, p.`Product Title`,p.`Slug Url`, p.`Product Price`,p.`Discount Price`,p.`Discount Percentage`, pm1.`Product Meta Value` 
AS ProductBrand, pm2.`Product Meta Value` AS ProductThumbnail,
CASE WHEN wishlist.`Product ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToWishlist,
CASE WHEN ci.`Product_ID` IS NOT NULL AND ci.`User ID`='$user_id' THEN 'Added' ELSE 'Not Added' END AS IsAddedToCart,
CASE WHEN p.`Product Quantity` <= 0 THEN 'Out of Stock' ELSE 'In Stock'END AS StockStatus
FROM posts p 
LEFT JOIN `product_cart` ci ON p.ID = ci.`Product_ID`
LEFT JOIN `product_wishlist` wishlist ON p.ID = wishlist.`Product ID` AND wishlist.`User ID` = '$user_id'
JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Brand ID'
JOIN postsmeta pm2 ON p.ID = pm2.`Product ID` AND pm2.`Product Meta Key` = 'Image 1'  WHERE pm1.`Product Meta Value`='$BrandID'";
    $result = mysqli_query($conn, $query);
    include_once $base_url . 'Assets/PHP/Configuration/Mobile Check.php';

    // SEO
    $Title = $BrandName . " - Dream Skin Nepal";
    $Description = "";
    $Keywords = "";
    $OGImage = "https://www.dreamskinnepal.com/Assets/Product/Media/Images/Brand Images/". $BrandImage;
} else {
    $BrandListQuery = "SELECT * FROM `product_category` WHERE `Product Category Name`='Brand' ORDER BY `Product Category Attribute` ASC";
    $BrandListRun = mysqli_query($conn, $BrandListQuery);
    // SEO
    $Title = "Top Korean Beauty Brands | Best Skincare & Makeup Brands - Dream Skin Nepal";
    $Description = "Discover the top Korean beauty brands at Dream Skin Nepal. Explore our curated selection of the best skincare, makeup, and cosmetic brands, including cruelty-free and vegan options. Shop now and enjoy free shipping over Rs. 3500.";
    $Keywords = "korean beauty brands, korean skincare brands, best korean makeup brands, cruelty-free korean cosmetics, vegan korean skincare, korean beauty products Nepal, Dream Skin Nepal, top korean skincare, korean cosmetics Nepal, free shipping beauty products Nepal";
    $OGImage = "https://www.dreamskinnepal.com/Assets/Product/Media/Images/Logo/Dream skin nepal.png";
}
