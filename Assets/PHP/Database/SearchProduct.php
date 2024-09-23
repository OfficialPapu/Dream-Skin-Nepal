<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
if(isset($_GET['Search'])){
  $Data=$_GET['Search'];
}else{
  $Data="";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
  <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
  <link rel="stylesheet" href="Assets/CSS/Product Style.css">
  <link rel="stylesheet" href="Assets/CSS/Search Product.css">
  <title>Search Product</title>
</head>

<body>
  <div class="search-box-container">
    <div class="search-box">
      <div class="search-wrapper">
        <div class="serarch-icon">
          <i class='bx bx-search-alt-2'></i>
        </div>
        <div class="search-box-input">
          <input type="text" class="search-input" id="search-bar" placeholder="Search here.." value="<?php echo $Data;?>">
        </div>
        <div class="designing-line-search-bar"></div>
      </div>
    </div>
    <div class="product-list">
        <div class="brand-heading-box">
        <div class="product-type-heading">
            <h1>Search Results<div class="designing-line"></div>
            </h1>
        </div>
        <div class="option-container">
            <div class="option-tag">
                <div class="select-btn">
                    <span class="SelectedText">Sort By</span>
                    <i class='bx bx-chevron-down'></i>
                </div>
                <ul class="options" data-producttypeid="0" data-brandid="0" data-featuredproduct="0">
                    <li class="option-list" data-shorttype="Default">
                        Default
                    </li>
                    <li class="option-list" data-shorttype="ASC">
                        Price Low to High <i class='bx bx-down-arrow-alt'></i>
                    </li>
                    <li class="option-list" data-shorttype="DESC">
                        Price High to Low <i class='bx bx-up-arrow-alt'></i>
                    </li>
                </ul>
            </div>
        </div>

    </div>
      <?php
      if (isset($_SESSION['Logged In'])) {
        $user_id = $_SESSION['LoginSession']['user_id'];
      } else {
        $user_id = $_SESSION['Cart']['user_id'];
      }
      include_once $base_url . 'Assets/Components/Navbar.php';
      $query = "SELECT p.ID, p.`Product Title`, p.`Product Price`, p.`Slug Url`, p.`Discount Price`,p.`Discount Percentage`, pm1.`Product Meta Value` 
AS ProductBrand, pm2.`Product Meta Value` AS ProductThumbnail, pm3.`Product Meta Value` AS ProductType,
CASE WHEN wishlist.`Product ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToWishlist,
CASE WHEN ci.`Product_ID` IS NOT NULL AND ci.`User ID`='$user_id' THEN 'Added' ELSE 'Not Added' END AS IsAddedToCart,
CASE WHEN p.`Product Quantity` <= 0 THEN 'Out of Stock' ELSE 'In Stock'END AS StockStatus
FROM posts p 
LEFT JOIN `product_cart` ci ON p.ID = ci.`Product_ID`
LEFT JOIN `product_wishlist` wishlist ON p.ID = wishlist.`Product ID` AND wishlist.`User ID` = '$user_id'
JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Brand ID'
JOIN postsmeta pm2 ON p.ID = pm2.`Product ID` AND pm2.`Product Meta Key` = 'Image 1'
JOIN postsmeta pm3 ON p.ID = pm3.`Product ID` AND pm3.`Product Meta Key` = 'Product Type ID' GROUP BY p.ID";
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
         if($DiscountPercentage != ''){
        $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
        $DiscountValue = $price - $DiscountValueCalculate;
        $DSNPoint=$DiscountValue/100;
        }elseif($DiscountPrice != ''){
        $DSNPoint=$DiscountPrice/100;
        }else{
        $DSNPoint=$price/100;
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
        ?>
      </div>

    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Search Product.js"></script>
</html>