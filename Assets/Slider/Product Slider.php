<head>
    <?php
    @session_name('URLSession');
    @session_start();
    $base_url = $_SESSION['URLSession']['Base Path'];
    include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
    include_once $base_url . 'Assets/PHP/Configuration/Slider Config.php';
    include_once  $base_url . 'Assets/PHP/URL/Base URL.php';
    ?>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" />
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Product Slider.css">
</head>

<body>
    <div class="swiper swiper-container">
        <?php
        $result = SliderQuery($Sql,$conn, $base_url,$user_id);
        include $base_url . "Assets/PHP/Configuration/Mobile Check.php";
        Slider($result, $base_url, $is_mobile, $conn);
        ?>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
    <script src="Assets/JS/Butterup/butterup.js"></script>
    <script src="Assets/JS/Butterup/butterup.min.js"></script>
    <script src="Assets/JS/Slider Config.js"></script>
