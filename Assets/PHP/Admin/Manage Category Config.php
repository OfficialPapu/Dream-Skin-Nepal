<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Admin Navbar.php';
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
$ProductCategoryID = '';
$ProductCategoryName = '';
$ProductCategoryAttribute = '';
$MetaTitle = '';
$MetaDescription = '';
$MetaKeyword = '';
if (isset($_GET['CategoryID'])) {
    $CategoryID = $_GET['CategoryID'];
    $CategoryQuery = "SELECT * FROM `product_category` WHERE `Product Category ID`='$CategoryID'";
    $CategoryQueryRun = mysqli_query($conn, $CategoryQuery);
    if($CategoryQueryRun->num_rows>0){
        $Row = $CategoryQueryRun->fetch_assoc();
            $ProductCategoryID = $Row['Product Category ID'];
            $ProductCategoryName = $Row['Product Category Name'];
            $ProductCategoryAttribute = $Row['Product Category Attribute'];
            $MetaTitle = $Row['Meta Title'];
            $MetaDescription = $Row['Meta Description'];
            $MetaKeyword = $Row['Meta Keyword'];
            $ProductCategoryAttribute = $Row['Product Category Attribute'];
        }
}
