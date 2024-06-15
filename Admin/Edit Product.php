<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Admin/Edit Product Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Edit Product.css">
</head>

<body>
    <div class="product-container">
        <div class="product-box">
            <div class="page-heading-and-save-box">
                <div class="page-heading">
                    Edit Product
                </div>
                <div class="save-changes-box">
                    <button class="save-changes">Save Changes</button>
                </div>
            </div>
            <div class="general-information">

                <div class="general-info-and-minimize-option">
                    <div class="general-heading">
                        General Information
                    </div>
                    <div class="minimize-btn-box">
                        <i class='bx bx-chevron-up'></i>
                    </div>
                </div>


                <div class="product-name">
                    <p class="body-heading">Product Name</p>
                    <input type="text" name="" id="ProductTitle" placeholder="Enter product name" value="<?php echo $ProductTitle ?>">
                </div>

                <div class="product-id-and-quantity">
                    <div class="product id">
                        <p class="body-heading">Customs ID</p>
                        <input type="text" value="<?php echo $CustomProductID; ?>" id="CustomProductID">
                        <input type="hidden" value="<?php echo $Productid; ?>" id="ID">
                    </div>
                    <div class="product-quanttiy">
                        <p class="body-heading">Product Quanttiy</p>
                        <input type="text" value="<?php echo $ProductQuantity; ?>" id="ProductQuantity">
                    </div>
                </div>



                <div class="product-category">
            <input type="hidden" class="SelectedProductTypeID" value="<?php
           echo $ProductTypeId; ?>">
                    <div class="select-skin-care-category">
                        <div class="option-tag" id="SkinCare">
                            <p class="body-heading">Select Skin Care</p>
                            <div class="select-btn">
                            <input type="hidden" class="ProductTypeID">
                                <span class="SelectedText">
                                    <?php
                                    if ($ProductCategoryName == 'Skin Care') {
                                        echo $ProductTypeName;
                                    } else {
                                        echo "Select Skin Care";
                                    }
                                    ?>
                                </span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <ul class="options" id="SkinCareItems"></ul>
                        </div>
                    </div>

                    <div class="select-makeup">
                        <div class="option-tag" id="makeup">
                            <p class="body-heading">Select Makeup</p>
                            <div class="select-btn">
                            <input type="hidden" class="ProductTypeID">
                                <span class="SelectedText">
                                    <?php
                                    if ($ProductCategoryName == 'Makeup') {
                                        echo $ProductTypeName;
                                    } else {
                                        echo "Select Makeup";
                                    }
                                    ?>
                                </span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <ul class="options" id="makeupitems"></ul>
                        </div>
                    </div>

                    
                    <div class="select-bodyandhaircare">
                        <div class="option-tag" id="bodyandhaircare">
                            <p class="body-heading">Select Body & Hair Care</p>
                            <div class="select-btn">
                            <input type="hidden" class="ProductTypeID">
                                <span class="SelectedText">
                                    <?php
                                    if ($ProductCategoryName == 'Body & Hair Care') {
                                        echo $ProductTypeName;
                                    } else {
                                        echo "Select Body & Hair Care";
                                    }
                                    ?>
                                </span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <ul class="options" id="bodyandhaircarelist"></ul>
                        </div>
                    </div>

                    <div class="select-product-type">
                        <div class="option-tag" id="BrandList">
                            <p class="body-heading">Select Brand</p>
                            <div class="select-btn">
                            <input type="hidden" class="ProductTypeID" value="<?php echo  $BrandId; ?>">
                                <span class="SelectedText">
                               
                                    <?php
                                    if ($BrandName != '') {
                                        echo $BrandName;
                                    } else {
                                        echo "Select Brand";
                                    }
                                    ?>
                                </span>
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <ul class="options" id="BrandItems"></ul>
                        </div>
                    </div>
                </div>


                <div class="price-plaining">
                    <div class="initial-price">
                        <p class="body-heading">Price</p>
                        <input type="text" value="<?php echo $ProductPrice; ?>" id="ProductPrice">
                    </div>
                    <div class="discount-price">
                        <p class="body-heading">Discount Price</p>
                        <input type="text" value="<?php echo $DiscountPrice; ?>" id="DiscountPrice">
                    </div>
                    <div class="discount-percentage">
                        <p class="body-heading">Discount Percentage</p>
                        <input type="text" value="<?php echo $DiscountPercentage; ?>" id="DiscountPercentage">
                    </div>
                </div>

                <div class="description">
                    <p class="body-heading">Description</p>
                    <textarea placeholder="Product content" id="Productdescription"><?php echo htmlspecialchars($ProductDescription); ?></textarea>
                </div>

            </div>

            <div class="image-section">
                <div class="card">
                    <div class="top">
                        <p>Drag & drop image uploading</p>
                        <div class="minimize-image-box-btn-box">
                            <i class='bx bx-chevron-up'></i>
                        </div>
                    </div>
                    <form action="/upload" method="post" class="data-upload">
                        <div class="upload-icon">
                            <i class='bx bx-cloud-upload'></i>
                        </div>
                        <span class="inner">Drag & drop image here or <span class="select">Browse</span></span>
                        <input name="file" type="file" class="file" multiple />
                    </form>
                    <div class="image-list-container"></div>
                </div>
            </div>



        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Edit Product.js"></script>

</html>