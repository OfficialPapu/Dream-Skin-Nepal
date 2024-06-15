<?php
$OrderListQuery="SELECT DISTINCT OrderItem.`Order ID` AS 'OrderID',
OrderItem.`User ID` AS 'UserID',
OrderItem.`Total Due` AS TotalDue,
OrderList.`Payment Method` AS PaymentMethod,
OrderList.`Order Status` AS OrderStatus,
deliveryInfo.`Full Name` AS Name,
pm1.`Product Meta Value` AS ImagePath
FROM
`orders` OrderItem
JOIN 
`order_items` AS OrderList ON OrderList.`Order ID` = OrderItem.`Order ID`
JOIN posts p ON
OrderList.`Product ID` = p.`ID`
JOIN postsmeta pm1 ON
pm1.`Product ID` = OrderList.`Product ID` AND pm1.`Product Meta Key` = 'Image 1'
JOIN `delivery_info` deliveryInfo ON deliveryInfo.`User ID`=OrderItem.`User ID`
GROUP BY OrderItem.`Order ID`  -- Use GROUP BY to ensure distinct Order IDs
ORDER BY OrderID DESC";
$OrderList=mysqli_query($conn,$OrderListQuery);

$OrderCountQuery="SELECT COUNT(*) AS CountOrder FROM orders";
$OrderCountRun=mysqli_query($conn,$OrderCountQuery);
$OrderCountData=$OrderCountRun->fetch_assoc();
$OrderCount=$OrderCountData['CountOrder'];

?>