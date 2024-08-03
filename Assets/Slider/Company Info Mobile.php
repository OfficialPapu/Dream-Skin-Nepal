<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="Assets/CSS/Company Info Mobile.css">
</head>
<div class="company-info-container hide-in-desktop swiper company-info-slider">
        <div class="company-info-box-mobile swiper-wrapper">

            <div class="swiper-slide">
                <div class="Company-detail-box">
                    <img src="Assets/Product/Media/Images/Logo/checked.png" alt="checked.png" loading="lazy">
                    <div class="box-heading">
                        <div class="body-heading">
                            Authenticity
                        </div>
                        <div class="body-heading-data">
                            100% Authentic Products Guaranteed
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="Company-detail-box">
                    <img src="Assets/Product/Media/Images/Logo/businessman.png" alt="businessman.png" loading="lazy">
                    <div class="box-heading">
                        <div class="body-heading">
                            Reliability
                        </div>
                        <div class="body-heading-data">
                            Your Go-To for Healthy, Glowing Skin
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="Company-detail-box">
                    <img src="Assets/Product/Media/Images/Logo/shipped.png" alt="shipped.png" loading="lazy">
                    <div class="box-heading">
                        <div class="body-heading">
                            Accuracy
                        </div>
                        <div class="body-heading-data">
                            Express Delivery Nationwide in Nepal
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="Company-detail-box">
                    <img src="Assets/Product/Media/Images/Logo/help.png" alt="help.png" loading="lazy">
                    <div class="box-heading">
                        <div class="body-heading">
                            Expertise
                        </div>
                        <div class="body-heading-data">
                            Expert skin advice, online or in-store
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="Company-detail-box">
                    <img src="Assets/Product/Media/Images/Logo/accessibility.png" alt="accessibility.png" loading="lazy">
                    <div class="box-heading">
                        <div class="body-heading">
                            Accessible
                        </div>
                        <div class="body-heading-data">
                            Contact us via phone, instagram & email
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="Company-detail-box">
                    <img src="Assets/Product/Media/Images/Logo/routine.png" alt="routine.png" loading="lazy">
                    <div class="box-heading">
                        <div class="body-heading">
                            Customized
                        </div>
                        <div class="body-heading-data">
                            Build your skincare routine with us
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".company-info-slider", {
            speed: 2500,
            loop: true,
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
            breakpoints: {
                430: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                650: {
                    slidesPerView: 4,
                },
                230: {
                    slidesPerView: 2,
                },
            },
        });
    </script>