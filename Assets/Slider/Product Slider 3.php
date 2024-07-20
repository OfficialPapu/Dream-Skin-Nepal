<head>
    <?php
    @session_name('URLSession');
    @session_start();
    include_once $base_url . 'Assets/PHP/Configuration/Slider Config.php';
    $Sql="ORDER BY Rand() LIMIT 0,10";
    ?>
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
