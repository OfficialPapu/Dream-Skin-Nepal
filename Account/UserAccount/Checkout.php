<?php
@session_name('LoginSession');
@session_name('URLSession');
@session_start();
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Account Configuration/Checkout Configuration.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Checkout.css">
</head>

<body>
    <form method="POST">
        <div class="cart-page-container">
            <div class="overlay"></div>
            <div class="cart-product">
                <div class="cart-product-data">
                    <div class="address-select-box">
                        <div class="user-address">
                            <div class="address-container">
                                <div class="user-data">
                                    <div class="address-title">
                                        <p class="title-new-add">Add New Address</p>
                                        <p><i class='bx bx-x add-close-btn'></i></p>
                                    </div>
                                    <p class='review-shipping-add'><i>*Note : Confirm your shipping address</i></p>
                                    <div class="add-input">
                                        <div class="data-check"><input type="hidden" class="check-data-filled" value="<?php if(isset($_SESSION['user_data_confirm-name'])){
                                            echo $_SESSION['user_data_confirm-name'];
                                        }else{ echo ''; }?>"></div>
                                        <div class="user-name"><input type="text" placeholder="Full Name" class="user-name-data"></div>
                                        <div class="user-number"><input type="text" placeholder="Phone" class="user-number-data"></div>
                                        <div class="user-city"><input type="text" placeholder="City" class="user-city-data"></div>
                                        <div class="user-address-field"><input type="text" placeholder="Address" class="user-address-data"></div>
                                    </div>
                                    <div class="data-send-btn"><button class="data-submit-btn">Submit</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($result->num_rows > 0) {
                        echo '<div class="flex px-5 py-3 text-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 Breadcrumb-box" aria-label="Breadcrumb">
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
                                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <a href="Account/UserAccount/Cart.php" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Cart</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Checkout</span>
                                </div>
                            </li>
                        </ol>
                    </div>';
                        $shippingFeeQuery = "SELECT `Shipping Fee` AS totalShippingFee FROM `product_cart` WHERE `User ID`='$user_id'";
                        $shippingFeeResult = $conn->query($shippingFeeQuery);
                        $shippingFeeRow = $shippingFeeResult->fetch_assoc();
                        $TotalPrice += $shippingFeeRow['totalShippingFee'];
                        $AddedShippingFeeValue = $shippingFeeRow['totalShippingFee'];
                        if (isset($_SESSION['user_data_confirm-add'])) {
                            echo "<div class='select-address'>
                            <p class='select-address-first-p'>" . $_SESSION['user_data_confirm-name'] . "</p>
                            <p class='select-address-second-p'>" . $_SESSION['user_data_confirm-add'] . "</p>
                            </div>";
                        } else {
                            echo "<div class='select-address'>
                            <p class='select-address-first-p'>Address not selected</p>
                            <p class='select-address-second-p'>Click to add your delivery address</p>
                            </div>";
                        }
                        while ($row = $result->fetch_assoc()) {
                            $product_id = $row['ID'];
                            $product_title = $row['Product Title'];
                            $SlugUrl = $row['Slug Url'];
                            $price = $row['Product Price'];
                            $DiscountPrice = $row['Discount Price'];
                            $DiscountPercentage = $row['Discount Percentage'];
                            if($DiscountPrice != ''){
                                $price=$DiscountPrice;
                            }else if ($DiscountPercentage != '') {
                            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
                            $DiscountValue = $price - $DiscountValueCalculate;
                            $price = $DiscountValue;
                            }
                            
                            $productqty = $row['CartQuantity'];
                            $thumbnail_url = $row['ProductTmumbnail'];
                            echo " <div class='product-divider'>
                                <div class='cart-product-image'>
                                    <a href='Product/$SlugUrl'><img src='$thumbnail_url'></a>
                                </div>
                                <div class='product-title'>
                                <a href='Product/$SlugUrl'>$product_title</a>
                                </div>
                                <div class='product-price'>
                                    Rs. $price
                                </div>
                                <div class='quantity-increase'>
                                    <span class='product-quantity'>$productqty</span>
                                </div>
                            </div>";
                        }
                        echo "</div>
                        </div>
                        <div class='product-summary'>
                            <p class='summary'><i class='bx bx-shopping-bag'></i>Order Summary</p>
                            <div class='total-price'>
                                <div class='order-total'>
                                    <p>Orders Total:</p>
                                    <p class='price order-total-price'>Rs. $TotalPrice</p>
                                </div>
                                <div class='Shipping'>
                                    <p class='shipping-title'>Shipping Fee</p>
                                    <span class='price'>Rs. $AddedShippingFeeValue</span>
                                </div>
                                <div class='grand-total'>
                                    <p>Grand Total:</p>
                                    <p class='price grand-total-price'>Rs. $TotalPrice</p>
                                </div>
                            </div>
                            <hr class='first-hr'>
                            <div class='coupon-code'>
                                <input type='text' placeholder='Enter your coupon'>
                                <button>Apply</button>
                            </div>
                            <div class='payment-method'>
                                <h3>Select Payment Method</h3>
                                <p class='payment-method-error'>Payment Method Is Required</p>
                                <div class='payment-images'>
                                    <div class='cod'>
                                        <img src='Assets/Product/Media/Images/Logo/cash on delivery.webp' alt=''>
                                        <i class='bx bx-check check-icon-1'></i>
                                    </div>
                                    <div class='e-sewa'>
                                        <img src='Assets/Product/Media/Images/Logo/e-sewa.webp' alt=''>
                                        <i class='bx bx-check check-icon-2'></i>
                                    </div>
                                </div>
                            </div>
                            <div class='checkout'>
                               <button type='submit' class='checkout-btn' name='submit-order'>PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>";
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
<script src="Assets/JS/Checkout.js"></script>
</html>