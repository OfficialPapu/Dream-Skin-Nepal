<head>
    <?php
    @session_name('URLSession');
    @session_start();
    $base_url = $_SESSION['URLSession']['Base Path'];
    $ImageCresol = 'Assets/Product/Media/Images/Slider Images/';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="Assets/CSS/Image Cresol.css">
</head>

<body>
    <div class="slider-main-container">
        <div class="swiper myswiper img-slider">
            <div class="swiper-wrapper Image-Cresol">
                <div class="swiper-slide">
                    <div class="slider"><img src="<?php echo $ImageCresol; ?>Moisturizer.jpg" alt="Moisturizer" loading="lazy"></div>
                </div>

                <div class="swiper-slide">
                    <div class="slider"><img src="<?php echo $ImageCresol; ?>Serum.jpg" alt="Serum" loading="lazy"></div>
                </div>

                <div class="swiper-slide">
                    <div class="slider"><img src="<?php echo $ImageCresol; ?>Sunscreen.jpg" alt="Sunscreen" loading="lazy"></div>
                </div>
                <div class="swiper-slide">
                    <div class="slider"><img src="<?php echo $ImageCresol; ?>Cleanser.jpg" alt="Cleanser" loading="lazy"></div>
                </div>
            </div>
            <div class="swiper-button-next swiper-button-next-btn"></div>
            <div class="swiper-button-prev swiper-button-next-btn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
<script src="Assets/JS/Image Cresol.js"></script>
<script>
    $(document).ready(function(){
    let width = $(window).width();
    if (width >= 600) {
        $('.remove-in-pc').remove();
        $('.Image-Cresol').prepend('<div class="swiper-slide remove-in-pc"><div class="slider"><img src="<?php echo $ImageCresol; ?>Mother\'s Day Offer.jpg" alt="Mother\'s Day Offer" loading="lazy"></div></div>');
    } else {
        $('.remove-in-pc').remove();
        $('.Image-Cresol').prepend('<div class="swiper-slide remove-in-mobile"><div class="slider"><img src="<?php echo $ImageCresol; ?>Mother\'s Day Offer 2.jpg" alt="Mother\'s Day Offer" loading="lazy"></div></div>');
    }
});
</script>
