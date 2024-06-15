<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Account Configuration/Cart Configuration.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping Cart</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Cart.css">
</head>

<body>
    <div class='cart-page-container'>
        <div class='cart-product'>
            <div class='cart-product-data'>
                <?php
                if ($result->num_rows > 0) {
                echo'<div class="flex px-5 py-3 text-gray-700 rounded-lg bg-gray-50  dark:bg-gray-800 dark:border-gray-700 Breadcrumb-box" aria-label="Breadcrumb">
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
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Shipping Cart</span>
                      </div>
                    </li>
                    </ol>
                </div>';
                    while ($row = $result->fetch_assoc()) {
                        $product_id = $row['ID'];
                        $SlugUrl = $row['Slug Url'];
                        $product_title = $row['Product Title'];
                        $price = $row['Product Price'];
                        $DiscountPrice = $row['Discount Price'];
                        $AddedInWishlist = $row['IsAddedToWishlist'];
                        $DiscountPercentage = $row['Discount Percentage'];
                        $productqtyforcart = $row['CartQuantity'];
                        $thumbnail_url = $row['ProductTmumbnail'];
                        echo "<div class='product-divider'>
                        <div class='image-and-title'> 
                        <a href='Product/$SlugUrl'>
                        <div class='cart-product-image'>
                            <img src='$thumbnail_url'>
                        </div>
                        <div class='product-title'>$product_title</div>
                        </a>
                        </div>
                        <div class='price-and-quantity'>";
                        if ($DiscountPrice != '') {
                        echo "<div class='product-price-box'>
                        <div class='product-non-discount-price product-price'>Rs. $price.00</div>
                        <div class='product-discount-price product-price'>Rs. $DiscountPrice.00</div>
                        </div>";
                        } else if ($DiscountPercentage != '') {
                            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
                            $DiscountValue = $price - $DiscountValueCalculate;
                        echo "<div class='product-price-box'>
                        <div class='product-non-discount-price product-price'>Rs. $price.00</div>
                        <div class='product-discount-price product-price'>Rs. $DiscountValue.00</div>
                        </div>";
                            
                        }else{
                         echo "<div class='product-price'>Rs. $price.00</div>";
                        }
                
               echo "<div class='quantity-increase' data-product-id-plus-minus='" . $product_id . "'>
                    <span class='minusButtons'>-</span>
                    <span class='product-quantity'>" . $productqtyforcart . "</span> 
                    <span class='plusButtons'>+</span>
                </div>
                </div>
                <div class='line-divider'></div>
                <div class='clear-add-to-wishlist'>
                <div class='clear-btn'>
                    <i class='bx bx-trash delete-item cart-delete-item' id='cart-close-btn' data-product-id='" . $product_id . "'><div class='hide-in-desktop remove-text'>Remove?</div></i> 
                </div>
                <div class='add-to-wishlist hide-in-desktop'>";
                 if ($AddedInWishlist == 'Not Added') {
                            echo "<i class='bx bx-heart AddToWishlist AddToWishlist-1' data-product-id-wishlist='" . $row['ID'] . "'></i>";
                        } else if ($AddedInWishlist == 'Added') {
                            echo "<i class='bx bxs-heart AddToWishlist AddToWishlist-1' data-product-id-wishlist='" . $row['ID'] . "'></i>";
                        }
                    echo "</div>
                </div>
            </div>";
                    }

                    echo "  </div>
</div>
<div class='product-summary'>
    <p class='summary'><i class='bx bx-shopping-bag'></i>Order Summary</p>
    <div class='total-price'>
        <div class='order-total'>
            <p>Sub Total:</p>
            <p class='price order-total-price total'>Rs. $TotalPrice</p>
        </div>
        <div class='Shipping'>
            <p class='shipping-title'>Shipping Fee</p>
            <ul id='shippingOptions'>
                <li>
                    <input type='checkbox' name='Shipping-rate' id='Outside-Valley'>
                    <label for='Outside-Valley'>Outside Valley: <span class='price'>Rs. 200</span></label>
                </li>
                <li>
                    <input type='checkbox' name='Shipping-rate' id='Inside-Valley'>
                    <label for='Inside-Valley'>Inside Valley: <span class='price'>Rs. 100</span></label>
                </li>
                <li>
                    <input type='checkbox' name='Shipping-rate' id='Collect-From-Store'>
                    <label for='Collect-From-Store'>Collect From Store: <span class='price'>Rs. 0</span></label>
                </li>
            </ul>
        </div>
        <div class='promo-applied'>
        <p>Promo Applied</p>
        <p class='promo-code'></p>
        </div>
        <div class='discount-data'>
        <p>Discount</p>
        <p class='discount-price'></p>
        </div>
        <div class='grand-total'>
            <p>Grand Total:</p>
            <p class='price grand-total-price total'>Rs. $TotalPrice</p>
        </div>
    </div>
    <hr class='first-hr'>
    <div class='coupon-code'>
        <input type='text' placeholder='Enter your coupon' class='couponcode'>
        <button id='applycode'>Apply</button>
    </div>
    <div class='checkout'>
        <button class='checkout-btn'>PROCEED TO CHECKOUT</button>
    </div>
</div>
 </div>";
                } else {
                    echo " <div class='cart-empty'>
        <div class='empty-cart-img'>
            <img src='Assets/Product/Media/Images/Logo/empty-cart.png'>
        </div>
        <p class='empty-cart-title'>No item in cart</p>
        <a href='/'><button class='continue-shopping'>Continue Shopping</button></a>
    </div>";
}
 ?>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Cart.js"></script>

</html>