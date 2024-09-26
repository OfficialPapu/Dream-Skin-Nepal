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
    <style>
        .slider-main-container {
            margin: 10px 0;
        }

        .slider-main-container img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        .slider-main-container {
            display: grid;
            grid-template-columns: 84vw 15vw;
            justify-content: center;
            gap: 4px;
        }

        @media (max-width:600px) {
            .image {
                display: none;
            }

            .slider-main-container {
                grid-template-columns: 99vw;
            }
            
        .slider-main-container img {
            border-radius: 4px;
        }
        }
    </style>
</head>


<body>
    <div class="slider-main-container">
        <div class="swiper myswiper img-slider">
            <img src="<?php echo $ImageCresol; ?>dsahian offer website.jpg" alt="Dsahian Offer Website" loading="lazy">
        </div>
        <div class="image">
            <img src="New theme.jpg" alt="">
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
<script src="Assets/JS/Image Cresol.js"></script>
<script>
    //     $(document).ready(function(){
    //     let width = $(window).width();
    //     if (width >= 600) {
    //         $('.remove-in-pc').remove();
    //         $('.Image-Cresol').prepend('<div class="swiper-slide remove-in-pc"><div class="slider"><img src="<?php echo $ImageCresol; ?>Mother\'s Day Offer.jpg" alt="Mother\'s Day Offer" loading="lazy"></div></div>');
    //     } else {
    //         $('.remove-in-pc').remove();
    //         $('.Image-Cresol').prepend('<div class="swiper-slide remove-in-mobile"><div class="slider"><img src="" alt="Mother\'s Day Offer" loading="lazy"></div></div>');
    //     }
    // });
</script>