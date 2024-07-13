<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . "Assets/Components/Admin Navbar.php";
include_once $base_url . 'Assets/PHP/Admin/Edit Product Config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/New Product.css">
    
</head>

<body>
    <div class="product-box">
        <div class="general-information">
            <div class="general-info-and-minimize-option">
                <div class="general-heading">
                    General Information
                </div>
                <div class="minimize-btn-box">
                    <i class='bx bx-chevron-up'></i>
                </div>
            </div>

            <form action="#" enctype="multipart/form-data" id="formdata">
                <div class="product-name">
                    <p class="body-heading">Product Name</p>
                    <input type="text" name="ProductTitle" id="ProductTitle" placeholder="Enter product name">
                </div>

                <div class="product-id-and-quantity">
                    <div class="product id">
                        <p class="body-heading">Customs ID</p>
                        <input type="text" name="CustomProductID" id="CustomProductID" placeholder="Custom Product ID">
                    </div>

                    <div class="product-quanttiy">
                        <p class="body-heading">Product Quanttiy</p>
                        <input type="text" name="ProductQuantity" id="ProductQuantity" placeholder="Product Quantity" value="50">
                    </div>
                </div>

                <div class="product-category">

                    <div class="select-skin-care-category">
                        <div class="option-tag" id="SkinCare">
                            <p class="body-heading">Select Skin Care</p>
                            <div class="select-btn">
                                <input type="hidden" class="ProductTypeID">
                                <span class="SelectedText">
                                    Select Skin Care
                                </span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <ul class="options" id="SkinCareItems">
                                <?php
                                $SkinCare = "SELECT * FROM `product_category` WHERE `Product Category Name`='Skin Care' ORDER BY `Product Category Attribute` ASC";
                                $Query = mysqli_query($conn, $SkinCare);
                                while ($Row = $Query->fetch_assoc()) {
                                    $SkinCareID = $Row['Product Category ID'];
                                    $SkinCare = $Row['Product Category Attribute'];
                                    echo "<li class='option-list' data-product-type-id='$SkinCareID'>$SkinCare</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="select-makeup">
                        <div class="option-tag" id="makeup">
                            <p class="body-heading">Select Makeup</p>
                            <div class="select-btn">
                                <input type="hidden" class="ProductTypeID">
                                <span class="SelectedText">
                                    Select Makeup
                                </span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <ul class="options" id="makeupitems">
                                <?php
                                $Makeup = "SELECT * FROM `product_category` WHERE `Product Category Name`='Makeup' ORDER BY `Product Category Attribute` ASC";
                                $Query = mysqli_query($conn, $Makeup);
                                while ($Row = $Query->fetch_assoc()) {
                                    $MakeupID = $Row['Product Category ID'];
                                    $Makeup = $Row['Product Category Attribute'];
                                    echo "<li class='option-list' data-product-type-id='$MakeupID'>$Makeup</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>


                    <div class="select-bodyandhaircare">
                        <div class="option-tag" id="bodyandhaircare">
                            <p class="body-heading">Select Baby, Body & Hair Care</p>
                            <div class="select-btn">
                                <input type="hidden" class="ProductTypeID">
                                <span class="SelectedText">
                                    Select Baby, Body & Hair Care
                                </span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <ul class="options" id="bodyandhaircarelist">
                                <?php
                                $BodyHairCare = "SELECT * FROM `product_category` WHERE `Product Category Name`='Body & Hair Care' OR `Product Category Name`='Baby Care'";
                                $Query = mysqli_query($conn, $BodyHairCare);
                                while ($Row = $Query->fetch_assoc()) {
                                    $BodyHairCareID = $Row['Product Category ID'];
                                    $BodyHairCare = $Row['Product Category Attribute'];
                                    echo "<li class='option-list' data-product-type-id='$BodyHairCareID'>$BodyHairCare</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="select-product-type">
                        <div class="option-tag" id="BrandList">
                            <p class="body-heading">Select Brand</p>
                            <div class="select-btn">
                                <input type="hidden" class="ProductTypeID">
                                <span class="SelectedText">
                                    Select Brand
                                </span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <ul class="options" id="BrandItems">
                                <?php
                                $Brand = "SELECT * FROM `product_category` WHERE `Product Category Name`='Brand' ORDER BY `Product Category Attribute` ASC";
                                $Query = mysqli_query($conn, $Brand);
                                while ($Row = $Query->fetch_assoc()) {
                                    $BrandID = $Row['Product Category ID'];
                                    $Brand = $Row['Product Category Attribute'];
                                    echo "<li class='option-list' data-brand-id='$BrandID'>$Brand</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="price-plaining">
                    <div class="initial-price">
                        <p class="body-heading">Price</p>
                        <input type="text" id="ProductPrice" name="Price" placeholder="Price">
                    </div>
                    <div class="discount-price">
                        <p class="body-heading">Discount Price</p>
                        <input type="text" id="DiscountPrice" name="DiscountPrice" placeholder="Discount price">
                    </div>
                    <div class="discount-percentage">
                        <p class="body-heading">Discount Percentage</p>
                        <input type="text" id="DiscountPercentage" name="DiscountPercentage" placeholder="Discount percentage" value='5'>
                    </div>
                </div>

                <div class="description">
                    <p class="body-heading">Description</p>
                    <textarea placeholder="Product content" id="Productdescription" name="ProductDescription"></textarea>
                </div>
                <div>
                    <label class="Upload-Images" for="multiple_files">Upload Images</label>
                    <input id="multiple_files" name="Images[]" type="file" multiple>

                </div>
                <div class="submit">
                    <input type="submit" id="Submit" class="save-changes">
                </div>
            </form>
        </div>

    </div>


</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/New Product.js"></script>

</html>