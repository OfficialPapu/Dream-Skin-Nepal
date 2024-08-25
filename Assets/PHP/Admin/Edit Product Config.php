<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Admin Navbar.php';
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
if (isset($_GET['ProductID'])) {
    $ProductID = $_GET['ProductID'];
    $GeneralInformationQuery = "SELECT 
    DISTINCT p.ID AS ID,
    p.`Custom Product ID` AS CustomID,
    p.`Product Title` AS Title,
    p.`Product Content` AS Description,
    p.`Product Price` AS Price,
    p.`Discount Price` AS DiscountPrice,
    p.`Discount Percentage` AS DiscountPercentage,
    p.`Product Quantity` AS Quantity,
    pm1.`Product Meta Value` AS BrandID,
    pm2.`Product Meta Value` AS ProductTypeID
    FROM `posts` p 
    JOIN postsmeta pm1 ON p.ID=pm1.`Product ID` AND pm1.`Product Meta Key`='Brand ID'
    JOIN postsmeta pm2 ON p.ID=pm2.`Product ID` AND pm2.`Product Meta Key`='Product Type ID'
    WHERE p.ID='$ProductID'";
    $GeneralInformationQueryRun = mysqli_query($conn, $GeneralInformationQuery);
    $Row = $GeneralInformationQueryRun->fetch_assoc();

    $CheckSkinTypeQuery = "SELECT pm.`Product Meta Value` AS SkinTypeID, pc.`Product Category Attribute`
    FROM `postsmeta` pm
    JOIN `product_category` pc ON pm.`Product Meta Value` = pc.`Product Category ID`
    WHERE pm.`Product ID` = '$ProductID' AND pm.`Product Meta Key` = 'Skin Type'";
    $CheckResult = $conn->query($CheckSkinTypeQuery);

    $values = [];
    while ($row = $CheckResult->fetch_assoc()) {
        $values[] = $row['Product Category Attribute'];
    }
    $values = implode(", ", $values);
    $Productid = $Row['ID'];
    $CustomProductID = $Row['CustomID'];
    $ProductTitle = $Row['Title'];
    $ProductDescription = $Row['Description'];
    $ProductPrice = $Row['Price'];
    $DiscountPrice = $Row['DiscountPrice'];
    $DiscountPercentage = $Row['DiscountPercentage'];
    $ProductQuantity = $Row['Quantity'];
    $BrandId = $Row['BrandID'];
    $ProductTypeId = $Row['ProductTypeID'];

    $ProductBrandQuery = "SELECT * FROM `product_category` WHERE `Product Category ID`='$BrandId'";
    $ProductBrandQueryRun = mysqli_query($conn, $ProductBrandQuery);
    $BrandData = $ProductBrandQueryRun->fetch_assoc();
    $BrandName = $BrandData['Product Category Attribute'];
    $ProductTypeName = '';
    $ProductCategoryName = '';
    if ($ProductTypeId != '') {
        $ProductTypeQuery = "SELECT * FROM `product_category` WHERE `Product Category ID`='$ProductTypeId'";
        $ProductTypeQueryRun = mysqli_query($conn, $ProductTypeQuery);
        $ProductTypeData = $ProductTypeQueryRun->fetch_assoc();
        $ProductTypeName = $ProductTypeData['Product Category Attribute'];
        $ProductCategoryName = $ProductTypeData['Product Category Name'];
    }


    $ImagesQuery = "SELECT * FROM `postsmeta` WHERE `Product Meta Key` LIKE '%Image%' AND `Product ID`='$ProductID'";
    $ImagesQueryRun = mysqli_query($conn, $ImagesQuery);
}
