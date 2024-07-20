<?php
    if (isset($_SESSION['Logged In'])) {
        $user_id = $_SESSION['LoginSession']['user_id'];
    }else{
        $user_id = $_SESSION['Cart']['user_id'];
    }
function SliderQuery($WhereCondition, $conn, $base_url, $user_id) {
    $query = "SELECT p.ID, p.`Product Title`, p.`Slug Url`, p.`Product Price`,p.`Discount Price`, p.`Discount Percentage`, pm1.`Product Meta Value` AS ProductBrand, pm2.`Product Meta Value` AS ProductThumbnail,
    CASE WHEN ci.`Product_ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToCart,
    CASE WHEN wishlist.`Product ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToWishlist,
    CASE WHEN p.`Product Quantity` <= 0 THEN 'Out of Stock' ELSE 'In Stock'END AS StockStatus
    FROM posts p 
    JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Brand ID'
    JOIN postsmeta pm2 ON p.ID = pm2.`Product ID` AND pm2.`Product Meta Key` = 'Image 1'
    JOIN postsmeta pm3 ON p.ID = pm3.`Product ID` AND pm3.`Product Meta Key` = 'Product Type ID'
    LEFT JOIN `product_cart` ci ON p.ID = ci.`Product_ID` AND ci.`User ID` = '$user_id'
    LEFT JOIN `product_wishlist` wishlist ON p.ID = wishlist.`Product ID` AND wishlist.`User ID` = '$user_id' $WhereCondition";
    return $result = $conn->query($query);
}

function Slider($result, $base_url, $is_mobile, $conn){
    echo "<div class='swiper-wrapper'>";
    while ($row = $result->fetch_assoc()) {
        $product_title = $row['Product Title'];
        include $base_url . "Assets/PHP/Configuration/TItle Length Count.php";
        $price = $row['Product Price'];
        $DiscountPrice = $row['Discount Price'];
        $DiscountPercentage = $row['Discount Percentage'];
        $StockStatus = $row['StockStatus'];
        $product_id = $row['ID'];
        $SlugUrl=$row['Slug Url'];
        $ProductBrand = $row['ProductBrand'];
        $AddedInCart = $row['IsAddedToCart'];
        $AddedInWishlist = $row['IsAddedToWishlist'];
        $FindBrandName = "SELECT * FROM `product_category` WHERE `Product Category ID`='$ProductBrand'";
        $Find = mysqli_query($conn, $FindBrandName);
        $Row = $Find->fetch_assoc();
        $ProductBrand = $Row['Product Category Attribute'];
        $thumbnail_url = $row['ProductThumbnail'];
        if($DiscountPercentage != ''){
            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
            $DiscountValue = $price - $DiscountValueCalculate;
            $DSNPoint=$DiscountValue/100;
        }elseif($DiscountPrice != ''){
            $DSNPoint=$DiscountPrice/100;
        }else{
            $DSNPoint=$price/100;
        }
        echo "<div class='swiper-slide'>";
        echo "<div class='product-box'>";
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
            echo "<i class='bx bx-heart AddToWishlist' data-product-id-wishlist='" . $row['ID'] . "'></i>";
        } else if ($AddedInWishlist == 'Added') {
            echo "<i class='bx bxs-heart AddToWishlist' data-product-id-wishlist='" . $row['ID'] . "'></i>";
        }
        echo "<a href='Product/$SlugUrl'>";
        echo "<div class='DSN-point-container'>
         <div class='DSN-point'>
            $DSNPoint DSN Point
        </div>
        <img src='$thumbnail_url' alt='$product_title' loading='lazy'>
        </div>";
    
        echo "<div class='product-data'>";
        echo "<span class='productbrand'>$ProductBrand</span>";
        echo "<h5>$limited_title</h5>";
        echo "</a>";
        echo "</div>";
        echo "<div class='price-cart'>";
        if ($DiscountPrice != '') {
            echo "<div class='product-price-box'>
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
        if ($AddedInCart == 'Not Added') {
            echo "<i class='bx bx-cart product-cart AddToCart' data-product-id='" . $row['ID'] . "'></i>";
        } else if ($AddedInCart == 'Added') {
            echo "<i class='bx bx-check product-cart AddToCart' data-product-id='" . $row['ID'] . "'></i>";
        }
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
echo "</div>";
}

?>
