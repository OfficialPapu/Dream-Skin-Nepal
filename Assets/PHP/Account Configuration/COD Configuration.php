<?php
@session_name('LoginSession');
@session_start();
$user_id = $_SESSION['LoginSession']['user_id'];
include_once $base_url . 'Assets/Components/Navbar.php';
include_once $base_url . 'Assets/PHP/Configuration/User IP.php';
include $base_url . 'Assets/PHP/Email Management/Orders Email/Admin Notify Email.php';
include $base_url . 'Assets/PHP/Email Management/Orders Email/User Notify Email.php';


function generateTrackingNumber()
{
    $prefix = "DSN";
    $randomNumber = mt_rand(0, 99999999);
    $trackingNumber = $prefix . $randomNumber;
    return $trackingNumber;
}
$user_ip = get_ip();
$TotalDue = "SELECT * FROM `product_cart` WHERE `User ID`='$user_id'";
$runquery = $conn->query($TotalDue);
$TotalPrice = 0;
while ($row = $runquery->fetch_assoc()) {
    $TotalShippingFee = $row['Shipping Fee'];
    $TotalPrice += $row['Total Due'];
}
$trackingNumber = "";
$order_id;
if (!isset($_SESSION['order_id'])) {
    $_SESSION['order_id'] = 0;
} else {
    $order_id = $_SESSION['order_id'];
}
if (isset($_GET['PaymentInfo'])) {
    $Cart = "SELECT * FROM `product_cart` WHERE `User ID`='$user_id'";
    $runquery = $conn->query($Cart);
    if ($runquery->num_rows > 0) {
        $InsertOrder = "INSERT INTO `orders`(`User ID`, `Total Due`, `Shipping Fee`,`Order Date`) VALUES ('$user_id','$TotalPrice','$TotalShippingFee',CONVERT_TZ(NOW(), '+00:00', '+05:45') )";
        $send = mysqli_query($conn, $InsertOrder);
        if ($send) {
            $PaymentMethod="Cash On Delivery";
            $_SESSION['order_id'] = mysqli_insert_id($conn);
            $order_id = $_SESSION['order_id'];
            while ($row = $runquery->fetch_assoc()) {
                $trackingNumber = generateTrackingNumber();
                $product_id_db = $row['Product_ID'];
                $product_quantity = $row['Product_Quantity'];
                $PerProductPrice = $row['Total Due'];
                $UpdateQuantity = "UPDATE `posts` SET `Product Quantity` = `Product Quantity` - $product_quantity WHERE `ID` = '$product_id_db'";
                $UpdateQuantityRun = mysqli_query($conn, $UpdateQuantity);
                $insert_into_order_items = "INSERT INTO `order_items`(`Order ID`, `User ID`, `Product ID`, `Quantity`,`Total Due`,`Payment Method`,`Payment Screenshot`, `Order Status`, `Tracking Number`, `Order Date`) VALUES ('$order_id','$user_id','$product_id_db','$product_quantity','$PerProductPrice','$PaymentMethod','','Pending','$trackingNumber',CONVERT_TZ(NOW(), '+00:00', '+05:45') )";
                $runentry = mysqli_query($conn, $insert_into_order_items);
                if ($runentry) {
                    $deleteproductfromcart = "DELETE FROM `product_cart` WHERE `User ID`='$user_id'";
                    $rundelete = mysqli_query($conn, $deleteproductfromcart);
                }
            } {
        $DnsPointFetach="SELECT * FROM `user_table` WHERE `ID`='$user_id'";
        $DnsPointFetachRun=$conn->query($DnsPointFetach);
        $Row=$DnsPointFetachRun->fetch_assoc();
        $DnsPointDB=$Row['DNS Point'];
        if($DnsPointDB==''){
        $DnsPointDB=0;
        }
        $PurchaseDnsPoint = $TotalPrice/100;
        $DnsPoint=$DnsPointDB+$PurchaseDnsPoint;
        $UpdateDnsQuery="UPDATE `user_table` SET `DNS Point`='$DnsPoint' WHERE `ID`='$user_id'";
        $UpdateDnsQueryRun=$conn->query($UpdateDnsQuery);         
        $ProductInformationQuery = "SELECT
            OrderList.`Tracking Number`,
            OrderItem.`Shipping Fee` AS ShippingFee,
            p.`Product Title`,
            p.`Product Price`,
            p.`Discount Price`,
            p.`Discount Percentage`,
            user.`First Name`,
            user.`Mobile Number`,
            user.Email
        FROM
            `order_items` OrderList
        JOIN posts p ON
            p.ID = OrderList.`Product ID`
        JOIN user_table user ON
            user.ID = OrderList.`User ID`
        JOIN orders OrderItem ON
            OrderItem.`Order ID` = OrderList.`Order ID`
        WHERE
            OrderList.`Order ID` = '$order_id'";
                $ProductTitle = [];
                $ProductPrice = [];
                $Price = [];
                $TrackingNum = [];
                $ProductInformation = mysqli_query($conn, $ProductInformationQuery);
                while ($Row = $ProductInformation->fetch_assoc()) {
                    $ProductTitle[] = $Row['Product Title'];
                    $ProductPrice[] = $Row['Product Price'];
                    $TrackingNum[] = $Row['Tracking Number'];
                    $InitialPrice = $Row['Product Price'];
                    $DiscountPrice = $Row['Discount Price'];
                    $DiscountPercentage = $Row['Discount Percentage'];
                    $TotalShippingCharge = $Row['ShippingFee'];
                    $UserName = $Row['First Name'];
                    $UserEmail = $Row['Email'];
                    $MobileNumber = $Row['Mobile Number'];
                    if ($DiscountPrice != '') {
                        $Price[] = $DiscountPrice;
                    } elseif ($DiscountPercentage != '') {
                        $DiscountValueCalculate = ceil(($InitialPrice / 100) * $DiscountPercentage);
                        $DiscountValue = $InitialPrice - $DiscountValueCalculate;
                        $Price[] = $DiscountValue;
                    } else {
                        $Price[] = $Row['Product Price'];
                    }
                }
                NotifyAdmin($UserName, $MobileNumber, $ProductTitle, $Price, $TrackingNum, $PaymentMethod, '');
                NotifyUser($UserEmail, $UserName, $ProductTitle, $Price, $TotalShippingCharge, $TrackingNum);
            }
        }
    }
    $OrderSummary = "SELECT oi.`Tracking Number`, oi.`Total Due`, p.`Product Title` AS Title, pm1.`Product Meta Value` AS thumbnail, o.`Total Due` AS GrandTotal, o.`Shipping Fee` AS ShippingFee
    FROM `order_items` oi 
    JOIN posts p ON p.ID = oi.`Product ID`
    JOIN postsmeta pm1 ON pm1.`Product ID` = p.ID AND pm1.`Product Meta Key` = 'Image 1'
    JOIN orders o ON o.`Order ID` = oi.`Order ID`
    WHERE oi.`User ID` = '$user_id' AND oi.`Order ID` = '$order_id'";
    $OrderSummaryRun = mysqli_query($conn, $OrderSummary);
}
