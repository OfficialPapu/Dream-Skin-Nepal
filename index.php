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
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PD3FG3HH');</script>
<!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="_n9au9euneNaJXGaKlDub_Mz-_--CUur_PMLWY_KMCg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dream Skin Nepal - Trusted for Korean Beauty products. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online for Korean products in Nepal.">
    <meta name="keywords" content="best korean beauty products, korean skincare, korean makeup, korean cosmetics, cruelty-free beauty, vegan skincare, Dream Skin Nepal, best korean skincare, buy korean cosmetics Nepal, online beauty shop Nepal, top korean beauty brands, free shipping beauty Nepal, korean skincare,korean skincare products,korean skincare routine,korean beauty,korean skin care,korean product,korean,viral korean products,korean beauty products,top products korea,best products korea,korean makeup,best korean skin care products,best korean skincare products 2023,skincare products,korean skincare for acne,korean skincare routıne,viral korean products #skincare #skineducation #shorts,korean skincare tips,beauty products">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Dream Skin Nepal - Best Korean Skincare Cosmetics Products in Nepal">
    <meta property="og:url" content="https://www.dreamskinnepal.com/">
    <meta property="og:image" content="https://dreamskinnepal.com/Assets/Product/Media/Images/Logo/Dream skin nepal.png">
    <meta property="og:description" content="Dream Skin Nepal - Trusted for Korean Beauty products. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online for Korean products in Nepal.">
    <!-- <link rel="canonical" href="https://www.dreamskinnepal.com/"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="Assets/Product/Media/Images/Logo/Dream skin nepal.png" type="image/x-icon">
    <link rel="stylesheet" href="Assets/CSS/Style.css">
    <title>Dream Skin Nepal - Best Korean Skincare Cosmetics Products in Nepal </title>
    <style>
        .offer-imges {
            background-color: rgba(0, 0, 0, 0.7);
            position: fixed;
            top: 0;
            z-index: 1000;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .offer-imges img {
            width: 90vw;
            height: 90vh;
            object-fit: contain;
        }

        .close-icon-box {
            position: absolute;
            background-color: white;
            z-index: 100;
            border-radius: 50%;
            cursor: pointer;
            top: 5%;
            right: 10%;
        }

        .close-icon-box i {
            color: #FF007F;
            font-size: 3.5rem;
        }

        @media (max-width: 400px) {
            .offer-imges {
                align-items: start;
            }

            .offer-imges img {
                height: 80vh;
            }

            .close-icon-box {
                top: 5%;
                right: 5%;
            }

            .close-icon-box i {
                font-size: 3rem;
            }
        }

    </style>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PD3FG3HH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
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
        <div class="view-more-box">
            <div class="heading-box">
                <h2 class="product-heading">OFFER</h2>
            </div>
            <div class="view-more">
                <a href="Category/ViewMoreProduct.php?Condition=OFFER">SHOP MORE<i class="bx bx-chevron-right"></i></a>
            </div>
        </div>
        <?php include('Assets/Slider/Friday Sale.php'); ?>
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
        <?php include('Assets/Slider/Product Slider 1.php'); ?>
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
        <?php include('Assets/Slider/Product Slider 2.php'); ?>
    </div>

    <div class="products recommanded">
        <h2 class="product-heading">Recommended For You</h2>
        <?php include('Assets/Slider/Product Slider 3.php'); ?>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="Assets/JS/Script.js"></script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "BreadcrumbList",
      "@id": "https://www.dreamskinnepal.com/#breadcrumblist",
      "itemListElement": [
        {
          "@type": "ListItem",
          "@id": "https://www.dreamskinnepal.com/#listItem",
          "position": 1,
          "name": "Home"
        }
      ]
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
      "image": { "@id": "https://www.dreamskinnepal.com/#organizationLogo" },
      "sameAs": [
        "https://facebook.com/Dream.Skin.Nepal/",
        "https://www.instagram.com/dream.skin.nepal/"
      ]
    },
    {
      "@type": "WebPage",
      "@id": "https://www.dreamskinnepal.com/#webpage",
      "url": "https://www.dreamskinnepal.com/",
      "name": "Best Korean Skincare Cosmetics Products in Nepal - Dream Skin Nepal",
      "description": "Dream Skin Nepal: Trusted for Korean Beauty. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online in Nepal.",
      "inLanguage": "en-US",
      "isPartOf": { "@id": "https://www.dreamskinnepal.com/#website" },
      "breadcrumb": { "@id": "https://www.dreamskinnepal.com/#breadcrumblist" },
      "datePublished": "2023-10-06T22:28:28+05:45",
      "dateModified": "2024-02-15T17:04:34+05:45"
    },
    {
      "@type": "WebSite",
      "@id": "https://www.dreamskinnepal.com/#website",
      "url": "https://www.dreamskinnepal.com/",
      "name": "Dream Skin Nepal",
      "description": "Trusted for Korean Beauty. Leading skincare, cosmetics, cruelty-free & vegan options. Free shipping over Rs. 5000. Shop online in Nepal.",
      "inLanguage": "en-US",
      "publisher": { "@id": "https://www.dreamskinnepal.com/#organization" },
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
    // document.querySelector('.close-icon-box').addEventListener('click', function() {
    //     document.querySelector('.offer-imges').remove();
    // });
    // document.addEventListener('click', function() {
    //     document.querySelector('.offer-imges').remove();
    // });
    setTimeout(function() {
        document.querySelector('.whatsapp').classList.add('show-whatsapp');
    }, 2000);
</script>

<script>
    !function(f, b, e, v, n, t, s) {
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
<noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1300972564192880&ev=PageView&noscript=1"
/ alt='meta pixel'></noscript>



