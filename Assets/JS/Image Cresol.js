let swiper_1 = new Swiper(".myswiper", {
    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
        clickable: true,
    },
    loop: true,
    autoplay: {
        pauseOnMouseEnter: true,
        delay: 8000,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
