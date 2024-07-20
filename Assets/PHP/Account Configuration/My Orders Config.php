<?php
include_once $base_url . 'Assets/Components/Navbar.php';
@session_start();
    if(isset($_SESSION['Logged In'])){
        $user_id = $_SESSION['LoginSession']['user_id'];
    }
$query="SELECT p.ID,
p.`Slug Url`,
p.`Product Title`,
order_items.`Order ID`,
pm1.`Product Meta Value` AS ProductTmumbnail,
order_items.`Order Status`,
order_items.`Tracking Number`,
order_items.`Order Date`,
orders.`Shipping Fee`,
order_items.`Total Due` AS ProductPrice
FROM posts p 
JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Image 1'
JOIN order_items ON p.ID = order_items.`Product ID`
JOIN orders ON order_items.`Order ID` = orders.`Order ID`
WHERE order_items.`User ID` = '$user_id' ORDER BY order_items.`ID` DESC";
    $result = $conn->query($query);
  ?>