<?php
/**
 * Section films template
 */

$films_title = get_field("films_title");
?>

<section class="films" id="films">
    <div class="container container-slide">
        <div class="films__title-box">
            <h2 class="films__title">MOVIES</h2>
        </div>
        <div class="films__content">
            <div class="swiper-container">
                <div class="swiper-wrapper"></div>
            </div>
            <div class="nav__btn swiper-button-prev"><span>Prev</span></div>
            <div class="nav__btn swiper-button-next"><span>Next</span></div>
        </div>
    </div>
</section>
