<?php
include 'Assets/PHP/URL/Base Path.php';
@session_name('LoginSession');
@session_name('URLSession');
@session_start();
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PD3FG3HH');
    </script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="ezoic-site-verification" content="8JoqehVJGqPYfEJaZHK6BJrFX6FVsB" />
    <meta name="google-site-verification" content="_n9au9euneNaJXGaKlDub_Mz-_--CUur_PMLWY_KMCg" />
    <meta name="google-adsense-account" content="ca-pub-3974057861773104">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dream Skin Nepal - Trusted for Korean Beauty products. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online for Korean products in Nepal.">
    <meta name="keywords" content="best korean beauty products, korean skincare, korean makeup, korean cosmetics, cruelty-free beauty, vegan skincare, Dream Skin Nepal, best korean skincare, buy korean cosmetics Nepal, online beauty shop Nepal, top korean beauty brands, free shipping beauty Nepal, korean skincare in Nepal, face cleansing products in Nepal, Korean product store in Nepal, Korean genuine products in Nepal, authentic korean skincare products, Korean skin care and beauty clinic Nepal, welcos in Nepal, glutathione cream in Nepal, how to buy products from AliExpress in Nepal, how to order from AliExpress in Nepal, best korean skincare products, Korean skincare routine, viral Korean products, Korean skincare for acne">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Dream Skin Nepal - Best Korean Skincare Cosmetics Products in Nepal">
    <meta property="og:url" content="https://www.dreamskinnepal.com/">
    <meta property="og:image" content="https://dreamskinnepal.com/Assets/Product/Media/Images/Logo/Dream skin nepal.png">
    <meta property="og:description" content="Dream Skin Nepal - Trusted for Korean Beauty products. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online for Korean products in Nepal.">
    <link rel="canonical" href="https://www.dreamskinnepal.com/">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="Assets/Product/Media/Images/Logo/Dream skin nepal.png" type="image/x-icon">
    <link rel="stylesheet" href="Assets/CSS/Style.css">
    <title>Dream Skin Nepal - Best Korean Skincare Cosmetics Products in Nepal</title>
    <style>
        .banner-combination {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  justify-content: center;
  align-items: center;
  gap: 10px;
}
.banner-combination img {
  width: 100%;
  height: 100%;
}

