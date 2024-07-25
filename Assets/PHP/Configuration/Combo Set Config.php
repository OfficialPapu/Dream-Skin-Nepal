<?php
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
} else {
    $user_id = $_SESSION['Cart']['user_id'];
}
include_once $base_url . 'Assets/Components/Navbar.php';
ChangeUrl();
$SlugUrl = $_SERVER['PATH_INFO'];
if ($SlugUrl == '/' || $SlugUrl == '') {
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


function ComboSetProduct($result, $base_url, $is_mobile, $conn)
{
    echo "<div class='product-main-container-brands'>";
    while ($row = $result->fetch_assoc()) {
        $product_title = $row['Product Title'];
        include $base_url . "Assets/PHP/Configuration/TItle Length Count.php";
        $price = $row['Product Price'];
        $DiscountPrice = $row['Discount Price'];
        $DiscountPercentage = $row['Discount Percentage'];
        $StockStatus = $row['StockStatus'];
        $product_id = $row['ID'];
        $SlugUrl = $row['Slug Url'];
        $AddedInCart = $row['IsAddedToCart'];
        $AddedInWishlist = $row['IsAddedToWishlist'];
        $thumbnail_url = $row['ProductThumbnail'];
        $BrandID = $row['ProductBrand'];
        $FindBrandName = "SELECT * FROM `product_category` WHERE `Product Category ID`='$BrandID'";
        $Find = mysqli_query($conn, $FindBrandName);
        $Row = $Find->fetch_assoc();
        $BrandName = $Row['Product Category Attribute'];
        if($DiscountPercentage != ''){
            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
            $DiscountValue = $price - $DiscountValueCalculate;
            $DNSPoint=$DiscountValue/100;
        }elseif($DiscountPrice != ''){
            $DNSPoint=$DiscountPrice/100;
        }else{
            $DNSPoint=$price/100;
        }
        echo "<div class='product-divider'>
<div class='product-box !rounded-[4px]' data-product-id='$product_id' data-selected='0' style='border:1px solid white'>";
        if ($StockStatus == 'Out of Stock') {
            echo "<div class='price-and-stock-info out-of-stock'>
<i class='bx bxs-purchase-tag'></i> Out of Stock
</div>";
        } elseif ($DiscountPercentage != '') {
            echo "<div class='price-and-stock-info discount'>
        <i class='bx bxs-purchase-tag'></i> $DiscountPercentage% Off
        </div>";
        } elseif ($DiscountPrice != '') {
            echo "<div class='price-and-stock-info discount'>
        <i class='bx bxs-purchase-tag'></i> Rs. $DiscountPrice 
        </div>";
        }
        if ($AddedInWishlist == 'Not Added') {
            echo "<i class='bx bx-heart AddToWishlist AddToWishlist-btn' data-product-id-wishlist='" . $row['ID'] . "'></i>";
        } else if ($AddedInWishlist == 'Added') {
            echo "<i class='bx bxs-heart AddToWishlist AddToWishlist-btn' data-product-id-wishlist='" . $row['ID'] . "'></i>";
        }
        echo " <div class='dns-point-container'>
                 <div class='dns-point'>
                    $DNSPoint DSN Point
                </div>
                <img src='$thumbnail_url' alt='$product_title' loading='lazy'>
                </div>
        <div class='product-data'>
            <span class='productbrand'>$BrandName</span>
            <h5>$limited_title</h5>
</div>
<div class='price-cart'>";
        if ($DiscountPrice != '') {
            echo "<div class='product-price-box comboset-price-box !gap-0 justify-between w-[100%] !flex'>
    <h4 class='product-non-discount-price'>Rs. $price.00</h4>
    <h4 class='product-discount-price'>Rs. $DiscountPrice.00</h4>
    </div>";
        } elseif ($DiscountPercentage != '') {
            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
            $DiscountValue = $price - $DiscountValueCalculate;
            echo "<div class='product-price-box'>
            <h4 class='product-non-discount-price'>Rs. $price.00</h4>
            <h4 class='product-discount-price'>Rs. $DiscountValue.00</h4>
            </div>";
        } else {
            echo "<h4>Rs. $price.00</h4>";
        }
        echo "</div>
</div>
</div>";
    }
   echo "</div>";

}
?>
