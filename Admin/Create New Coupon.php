<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Admin Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new Coupon</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Create New Coupon.css">
</head>
<body>
<div class="coupon-container">
        <form action="/submit-coupon" method="post">
            <div class="form-group">
                <label for="coupon-code">Coupon Code</label>
                <input type="text" id="coupon-code" name="coupon-code"  placeholder="Enter coupon code">
            </div>
            <div class="form-group">
                <label for="coupon-description">Coupon Description</label>
                <textarea id="coupon-description" name="coupon-description" 
                    placeholder="Enter coupon description"></textarea>
            </div>
            <div class="form-group">
                <label for="end-date">End Date</label>
                <input type="date" id="end-date" name="end-date" >
            </div>
            <div class="form-group">
                <div class="option-tag">
                    <div class="select-btn">
                        <span class="SelectedText">Select Coupon Type</span>
                        <i class='bx bx-chevron-down'></i>
                    </div>
                    <ul class="options">
                        <li class="option-list">
                            Fixed Amount
                        </li>
                        <li class="option-list">
                            Percentage
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label for="coupon-amount">Coupon Amount</label>
                <input type="text" id="coupon-amount" name="coupon-amount" placeholder="Enter coupon amount" >
            </div>
            <div class="form-group">
                <label for="min-cart-price">Minimum Cart Price</label>
                <input type="text" id="min-cart-price" placeholder="Enter minimum cart price" >
            </div>
            <button type="submit" id="create-coupon">Create Coupon</button>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Create New Coupon.js"></script>
</html>