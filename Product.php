<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Configuration/Product Detail Config.php';
$canonical_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION["StockStatus"] = "InStock";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo $ProductTitle ?> price in Nepal. Check out the details, price, and exclusive discounts on korean skincare product in Nepal">
  <meta name="keywords" content="<?php echo $ProductTitle ?>, Dream Skin Nepal, skincare products, discounts, in Neapl, korean skincare product in Nepal">
  <meta property="og:title" content="<?php echo $ProductTitle ?> - Dream Skin Nepal">
  <meta property="og:site_name" content="Dream Skin Nepal">
  <meta property="og:url" content="<?php echo $canonical_url; ?>">
  <meta property="og:description" content="<?php echo htmlentities($ProductDescription); ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://www.dreamskinnepal.com/<?php echo $ProductImg; ?>">
  <link rel="canonical" href="<?php echo $canonical_url; ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Assets/CSS/Product Detail Page.css">
  <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title><?php echo htmlentities($ProductTitle); ?> - Dream Skin Nepal</title>
</head>

<body>
  <?php
  $_SESSION["ReslutCount"] = $result->num_rows > 0;
  if ($result->num_rows > 0) {
    $product_id = $row['ID'];
    $product_title = $row['Product Title'];
    include $base_url . 'Assets/PHP/Configuration/Mobile Check.php';
    $result = mysqli_query($conn, $query);
    if ($is_mobile) {
      $limited_title = (strlen($product_title) > 20) ? substr($product_title, 0, 20) . "..." : $product_title;
    } else {
      $limited_title = $product_title;
    }
    $productDescription = $row['Product Content'];
    $DiscountPrice = $row['Discount Price'];
    $AddedInWishlist = $row['IsAddedToWishlist'];
    $DiscountPercentage = $row['Discount Percentage'];
    $ProductQuantity = $row['Product Quantity'];
    $price = $row['Product Price'];
    $_SESSION["Price"] = $price;
    $ProductBrand = $row['ProductBrand'];
    $ProductBrandID = $row['ProductBrand'];
    $FindBrand = "SELECT * FROM `product_category` WHERE `Product Category ID`='$ProductBrand'";
    $Find = mysqli_query($conn, $FindBrand);
    $Row = $Find->fetch_assoc();
    $ProductBrand = $Row['Product Category Attribute'];
    $SlugUrl = $Row['Slug Url'];
  ?>

    <nav aria-label="Breadcrumb" class="flex px-5 py-3 text-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 Breadcrumb-box">
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
            <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
            </svg>
            <a href="/" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Product</a>
          </div>
        </li>
        <li aria-current="page">
          <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
            </svg>
            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"><?php echo $limited_title; ?></span>
          </div>
        </li>
      </ol>
    </nav>

    <div class='product-container'>
      <div class='product-image'>
        <div style='--swiper-navigation-color: #fff; --swiper-pagination-color: #fff' class='swiper mySwiper2'>
          <div class='swiper-wrapper'>
            <?php
            $image_url_query = "SELECT p.ID, pm_images.`Product Meta Value` AS AdditionalImage FROM posts p LEFT JOIN postsmeta pm_images ON p.ID = pm_images.`Product ID` AND pm_images.`Product Meta Key` LIKE 'Image%' WHERE `Product ID`='$product_id'";
            $image_url_result = $conn->query($image_url_query);

            while ($image_url_row = $image_url_result->fetch_assoc()) {
              $image_url = ($image_url_row) ? $image_url_row['AdditionalImage'] : '';
              $full_image_url = $image_url;
            ?>
              <div class='swiper-slide big-image'>
                <img src='<?php echo $full_image_url; ?>' alt='<?php echo $product_title; ?>' />
              </div>
            <?php
            }
            ?>
          </div>
          <div class='swiper-button-next'></div>
          <div class='swiper-button-prev'></div>
        </div>
        <div thumbsSlider='' class='swiper mySwiper'>
          <div class='swiper-wrapper'>
            <?php
            $image_url_result->data_seek(0);
            while ($image_url_row = $image_url_result->fetch_assoc()) {
              $image_url = ($image_url_row) ? $image_url_row['AdditionalImage'] : '';
              $full_image_url = $image_url;
            ?>
              <div class='swiper-slide add-border'>
                <img src='<?php echo $full_image_url; ?>' alt='<?php echo $product_title; ?>' />
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <div class='product-details'>
        <a href='Category/ProductBrand.php/<?php echo $SlugUrl; ?>'>
          <h2 class='product-brand'>
            <?php echo $ProductBrand; ?>
            <div class='brand-underline'></div>
          </h2>
        </a>
        <h1 class='product-title'><?php echo $product_title; ?></h1>
        <div class="price-wishlist-share-wrapper">
          <div class="price-box">
            <?php
            if ($DiscountPrice != '') {
              $DiscountPriceShow = $price - $DiscountPrice;
              echo "<div class='product-price-box-detail-page'>
                    <p class='product-discount-price'>Rs $DiscountPrice.00</p>
                    <p class='product-price non-discount-price'><span class='discountvalue'>Rs $price.00</span> - Rs. $DiscountPriceShow</p>
                    </div>";
            } elseif ($DiscountPercentage != '') {
              $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
              $DiscountValue = $price - $DiscountValueCalculate;
              $DiscountPercentageShow = $DiscountPercentage . "%";
              echo "<div class='product-price-box-detail-page'>
                    <p class='product-discount-price'>Rs $DiscountValue.00</p>
                    <p class='product-price non-discount-price'><span class='discountvalue'>Rs $price.00</span> -$DiscountPercentageShow</p>
                    </div>";
            } else {
              echo "<p class='product-price'>Rs $price.00</p>";
            }
            ?>
          </div>
          <div class="share-wishlist">
            <i class='bx bx-share-alt ShareBtn'></i>
            <div class="share-link-box">
              <div class="share-link-icons">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $canonical_url; ?>"><i class="fa-brands fa-facebook" style="color: #4268b3;"></i></a>
                <a href="fb-messenger://share?link=<?php echo urlencode($canonical_url); ?>"><i class="fa-brands fa-facebook-messenger" style="color: #183153;"></i></a>
                <a href="https://api.whatsapp.com/send?text=<?php echo $canonical_url; ?>"><i class="fa-brands fa-whatsapp" style="color: #25d366;"></i></a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo $canonical_url; ?>"><i class="fa-brands fa-twitter" style="color: #1da1f2;"></i></a>
                <a href="https://www.instagram.com/?url=<?php echo $canonical_url; ?>"><i class="fa-brands fa-instagram"></i></a>

              </div>
              <div class="clipboard">
                <div class="w-full max-w-100">
                  <div class="relative">
                    <input id="npm-install-copy-button" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" value="<?php echo $canonical_url; ?>" readonly>
                    <button class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center" data-clipboard-target="#npm-install-copy-button" id="copy-button">
                      <span id="default-icon">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                          <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                        </svg>
                      </span>
                      <span id="success-icon" class="hidden inline-flex items-center">
                        <svg class="w-3.5 h-3.5 text-blue-700 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                      </span>
                    </button>
                  </div>
                </div>

              </div>
            </div>
            <?php
            if ($AddedInWishlist == 'Not Added') {
              echo "<i class='bx bx-heart WishlistBtn AddToWishlistProductDetail' data-product-id='" . $row['ID'] . "'></i>";
            } else if ($AddedInWishlist == 'Added') {
              echo "<i class='bx bxs-heart WishlistBtn AddToWishlistProductDetail' data-product-id='" . $row['ID'] . "'></i>";
            }
            ?>
          </div>
        </div>
        <div class='product-description'>
          <h3 class='about-heading'>About this item</h3>
          <p class='about-product'><?php echo nl2br($productDescription); ?></p>
        </div>

        <div class='product-action-btn'>
          <div class="quantity-details-box">
            <div class="quantity-selector">
              <button id="decrease"><i class='bx bx-minus'></i></button>
              <div class="vertical-line"></div>
              <input type="text" id="quantity" value="1" class='product-number' readonly>
              <div class="vertical-line"></div>
              <button id="increase"><i class='bx bx-plus'></i></button>
            </div>
            <?php
            if ($ProductQuantity > 5) {
              echo "<p>In stock</p>";
            } elseif ($ProductQuantity <= 5 && $ProductQuantity >= 1) {
              echo "<p>Only " . $ProductQuantity . " unit left</p>";
            } else {
              echo "<p class='not-available-text'>Out of Stock</p>";
            }
            ?>
          </div>
          <div class='add-to-cart-quich-buy-box'>
            <button class='buy-now-btn BuyNow' data-product-id='<?php echo $row['ID']; ?>'>Buy Now</button>
            <button class='cart-btn AddToCart' data-product-id='<?php echo $row['ID']; ?>'>Add to Cart</button>
          </div>
        </div>
      </div>
    </div>
    <hr class='line-devider'>
  <?php
  } else {
  ?>
    <div class="flex flex-col items-center justify-center gap-6 md:mb-[5rem] mb-[2rem] mt-[5rem] px-4 md:px-6" data-id="1">
      <div class="max-w-md text-center" data-id="2">
        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl" data-id="3" style="color: rgb(255, 0, 127);">Product Not Found</h1>
        <p class="mt-4 text-gray-500 dark:text-gray-400" data-id="4">We're sorry, but the product you were looking for could not be found. It may have been removed or is no longer available.</p><a data-id="5" class="inline-flex items-center justify-center mt-2 rounded-md border border-[#00ADEF] bg-white px-6 py-3 text-[#FF007F] text-sm font-bold shadow-sm transition-colors hover:bg-[#00ADEF] hover:text-white disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus:ring-gray-300" href="/" rel="ugc"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
            <path d="m12 19-7-7 7-7"></path>
            <path d="M19 12H5"></path>
          </svg>
          Go back home
        </a>
      </div>
    </div>
  <?php
  }
  ?>
  <section class="featured-product">
    <h2 class='featured-product-heading'>Exclusive Selection</h2>
    <?php
    include_once $base_url . 'Category/FeaturedProduct.php';
    ?>
  </section>
  <footer>
    <?php
    include_once $base_url . 'Assets/Components/Footer.php';
    ?>
  </footer>

</body>
<?php
if ($_SESSION["ReslutCount"] > 0) {
?>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [{
          "@type": "BreadcrumbList",
          "@id": "<?php echo $canonical_url; ?>/#breadcrumblist",
          "itemListElement": [{
              "@type": "ListItem",
              "@id": "https://www.dreamskinnepal.com/#listItem",
              "position": 1,
              "name": "Home",
              "item": "https://www.dreamskinnepal.com/",
              "nextItem": "<?php echo $canonical_url; ?>/#listItem"
            },
            {
              "@type": "ListItem",
              "@id": "<?php echo $canonical_url; ?>/#listItem",
              "position": 2,
              "name": "<?php echo htmlentities($ProductTitle); ?> - Dream Skin Nepal",
              "previousItem": "https://www.dreamskinnepal.com/#listItem"
            }
          ]
        },
        {
          "@type": "Organization",
          "@id": "https://www.dreamskinnepal.com/#organization",
          "name": "Dream Skin Nepal",
          "description": "Best Korean Skincare Cosmetics Products in Nepal",
          "url": "https://www.dreamskinnepal.com/",
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
            "https://www.facebook.com/Dream.Skin.Nepal/",
            "https://www.instagram.com/dream.skin.nepal/",
            "https://tiktok.com/@dream.skin.nepal/"
          ]
        },
        {
          "@type": "WebPage",
          "@id": "<?php echo $canonical_url; ?>/#webpage",
          "url": "<?php echo $canonical_url; ?>/",
          "name": "<?php echo htmlentities($ProductTitle); ?> - Dream Skin Nepal",
          "description": "<?php echo htmlentities($ProductDescription); ?>",
          "inLanguage": "en-US",
          "isPartOf": {
            "@id": "https://www.dreamskinnepal.com/#website"
          },
          "breadcrumb": {
            "@id": "<?php echo $canonical_url; ?>/#breadcrumblist"
          },
          "image": {
            "@type": "ImageObject",
            "url": "https://www.dreamskinnepal.com/<?php echo $ProductImg; ?>",
            "@id": "<?php echo $canonical_url; ?>/#mainImage",
            "width": 600,
            "height": 600
          },
          "primaryImageOfPage": {
            "@id": "<?php echo $canonical_url; ?>/#mainImage"
          },
          "datePublished": "2023-10-28T05:35:06+05:45",
          "dateModified": "2024-04-28T13:05:48+05:45"
        },
        {
          "@type": "WebSite",
          "@id": "https://www.dreamskinnepal.com/#website",
          "url": "https://www.dreamskinnepal.com/",
          "name": "Dream Skin Nepal",
          "description": "Best Korean Skincare Cosmetics Products in Nepal",
          "inLanguage": "en-US",
          "publisher": {
            "@id": "https://www.dreamskinnepal.com/#organization"
          }
        }
      ]
    }
  </script>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@graph": [{
          "@type": "BreadcrumbList",
          "itemListElement": [{
              "@type": "ListItem",
              "position": 1,
              "item": {
                "name": "Home",
                "@id": "https://www.dreamskinnepal.com/"
              }
            },
            {
              "@type": "ListItem",
              "position": 2,
              "item": {
                "name": "<?php echo htmlentities($ProductTitle); ?> - Dream Skin Nepal",
                "@id": "<?php echo $canonical_url; ?>"
              }
            }
          ]
        },
        {
          "@type": "Product",
          "@id": "<?php echo $canonical_url; ?>/#product",
          "name": "<?php echo htmlentities($ProductTitle); ?> - Dream Skin Nepal",
          "url": "<?php echo $canonical_url; ?>",
          "description": "<?php echo htmlentities($ProductDescription); ?>",
          "image": "https://www.dreamskinnepal.com/<?php echo $ProductImg; ?>",
          "sku": "",
          "offers": [{
            "@type": "Offer",
            "price": "<?php echo $_SESSION["Price"]; ?>.00",
            "priceValidUntil": "2030-12-31",
            "priceSpecification": {
              "price": "<?php echo $_SESSION["Price"]; ?>.00",
              "priceCurrency": "NPR",
              "valueAddedTaxIncluded": false
            },
            "priceCurrency": "NPR",
            "availability": "http://schema.org/<?php echo $_SESSION["StockStatus"]; ?>",
            "url": "<?php echo $canonical_url; ?>",
            "seller": {
              "@type": "Organization",
              "name": "Dream Skin Nepal",
              "url": "https://www.dreamskinnepal.com/"
            }
          }]
        }
      ]
    }
  </script>