@media (max-width: 900px) {
  .banner-combination {
    grid-template-columns: 1fr 1fr;
    gap: 0;
  }
  .Retinol {
    grid-column: 1 / 2;
  }
  .Ampoule {
    grid-column: 1 / -1;
  }
  .Eyecream {
    grid-column: 2 / 3;
  }
  .Eyecream {
    margin-left: 6px;
  }
}

    </style>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PD3FG3HH" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <nav class="main-nav">
        <?php include('Assets/Components/Navbar.php'); ?>
    </nav>
    <h1 style="display:none">Dream Skin Nepal - Best Korean Skincare Cosmetics Products in Nepal</h1>
    <div class="image_cresol">
        <?php include('Assets/Slider/Image Cresol.php'); ?>
    </div>

    <div class="Companyinfo">
        <?php
        include('Assets/Slider/Company Info PC.php');
        include('Assets/Slider/Company Info Mobile.php');
        ?>
    </div>

    <div class="fridaysales">
        <!--<div class="view-more-box">-->
        <!--    <div class="heading-box">-->
        <!--        <h2 class="product-heading">Live Sales</h2>-->
        <!--    </div>-->
        <!--    <div class="view-more">-->
        <!--        <a href="Category/ViewMoreProduct.php?Condition=OFFER">SHOP MORE<i class="bx bx-chevron-right"></i></a>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<div class="sales-offer-container">-->
        <!--    <div class="sales-offer-box">-->
        <!--        <div class="first-child">On sale now</div>-->
        <!--        <div class="second-child">-->
        <!--            <div class="ending-text">-->
        <!--                Ends in-->
        <!--            </div>-->
        <!--            <div class="time">-->
        <!--                <div class="hour">00<span class="time-info"> hrs</span></div>-->
        <!--                <div class="minute">00<span class="time-info"> min</span></div>-->
        <!--                <div class="second">00<span class="time-info"> sec</span></div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <?php
        //$Sql = "WHERE p.ID>=331 ORDER BY Rand() LIMIT 0,10";
        //include('Assets/Slider/Product Slider.php');
        ?>
    </div>

     <div class="products">
        <div class="view-more-box">
            <div class="heading-box">
                <h2 class="product-heading">New Arrivals</h2>
            </div>
            <div class="view-more">
                <a href="Category/ViewMoreProduct.php?Condition=NewArrivals">SHOP MORE<i class="bx bx-chevron-right"></i></a>
            </div>
        </div>
        <?php
        $Sql = "WHERE (p.ID >= 331 OR p.ID IN (36, 294, 47, 276, 94)) ORDER BY Rand() LIMIT 0,10";
        include('Assets/Slider/Product Slider.php');
        ?>
    </div> 

    <div class="products">
        <div class="view-more-box">
            <div class="heading-box">
                <h2 class="product-heading">Best Sellers</h2>
            </div>
            <div class="view-more">
                <a href="Category/ViewMoreProduct.php?Condition=BestSellers">SHOP MORE<i class="bx bx-chevron-right"></i></a>
            </div>
        </div>
        <?php
        $Sql = "WHERE p.`Product Quantity`>0 ORDER BY Rand() LIMIT 0,10";
        include('Assets/Slider/Product Slider.php');
        ?>
    </div>

 <?php
    $CategorySql = "SELECT * FROM `product_category`
    WHERE `Product Category Attribute` IN('Cleanser','Toner/ Toner Pad','Essence','Serum','Moisturizer','Sunscreen/ Sun Stick','Sheet Mask','Hair Care','Cushion Foundation','Lip Stick (Lip Tint/Lip Balm)' ) ORDER BY CASE `Product Category Attribute` 
    WHEN 'Cleanser' THEN 1 
    WHEN 'Toner/ Toner Pad' THEN 2 
    WHEN 'Essence' THEN 3 
    WHEN 'Serum' THEN 4 WHEN 'Moisturizer' THEN 5 
    WHEN 'Sunscreen/ Sun Stick' THEN 6 
    WHEN 'Sheet Mask' THEN 7 
    WHEN 'Lip Stick (Lip Tint/Lip Balm)' THEN 8 
    WHEN 'Cushion Foundation' THEN 9 
    WHEN 'Hair Care' THEN 10
    ELSE 11 END, `Product Category Attribute` ASC LIMIT 1";
    $CategorySqlRun = mysqli_query($conn, $CategorySql);
    while ($Row = $CategorySqlRun->fetch_assoc()) {
        $CategoryAttribute = $Row['Product Category Attribute'];
        $CategoryID = $Row['Product Category ID'];
        $SlugUrl = $Row['Slug Url'];
        $ImageUrl = $Row['Image Url'];
        $Sql = "WHERE pm3.`Product Meta Value`='$CategoryID' AND p.`Product Quantity`>0";
        echo "<div class='products'>
        <div class='view-more-box'>
            <div class='heading-box'>
                <h2 class='product-heading'>$CategoryAttribute</h2>
            </div>
            <div class='view-more'>
                <a href='Category/SkinCare.php/$SlugUrl'>SHOP MORE<i class='bx bx-chevron-right'></i></a>
            </div>
        </div>";
        if ($ImageUrl != "") {
            echo "<div class='banner'>
            <img src='Assets/Product/Media/Images/Banners/$ImageUrl' alt='$CategoryAttribute' loading='lazy'>
            </div>";
        }
        include('Assets/Slider/Product Slider.php');
        echo "</div>";
    }
    ?>
  <div class="products">
        <?php
        echo "<div class='banner-combination'>
            <a href='Category/SkinCare.php/ampoule' class='Ampoule'><img src='Assets/Product/Media/Images/Banners/Ampoule.jpg' alt='Ampoule' loading='lazy'></a>
            <a href='Category/SkinCare.php/retinol' class='Retinol'><img src='Assets/Product/Media/Images/Banners/Retinol.jpg' alt='Retinol' loading='lazy'></a>
            <a href='Category/SkinCare.php/eye-cream' class='Eyecream'><img src='Assets/Product/Media/Images/Banners/Eyecream.jpg' alt='Eyecream' loading='lazy'></a>
            </div>";
        $Sql = "WHERE (pm3.`Product Meta Value`='23' OR pm3.`Product Meta Value`='55' OR pm3.`Product Meta Value`='82') AND p.`Product Quantity`>0 ORDER BY Rand() LIMIT 0,10";
        include('Assets/Slider/Product Slider.php');
        ?>
    </div>

    <div class="products">
        <?php
        echo "<div class='banner'>
             <img src='Assets/Product/Media/Images/Banners/skincare mix.jpg' alt='skincare mix' loading='lazy'>
         </div>";
        $Sql = "WHERE pm3.`Product Meta Value` IN (23, 24, 25, 26, 27, 29, 30, 31, 32, 37, 55, 80, 81, 82, 83, 84) AND p.`Product Quantity`>0 ORDER BY Rand() LIMIT 0,10";
        include('Assets/Slider/Product Slider.php');
        ?>
    </div>
    <div class="products">
        <?php
        echo "<div class='banner'>
             <img src='Assets/Product/Media/Images/Banners/makeup mix.jpg' alt='makeup mix' loading='lazy'>
         </div>";
        $Sql = "WHERE pm3.`Product Meta Value` IN (33, 34, 35, 36, 54, 56, 57, 59, 74, 75, 85) AND p.`Product Quantity`>0 ORDER BY Rand() LIMIT 0,10";
        include('Assets/Slider/Product Slider.php');
        ?>
    </div>
    <div class="products review">
        <h2 class="product-heading">Customer Reviews</h2>
        <?php include('Assets/Slider/Customer Review.php'); ?>
    </div>

    <div class="whatsapp">
        <a href="https://wa.me/9862078653"><img src="Assets/Product/Media/Images/Logo/Whatsapp.png" alt="Contact us on WhatsApp"></a>
    </div>

    <footer>
        <?php include('Assets/Components/Footer.php'); ?>
    </footer>

