<?php
@session_name('LoginSession');
@session_name('URLSession');
@session_start();
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Account Configuration/Upload Payment Screenshot Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>Upload Payment Screenshot</title>
    <link rel="stylesheet" href="Assets/CSS/Upload Payment Screenshot.css">
</head>

<body>
    <div class="esewa-container">
        <h1>Upload Payment Screenshot</h1>
        <p class="remark">Note: Please write your name is remark</p>
        <div class="qr-code-box">
            <img src="Assets/Product/Media/Images/Logo/Dream Skin Nepal e-Sewa.jpg" alt="QR Code">
            <a class="download-qr" href="Assets/Product/Media/Images/Logo/Dream Skin Nepal e-Sewa.jpg" download>Download QR</a>
        </div>

        <form action="Account/UserAccount/eSewa.php?PaymentInfo" method="POST" enctype="multipart/form-data" class="Esewa-payment-form">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Select Payment
                Screenshot</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="file_input" type="file" accept="image/*" required name="fileToUpload">
            <input type="submit" class="submit-btn" value='Place Order' name="Submit">
        </form>
    </div>
</body>

</html>