<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Account Configuration/Wishlist Configuration.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Wishlist.css">
    <title>Wishlist</title>
</head>

<body>
    <div class="wishlist-container">
        <div class="wishlist-product">
            <?php

            if ($result->num_rows > 0) {
        echo '<div class="flex px-5 py-3 text-gray-700 rounded-lg bg-gray-50  dark:bg-gray-800 dark:border-gray-700 Breadcrumb-box" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Wishlist</span>
                        </div>
                    </li>
                </ol>
            </div>';
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['ID'];
                    $product_title = $row['Product Title'];
                    $SlugUrl = $row['Slug Url'];
                    $price = $row['Product Price'];
                    $DiscountPrice = $row['Discount Price'];
                    $DiscountPercentage = $row['Discount Percentage'];
                    if ($DiscountPrice != '') {
                        $price = $DiscountPrice;
                    } 
                    else if ($DiscountPercentage != '') {
                    $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
                    $DiscountValue = $price - $DiscountValueCalculate;
                    $price = $DiscountValue;
                    }
                    $thumbnail_url = $row['ProductTmumbnail'];
                    echo " <div class='product-divider-wishlist'>
                <div class='wishlist-img'>
                    <a href='Product/$SlugUrl'><img src='$thumbnail_url'></a>
                </div>
               <div class='proudct-title'> <a href='Product/$SlugUrl'>$product_title</a></div>
                <div class='product-price'>Rs. $price</div>
                <div class='add-to-cart-btn-and-trash'>
                    <div class='wishlist-add-to-cart'>
                        <button class='add-to-cart-wishlist show-popup AddToCart' data-product-id='" . $row['ID'] . "'>ADD TO CART</button>
                    </div>
                    <div class='clear-btn'>
                        <i class='bx bx-trash deletefromwishlist' data-product-id='" . $row['ID'] . "'></i>
                    </div>
                </div>
            </div>";
                }
            } else {
                echo " <div class='cart-empty'>
        <div class='empty-cart-img'>
            <img src='Assets/Product/Media/Images/Logo/empty-cart.png'>
        </div>
        <p class='empty-cart-title'>No item in wishlist</p>
        <a href='/'><button class='continue-shopping'>Continue Shopping</button></a>
    </div>";
            }
            ?>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Wishlist.js"></script>

</html>