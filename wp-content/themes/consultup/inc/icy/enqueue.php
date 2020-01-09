<?php function consultup_scripts() {

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');

	wp_enqueue_style( 'consultup-style', get_stylesheet_uri() );
	wp_style_add_data( 'consultup-style', 'rtl', 'replace' );

	wp_enqueue_style('consultup-default', get_template_directory_uri() . '/css/colors/default.css');
	
	wp_enqueue_style('smartmenus',get_template_directory_uri().'/css/jquery.smartmenus.bootstrap.css');	

	wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/font-awesome.css');

	/* Js script */

	wp_enqueue_script( 'consultup-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'));

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));

	wp_enqueue_script('smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.js' , array('jquery'));

	wp_enqueue_script('smartmenus-bootstrap', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.js' , array('jquery'));
	
	wp_enqueue_script('consultup-main-js', get_template_directory_uri() . '/js/main.js' , array('jquery'));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'consultup_scripts');