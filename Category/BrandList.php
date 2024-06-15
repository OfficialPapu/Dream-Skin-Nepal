<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/Configuration/Brand List Config.php';
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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover the top Korean beauty brands at Dream Skin Nepal. Explore our curated selection of the best skincare, makeup, and cosmetic brands, including cruelty-free and vegan options. Shop now and enjoy free shipping over Rs. 5000.">
    <meta name="keywords" content="korean beauty brands, korean skincare brands, best korean makeup brands, cruelty-free korean cosmetics, vegan korean skincare, korean beauty products Nepal, Dream Skin Nepal, top korean skincare, korean cosmetics Nepal, free shipping beauty products Nepal">
    <meta property="og:title" content="Top Korean Beauty Brands | Best Skincare & Makeup Brands - Dream Skin Nepal">
    <meta property="og:site_name" content="Dream Skin Nepal">
    <meta property="og:url" content="<?php echo $canonical_url; ?>">
    <meta property="og:description" content="Discover the top Korean beauty brands at Dream Skin Nepal. Explore our curated selection of the best skincare, makeup, and cosmetic brands, including cruelty-free and vegan options. Shop now and enjoy free shipping over Rs. 5000.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://www.dreamskinnepal.com/Assets/Product/Media/Images/Logo/Dream skin nepal.png">
    <link rel="canonical" href="<?php echo $canonical_url; ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet"/>
    <title>Top Korean Beauty Brands | Best Skincare & Makeup Brands - Dream Skin Nepal</title>
    <link rel="stylesheet" href="Assets/CSS/Brand List.css">
</head>

<body>
    <div class="brand-list-container">
                <div class="flex px-5 py-3 text-gray-700 rounded-lg  dark:bg-gray-800 dark:border-gray-700 Breadcrumb-box" aria-label="Breadcrumb">
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
        <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Category</a>
      </div>
    </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"><h1>Top Korean Beauty Brands</h1></span>
                    </div>
                </li>
            </ol>
        </div>
        <div class="brand-list-box">
            <?php
            while ($Row=$BrandListRun->fetch_assoc()) {
              $BrandName=$Row['Product Category Attribute'];
              $BrandImageUrl="Assets/Product/Media/Images/Brand Images/".$Row['Image Url'];
                $SlugUrl = $Row['Slug Url'];

            ?>
            <div class="brand-divider">
                <a href="Category/ProductBrand.php/<?php echo $SlugUrl;?>">
                    <div class="brand-info">
                        <div class="brand-image">
                            <img src="<?php echo $BrandImageUrl;?>" alt="<?php echo $BrandName;?>">
                        </div>
                        <div class="bard-data">
                            <div class="brand-heading"><?php echo $BrandName;?></div>
                            <div class="delivery-date">Delivery With in 24 hours</div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>