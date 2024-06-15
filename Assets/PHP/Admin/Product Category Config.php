<?php
if (isset($_POST['CreateCategory'])) {
    @session_name('URLSession');
    @session_start();
    $base_url = $_SESSION['URLSession']['Base Path'];
    include_once $base_url . 'Assets/PHP/Configuration/Create Slug.php';
    include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
    $CategoryName = $_POST['CategoryName'];
    $CategoryAttribute = $_POST['CategoryAttribute'];
    $CategoryName = mysqli_real_escape_string($conn, $CategoryName);
    $Slug= CreateSlug($CategoryAttribute);
    $CategoryAttribute = mysqli_real_escape_string($conn, $CategoryAttribute);
    $Query = "SELECT * FROM `product_category` WHERE `Product Category Name`='$CategoryName' AND `Product Category Attribute`='$CategoryAttribute'";
    
    $MySqli = mysqli_query($conn, $Query);
    if ($MySqli->num_rows > 0) {
        echo "Already Exist";
    } else {
        $Query = "INSERT INTO `product_category`(`Product Category Name`, `Product Category Attribute`,`Slug Url`) VALUES ('$CategoryName','$CategoryAttribute','$Slug')";
        $MySqli = mysqli_query($conn, $Query);
        if ($MySqli) {
            echo "Sucess";
        } else {
            echo "Fail";
        }
    }
}
?>