</body>
<script src="Assets/JS/Script.js"></script>
<script>
    let countDownTime = new Date('July 26, 2024 23:00:00').getTime();
    setInterval(() => {
        let today = new Date().getTime();
        let difference = countDownTime - today;

        if (difference > 0) {
            let hours = Math.floor(difference / (1000 * 60 * 60));
            let minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((difference % (1000 * 60)) / 1000);

            $('.hour').html(hours + `<span class="time-info"> hrs</span>`);
            $('.minute').html(minutes + `<span class="time-info"> min</span>`);
            $('.second').html(seconds + `<span class="time-info"> sec</span>`);

        } else {
            $('.hour').html('00<span class="time-info"> hrs</span>');
            $('.minute').html('00<span class="time-info"> min</span>');
            $('.second').html('00<span class="time-info"> sec</span>');
        }
    }, 1000);
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [{
                "@type": "BreadcrumbList",
                "@id": "https://www.dreamskinnepal.com/#breadcrumblist",
                "itemListElement": [{
                    "@type": "ListItem",
                    "@id": "https://www.dreamskinnepal.com/#listItem",
                    "position": 1,
                    "name": "Home"
                }]
            },
            {
                "@type": "Organization",
                "@id": "https://www.dreamskinnepal.com/#organization",
                "name": "Dream Skin Nepal",
                "url": "https://www.dreamskinnepal.com/",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://dreamskinnepal.com/Assets/Product/Media/Images/Logo/Dream skin nepal.png",
                    "@id": "https://www.dreamskinnepal.com/#organizationLogo",
                    "width": 600,
                    "height": 600
                },
                "image": {
                    "@id": "https://www.dreamskinnepal.com/#organizationLogo"
                },
                "sameAs": [
                    "https://facebook.com/Dream.Skin.Nepal/",
                    "https://www.instagram.com/dream.skin.nepal/"
                ]
            },
            {
                "@type": "WebPage",
                "@id": "https://www.dreamskinnepal.com/#webpage",
                "url": "https://www.dreamskinnepal.com/",
                "name": "Dream Skin Nepal - Best Korean Skincare Cosmetics Products in Nepal",
                "description": "Dream Skin Nepal - Trusted for Korean Beauty products. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online for Korean products in Nepal.",
                "inLanguage": "en-US",
                "isPartOf": {
                    "@id": "https://www.dreamskinnepal.com/#website"
                },
                "breadcrumb": {
                    "@id": "https://www.dreamskinnepal.com/#breadcrumblist"
                },
                "datePublished": "2023-10-06T22:28:28+05:45",
                "dateModified": "2024-02-15T17:04:34+05:45"
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
                },
                "potentialAction": {
                    "@type": "SearchAction",
                    "target": {
                        "@type": "EntryPoint",
                        "urlTemplate": "https://www.dreamskinnepal.com/Assets/PHP/Database/SearchProduct.php?search_term_string={search_term_string}"
                    },
                    "query-input": "required name=search_term_string"
                }
            }
        ]
    }
</script>
<script>
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1300972564192880');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1300972564192880&ev=PageView&noscript=1" / alt='meta pixel'></noscript>