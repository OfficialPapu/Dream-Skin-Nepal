<head>
    <?php
    include_once $base_url . 'Assets/PHP/Configuration/Product Slider 2 Config.php';
    ?>
</head>

<body>
    <div class="swiper swiper-container">
        <div class="swiper-wrapper">
            <?php
            while ($row = $result->fetch_assoc()) {
                $product_title = $row['Product Title'];
                include $base_url . "Assets/PHP/Configuration/TItle Length Count.php";
                $price = $row['Product Price'];
                $DiscountPrice = $row['Discount Price'];
                $DiscountPercentage = $row['Discount Percentage'];
                $StockStatus = $row['StockStatus'];
                $product_id = $row['ID'];
                $SlugUrl = $row['Slug Url'];
                $ProductBrand = $row['ProductBrand'];
                $AddedInCart = $row['IsAddedToCart'];
                $AddedInWishlist = $row['IsAddedToWishlist'];
                $FindBrandName = "SELECT * FROM `product_category` WHERE `Product Category ID`='$ProductBrand'";
                $Find = mysqli_query($conn, $FindBrandName);
                $Row = $Find->fetch_assoc();
                $ProductBrand = $Row['Product Category Attribute'];
                $thumbnail_url = $row['ProductThumbnail'];
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
                    echo "<i class='bx bx-heart AddToWishlist AddToWishlist-2' data-product-id-wishlist='" . $row['ID'] . "'></i>";
                } else if ($AddedInWishlist == 'Added') {
                    echo "<i class='bx bxs-heart AddToWishlist AddToWishlist-2' data-product-id-wishlist='" . $row['ID'] . "'></i>";
                }
                echo "<a href='Product/$SlugUrl'>";
                echo "<img src='$thumbnail_url' alt='$product_title' loading='lazy'>";
                echo "<div class='product-data'>";
                echo "<span class='productbrand'>$ProductBrand</span>";
                echo "<h5>$limited_title</h5>";
                echo "</a>";
                echo "<div class='stars'>";
                echo "<i class='bx bxs-star'></i>";
                echo "<i class='bx bxs-star'></i>";
                echo "<i class='bx bxs-star'></i>";
                echo "<i class='bx bxs-star'></i>";
                echo "<i class='bx bxs-star'></i>";
                echo "</div>";
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
                    echo "<i class='bx bx-cart product-cart AddToCart-2' data-product-id='" . $row['ID'] . "'></i>";
                } else if ($AddedInCart == 'Added') {
                    echo "<i class='bx bx-check product-cart AddToCart-2' data-product-id='" . $row['ID'] . "'></i>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>
    <script src="Assets/JS/Product Slider 2.js"></script>