<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Admin Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/New Category.css">
    <title>Add Product Category</title>
</head>

<body>
    <div class="category-container">
        <div class="category">
            <form>
                <h1>Add New Category</h1>
                <div class="option-tag">
                    <div class="select-btn">
                        <input type="hidden" class="CategoryName">
                        <span class="SelectedText">Select Category</span>
                        <i class='bx bx-chevron-down'></i>
                    </div>
                    <ul class="options">
                        <li class="option-list">
                            Brand
                        </li>
                        <li class="option-list">
                            Skin Care
                        </li>
                        <li class="option-list">
                            Makeup
                        </li>
                        <li class="option-list">
                            Body & Hair Care
                        </li>
                        <li class="option-list">
                            Baby Care
                        </li>
                        <li class="option-list">
                            Skincare Set
                        </li>
                    </ul>
                </div>

                <div class="input-box-category">
                    <input type="text" placeholder="Product Category Attribute" class="CategoryAttribute">
                </div>
                <div class="submit-box">
                    <input type="submit" value="Add" id="CreateCategory">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/New Category.js"></script>
</html>