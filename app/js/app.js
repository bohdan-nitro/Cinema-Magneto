class Cinema {

    constructor (headerNavSelector) {
        this.headerNavigationSelector = headerNavSelector;
        this.filmsSlider = null;
        this.reviewsSlider = null;
    }

    /**
     * Show response burger menu
     */
    showBurgerMenu = () => {
        $(this.headerNavigationSelector).slideDown(300, function () {
            $(this).addClass('active')
        })
    };

    /**
     * Hide response burger menu
     */
    hideBurgerMenu = () => {
        $(this.headerNavigationSelector).slideUp(300, function () {
            $(this).removeClass('active')
        })
    };

    /**
     * Initialization films slider
     * @param {string} slider - slider element selector
     * @param {object} data - films ajax response object
     * @returns {object|boolean} Swiper object or false
     */
    initFilmsSlider = (slider, data) => {

        if (!slider || slider === '') {
            return false;
        }

        let films = data.results && data.results.length ? data.results : false;
        let filmsWrapper = $(slider).find('.swiper-wrapper');

        if (films) {
            filmsWrapper.empty();

            Object.keys(films).map((key) => {
                let film = films[key];
                let posterPath = 'https://image.tmdb.org/t/p/original' + film.poster_path;
                filmsWrapper.append('<div class="swiper-slide">' +
                    '<img src="' + posterPath + '" alt="" class="swiper-item"/> ' +
                    '<span class="swiper-title">' + film.title + '</span>' +
                    '</div>');
            });
        }

        this.filmsSlider = new Swiper(slider, {
            speed: 400,
            direction: 'horizontal',
            spaceBetween: 20,
            slidesPerView: 4,
            navigation: {
                nextEl: '.films .swiper-button-next',
                prevEl: '.films .swiper-button-prev',
            },
            breakpoints: {
                1024: {
                    slidesPerView: 2,
                },
                640: {
                    slidesPerView: 2,
                },
                420: {
                    slidesPerView: 1,
                },
            }
        });

        return this.filmsSlider;
    };

    /**
     * Get films AJAX
     * @param {string} slider - slider element selector
     * @param {string} ulrString - films ajax url
     */
    getFilms = (slider, ulrString) => {
        let _this = this;

        if (!ulrString) {
            return;
        }

        $.ajax({
            dataType: "json",
            url: ulrString,
            type: 'GET',
            success: function (data) {
                _this.initFilmsSlider(slider, data);
            }
        });
    };

    /**
     * Initialization reviews slider
     * @param {string} slider - slider element selector
     * @returns {object|bool} Swiper object or false
     */
    initReviewsSlider = (slider) => {

        if (!slider || slider === '') {
            return;
        }

        this.reviewsSlider = new Swiper(slider, {
            speed: 400,
            spaceBetween: 40,
            slidesPerView: 1,
            navigation: {
                nextEl: '.reviews .swiper-button-next',
                prevEl: '.reviews .swiper-button-prev',
            }
        });

        return this.reviewsSlider;

    };

    /**
     * Open contact popup
     */
    openContactPopup = () => {

        $.magnificPopup.open({
            items: {
                src: '#contactPopup',
            },
            type: 'inline',
            midClick: true,
            removalDelay: 100,
            mainClass: 'my-mfp-zoom-in',
            callbacks: {
                open: function () {
                    $('body').addClass('fixed');

                },
                close: function () {
                    $('body').removeClass('fixed');
                }
            }
        });

        $( 'div.wpcf7 > form' ).each( function() {
            let $form = $( this );
            wpcf7.initForm( $form );
            if ( wpcf7.cached ) {
                wpcf7.refill( $form );
            }

        });

    };

}

$(document).ready(function ($) {

    //  Header variables
    let headerNavSelector = '.header .header-navigation';
    let headerBurgerBtnSelector = '.header .header-burger-btn';
    let headerLink = ".header .nav__item";
    let headerContactLink = '.header .contact__btn';

    //  Create cinema class
    let cinema = new Cinema(headerNavSelector);

    //  Init films slider
    let filmsUrl = 'https://api.themoviedb.org/3/trending/movie/day?api_key=19cc2d55ec287216302aaf07144d9835';
    cinema.getFilms('.films .swiper-container', filmsUrl);

    //  Header burger btn click event
    $(document).on('click', headerBurgerBtnSelector, function () {
        if (!$(headerNavSelector).hasClass('active')) {
            cinema.showBurgerMenu();
        } else {
            cinema.hideBurgerMenu();
        }

        return false;
    });

    $(document).on('click', headerLink, function (e) {
        e.preventDefault();
        if ($(window).width() < 1024) {
            cinema.hideBurgerMenu();
        }
        let elementClick = $(this).attr("href");
        let destination = $(elementClick).offset().top;

        $('html:not(:animated), body:not(:animated)').animate({
            scrollTop: destination
        }, 800);

        return false;
    });

    $(document).on('click', headerContactLink, function (e) {
        e.preventDefault();
        cinema.openContactPopup();

        return false;
    });

    //  Init reviews slider
    cinema.initReviewsSlider('.reviews .swiper-container');

});