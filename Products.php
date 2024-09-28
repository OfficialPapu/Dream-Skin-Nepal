<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/Dream Skin Nepal/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Configuration/Product Detail Config.php';
$canonical_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION["StockStatus"] = "InStock";
$limited_title = "Abib Collagen Eye Creme Jericho Rose Tube for Dark Circles and Puffiness";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Swiper demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="Assets/CSS/Product Detail.css"> -->

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Nunito Sans', sans-serif;
            box-sizing: border-box;
        }

        *:focus {
            outline: none;
        }

        .shadow-none {
            box-shadow: none !important;
        }

        html,
        body {
            overflow-x: hidden;
        }

        .wrapper {
            display: grid;
            grid-template-columns: 33vw 55vw;
            margin-left: 15px;
            justify-content: center;
        }

        .image-box {
            display: grid;
            grid-template-columns: 50px auto;
        }

        @media (max-width:1450px) {
            .wrapper {
                grid-template-columns: 38vw 62vw;
            }
        }

        @media (max-width:1250px) {
            .wrapper {
                grid-template-columns: 45vw 55vw;
            }
        }

        @media (max-width:1080px) {
            .wrapper {
                grid-template-columns: 50vw 50vw;
            }
        }

        @media (max-width:970px) {
            .wrapper {
                grid-template-columns: 55vw 45vw;
            }
        }

        @media (max-width:865px) {
            .mySwiper {
                display: none;
            }

            .wrapper {
                flex-direction: column;
                grid-template-columns: 100vw;
            }

            .image-box {
                grid-template-columns: 100vw;
            }
        }

        .mySwiper .swiper-slide-thumb-active img {
            border-radius: 4px;
        }

        .mySwiper .swiper-slide-thumb-active {
            border: 2px solid #FF007F;
            padding: 2px;
            transition: 0.05s;
        }

        .mySwiper {
            z-index: 10;
            background-color: white;
            padding-right: 5px;
        }

        .discountvalue {
            text-decoration: line-through;
            text-decoration-color: #FF007F;
            -webkit-text-decoration-color: #FF007F;
        }

        .share-link-box {
            display: flex;
            flex-direction: column;
            position: absolute;
            right: 108%;
            top: 50%;
            width: 300px;
            gap: 10px;
            background-color: white;
            box-shadow: 0 0 10px rgba(255, 0, 128, 0.1);
            border-radius: 20px;
            padding: 20px;
            transform: scale(0);
        }

        .share-link-box.active {
            transform: translateY(-50%) scale(1);
        }

        .share-wishlist {
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
        }

        .share-wishlist .WishlistBtn {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            height: 40px;
            width: 40px;
            line-height: 22px;
            border-radius: 50%;
            padding: 3px;
            background-color: white;
            color: #FF007F;
            transition: .3s;
            cursor: pointer
        }

        .ShareBtn {
            color: #FF007F;
            font-size: 2rem;
            cursor: pointer;
            transition: .8s;
            transform-origin: center;
        }

        #npm-install-copy-button {
            padding-right: 40px;
        }

        .ShareBtn.active {
            transform: rotate(180deg);
        }

        @media (max-width:500px) {
            .share-link-box.active {
                top: 100%;
                right: 50%;
                transform: translateY(0%);
                width: 270px;
            }
        }
    </style>
</head>

