<?php 
/**
 * WooCommerce Functions
 *
 * @package Navolio_Light
 * @since 1.0
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	/* Declare WooCommerce support */
	add_action( 'after_setup_theme', 'navolio_light_woocommerce_support' );
	function navolio_light_woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
   
	/* Header Add To Cart Ajax Function */
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
