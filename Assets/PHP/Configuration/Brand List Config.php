<?php
$BrandListQuery="SELECT * FROM `product_category` WHERE `Product Category Name`='Brand' ORDER BY `Product Category Attribute` ASC";
$BrandListRun=mysqli_query($conn,$BrandListQuery);
?>