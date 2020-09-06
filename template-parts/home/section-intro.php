<?php
/**
 * Section intro template
 */

$background = get_field("intro_background");
$title = get_field("intro_title");
$intro_description = get_field("intro_description");
$intro_link = get_field("intro_link");
$intro_image = get_field("intro_image");
?>

<section class="intro">
    <div class="intro-mask"></div>
    <div class="intro-background">
        <img src="<?php echo $background["url"]; ?>" alt="">
    </div>
    <div class="container">
        <div class="intro__content">
            <div class="intro__title">
                <h2 class="intro__label">
                    <?php echo $title; ?>
                </h2>
            </div>
            <div class="intro__description">
                <?php echo $intro_description; ?>
            </div>
            <div class="intro__btn">
                <a href="<?php echo $intro_link["url"]; ?>" target="<?php echo $intro_link["target"]; ?>" class="btn">
                    <?php echo $intro_link["title"]; ?>
                </a>
            </div>
        </div>
        <div class="intro__image">
            <img src="<?php echo $intro_image["url"]; ?>" alt="main-image" class="intro__image-item">
        </div>
    </div>
</section>