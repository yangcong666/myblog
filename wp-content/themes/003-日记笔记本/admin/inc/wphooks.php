<?php
/*********************************************************************************************

WP_Hooks - Enqueue Javascripts

*********************************************************************************************/
function site5framework_header_init() {
    if (!is_admin()) {

    wp_enqueue_script('jquery' );

    wp_enqueue_script('modernizr', get_template_directory_uri().'/js/modernizr.full.min.js');
	wp_enqueue_script('selectivizr', get_template_directory_uri().'/js/selectivizr-min.js');
	wp_enqueue_script('prettyphotojs', get_template_directory_uri().'/js/jquery.prettyPhoto.js');
	wp_enqueue_script('customjs', get_template_directory_uri().'/js/custom.js');
	wp_enqueue_script('buttonsjs', get_template_directory_uri().'/lib/shortcodes/js/buttons.js');
	wp_enqueue_script('quovolverjs', get_template_directory_uri().'/lib/shortcodes/js/jquery.quovolver.js');
	wp_enqueue_script('cyclejs', get_template_directory_uri().'/lib/shortcodes/js/jquery.cycle.all.min.js');
	wp_enqueue_script('tweets', get_template_directory_uri() .'/js/jquery.tweet.js', array( 'jquery' ), false, false );

	wp_enqueue_style('skins',get_template_directory_uri().'/css/skin.php');
	wp_enqueue_style('prettyphoto',get_template_directory_uri().'/css/prettyPhoto.css');
	wp_enqueue_style('normalize', get_template_directory_uri().'/css/normalize.css');
	wp_enqueue_style('boxes',get_template_directory_uri().'/lib/shortcodes/css/boxes.css');
	wp_enqueue_style('lists',get_template_directory_uri().'/lib/shortcodes/css/lists.css');
	wp_enqueue_style('social',get_template_directory_uri().'/lib/shortcodes/css/social.css');
	wp_enqueue_style('slider',get_template_directory_uri().'/lib/shortcodes/css/slider.css');
	wp_enqueue_style('viewers',get_template_directory_uri().'/lib/shortcodes/css/viewers.css');
	wp_enqueue_style('tabs',get_template_directory_uri().'/lib/shortcodes/css/tabs.css');
	wp_enqueue_style('toggles',get_template_directory_uri().'/lib/shortcodes/css/toggles.css');
	wp_enqueue_style('site5_buttons',get_template_directory_uri().'/lib/shortcodes/css/buttons.css');
	wp_enqueue_style('columns',get_template_directory_uri().'/lib/shortcodes/css/columns.css');

}
}
add_action('init', 'site5framework_header_init');


/*********************************************************************************************

Admin Hooks / Portfolio and Slider Media Uploader

*********************************************************************************************/
function site5framework_mediauploader_init() {
    if (is_admin()) {
    wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('site5mediauploader', get_template_directory_uri().'/admin/js/site5mediauploader.js', array('jquery'));
}
}
add_action('init', 'site5framework_mediauploader_init');


/*********************************************************************************************

Favicon

*********************************************************************************************/
function site5framework_custom_shortcut_favicon() {
	if (of_get_option('diary_custom_favicon') != '') {
    echo '<link rel="shortcut icon" href="'. of_get_option('diary_custom_favicon') .'" type="image/ico" />'."\n";
	}
	else { ?><link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/ico" />
	<?php }
}
add_action('wp_head', 'site5framework_custom_shortcut_favicon');

/*********************************************************************************************

Contact Form JS

*********************************************************************************************/
function site5framework_contactform_init() {
	if (is_page_template('contact.php') && !is_admin()) {
    wp_enqueue_script('contactform', get_template_directory_uri().'/lib/contactform/contactform.js', array( 'jquery' ), false, false );
    }
}
add_action('template_redirect', 'site5framework_contactform_init');

/*********************************************************************************************

Stats

*********************************************************************************************/
function site5framework_analytics(){
	$output = of_get_option('diary_analytics');
	if ( $output <> "" )
	echo stripslashes($output) . "\n";
}
add_action('wp_footer','site5framework_analytics');
?>