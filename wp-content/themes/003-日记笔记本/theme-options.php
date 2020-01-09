<?php
/*********************************************************************************************

Initalize Framework Settings

*********************************************************************************************/
if ( !function_exists( 'optionsframework_init' ) ) {

define('OPTIONS_FRAMEWORK_URL',  get_template_directory_uri() . '/admin/');
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory() . '/admin/');  

require_once (OPTIONS_FRAMEWORK_DIRECTORY . 'options-framework.php');
require_once (OPTIONS_FRAMEWORK_DIRECTORY . 'inc/customfunctions.php');
require_once (OPTIONS_FRAMEWORK_DIRECTORY . 'inc/wphooks.php');
require_once (OPTIONS_FRAMEWORK_DIRECTORY . 'inc/customizer.php');
require_once (OPTIONS_FRAMEWORK_DIRECTORY . 'shortcodes/shortcodes.php');
require_once (OPTIONS_FRAMEWORK_DIRECTORY . 'shortcodes/shortcodespanel.php');
}

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
    $optionsframework_settings = get_option('optionsframework');
    // Gets the unique option id
    $option_name = $optionsframework_settings['id'];
    if ( get_option($option_name) ) {
        $options = get_option($option_name);
    }
    if ( isset($options[$name]) ) {
        return $options[$name];
    } else {
        return $default;
    }
}
}

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(get_stylesheet_directory() . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtoupper($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Theme Prefix
	$shortname = "diary";
		
	// Default Font Format
	$defaultfonts_array = array(
    "Georgia, Times New Roman, Times, serif" => "Georgia, Times New Roman, Times, serif",
    "Arial, Helvetica, sans-serif" => "Arial, Helvetica, sans-serif",
	"Verdana, Arial, Helvetica, sans-serif" => "Verdana, Arial, Helvetica, sans-serif",
	"Trebuchet MS, Arial, Helvetica, sans-serif" => "Trebuchet MS, Arial, Helvetica, sans-serif"
    );
	
	// Number Format For Select
    $numberofs_array = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10", "11" => "11", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18", "19" => "19", "20" => "20");


	// Background Defaults
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');


	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/admin/images/';
	$blogpath =  get_stylesheet_directory_uri() . '';
	$options = array();


/*********************************************************************************************

Initalize Theme Options

*********************************************************************************************/
if ( !function_exists( 'optionsframeworks_init' ) ) {

define('OPTIONS_URL', get_template_directory_uri() . '/admin/options/');
define('OPTIONS_DIRECTORY', get_template_directory() . '/admin/options/');

require( OPTIONS_DIRECTORY . 'general.php' );
require( OPTIONS_DIRECTORY . 'typography.php' );
require( OPTIONS_DIRECTORY . 'css.php' );
require( OPTIONS_DIRECTORY . 'colors.php' );
require( OPTIONS_DIRECTORY . 'social.php' );
require( OPTIONS_DIRECTORY . 'contact.php' );
require( OPTIONS_DIRECTORY . 'footer.php' );
require( OPTIONS_DIRECTORY . 'meta.php' );
}
	return $options;
}
?>