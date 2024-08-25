<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . "Assets/PHP/Configuration/Skin Care Config.php";
$canonical_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-10828634041"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-10828634041');
</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $SkinCareDescription; ?>">
    <meta name="keywords" content="<?php echo $SkinCarekeywords; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $SkinCareTitle; ?>">
    <meta property="og:url" content="<?php echo $canonical_url; ?>">
    <meta property="og:image" content="https://dreamskinnepal.com/Assets/Product/Media/Images/Logo/Dream skin nepal.png">
    <meta property="og:description" content="<?php echo $SkinCareDescription; ?>">
     <link rel="canonical" href="<?php echo $canonical_url; ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Product Style.css">
    <title><?php echo $SkinCareTitle; ?></title>
</head>

<body>
        <div class="flex px-5 py-3 text-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 Breadcrumb-box" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Home
                </a>
            </li>
            <li>
      <div class="flex items-center">
        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <a href="/" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Skin Care</a>
      </div>
    </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"><?php echo $ProductTypeName; ?></span>
                </div>
            </li>
        </ol>
    </div>
<div class="brand-heading-box">
        <div class="product-type-heading">
            <h1><?php echo $ProductTypeName; ?><div class="designing-line"></div>
            </h1>
        </div>
        <div class="option-container">
            <div class="option-tag">
                <div class="select-btn">
                    <span class="SelectedText">Sort By</span>
                    <i class='bx bx-chevron-down'></i>
                </div>
                <ul class="options" data-producttypeid="<?php echo $ProductTypeID;?>" data-brandid="0" data-featuredproduct="0">
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
    <div class="product-main-container-brands">
        <?php
        while ($row = $result->fetch_assoc()) {
            $product_title = $row['Product Title'];
            include $base_url . "Assets/PHP/Configuration/TItle Length Count.php";
            $price = $row['Product Price'];
            $DiscountPrice = $row['Discount Price'];
            $DiscountPercentage = $row['Discount Percentage'];
            $StockStatus = $row['StockStatus'];
            $AddedInCart = $row['IsAddedToCart'];
            $AddedInWishlist = $row['IsAddedToWishlist'];
            $product_id = $row['ID'];
            $SlugUrl = $row['Slug Url'];
            $ProductBrand = $row['ProductBrand'];
            $FindBrand = "SELECT * FROM `product_category` WHERE `Product Category ID`='$ProductBrand'";
            $Find = mysqli_query($conn, $FindBrand);
            $Row = $Find->fetch_assoc();
            $ProductBrand = $Row['Product Category Attribute'];
            $thumbnail_url = $row['ProductThumbnail'];
            $BrandID=$row['ProductBrand'];
            $FindBrandName="SELECT * FROM `product_category` WHERE `Product Category ID`='$BrandID'";
            $Find=mysqli_query($conn,$FindBrandName);
            $Row=$Find->fetch_assoc();
            $BrandName=$Row['Product Category Attribute'];
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
    <footer>
        <?php
        include_once $base_url . 'Assets/Components/Footer.php';
        ?>
    </footer>

    </div>

</body>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "BreadcrumbList",
      "@id": "<?php echo $canonical_url; ?>/#breadcrumblist",
      "itemListElement": [
        {
          "@type": "ListItem",
          "@id": "https://dreamskinnepal.com/#listItem",
          "position": 1,
          "name": "Home",
          "item": "https://dreamskinnepal.com/",
          "nextItem": "<?php echo $canonical_url; ?>/#listItem"
        },
        {
          "@type": "ListItem",
          "@id": "<?php echo $canonical_url; ?>/#listItem",
          "position": 2,
          "name": "<?php echo $SkinCareTitle; ?>",
          "previousItem": "https://dreamskinnepal.com/#listItem"
        }
      ]
    },
    {
      "@type": "CollectionPage",
      "@id": "<?php echo $canonical_url; ?>/#collectionpage",
      "url": "<?php echo $canonical_url; ?>/",
      "name": "<?php echo $SkinCareTitle; ?>",
      "inLanguage": "en-US",
      "isPartOf": { "@id": "https://dreamskinnepal.com/#website" },
      "breadcrumb": {
        "@id": "<?php echo $canonical_url; ?>/#breadcrumblist"
      }
    },
    {
      "@type": "Organization",
      "@id": "https://dreamskinnepal.com/#organization",
      "name": "Dream Skin Nepal",
      "description": "<?php echo $SchemaDescription; ?>",
      "url": "https://dreamskinnepal.com/",
      "logo": {
        "@type": "ImageObject",
        "url": "https://dreamskinnepal.com/Assets/Product/Media/Images/Logo/Dream skin nepal.png",
        "@id": "<?php echo $canonical_url; ?>/#organizationLogo",
        "width": 1500,
        "height": 1500
      },
      "image": {
        "@id": "<?php echo $canonical_url; ?>/#organizationLogo"
      },
      "sameAs": [
        "https://facebook.com/Dream.Skin.Nepal/",
        "https://www.instagram.com/dream.skin.nepal/"
      ]
    },
    {
      "@type": "WebSite",
      "@id": "https://dreamskinnepal.com/#website",
      "url": "https://dreamskinnepal.com/",
      "name": "Dream Skin Nepal",
      "description": "<?php echo $SchemaDescription; ?>",
      "inLanguage": "en-US",
      "publisher": { "@id": "https://dreamskinnepal.com/#organization" }
    }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "item": { "name": "Home", "@id": "https://dreamskinnepal.com" }
    },
    {
      "@type": "ListItem",
      "position": 2,
      "item": {
        "name": "<?php echo $SkinCareTitle; ?>",
        "@id": "<?php echo $canonical_url; ?>"
      }
    }
  ]
}
</script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Product Script.js"></script>

</html>