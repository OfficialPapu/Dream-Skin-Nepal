<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/PHP/Database/Database Connection.php';

$ListProductQuery = "SELECT
p.ID AS ProductID,
pm1.`Product Meta Value` AS ProductImage,
p.`Product Title`,
p.`Custom Product ID` AS CustomID,
p.`Product Price`,
p.`Product Quantity`
FROM `posts` p
JOIN postsmeta pm1 ON pm1.`Product ID`=p.ID AND pm1.`Product Meta Key`='Image 1'
ORDER BY p.ID DESC";
$ListProduct = mysqli_query($conn, $ListProductQuery);

