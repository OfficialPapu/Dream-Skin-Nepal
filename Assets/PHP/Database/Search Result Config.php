<?php
@session_name('URLSession');
@session_start();
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
} else {
    $user_id = $_SESSION['Cart']['user_id'];
}
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';

if (isset($_POST['ListProduct'])) {
$search_input = addslashes(mysqli_real_escape_string($conn, $_POST['SearchInput']));
$search_input_metaphone = metaphone($search_input);
    $query = "SELECT DISTINCT p.ID,
    p.`Custom Product ID`, 
    p.`Product Title`, 
    p.`Slug Url`, 
    p.`Product Price`,
    p.`Discount Price`,
    p.`Product Content`,
    p.`Discount Percentage`, 
    pm1.`Product Meta Value` AS ProductBrand, 
    pm2.`Product Meta Value` AS ProductThumbnail ,
    CASE 
        WHEN ci.`Product_ID` IS NOT NULL AND ci.`User ID`='$user_id' THEN 'Added' 
        ELSE 'Not Added' 
    END AS IsAddedToCart,
    CASE 
        WHEN p.`Product Quantity` <= 0 THEN 'Out of Stock' 
        ELSE 'In Stock'
    END AS StockStatus
FROM posts p 
LEFT JOIN `product_cart` ci ON p.ID = ci.`Product_ID`
JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Brand ID'
JOIN postsmeta pm2 ON p.ID = pm2.`Product ID` AND pm2.`Product Meta Key` = 'Image 1'
JOIN postsmeta pm3 ON p.ID = pm3.`Product ID` AND pm3.`Product Meta Key` = 'Product Type ID'
JOIN product_category pc1 ON pm3.`Product Meta Value` = pc1.`Product Category ID`
WHERE 
    LOWER(p.`Product Title`) LIKE LOWER('%$search_input%') 
    OR LOWER(p.`Slug Url`) LIKE LOWER('%$search_input%') 
    OR LOWER(pc1.`Product Category Attribute`) LIKE LOWER('%$search_input%')
    OR LOWER(p.`Product Price`) LIKE LOWER('%$search_input%')
    OR LOWER(p.`Product Content`) LIKE LOWER('%$search_input%')
    OR LOWER(p.`ID`) LIKE LOWER('%$search_input%')
    OR LOWER(p.`Custom Product ID`) LIKE LOWER('%$search_input%')";
    $result = $conn->query($query);
    $Output = '';

    if (!function_exists('isMobileDevice')) {
        function isMobileDevice()
        {
            return (bool) preg_match('/(android|webos|iphone|ipad|ipod|blackberry|windows phone)/i', $_SERVER['HTTP_USER_AGENT']);
        }
    }
    $is_mobile = isMobileDevice();
    while ($row = $result->fetch_assoc()) {
        $product_title = $row['Product Title'];
        if ($is_mobile) {
            $limited_title = (strlen($product_title) > 35) ? substr($product_title, 0, 35) . "...." : $product_title;
        } else {
            $limited_title = (strlen($product_title) > 50) ? substr($product_title, 0, 50) . "...." : $product_title;
        }
        $price = $row['Product Price'];
        $DiscountPrice = $row['Discount Price'];
        $DiscountPercentage = $row['Discount Percentage'];
        $StockStatus = $row['StockStatus'];
        $product_id = $row['ID'];
        $SlugUrl = $row['Slug Url'];
        $AddedInCart = $row['IsAddedToCart'];
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
        $Output .= "<div class='product-divider'>
            <div class='product-box'>";
        if ($StockStatus == 'Out of Stock') {
            $Output .= "<div class='price-and-stock-info out-of-stock'>
            <i class='bx bxs-purchase-tag'></i> Out of Stock
            </div>";
        } elseif ($DiscountPercentage != '') {
            $Output .= "<div class='price-and-stock-info discount'>
            <i class='bx bxs-purchase-tag'></i> $DiscountPercentage% Off
            </div>";
        } elseif ($DiscountPrice != '') {
            $Output .= "<div class='price-and-stock-info discount'>
            <i class='bx bxs-purchase-tag'></i> Rs. $DiscountPrice 
            </div>";
        }
        $Output .= "<a href='Product/$SlugUrl'>
                      <div class='dns-point-container'>
                 <div class='dns-point'>
                    $DNSPoint DSN Point
                </div>
                <img src='$thumbnail_url' alt='$product_title' loading='lazy'>
                </div>
                    <div class='product-data'>
                        <span class='productbrand'>$BrandName</span>
                        <h5>$limited_title</h5>
                </a>    
            </div>
            <div class='price-cart'>";
        if ($DiscountPrice != '') {
            $Output .= "<div class='product-price-box'>
                <h4 class='product-non-discount-price'>Rs. $price.00</h4>
                <h4 class='product-discount-price'>Rs. $DiscountPrice.00</h4>
                </div>";
        } elseif ($DiscountPercentage != '') {
            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
            $DiscountValue = $price - $DiscountValueCalculate;
            $Output .= "<div class='product-price-box'>
                        <h4 class='product-non-discount-price'>Rs. $price.00</h4>
                        <h4 class='product-discount-price'>Rs. $DiscountValue.00</h4>
                        </div>";
        } else {
            $Output .= "<h4>Rs. $price.00</h4>";
        }
        if ($AddedInCart == 'Not Added') {
            $Output .= "<i class='bx bx-cart product-cart AddToCart' data-product-id='" . $row['ID'] . "'></i>";
        } else if ($AddedInCart == 'Added') {
            $Output .= "<i class='bx bx-check product-cart AddToCart' data-product-id='" . $row['ID'] . "'></i>";
        }
        $Output .= "</div>
            </div>
            </div>";
    }
    echo $Output;
}
?>