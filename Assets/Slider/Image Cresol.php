<head>
    <?php
    @session_name('URLSession');
    @session_start();
    $base_url = $_SESSION['URLSession']['Base Path'];
    $ImageCresol = 'Assets/Product/Media/Images/Slider Images/';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" />
    <link rel="stylesheet" href="Assets/CSS/Images Cresol.css">
</head>
<body>
    <div class="slider-main-container">
        <div class="swiper myswiper img-slider">
            <img src="<?php echo $ImageCresol; ?>dsahian offer website.jpg" alt="Dsahian Offer Website" loading="lazy">
        </div>
        <div class="image">
            <img src="<?php echo $ImageCresol; ?>Sidebar.jpg" alt="Sidebar Image">
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>