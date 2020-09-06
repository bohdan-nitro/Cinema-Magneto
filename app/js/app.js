class Cinema {

    constructor (headerNavSelector) {
        this.headerNavigationSelector = headerNavSelector;
        this.filmsSlider = null;
        this.reviewsSlider = null;
    }

    /**
     * Show response burger menu
     */
    showBurgerMenu = () => { $(this.headerNavigationSelector).addClass('active').slideUp(300) };

    /**
     * Hide response burger menu
     */
    hideBurgerMenu = () => { $(this.headerNavigationSelector).removeClass('active').slideDown(300) };

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
                    '<spn class="title">' + film.title + '</spn>' +
                    '</div>');
            });
        }

        this.filmsSlider = new Swiper(slider, {
            speed: 400,
            direction: 'horizontal',
            spaceBetween: 20,
            slidesPerView: 3,
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

}

$(document).ready(async () => {

    //  Header variables
    let headerNavSelector = '.header .header-navigation';
    let headerBurgerBtnSelector = '.header .header-burger-btn';
    let headerLink = ".header .nav__item";

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

        let elementClick = $(this).attr("href");
        let destination = $(elementClick).offset().top;

        $('html:not(:animated), body:not(:animated)').animate({
            scrollTop: destination
        }, 800);

        return false;
    });

    //  Init reviews slider
    cinema.initReviewsSlider('.reviews .swiper-container');

});