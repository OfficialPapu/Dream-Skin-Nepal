<head>
    <?php
    $ProductType = 'Category/SkinCare.php/';
    ?>
    <?php
    include_once  $base_url . 'Assets/PHP/URL/Base URL.php';
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="Assets/CSS/Footer.css">
</head>

<div class="footer-container">
    <footer class="footer">
        <div class="footer__addr">
            <h2 class="nav__title">Locate Us</h2>
            <div class="card-content footer-map-content">
                <a class="card-item" href="https://maps.app.goo.gl/UFcmNCeu9iBK3bxE9">
                    <div class="card-icon">
                        <i class='bx bx-map'></i>
                    </div>
                    <h3 class="card-title">Dream Skin Baneshwor</h3>
                    <p class="card-description">View location</p>
                </a>
                <a class="card-item" href="https://maps.app.goo.gl/kLGH6gtYM62ZSFCbA">
                    <div class="card-icon">
                        <i class='bx bx-map'></i>
                    </div>
                    <h3 class="card-title">Dream Skin Lazimpat</h3>
                    <p class="card-description">View location</p>
                </a>
            </div>
        </div>

        <ul class="footer__nav">
            <li class="nav__item">
                <h2 class="nav__title">Quick Links</h2>

                <ul class="nav__ul">
                    <li>
                        <a href="<?php echo $ProductType; ?>Cleanser">Cleanser</a>
                    </li>
                    <li>
                        <a href="<?php echo $ProductType; ?>Moisturizer">Moisturizer</a>
                    </li>

                    <li>
                        <a href="<?php echo $ProductType; ?>Serum">Serum</a>
                    </li>
                    <li>
                        <a href="<?php echo $ProductType; ?>Sunscreen-Sun-Stick">Sunscreen</a>
                    </li>
                    <li>
                        <a href="<?php echo $ProductType; ?>Toner-Toner-Pad">Toner</a>
                    </li>
                </ul>
            </li>


            <li class="nav__item">
                <h2 class="nav__title">Follow Us</h2>
                <div class="social-links">
                    <a href="https://www.instagram.com/dream.skin.nepal"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/Dream.Skin.Nepal/"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://tiktok.com/@dream.skin.nepal"><i class="fab fa-tiktok"></i></a>
                </div>
                <div class="contact-infomation">
                    <p><i class="fa-brands fa-whatsapp"></i>&nbsp;&nbsp;&nbsp;&nbsp; +977-986-2078653</p>
                    <p><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;info@dreamskinnepal.com</p>
                </div>
            </li>
        </ul>

        <div class="legal">
            <p>&copy;2024 Dream Skin Nepal. All rights reserved.</p>
        </div>
    </footer>
</div>