<?php
function ShowNormalProducts($result, $base_url, $is_mobile, $conn)
{
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
        if ($DiscountPercentage != '') {
            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
            $DiscountValue = $price - $DiscountValueCalculate;
            $DSNPoint = $DiscountValue / 100;
        } elseif ($DiscountPrice != '') {
            $DSNPoint = $DiscountPrice / 100;
        } else {
            $DSNPoint = $price / 100;
        }
        echo "<div class='product-divider'>
<div class='product-box'>";
        if ($StockStatus == 'Out of Stock') {
            echo "<div class='price-and-stock-info out-of-stock'>
 Out of Stock
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
        echo "<a href='Product/$SlugUrl'>
          <div class='DSN-point-container'>
             <div class='DSN-point'>
                $DSNPoint DS Point
            </div>
            <img src='$thumbnail_url' alt='$product_title' loading='lazy'>
            </div>
        <div class='product-data'>
            <span class='productbrand'>$BrandName</span>
            <h5>$limited_title</h5>
    </a>
   <!--  <div class='stars'>
        <i class='bx bxs-star'></i>
        <i class='bx bxs-star'></i>
        <i class='bx bxs-star'></i>
        <i class='bx bxs-star'></i>
        <i class='bx bxs-star'></i>
    </div>-->
</div>
<div class='price-cart'>";
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
        echo "</div>
</div>
</div>";
    }
}
