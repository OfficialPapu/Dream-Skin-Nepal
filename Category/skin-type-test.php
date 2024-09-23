<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Skintype test - Dream Skin Nepal</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Product Style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .DocBody {
            background-color: #d7f4ff;
            background-image: radial-gradient(at 47% 33%,
                    hsl(156, 0%, 100%) 0,
                    transparent 59%),
                radial-gradient(at 82% 65%, hsl(330.27, 81%, 74%) 0, transparent 55%);
            height: 100vh;
        }

        .CardSkintype {
            backdrop-filter: blur(13px) saturate(200%);
            -webkit-backdrop-filter: blur(13px) saturate(200%);
            background-color: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(209, 213, 219, 0.3);
        }

        @media (max-width:600px) {
            .DocBody {
                height: auto;
            }

            .CardSkintype {
                background-color: rgba(255, 255, 255, 0.8);
            }
        }

        .heading-box::after {
            content: '';
            position: absolute;
            height: 3px;
            width: 60%;
            left: 0.5rem;
            bottom: -5px;
            background-color: #00ADEF;
            transition: .4s;
        }

        .heading-box:hover:after {
            width: calc(100% - 1rem);
        }
    </style>
</head>

<body class="DocBody">
    <div class="flex justify-center items-center md:mb-0 mb-[6rem] md:mt-[1rem]" id="body">
        <div class="w-[100vw] md:max-w-3xl rounded-lg shadow-lg p-4 md:p-8 CardSkintype !pb-12">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm font-medium text-muted-foreground">
                    Question <span id="QuestionNo">0</span> / 10
                </div>
                <div class="flex justify-center items-center cursor-pointer hover:text-[#00adef]">
                    <button class="text-sm font-medium text-muted-foreground hover:text-muted transition-colors" id="Finishlater">
                        Finish later
                    </button>
                    <i class="bx bx-x text-3xl"></i>
                </div>
            </div>
            <div class="relative w-full h-2 bg-[#f4f4f4] rounded-full mb-2">
                <div class="absolute top-0 left-0 h-full bg-[#ff007f] rounded-full" style="width: 10%" id="ProgressBar"></div>
            </div>
            <div class="text-center text-sm text-muted-foreground mb-8" id="ProgressPercentage">0%</div>
            <h2 class="text-center text-2xl font-bold mb-8 text-[#00adef]" id="Question"></h2>
            <div class="grid grid-cols-1 gap-2 md:gap-4 md:grid-cols-2 mt-10" id="Option"></div>
        </div>
    </div>
    <div class="hidden" id="Recommendation">
        <div class="heading-box relative inline-block cursor-pointer p-2">
            <h2 class="text-[#ff4da6] text-3xl font-bold">Recommendation</h2>
        </div>
        <div class='product-main-container-brands' id="Result"></div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Product Script.js"></script>
<script src="Assets/JS/Skintype Test.js"></script>
</html>