<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
$canonical_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link rel="stylesheet" href="Assets/CSS/404.css">
</head>
<body>
    <div class="container">
        <h1><span class="first-text">4</span>0<span class="last-text">4</span>!</h1>
        <p>Whoops! The page you are looking for cannot be found.</p>
        <a href="/" class="home-link">Return to Home</a>
    </div>
</body>
</html>
