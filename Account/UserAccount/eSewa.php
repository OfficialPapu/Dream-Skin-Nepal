<?php
@session_name('LoginSession');
@session_name('URLSession');
@session_start();
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Account Configuration/eSewa Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSewa Payment</title>
    <link rel="stylesheet" href="Assets/CSS/Cash On Delivery.css">
</head>

<body>
    <?php
    if (isset($_GET['PaymentInfo'])) {
        echo " <div class='success-container'>
                <i class='success-icon fas fa-check-circle'></i>
                <h1 class='success-heading'>Order Placed Successfully!</h1>
                <p class='success-text'>Thank you for your purchase. Your order has been successfully placed.</p>";

        while ($Row = $OrderSummaryRun->fetch_assoc()) {
            $TrackingNumdata = $Row['Tracking Number'];
            $Thumbnail = $Row['thumbnail'];
            $ProductTitleData = $Row['Title'];
            $ProductPrice = $Row['Total Due'];
            $GrandTotal = $Row['GrandTotal'];
            $ShippingFee = $Row['ShippingFee'];
            echo "<div class='product-item'>
                    <img src='$Thumbnail' class='product-image'>
                    <div class='product-details'>
                        <h3>$ProductTitleData</h3>
                        <p>Price: Rs. $ProductPrice.00</p>
                        <p>Tracking Number: $TrackingNumdata</p>
                    </div>
                </div>";
        }
        echo "<div class='order-info'>
                    <p>Payment Method :<span class='body-title'> eSewa</span></p>
                    <p>Shipping Fee :</strong><span class='body-title'> Rs. $ShippingFee.00</span></p>
                    <p>Total Amount :</strong><span class='body-title'> Rs. $GrandTotal.00</span></p>
                    <p>Order ID :</span><span class='body-title'> #$order_id</span></p>
                </div>
                <a href='/'><button class='success-btn'>Continue Shopping</button></a>
            </div>";
    } else {
        echo '<div class="main-submit-container">
    <div class="no-product-found-img">
    <img src="Assets/Product/Media/Images/Logo/no-results.png" alt="">
    </div>
    <div class="empty-box-title">
    No item selected
    </div>
    </div>';
    }
    ?>
    <footer>
        <?php
        include_once $base_url . 'Assets/Components/Footer.php';
        ?>
    </footer>
</body>

</html>