<?php } else {
?>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [{
          "@type": "BreadcrumbList",
          "@id": "<?php echo $canonical_url; ?>/#breadcrumblist",
          "itemListElement": [{
              "@type": "ListItem",
              "@id": "https://www.dreamskinnepal.com/#listItem",
              "position": 1,
              "name": "Home",
              "item": "https://www.dreamskinnepal.com/",
              "nextItem": "<?php echo $canonical_url; ?>/#listItem"
            },
            {
              "@type": "ListItem",
              "@id": "<?php echo $canonical_url; ?>/#listItem",
              "position": 2,
              "name": "Not Found - Dream Skin Nepal",
              "previousItem": "https://www.dreamskinnepal.com/#listItem"
            }
          ]
        },
        {
          "@type": "Organization",
          "@id": "https://www.dreamskinnepal.com/#organization",
          "name": "Dream Skin Nepal",
          "description": "Dream Skin Nepal - Trusted for Korean Beauty products. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online for Korean products in Nepal.",
          "url": "https://www.dreamskinnepal.com/",
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
            "https://www.facebook.com/Dream.Skin.Nepal/",
            "https://www.instagram.com/dream.skin.nepal/",
            "https://tiktok.com/@dream.skin.nepal/"
          ]
        },
        {
          "@type": "WebPage",
          "@id": "<?php echo $canonical_url; ?>/#webpage",
          "url": "<?php echo $canonical_url; ?>/",
          "name": "Not Found - Dream Skin Nepal",
          "description": "Dream Skin Nepal - Trusted for Korean Beauty products. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online for Korean products in Nepal.",
          "inLanguage": "en-US",
          "isPartOf": {
            "@id": "https://www.dreamskinnepal.com/#website"
          },
          "breadcrumb": {
            "@id": "<?php echo $canonical_url; ?>/#breadcrumblist"
          },
          "image": {
            "@type": "ImageObject",
            "url": "https://www.dreamskinnepal.com/Assets/Product/Media/Images/Logo/Dream skin nepal.png",
            "@id": "<?php echo $canonical_url; ?>/#mainImage",
            "width": 600,
            "height": 600
          },
          "primaryImageOfPage": {
            "@id": "<?php echo $canonical_url; ?>/#mainImage"
          },
          "datePublished": "2024-02-28T05:35:06+05:45",
          "dateModified": "2024-04-28T13:05:48+05:45"
        },
        {
          "@type": "WebSite",
          "@id": "https://www.dreamskinnepal.com/#website",
          "url": "https://www.dreamskinnepal.com/",
          "name": "Dream Skin Nepal",
          "description": "Dream Skin Nepal - Trusted for Korean Beauty products. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online for Korean products in Nepal.",
          "inLanguage": "en-US",
          "publisher": {
            "@id": "https://www.dreamskinnepal.com/#organization"
          }
        }
      ]
    }
  </script>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@graph": [{
          "@type": "BreadcrumbList",
          "itemListElement": [{
              "@type": "ListItem",
              "position": 1,
              "item": {
                "name": "Home",
                "@id": "https://www.dreamskinnepal.com/"
              }
            },
            {
              "@type": "ListItem",
              "position": 2,
              "item": {
                "name": "Not Found - Dream Skin Nepal",
                "@id": "<?php echo $canonical_url; ?>"
              }
            }
          ]
        },
        {
          "@type": "Product",
          "@id": "<?php echo $canonical_url; ?>/#product",
          "name": "Not Found - Dream Skin Nepal",
          "url": "<?php echo $canonical_url; ?>",
          "description": "Dream Skin Nepal - Trusted for Korean Beauty products. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online for Korean products in Nepal.",
          "image": "https://www.dreamskinnepal.com/Assets/Product/Media/Images/Logo/Dream skin nepal.png",
          "sku": "",
          "offers": [{
            "@type": "Offer",
            "price": "0",
            "priceValidUntil": "2030-12-31",
            "priceSpecification": {
              "price": "0",
              "priceCurrency": "NPR",
              "valueAddedTaxIncluded": false
            },
            "priceCurrency": "NPR",
            "availability": "http://schema.org/<?php echo $_SESSION["StockStatus"]; ?>",
            "url": "<?php echo $canonical_url; ?>",
            "seller": {
              "@type": "Organization",
              "name": "Dream Skin Nepal",
              "url": "https://www.dreamskinnepal.com/"
            }
          }]
        }
      ]
    }
  </script>
<?php
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Product Detail Page.js"></script>

</html>