<body>
    <nav aria-label="Breadcrumb" class="flex px-5 py-3 text-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 mt-[10px] mb-[20px] w-1[100vw]">
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
    <div class="wrapper relative">
        <div class="image-box h-[400px]">
            <div thumbsSlider="" class="swiper mySwiper relative h-[100%] w-[60px]">
                <div class="swiper-wrapper">
                    <div class="swiper-slide overflow-hidden rounded-[4px] h-[60px] w-[60px] grid place-items-center">
                        <img src="https://picsum.photos/800/610" class="relative object-cover w-[100%] h-[100%]">
                    </div>
                    <div class="swiper-slide overflow-hidden rounded-[4px] h-[60px] w-[60px] grid place-items-center">
                        <img src="https://picsum.photos/800/640" class="relative object-cover w-[100%] h-[100%]">
                    </div>
                    <div class="swiper-slide overflow-hidden rounded-[4px] h-[60px] w-[60px] grid place-items-center">
                        <img src="https://picsum.photos/800/601" class="relative object-cover w-[100%] h-[100%]">
                    </div>
                    <div class="swiper-slide overflow-hidden rounded-[4px] h-[60px] w-[60px] grid place-items-center">
                        <i class='bx bx-play-circle text-4xl absolute z-[1] text-white'></i>
                        <video class="relative object-cover w-[100%] h-[100%]">
                            <source src="VD.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <div class="swiper mySwiper2 w-[100%]">
                <div class="swiper-wrapper">
                    <div class="swiper-slide grid justify-center"><img src="https://picsum.photos/800/610"
                            class="h-[400px] w-[400px] rounded-[8px] object-cover"></div>
                    <div class="swiper-slide grid justify-center"><img src="https://picsum.photos/800/640"
                            class="h-[400px] w-[400px] rounded-[8px] object-cover"></div>
                    <div class="swiper-slide grid justify-center"><img src="https://picsum.photos/800/601"
                            class="h-[400px] w-[400px] rounded-[8px] object-cover"></div>
                    <div class="swiper-slide grid justify-center">
                        <video class="h-[400px] w-[400px] rounded-[8px] object-cover" controls muted>
                            <source src="VD.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-box">
            <h1 class='product-title text-3xl'>Abib Collagen Eye Creme Jericho Rose Tube for Dark Circles and Puffiness
            </h1>
            <hr class="my-2">
            <div class="mb-4">
                <table>
                    <tbody>
                        <tr>
                            <td class="p-1 w-[120px]"> <span>Brand</span> </td>
                            <td class="p-1"> <span>NEEDLY</span> </td>
                        </tr>
                        <tr>
                            <td class="p-1 w-[120px]"> <span>Category</span> </td>
                            <td class="p-1"> <span>SkinCare : Ampoule</span> </td>
                        </tr>
                        <tr>
                            <td class="p-1 w-[120px]"> <span>Skin Type</span> </td>
                            <td class="p-1"> <span>Acne, Sebum, Sensitive</span> </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between w-[80%]">

                <div class="price-box">

                    <!-- DiscountPrice -->
                    <!-- <div>
                    <p class='text-[1.8rem] text-[#FF007F] font-bold'>Rs 1209.00</p>
                    <p class='text-[#00ADEF] font-bold text-[1.2rem]'><span class='discountvalue'>Rs 100.00</span> - Rs.
                        50.00</p>
                </div> -->

                    <!-- DiscountPercentage -->
                    <div>
                        <p class='text-[1.8rem] text-[#FF007F] font-bold'>Rs 1289.00</p>
                        <p class='text-[#00ADEF] font-bold text-[1.2rem]'><span class='discountvalue'>Rs 1289.00</span>
                            -10%</p>
                    </div>

                    <!-- NORMAL -->
                    <!-- <p class='text-[1.8rem] text-[#FF007F] font-bold'>Rs 1285.00</p> -->

                </div>

                <div class="share-wishlist">
                    <i class='bx bx-share-alt ShareBtn'></i>
                    <div class="share-link-box z-[100]">
                        <div class="flex w-[100%] justify-evenly">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $canonical_url; ?>"><i
                                    class="fa-brands fa-facebook pointer text-[2rem]" style="color: #4268b3;"></i></a>
                            <a href="fb-messenger://share?link=<?php echo urlencode($canonical_url); ?>"><i
                                    class="fa-brands fa-facebook-messenger pointer text-[2rem]"
                                    style="color: #183153;"></i></a>
                            <a href="https://api.whatsapp.com/send?text=<?php echo $canonical_url; ?>"><i
                                    class="fa-brands fa-whatsapp pointer text-[2rem]" style="color: #25d366;"></i></a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo $canonical_url; ?>"><i
                                    class="fa-brands fa-twitter pointer text-[2rem]" style="color: #1da1f2;"></i></a>
                            <a href="https://www.instagram.com/?url=<?php echo $canonical_url; ?>"><i
                                    class="fa-brands fa-instagram pointer text-[2rem]"></i></a>

                        </div>
                        <div class="clipboard">
                            <div class="w-full max-w-100">
                                <div class="relative">
                                    <input id="npm-install-copy-button" type="text"
                                        class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        value="<?php echo $canonical_url; ?>" readonly>
                                    <button
                                        class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center"
                                        data-clipboard-target="#npm-install-copy-button" id="copy-button">
                                        <span id="default-icon">
                                            <svg class="w-3.5 h-3.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 18 20">
                                                <path
                                                    d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                                            </svg>
                                        </span>
                                        <span id="success-icon" class="hidden inline-flex items-center">
                                            <svg class="w-3.5 h-3.5 text-blue-700 dark:text-blue-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M1 5.917 5.724 10.5 15 1.5" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <i class='bx bx-heart WishlistBtn AddToWishlistProductDetail'></i>
                    <!-- <i class='bx bxs-heart WishlistBtn AddToWishlistProductDetail'></i> -->
                </div>
            </div>

            <div class='flex flex-col mt-[20px] justify-center items-start w-[250px] gap-[20px]'>
                <div class="flex justify-start items-center w-[500px] gap-[20px]">
                    <div
                        class="flex items-center rounded-[10px] overflow-hidden bg-[#fff] shadow-[0_0_10px_rgba(255,0,128,0.1)]">
                        <button id="decrease"
                            class="bg-white w-[50px] h-[40px] pointer text-[20px] grid place-items-center"><i
                                class='bx bx-minus'></i></button>
                        <div class="bg-[#cccccc80] h-[50px] w-[1px]"></div>
                        <input type="text" id="quantity" value="1"
                            class='w-[59px] h-[40px] border-none text-center text-[18px] shadow-none' readonly>
                        <div class="bg-[#cccccc80] h-[50px] w-[1px]"></div>
                        <button id="increase"
                            class="bg-white w-[50px] h-[40px] pointer text-[20px] grid place-items-center"><i
                                class='bx bx-plus'></i></button>
                    </div>
                    <!-- <p>In stock</p> -->
                    <!-- <p>Only 5 unit left</p> -->
                    <p class='text-[red]'>Out of Stock</p>
                </div>
                <div class='flex items-center justify-center gap-[20px]'>
                    <button class='w-[225px] h-[44px] border-none outline-none rounded-md bg-[#00ADEF] text-white cursor-pointer transition duration-300 text-base BuyNow'>Buy Now</button>
                    <button class='w-[225px] h-[44px] border-none outline-none rounded-md bg-[#FF007F] text-white cursor-pointer transition duration-300 text-base AddToCart'>Add to Cart</button>
                </div>
            </div>

        </div>
 
    </div>
    <div class='product-description w-[100vw] px-4'>
            <h2 class='text-2xl mt-10 mb-1 text-[#00ADEF] font-bold'>About this item</h2>
            <p class='leading-[30px]'><?php echo nl2br('
 [🧹GENTLE YET POTENT CLEANSING OIL🧹] Effective in eliminating makeup residue, blackheads and sebum, whilst preventing pore congestion. Essential step for double cleansing, with glowy glass skin results.[👀 GENTLE ON THE EYES👀] No eye stinging experiences when used around eyes, Eye Irritation Test (Cruelty Free HET-CAM Test) completed [🌚DEEP PORE CLEANSING FOR ALL SKIN TYPES🌚]: Creates a delicate light foam infused with Heartleaf Extract, [😀GENTLE EXFOLIATION😀]: Contains 3,000ppm Heartleaf powder which helps to gently clear deep within the pores, exfoliate dead skin cells and effectively clear any impurities.'); ?></p>
        </div>  

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            direction: "vertical",
            loop: true,
            slidesPerView: 6,
            spaceBetween: 10,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });

        const clipboard = new ClipboardJS('#copy-button');
        clipboard.on('success', function(e) {
            showSuccess();
            setTimeout(() => {
                resetToDefault();
            }, 2000);
            e.clearSelection();
        });

        const showSuccess = () => {
            document.getElementById('default-icon').classList.add('hidden');
            document.getElementById('success-icon').classList.remove('hidden');
        }

        const resetToDefault = () => {
            document.getElementById('default-icon').classList.remove('hidden');
            document.getElementById('success-icon').classList.add('hidden');
        }

        $('.ShareBtn').click(function(e) {
            e.preventDefault();
            $(this).toggleClass('active');
            $('.share-link-box').toggleClass('active');
        });
        $('#increase').click(function(e) {
            let CurrentValue = $("#quantity").val();
            CurrentValue++;
            $("#quantity").val(CurrentValue);
        });
        $('#decrease').click(function(e) {
            let CurrentValue = $("#quantity").val();
            if (CurrentValue > 1) {
                CurrentValue--;
                $("#quantity").val(CurrentValue);
            }
        });
    </script>
</body>

</html>

