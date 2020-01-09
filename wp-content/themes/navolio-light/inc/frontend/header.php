<?php
/**
 * Hooks for template header
 *
 * @package Navolio_Light
 * Custom scripts and styles on header
 *
 * @since  1.0
 */
function navolio_light_header_scripts_css() {	
	ob_start();
	get_template_part('/inc/frontend/helpers');	
	$custom_css_code = ob_get_clean(); 
	wp_add_inline_style( 'navolio-light-main-style', $custom_css_code );
}
add_action( 'wp_enqueue_scripts', 'navolio_light_header_scripts_css', 300 );
