
$(document).ready(function () {


    let films = new Swiper('.films .swiper-container', {
        speed: 400,
        direction: 'horizontal',
        spaceBetween: 20,
        slidesPerView: 4,
        navigation: {
            nextEl: '.films .swiper-button-next',
            prevEl: '.films .swiper-button-prev',
        },
        breakpoints: {
            1000: {
                slidesPerView: 3,
            },
            640: {
                slidesPerView: 1,
            },
        }
    });

    let reviews = new Swiper('.reviews .swiper-container', {
        speed: 400,
        spaceBetween: 40,
        slidesPerView: 4,
        navigation: {
            nextEl: '.reviews .swiper-button-next',
            prevEl: '.reviews .swiper-button-prev',
        },
        breakpoints: {
            1000: {
                slidesPerView: 3,
            },
            640: {
                slidesPerView: 1,
            },
        }
    });

});