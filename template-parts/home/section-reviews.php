<?php
/**
 * Section reviews template
 */

$args = array(
    'post_type' => 'post',
    'category_name' => 'reviews',
    'posts_per_page' => 10,
    'post_status' => 'publish'
);
$posts = new WP_Query($args);

if ($posts->have_posts()) : ?>

<section class="reviews" id="reviews">
    <div class="container">
        <div class="reviews__title-box">
            <h2 class="reviews-title">Reviews</h2>
        </div>
        <div class="content__wrapper">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <?php while ($posts->have_posts()) : $posts->the_post(); ?>

                        <div class="swiper-slide">
                            <div class="reviews-image">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <span class="reviews-name">
                                <?php echo get_field('review_author'); ?>
                            </span>
                            <span class="reviews-description">
                                <?php echo get_the_content(); ?>
                            </span>
                        </div>

                    <?php endwhile; ?>

                </div>
            </div>
            <div class="nav__btn swiper-button-prev"><span>Prev</span></div>
            <div class="nav__btn swiper-button-next"><span>Next</span></div>
        </div>
    </div>
</section>

<?php wp_reset_postdata();
endif; ?>