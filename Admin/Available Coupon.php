<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Admin Navbar.php';
// include_once $base_url . 'Assets/PHP/Admin/Available Coupon Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Coupon List</title>
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Available Coupon.css">
</head>

<body>

    <div class="coupon-list">
        <div class="container">
            <div class="coupon-list-headig">Available Coupon</div>
            <table>
                <thead>
                    <tr class="coupon-code-list-heading">
                        <th>ID</th>
                        <th>Coupon Code</th>
                        <th>Description</th>
                        <th class="start-date">Start Date</th>
                        <th>Expiry</th>
                        <th>Discount</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="list-coupon-tbody"></tbody>
            </table>

        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Available Coupon.js"></script>
</html>