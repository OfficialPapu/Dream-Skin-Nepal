<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/Dream Skin Nepal/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
ChangeUrl();
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title></title>
    <style>
        .offer-summary {
            background-color: #d7f4ff;
            background-image:
                radial-gradient(at 47% 33%, hsl(156.00, 0%, 100%) 0, transparent 59%),
                radial-gradient(at 82% 65%, hsl(330.27, 81%, 74%) 0, transparent 55%);
        }

        .card {
            backdrop-filter: blur(13px) saturate(200%);
            -webkit-backdrop-filter: blur(13px) saturate(200%);
            background-color: rgba(255, 255, 255, 0.66);
            border: 1px solid rgba(209, 213, 219, 0.3);
        }

        /* .offer-summary {
            background-color: #111927;
            background-image:
                radial-gradient(at 47% 33%, hsl(218.18, 39%, 11%) 0, transparent 59%),
                radial-gradient(at 82% 65%, hsl(230.29, 61%, 22%) 0, transparent 55%);
        }

        .card {
            backdrop-filter: blur(16px) saturate(200%);
            -webkit-backdrop-filter: blur(16px) saturate(200%);
            background-color: rgba(17, 25, 40, 0.73);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.125);
        } */
    </style>
</head>

<body>
    <!-- <div class="flex flex-col items-start gap-2 my-4">
        <div class="w-full rounded-full bg-muted">
            <div class="h-1 rounded-full bg-[#ff007f]" style="width: 60%;"></div>
        </div>
    </div> -->
    <div class="brand-heading-box">
        <div class="product-type-heading">
            <h1><span id="SetName"></span><div class="designing-line"></div>
            </h1>
        </div>
    </div>
    <div>
    <div class='product-main-container-brands'></div>
        <div class="offer-summary mb-[6rem] md:mb-[0rem]">
            <div class="w-full bg-background px-4 py-6 md:px-6 md:py-8 card">
                <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-6 items-center">
                    <div class="grid gap-2">
                        <div class="flex items-center gap-4">
                            <div class="text-4xl font-bold text-[#ff007f]">Rs. 99.99</div>
                            <div class="text-2xl font-bold text-[#00adef] line-through" style="text-decoration-color:#ff007f; -webkit-text-decoration-color:#ff007f;">Rs. 149.99</div>
                            <div class="bg-[#ff007f] text-white px-3 py-1 rounded-full text-sm font-medium">3% OFF</div>
                        </div>
                        <p class="text-[#6e6e76]">You're saving <span class="font-bold text-[#00adef]">Rs. 50</span> on this purchase!</p>
                    </div>
                    <div class="flex items-center justify-end gap-4">
                        <button class="text-md text-[#ff007f] font-500 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-[#00adef] bg-background h-11 rounded-md px-8 hover:bg-[#00adef] hover:text-white duration-300" id="Next">Next</button>
                        <button class="text-md font-500 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 h-11 rounded-md px-8 bg-[#ff007f] text-white hover:bg-[#ff007f]/90" id="Previous">Previous</button>
                    </div>
                </div>
            </div>
        </div>
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