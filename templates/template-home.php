<!DOCTYPE html>
<html lang="en">
<?php
/**
 * Template Name: Home page template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Cinema-Magnetto
 * @since Cinema-Magnetto 1.0
 */
wp_head();
?>
<body>

<?php
    get_header();
    get_template_part('./template-parts/home/section', 'intro');
    get_template_part('./template-parts/home/section', 'about');
    get_template_part('./template-parts/home/section', 'films');
    get_template_part('./template-parts/home/section', 'news');
    get_template_part('./template-parts/home/section', 'reviews');
    get_footer();
?>

</body>
<?php wp_footer(); ?>
</html>
