<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
ChangeUrl();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Product Style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title></title>
    <style>
        .custom-look-up-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .custom-look-up-button:hover {
            background-color: #45a049;
        }

        .custom-cancel-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .custom-cancel-button:hover {
            background-color: #e53935;
        }

        .custom-input {
            border: 2px solid #4CAF50;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
        }

        .custom-input::placeholder {
            color: #9e9e9e;
        }

        .custom-success-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .custom-success-button:hover {
            background-color: #45a049;
        }

        .custom-look-up-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .custom-look-up-button:hover {
            background-color: #45a049;
        }

        .custom-cancel-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .custom-cancel-button:hover {
            background-color: #e53935;
        }

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
    <div class="brand-heading-box md:mt-4 mt-2">
        <div class="product-type-heading">
            <h1><span id="SetName"></span>
                <div class="designing-line"></div>
            </h1>
        </div>
    </div>

    <div>
        <div class='product-main-container-brands'></div>
        <div class="offer-summary mb-[6rem] md:mb-[0rem]">
            <div class="w-full bg-background px-4 py-6 md:px-6 md:py-8 card">
                <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-6 items-center">
                    <div class="grid gap-2 hide-box"></div>
                    <div class="flex items-center justify-end gap-4">
                        <button class="text-md text-[#ff007f] font-500 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-[#00adef] bg-background h-11 rounded-md px-8 hover:bg-[#00adef] hover:text-white duration-300" id="Next">Next</button>
                        <button class="text-md font-500 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 h-11 rounded-md px-8 bg-[#ff007f] text-white hover:bg-[#ff007f]/90" id="Previous">Previous</button>
                    </div>
                </div>
            </div>
        </div>

</body>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Product Script.js"></script>
<script src="Assets/JS/SkinType.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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