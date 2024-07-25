<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/Dream Skin Nepal/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . "Assets/PHP/Configuration/Combo Set Config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Product Style.css">
    <title><?php echo $ProductTypeName; ?> - Dream Skin Nepal</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="/" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">SkinCare Set</a>
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
    </div>
    <div>
        <?php
        ComboSetProduct($result, $base_url, $is_mobile, $conn);
        ?>
        <div class="rounded-lg text-card-foreground max-w-[500px] bg-background border-muted shadow-md mb-2 mx-auto">
            <div class="flex flex-col gap-4 p-6">
                <div>
                    <h3 class="text-xl font-bold">Add to Cart</h3>
                    <p class="text-muted-foreground text-sm">Get this item added to your cart</p>
                </div>

                <div class="flex items-center justify-between">
                    <div class="grid gap-1">
                        <p class="text-muted-foreground text-sm">Total Price</p>
                        <h4 class="text-2xl md:text-3xl font-bold">Rs. 8764.00</h4>
                    </div>
                    <div class="grid gap-1 text-right">
                        <p class="text-muted-foreground text-sm">You Save</p>
                        <h4 class="text-2xl md:text-3xl font-bold text-green-500">Rs. 9834.00</h4>
                    </div>
                </div>
                <div>
                    <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-11 rounded-md shrink-0 px-6 py-3 bg-[#ff007f] text-white w-full" id="AddToCart">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <?php
        include_once $base_url . 'Assets/Components/Footer.php';
        ?>
    </footer>
</body>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Product Script.js"></script>
<script src="Assets/JS/Combo Set.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-10828634041"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'AW-10828634041');
</script>

</html>