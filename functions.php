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
        wp_enqueue_style('cinema_magnetto-mfp', get_theme_file_uri('/app/css/mfp-popup.css'));
        wp_enqueue_style('cinema_magnetto-style', get_theme_file_uri('/style.css'));
    }

endif;

/**
 * Replace theme jquery core.
 */
if (!function_exists('replace_core_jquery_version')) :

    function replace_core_jquery_version()
    {
        wp_deregister_script('jquery-core');
        wp_register_script('jquery-core', get_theme_file_uri('/app/js/libs/jquery-3.4.1.min.js'), array(), '3.4.1');
        wp_deregister_script('jquery-migrate');
        wp_register_script('jquery-migrate', "https://code.jquery.com/jquery-migrate-3.0.0.min.js", array(), '3.0.0');
    }

endif;
add_action('wp_enqueue_scripts', 'replace_core_jquery_version');

//  Register scripts
if (!function_exists('cinema_magnetto_scripts_setup')) :

    function cinema_magnetto_scripts_setup()
    {
        $release_version = '1.001';

        wp_enqueue_script('cinema-magnetto-swiper', get_theme_file_uri('/app/js/libs/swiper.js'), array('jquery'), '1.0', true);
        wp_enqueue_script('cinema-magnetto-jquery-ui', get_theme_file_uri('/app/js/libs/jquery-ui.min.js'), array('jquery'), '1.0', true);
        wp_enqueue_script('cinema-magnetto-mfp', get_theme_file_uri('/app/js/libs/jquery.magnific-popup.js'), array('jquery'), '1.0', true);

        wp_enqueue_script('cinema-magnetto-main', get_theme_file_uri('/app/js/app.js'), array('jquery'), $release_version, true);
    }

endif;
add_action('wp_enqueue_scripts', 'cinema_magnetto_scripts_setup');

function kama_excerpt( $args = '' ){
    global $post;

    if( is_string($args) )
        parse_str( $args, $args );

    $rg = (object) array_merge( array(
        'maxchar'     => 350,   // Макс. количество символов.
        'text'        => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
        // Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется
        // все до <!--more--> вместе с HTML.
        'autop'       => true,  // Заменить переносы строк на <p> и <br> или нет?
        'save_tags'   => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
        'more_text'   => 'Читать дальше...', // Текст ссылки `Читать дальше`.
        'ignore_more' => false, // нужно ли игнорировать <!--more--> в контенте
    ), $args );

    $rg = apply_filters( 'kama_excerpt_args', $rg );

    if( ! $rg->text )
        $rg->text = $post->post_excerpt ?: $post->post_content;

    $text = $rg->text;
    // убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
    $text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text );
    // убираем шоткоды: [singlepic id=3]. Учитывает markdown
    $text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text );
    $text = trim( $text );

    // <!--more-->
    if( ! $rg->ignore_more  &&  strpos( $text, '<!--more-->') ){
        preg_match('/(.*)<!--more-->/s', $text, $mm );

        $text = trim( $mm[1] );

        $text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
    }
    // text, excerpt, content
    else {
        $text = trim( strip_tags($text, $rg->save_tags) );

        // Обрезаем
        if( mb_strlen($text) > $rg->maxchar ){
            $text = mb_substr( $text, 0, $rg->maxchar );
            $text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1...', $text ); // кил последнее слово, оно 99% неполное
        }
    }

    // сохраняем переносы строк. Упрощенный аналог wpautop()
    if( $rg->autop ){
        $text = preg_replace(
            array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
            array('',     '</p><p>',  '<br />', '</p>'),
            $text
        );
    }

    $text = apply_filters( 'kama_excerpt', $text, $rg );

    if( isset($text_append) )
        $text .= $text_append;

    return ( $rg->autop && $text ) ? "$text" : $text;
}
