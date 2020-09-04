
$(document).ready(function () {

    let headerNavigationSelector = '.header .header-navigation';
    let headerBurgerBtnSelector = '.header .header-burger-btn';
    let headerLink = ".header .nav__item";

    //  Burger btn click
    $(headerBurgerBtnSelector).on('click', function () {

        $(headerNavigationSelector).addClass('active').fadeIn(300);

        $(headerLink).on("click", function () {
            $(headerNavigationSelector).removeClass("active");


        });

    });


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
        slidesPerView: 1,
        freeMode: true,
        navigation: {
            nextEl: '.films .swiper-button-next',
            prevEl: '.films .swiper-button-prev',
        },
        breakpoints: {
            1024: {
                slidesPerView: 3,
            },
            640: {
                slidesPerView: 1,
            },
            420: {
                slidesPerView: 1,
                spaceBetweenSlides: 30,
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
            1200: {
                slidesPerView: 4,
            },
            1000: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            640: {
                slidesPerView: 1,
            },
            420: {
                slidesPerView: 1,
            },
            400: {
                slidesPerView: 1,
            },
        }
    });

});