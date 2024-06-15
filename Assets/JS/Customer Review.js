var swiper = new Swiper(".mySwiper", {
    loop: true,
    speed: 1000,

    autoplay: {
        pauseOnMouseEnter: true,
        delay: 5000,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
        },
        830: {
            slidesPerView: 2,
        },
        1250: {
            slidesPerView: 3,
        },
        1600: {
            slidesPerView: 4,
        },
    },

});