<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Admin Navbar.php';
include $base_url . 'Assets/PHP/Admin/Order Detail Page Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Order Detail Page.css">
    <title>Order Detail Page</title>
</head>

<body>
    <div class="order-detail-container">
        <div class="order-detail-box">
            <div class="cart-total-and-order-list">
                <div class="order-item-list">
                    <div class="order-heading">
                        All items
                    </div>
                    <div class="order-items">
                        <?php
                        if ($AllItems->num_rows > 0) {
                            while ($Row = $AllItems->fetch_assoc()) {
                                $Image = $Row['ImagePath'];
                                $Quantity = $Row['Quantity'];
                                $ProductTitle = $Row['Product Title'];
                                $TrackingNumber =  $Row['TrackingNumber'];
                                $PerProductPrice=$Row['PerProductPrice'];
                        ?>
                                <ul>
                                    <li>
                                        <div class="product-img">
                                            <img src='<?php echo  $Image; ?>'>
                                            <div class='tracking-num'><?php echo $TrackingNumber; ?></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="product-quantity">
                                            <p class="order-list-title">Quantity</p>
                                            <p class="order-list-title-data"><?php echo  $Quantity; ?></p>
                                        </div>
                                    </li>
                                    <li class="product-name">
                                        <div>
                                            <p class="order-list-title">Product Name</p>
                                            <div class="order-list-title-data"><?php echo $ProductTitle; ?></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="order-price">
                                            <p class="order-list-title">Price</p>
                                            <p class="order-list-title-data"><?php echo "Rs. ". $PerProductPrice .".00"; ?></p>
                                        </div>
                                    </li>
                                </ul>
                        <?php
                            }
                        } else {
                            echo "<p class='order-completed'>Order Is Completed</p>";
                        }
                        ?>
                    </div>
                </div>

                <div class="cart-totals">
                    <div class="cart-title">
                        <ul>
                            <li>Cart Totals</li>
                            <li>Price</li>
                        </ul>
                    </div>

                    <div class="cart-body">
                        <?php
                        if ($OrderDetail->num_rows > 0) {
                            $Pickup =  $OrderInfo['Pickup'] ;
                            $SubTotal =  $OrderInfo['SubTotal'] ;
                            $TotalDue = "Rs. " . $OrderInfo['TotalDue'] . ".00";
                            $ShippingFee = "Rs. " . $OrderInfo['ShippingFee'] . ".00";
                        ?>
                            <ul>
                            <li class="cart-totals-item">
                                    <span class="body-text">Pickup:</span>
                                    <span class="body-title-2 pickup"><?php echo $Pickup ?></span>
                            </li>
                                <li class="cart-totals-item">
                                    <input type="hidden" value="<?php echo $SubTotal; ?>" id="subtotal">
                                    <span class="body-text">Subtotal:</span>
                                    <span class="body-title-2"><?php echo "Rs. " .$SubTotal.".00"?></span>
                                </li>
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-text">Shipping:</span>
                                    <span class="body-title-2"><?php echo  $ShippingFee; ?></span>
                                </li>
                                <li class="divider"></li>
                                <li class="cart-totals-item">
                                    <span class="body-text-total">Total price:</span>
                                    <span class="body-title-total"><?php echo  $TotalDue; ?></span>
                                </li>
                            </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="change-status-box">
                    <?php
                    if ($OrderDetail->num_rows > 0) {
                        $UserID =  $OrderInfo['UserID'];
                        $PaymentMethod =  $OrderInfo['PaymentMethod'];
                        $PaymentScreenshot=$OrderInfo['PaymentScreenshot'];
                        if($PaymentMethod =='eSewa'){
                    ?>
                        <div class="option-tag" data-user-id="<?php echo $UserID; ?>" data-row-id="<?php echo $RowOrderID; ?>">
                            <div class="select-btn">
                                <span class="SelectedText">Pending</span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <ul class="options">
                                <li class="option-list">
                                    Pending
                                </li>
                                <li class="option-list">
                                    Shipped
                                </li>
                                <li class="option-list">
                                    Complete
                                </li>
                                <li class="option-list">
                                    Cancelled
                                </li>
                                <li class="option-list">
                                    Rejected
                                </li>
                            </ul>
                        </div>
                        <a href="Account/UserAccount/Payment Receipts/<?php echo $PaymentScreenshot; ?>"><button>View Screenshot</button></a>
                    <?php
                        }else{
                            ?>
                              <div class="option-tag" data-user-id="<?php echo $UserID; ?>" data-row-id="<?php echo $RowOrderID; ?>">
                            <div class="select-btn">
                                <span class="SelectedText">Pending</span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <ul class="options">
                                <li class="option-list">
                                    Shipped
                                </li>
                                <li class="option-list">
                                    Complete
                                </li>
                                <li class="option-list">
                                    Cancelled
                                </li>
                                <li class="option-list">
                                    Rejected
                                </li>
                            </ul>
                        </div>
                            
                    <?php        
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            if ($OrderDetail->num_rows > 0) {
                echo ' <div class="summary-container">
                <div class="user-box">';

                $BillingFullName =  $OrderInfo['BillingFullName'];
                $BillingNumber =  $OrderInfo['BillingNumber'];
                $AccountFullName =  $OrderInfo['AccountFirstName'] . " " . $OrderInfo['AccountLastName'];
                $AccountNumber =  $OrderInfo['AccountNumber'];
            ?>
                <div class="body-title user-head-title-1">Billing Details</div>
                <div class="user-info">
                    <ul>
                        <li>
                            <span class="user-title">Name:</span>
                            <p class="user-name"><?php echo $BillingFullName; ?></p>
                        </li>
                        <li>
                            <span class="user-title">Number:</span>
                            <p class="user-number"><?php echo $BillingNumber; ?></p>

                        </li>
                    </ul>
                </div>

                <div class="body-title user-head-title-2">Account Details</div>
                <div class="user-info">
                    <ul>
                        <li>
                            <span class="user-title">Name:</span>
                            <p class="user-name"><?php echo $AccountFullName; ?></p>
                        </li>
                        <li>
                            <span class="user-title">Number:</span>
                            <p class="user-number"><?php echo $AccountNumber; ?></p>

                        </li>
                    </ul>
                </div>

            <?php
            }
            ?>
        </div>
        <?php
        if ($OrderDetail->num_rows > 0) {
            echo '<div class="Summary-box">';
            $OrderID =  $OrderInfo['OrderID'];
            $UserID =  $OrderInfo['UserID'];
            $TotalDue = "Rs. " . $OrderInfo['TotalDue'] . ".00";
            $OrderDate =  $OrderInfo['OrderDate'];
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $OrderDate);
            $formattedDate = $dateTime->format('j M, Y');
            $formattedTime = $dateTime->format('g:i A');
        ?>
            <div class="body-title">Summary</div>
                <a href="Admin/Transaction Record.php?UserID=<?php echo $UserID; ?>" class="summary-item" target="_blank">
                <div class="body-text">User ID</div>
                <div class="body-title-3"><?php echo $UserID; ?></div>
                </a>
            <div class="summary-item">
                <div class="body-text">Date</div>
                <div class="body-title-3"><?php echo  $formattedDate; ?></div>
            </div>
             <div class="summary-item">
                <div class="body-text">Time</div>
                <div class="body-title-3"><?php echo $formattedTime; ?></div>
             </div>
            <div class="summary-item">
                <div class="body-text">Total</div>
                <div class="body-title-3 tf-color-1"><?php echo  $TotalDue; ?></div>
            </div>
    </div>
<?php
        }
?>
<?php
if ($OrderDetail->num_rows > 0) {
    echo '<div class="billing-address">';
    $BillingCity =  $OrderInfo['BillingCity'];
    $BillingAddress =  $OrderInfo['BillingAddress'];
    $AccountAddress =  $OrderInfo['AccountAddress'];
?>
    <div class="body-title">Billing Address</div>
    <div class="body-text"><?php echo  $BillingCity . ", " . $BillingAddress; ?></div>
    <div class="body-title second-address">Account Address</div>
    <div class="body-text"><?php echo  $AccountAddress; ?></div>
<?php
}
?>
</div>
<?php
if ($OrderDetail->num_rows > 0) {
    echo ' <div class="payment-method">
                <div class="body-title">Payment Method</div>';
    $PaymentMethod =  $OrderInfo['PaymentMethod'];
    if ($PaymentMethod == 'Cash On Delivery') {
        echo "<div class='body-text'>Cash on delivery (COD)</div>";
    } else {
        echo "<div class='body-text esewa'>$PaymentMethod</div>";
    }
}
?>
</div>
</div>
</div>

</div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Order Detail Page.js"></script>

</html>