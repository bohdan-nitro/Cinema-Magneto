<?php
/**
 * Section news template
 */

$args = array(
    'post_type' => 'post',
    'category_name' => 'news',
    'posts_per_page' => 3,
    'post_status' => 'publish'
);
$posts = new WP_Query($args);

if ($posts->have_posts()) :

    $title_label = get_field("title_label");

    $right_label = get_field("right_label");
    $right_image = get_field("right_image");
    $right_description = get_field("right_description");
    $right_link = get_field("right_link");
    ?>

    <section class="news" id="news">
        <div class="container">

            <div class="title-box">
                <div class="left-side">
                    <img src="images/src/video.svg" alt="" class="title-image">
                    <h2 class="left-label">
                        Latest News
                    </h2>

                    <div class="content-wrapper">

                        <?php while ($posts->have_posts()) : $posts->the_post(); ?>

                            <div class="content-box">
                                <div class="content-image">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="content-label">
                                    <?php echo get_the_title(); ?>
                                </div>
                                <div class="content-description">
                                    <?php echo get_the_content(); ?>
                                </div>
                            </div>

                        <?php endwhile; ?>

                    </div>

                </div>
            </div>

            <div class="right-side">
                <h2 class="right-label"><?php echo $right_label; ?></h2>
                <div class="right-content-box">
                    <div class="right-image">
                        <img src="<?php echo $right_image["url"]; ?>" alt="">
                    </div>
                    <div class="right-title"><?php echo $right_description; ?></div>
                    <a href="<?php echo $right_link["url"]; ?>" target="<?php echo $right_link["target"]; ?>"
                       class="btn">
                        <?php echo $right_link["title"]; ?>
                    </a>
                </div>
            </div>

        </div>
    </section>

<?php endif; ?>