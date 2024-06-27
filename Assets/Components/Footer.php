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
            <address>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.6214022099293!2d85.3356978751235!3d27.698094025900176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1926fcb220d7%3A0xa7afb64531f2dbc6!2sDream%20Skin%20Nepal!5e0!3m2!1sen!2snp!4v1707034493455!5m2!1sen!2snp" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="google-map"></iframe>
            </address>
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
