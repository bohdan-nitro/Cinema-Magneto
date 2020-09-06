<?php
/**
 * Section about template
 */

$about_image= get_field("about_image");
$about_label = get_field("about_label");
$about_description = get_field("about_description");
?>

<section class="about" id="about">
    <div class="container">
        <div class="about__title-box">
            <h2 class="about__title">About</h2>
        </div>
        <div class="about__left-side">
            <div class="about__image">
                <img src="<?php echo $about_image["url"]; ?>" alt="about">
            </div>
        </div>
        <div class="about__right-side">
            <div class="right__side-title"><?php echo $about_label; ?></div>
            <div class="right__side-description">
                <?php echo $about_description; ?>
            </div>
            <div class="right__side-link">
                <a href="#" class="btn about-btn"><?php echo get_field("about_link")["title"];?></a>
            </div>
        </div>
    </div>
</section>