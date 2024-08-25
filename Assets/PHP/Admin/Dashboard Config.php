<?php
$LatestOrderQuery="SELECT DISTINCT orders.`Order ID` AS ID, user.`First Name` AS FirstName, user.`Email` AS Email, orders.`Total Due` AS TotalDue, OrderList.`Order Status` AS OrderStatus, orders.`Order Date` AS OrderDate
FROM `orders`
JOIN user_table user ON user.`ID`= orders.`User ID`
JOIN order_items OrderList ON OrderList.`Order ID`=orders.`Order ID`
ORDER BY ID DESC LIMIT 0,10";
$LatestOrder=mysqli_query($conn,$LatestOrderQuery);
?>