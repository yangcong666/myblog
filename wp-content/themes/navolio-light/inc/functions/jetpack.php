<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Navolio_Light
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function navolio_light_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'navolio_light_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function navolio_light_jetpack_setup
add_action( 'after_setup_theme', 'navolio_light_jetpack_setup' );

function navolio_light_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/post/content', get_post_format() );
	}
} // end function navolio_light_infinite_scroll_render