var swiper = new Swiper(".slider-1", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
var swiper2 = new Swiper(".slider-2", {
    autoHeight: true,
    navigation: {
        nextEl: "swiper-next",
        prevEl: ".swiper-prev",
    },
});
var swiper3 = new Swiper(".slider-3", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    loop: true,
    slidesPerView: "auto",
    coverflowEffect: {
        rotate: 40,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
    },
    navigation: {
        nextEl: "custom-next",
        prevEl: ".custom-prev",
    },
    pagination: {
        el: '.custom-pagination',
    }
});