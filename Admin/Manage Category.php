<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Admin/Manage Category Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Edit Product.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Product Category</title>
</head>

<body>
    <div class="product-container">
        <form action="#" enctype="multipart/form-data" id="formdata" data-category-id="<?php echo $CategoryID?>">
            <div class="product-box">
                <div class="page-heading-and-save-box">
                    <div class="page-heading">
                        Edit Product Category
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
                        <p class="body-heading">Category Name</p>
                        <input type="text" name="CategoryAttribute" class="h-[50px] placeholder:text-xs border" placeholder="Enter Category Name" value="<?php echo $ProductCategoryAttribute ?>">
                    </div>
                </div>

                <div class="image-section">
                    <div class="card">
                        <div class="top">
                            <div class="update-image-box">
                                <div class="general-heading">
                                    Search Engine Optimization
                                </div>
                            </div>
                            <div class="minimize-image-box-btn-box">
                                <i class='bx bx-chevron-up'></i>
                            </div>
                        </div>
                        <div class="product-name category-edit">
                            <p class="body-heading">Meta Title</p>
                            <input type="text" name="MetaTitle" class="h-[50px] placeholder:text-xs border" placeholder="Enter Meta Title" value="<?php echo $MetaTitle ?>">
                        </div>
                        <div class="description">
                            <p class="body-heading">Meta Description</p>
                            <textarea placeholder="Meta Description" name="MetaDescription" class="placeholder:text-xs border"><?php echo htmlspecialchars($MetaDescription); ?></textarea>
                        </div>
                        <div class="description">
                            <p class="body-heading">Meta Keyword ( Seperated By Comma )</p>
                            <textarea placeholder="Enter Meta Keyword" name="MetaKeyword" class="placeholder:text-xs border"><?php echo $MetaKeyword ?></textarea>
                        </div>
                    </div>
                </div>
                
            </form>
    </div>

</body>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Manage Category.js"></script>

</html>