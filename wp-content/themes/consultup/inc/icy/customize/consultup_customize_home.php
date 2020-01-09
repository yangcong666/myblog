<?php
function consultup_homepage_setting( $wp_customize ) {

	/* Frontpage Section */
	$wp_customize->add_panel( 'homepage_sections', array(
		'priority' => 95,
		'capability' => 'edit_theme_options',
		'title' => __('Homepage section settings', 'consultup'),
	) );
	}
	add_action( 'customize_register', 'consultup_homepage_setting' );