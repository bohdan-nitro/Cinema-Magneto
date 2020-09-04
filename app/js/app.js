
$(document).ready(function () {


    $('a.scrollto').click(function () {
        let elementClick = $(this).attr("href");
        let destination = $(elementClick).offset().top;
        $('html:not(:animated), body:not(:animated)').animate({
            scrollTop: destination
        }, 800);
        return false;
    });



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
                slidesPerView: 4,
            },
            640: {
                slidesPerView: 1,
            },
        }
    });

});