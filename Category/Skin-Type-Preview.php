<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Account Configuration/Skin-Type-Preview-Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bundle Cart</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Cart.css">
</head>

<body>
    <div class='cart-page-container'>
        <div class='cart-product'>
            <div class='cart-product-data'>
                <?php
                if ($result->num_rows > 0) {
                    echo '<div class="flex px-5 py-3 text-gray-700 rounded-lg bg-gray-50  dark:bg-gray-800 dark:border-gray-700 Breadcrumb-box" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="/Dream Skin Nepal/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Bundle Cart</span>
                      </div>
                    </li>
                    </ol>
                </div>';
                    while ($row = $result->fetch_assoc()) {
                        $product_id = $row['ID'];
                        $SlugUrl = $row['Slug Url'];
                        $product_title = $row['Product Title'];
                        $price = $row['Product Price'];
                        $DiscountPrice = ceil($row['TotalDue']);
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
                        } else {
                            echo "<div class='product-price'>Rs. $price.00</div>";
                        }

                        echo "<div class='text-center w-[80px]'>
                        <span class='product-quantity text-center '>" . $productqtyforcart . "</span> 
                        <span class='text-xs'>Qty</span>
                        </div>
                </div>
            </div>";
                    }
                ?>
            </div>
        </div>

        <div class='product-summary'>
            <div class="rounded-lg bg-card text-card-foreground shadow-sm w-full max-w-2xl">
                <div class="flex justify-center items-center p-6 gap-[10px]">
                    <i class='bx bx-shopping-bag text-2xl mt-[-4px] text-[#00ADEF]'></i>
                    <h3 class="text-2xl font-semibold leading-none tracking-tight text-[#FF007F]">Order Summary</h3>
                </div>
                <div class="p-3 grid gap-4" data-id="4">
                    <div class="flex items-center justify-between" data-id="5">
                        <span>Subtotal</span>
                        <span id="SubTotal">Rs. <?php echo $TotalPrice; ?>.00</span>
                    </div>

                    <div class="grid gap-2">
                        <span class="font-medium">Shipping</span>


                        <div class="grid gap-2" id='shippingOptions'>
                            <label class="text-sm font-medium flex items-center justify-between rounded-md border border-muted px-4 py-3 cursor-pointer" for="Outside-Valley">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" class="mt-[-2px]" value="outside-valley" id="Outside-Valley" name='Shipping-rate'></input>
                                    Outside Valley
                                </div>
                                <span>Rs. 200</span>
                            </label>
                            <label class="text-sm font-medium flex items-center justify-between rounded-md border border-muted px-4 py-3 cursor-pointer" for="Inside-Valley">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" class="mt-[-2px]" id="Inside-Valley" name='Shipping-rate'></input>
                                    Inside Valley
                                </div>
                                <span>Rs. 100</span>
                            </label>
                            <label class="text-sm font-medium flex items-center justify-between rounded-md border border-muted px-4 py-3 cursor-pointer" for="Collect-From-Store">
                                <div class="flex items-center justify-center gap-2">
                                    <input type="checkbox" class="mt-[-2px]" id="Collect-From-Store" name='Shipping-rate'></input>
                                    Collect From Store
                                </div>
                                <span>Rs. 0</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between CouponCodeBox hidden">
                            <span>Coupon</span>
                            <span class="text-green-500 PromoCode"></span>
                        </div>
                        <div class="flex items-center justify-between CouponValueBox hidden">
                            <span>Coupon Value</span>
                            <span class="text-green-500 CouponValue"></span>
                        </div>
                        <div class="flex items-center justify-between TotalSavedBox hidden">
                            <span>Total Saved</span>
                            <span class="text-green-500 TotalSavedData font-bold"></span>
                        </div>
                        <?php
                        if ($TotalPrice != $TotalSaved) {
                            echo "<div class='flex justify-between font-medium' id='TotalSavedInitial'>
                            <span>Total Saved</span>
                            <span class='text-green-500 font-bold'>Rs. $SavedAmount.00</span>
                        </div>";
                        }
                        ?>
                        <div class="flex justify-between font-medium">
                            <span>Grand Total</span>
                            <span id="GrandTotal" class="text-[#FF5200] font-bold">Rs. <?php echo $TotalPrice; ?>.00</span>
                        </div>
                        <div class="flex flex-col items-center justify-between text-green-500 FreeShippingBox hidden">
                            <span>Congrats, you got free shipping!</span>
                            <span>Purchase over 3500.</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center my-7">
                    <button class='checkout-btn bg-[#FF007F] py-3 w-[70%] rounded-md text-white'>PROCEED TO CHECKOUT</button>
                </div>
            </div>
        </div>

    <?php
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="Assets/JS/Skin-Type-Previews.js"></script>

</html>