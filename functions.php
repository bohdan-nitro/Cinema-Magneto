<?php
/**
 * Setup Cinema-Magnetto Theme.
 */

add_theme_support( 'post-thumbnails' );

//  Add viewport meta
if (!function_exists('add_viewport_meta_tag')) :

    function add_viewport_meta_tag()
    {
        echo ' <meta name="robots" content="index, follow, noodp">
               <meta name="googlebot" content="index, follow">
               <meta name="google" content="notranslate">
               <meta name="msapplication-TileColor" content="#ffffff">
	           <meta name="theme-color" content="#000000">
			   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
			   <meta http-equiv="X-UA-Compatible" content="ie=edge">';

    }

endif;
add_action('wp_head', 'add_viewport_meta_tag', '1');

//  Register styles
add_action('wp_enqueue_scripts', 'cinema_magnetto_styles_setup');
if (!function_exists('cinema_magnetto_styles_setup')) :

    function cinema_magnetto_styles_setup()
    {


        wp_enqueue_style('cinema_magnetto-swiper', get_theme_file_uri('/app/css/swiper.min.css'));
        wp_enqueue_style('cinema_magnetto-style', get_theme_file_uri('/style.css'));
    }

endif;

/**
 * Replace theme jquery core.
 */
if (!function_exists('replace_core_jquery_version')) :

    function replace_core_jquery_version()
    {
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-core');
        wp_register_script('jquery-core', get_theme_file_uri('/app/js/components/jquery-3.4.1.min.js'), array(), '3.4.1');
        wp_deregister_script('jquery-migrate');
        wp_register_script('jquery-migrate', "https://code.jquery.com/jquery-migrate-3.0.0.min.js", array(), '3.0.0');
    }

endif;
add_action('wp_enqueue_scripts', 'replace_core_jquery_version');

//  Register scripts
if (!function_exists('cinema_magnetto_scripts_setup')) :

    function cinema_magnetto_scripts_setup()
    {

        $release_version = '1.002';

        wp_enqueue_script('cinema_magnetto-swiper', get_theme_file_uri('/app/js/components/swiper.js'), array('jquery-core'), '1.0', true);

        wp_enqueue_script('cinema_magnetto-main', get_theme_file_uri('/app/js/app.min.js'), array('jquery-core'), $release_version, true);
    }

endif;
add_action('wp_enqueue_scripts', 'cinema_magnetto_scripts_setup');
