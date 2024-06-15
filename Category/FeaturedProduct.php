
<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-10828634041"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-10828634041');
</script>

  <link rel="stylesheet" href="Assets/CSS/Product Style.css">
  <link rel="stylesheet" href="Assets/CSS/Search Product.css">
</head>

<body>
  <div class="search-box-container">
    <div class="product-list">
      <?php
      if (isset($_SESSION['Logged In'])) {
        $user_id = $_SESSION['LoginSession']['user_id'];
      } else {
        $user_id = $_SESSION['Cart']['user_id'];
      }
      include_once $base_url . 'Assets/Components/Navbar.php';
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
JOIN postsmeta pm3 ON p.ID = pm3.`Product ID` AND pm3.`Product Meta Key` = 'Product Type ID' ORDER BY RAND() LIMIT 10 ";
      $result = $conn->query($query);
      include_once $base_url . 'Assets/PHP/Configuration/Mobile Check.php';
      ?>

      <div class="product-main-container-brands">
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
          $AddedInCart = $row['IsAddedToCart'];
          $AddedInWishlist = $row['IsAddedToWishlist'];
          $thumbnail_url = $row['ProductThumbnail'];
          $BrandID = $row['ProductBrand'];
          $FindBrandName = "SELECT * FROM `product_category` WHERE `Product Category ID`='$BrandID'";
          $Find = mysqli_query($conn, $FindBrandName);
          $Row = $Find->fetch_assoc();
          $BrandName = $Row['Product Category Attribute'];
          echo "<div class='product-divider'>
    <div class='product-box'>";
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
          echo "<a href='Product/$SlugUrl'>
            <img src='$thumbnail_url' alt='$limited_title'>
            <div class='product-data'>
                <span class='productbrand'>$BrandName</span>
                <h5>$limited_title</h5>
        </a>
        <div class='stars'>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
        </div>
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
            echo "<i class='bx bx-cart product-cart AddToCart-btn' data-product-id='" . $row['ID'] . "'></i>";
          } else if ($AddedInCart == 'Added') {
            echo "<i class='bx bx-check product-cart AddToCart-btn' data-product-id='" . $row['ID'] . "'></i>";
          }
          echo "</div>
    </div>
</div>";
        }
        ?>
      </div>

    </div>
  </div>
</body>
<script src="Assets/JS/Featured Product.js"></script>