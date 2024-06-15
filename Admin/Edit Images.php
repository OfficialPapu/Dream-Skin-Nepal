<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Images</title>
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Edit Images.css">
</head>

<body>
    <div class="image-search-container">
        <div class="image-search-main-box">
            <div class="image-search-box">
                <div class="search-img">
                    <input type="number" placeholder="Enter a Product ID" id="product-id">
                </div>
                <div class="search-sumbit-btn">
                    <button id="search-image">Search</button>
                </div>
            </div>
            <div class="image-list-box">
                <div class="image-list"></div>
                <div class="hr-line"></div>
            </div>
            <div class="edit-image-postion">
                <div class="edit-image-btn">
                    <button id="SaveOrder">Save</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Edit Images.js"></script>

</html>