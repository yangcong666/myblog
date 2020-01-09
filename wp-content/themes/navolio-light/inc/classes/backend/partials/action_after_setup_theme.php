<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'navolio-light' ) );

/*
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on Navolio_Light, use a find and replace
 * to change 'navolio-light' to the name of your theme in all the template files
 */
load_theme_textdomain( 'navolio-light', get_template_directory() . '/languages' );

/**
 * Add default posts and comments RSS feed links to head.
 * @package Navolio_Light
 * @since 1.0
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 * @package Navolio_Light
 * @since 1.0
 */
add_theme_support( 'title-tag' );

/**
 * Enable support for Post Thumbnails on posts and pages.
 * @package Navolio_Light
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 * @since 1.0
 */
add_theme_support( 'post-thumbnails' );

/**
 * Enable support for register menu
 * @package Navolio_Light
 * @since 1.0
 */
register_nav_menus( 
    array(
        'main-menu' => esc_html__( 'Main Menu', 'navolio-light' ),
    ) 
);

/**
 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
 * @package Navolio_Light
 * @since 1.0
 */
add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) 
);

/**
 * Enable support for custom background.
 * @package Navolio_Light
 * @since 1.0
 */
add_theme_support( 'custom-background', apply_filters( 'navolio_light_custom_background_args', array (
    'default-color' => 'f8f8ff',
    'default-image' => '',
) ) );

/**
 * Enable support for custom Header Image.
 * @package Navolio_Light
 * @since 1.0
 */
$args = array(
    'flex-width'    => true,
    'width'         => 1920,
    'flex-height'    => true,
    'height'        => 932,
);
add_theme_support( 'custom-header', $args );

/**
 * Enable support for custom Logo Image.
 * @package Navolio_Light
 * @since 1.0
 */
$navolio_light_cutom_logo = array(
    'height'      => 30,
    'width'       => 130,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
);
add_theme_support( 'custom-logo', $navolio_light_cutom_logo );

/** 
 * Enable selective refresh for widgets.
 *
 * @since 1.0
 */
add_theme_support( 'customize-selective-refresh-widgets' );

/**
 * Add Editor Style
 *
 * @since 1.0
 */
// Add support for editor styles.
add_theme_support( 'editor-styles' );

/**
 * Enable support for custom Editor Style.
 *
 * @since 1.0
 */
add_editor_style( 'assets/css/custom-editor-style.css' );

/**
 * Enable fonts Google font family
 *
 * @since 1.0
 */
// Enqueue fonts in the editor.
add_editor_style( navolio_light_enqueue_google_font_url( navolio_light_get_options( array('body_font', 'Open Sans' ) ) ) );
add_editor_style( navolio_light_enqueue_google_font_url( navolio_light_get_options( array('body_font', 'PT Serif' ) ) ) );

/** 
 * Enable WP Gutenberg Block Style
 *
 * @since 1.0
 */
add_theme_support( 'wp-block-styles' );

/** 
 * Enable WP Gutenberg Align Wide
 *
 * @since 1.0
 */
add_theme_support( 'align-wide' );

/** 
 * Enable Custom Color Scheme For Block Style
 *
 * @since 1.0
 */
add_theme_support( 'editor-color-palette', array(
    array(
        'name'  => esc_html__('strong blue','navolio-light'),
        'slug'  => 'strong-blue',
        'color' => '#0073aa',
    ),
    array(
        'name'  => esc_html__('lighter blue','navolio-light'),
        'slug'  => 'lighter-blue',
        'color' => '#229fd8',
    ),
    array(
        'name'  => esc_html__('very light gray','navolio-light'),
        'slug'  => 'very-light-gray',
        'color' => '#eee',
    ),
    array(
        'name'  => esc_html__('very dark gray','navolio-light'),
        'slug'  => 'very-dark-gray',
        'color' => '#444',
    )
) );