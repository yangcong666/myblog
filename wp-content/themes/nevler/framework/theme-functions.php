<?php
/*
 * @package nevler, Copyright Rohit Tripathi, rohitink.com
 * This file contains Custom Theme Related Functions.
 */
 
/*
** Walkers for Navigation menus
*/ 


/*
 * Pagination Function. Implements core paginate_links function.
 */
function nevler_pagination() {
	the_posts_pagination( array( 'mid_size' => 2 ) );
}

/*
** Customizer Controls 
*/
if (class_exists('WP_Customize_Control')) {
	class Nevler_WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'nevler' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}  

if (class_exists('WP_Customize_Control')) {
	class WP_Customize_Upgrade_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
             printf(
                '<label class="customize-control-upgrade"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $this->description
            );
        }
    }
}
  
/*
** Function to check if Sidebar is enabled on Current Page 
*/

function nevler_load_sidebar() {
	$load_sidebar = true;
	if ( get_theme_mod('nevler_disable_sidebar') ) :
		$load_sidebar = false;
	elseif( get_theme_mod('nevler_disable_sidebar_home') && is_home() )	:
		$load_sidebar = false;
	elseif( get_theme_mod('nevler_disable_sidebar_front') && is_front_page() ) :
		$load_sidebar = false;
	endif;
	
	return  $load_sidebar;
}

/*
**	Determining Sidebar and Primary Width
*/
function nevler_primary_class() {
	$sw = esc_html( get_theme_mod('nevler_sidebar_width',4) );
	$class = "col-md-".(12-$sw);
	
	if ( !nevler_load_sidebar() ) 
		$class = "col-md-12";
	
	echo $class;
}
add_action('nevler_primary-width', 'nevler_primary_class');

function nevler_secondary_class() {
	$sw = esc_html( get_theme_mod('nevler_sidebar_width',4) );
	$class = "col-md-".$sw;
	
	echo $class;
}
add_action('nevler_secondary-width', 'nevler_secondary_class');


/*
**	Helper Function to Convert Colors
*/
function nevler_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}
function nevler_fade($color, $val) {
	return "rgba(".nevler_hex2rgb($color).",". $val.")";
}


/*
** Function to Get Theme Layout 
*/
function nevler_get_blog_layout(){
	$ldir = 'framework/layouts/content';
	if (get_theme_mod('nevler_blog_layout') ) :
		get_template_part( $ldir , get_theme_mod('nevler_blog_layout') );
	else :
		get_template_part( $ldir ,'nevler');	
	endif;	
}
add_action('nevler_blog_layout', 'nevler_get_blog_layout');



/*
** Load Custom Widgets
*/

require get_template_directory() . '/framework/widgets/recent-posts.php';


