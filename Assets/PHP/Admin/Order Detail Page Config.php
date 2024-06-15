<?php
$RowOrderID = $_GET['OrderID'];
$FindUserId="SELECT * FROM `order_items` WHERE `Order ID`='$RowOrderID'";
$FindUserIdRun=mysqli_query($conn,$FindUserId);
$Data=$FindUserIdRun->fetch_assoc();
$DBUserID=$Data['User ID'];

$OrderDetailQuery = "SELECT
orders.`Total Due` AS SubTotal,
(orders.`Total Due` + orders.`Shipping Fee`) AS TotalDue,
orders.`Shipping Fee` AS ShippingFee,
delivery.`Full Name` AS BillingFullName,
delivery.`Phone` AS BillingNumber,
user.`First Name` AS AccountFirstName,
user.`Last Name` AS AccountLastName,
user.`Mobile Number` AS AccountNumber,
OrderList.`Payment Screenshot` AS 	PaymentScreenshot,
OrderList.`Order ID` AS OrderID,
OrderList.`Order Date` OrderDate,
OrderList.`Payment Method` AS PaymentMethod,
OrderList.`Order Status` AS OrderStatus,
delivery.City AS BillingCity,
delivery.Address AS BillingAddress,
user.`User Address` AS AccountAddress,
OrderList.`User ID` AS UserID
FROM
`order_items` OrderList
JOIN orders ON orders.`Order ID` = OrderList.`Order ID`
JOIN user_table user ON
user.ID = OrderList.`User ID`
JOIN delivery_info delivery ON
delivery.`User ID` = OrderList.`User ID`
WHERE OrderList.`User ID` = '$DBUserID' AND OrderList.`Order ID`='$RowOrderID'";


$OrderDetail=mysqli_query($conn,$OrderDetailQuery);
$OrderInfo=$OrderDetail->fetch_assoc();
$AllItemsQuery="SELECT
OrderList.`Order ID` AS OrderID,
pm1.`Product Meta Value` AS ImagePath,
OrderList.`Quantity`,
OrderList.`Tracking Number` AS TrackingNumber,
OrderList.`Total Due` AS PerProductPrice,
p.`Product Title`
FROM
`order_items` OrderList
JOIN posts p ON
p.ID = OrderList.`Product ID`
JOIN postsmeta pm1 ON
pm1.`Product ID` = OrderList.`Product ID` AND pm1.`Product Meta Key` = 'Image 1'
WHERE
OrderList.`User ID` = '$DBUserID' AND OrderList.`Order ID` ='$RowOrderID' AND  OrderList.`Order ID`='$RowOrderID'
ORDER BY
OrderID DESC";
$AllItems=mysqli_query($conn,$AllItemsQuery);
?>