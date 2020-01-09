<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Codilight_Lite
 */

if ( ! is_active_sidebar( 'sidebar-default' ) ) {

	return;
}
?>


		

		
<div id="sidebar" class="widget-area"> 	
	<div> 	
				
<?php 


if (is_single() && is_active_sidebar( 'sidebar-postsidebar' )){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-postsidebar')) : endif; 
}
else if (is_category() && is_active_sidebar( 'widget-catsidebar' )){
	
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget-catsidebar')) : endif; 
  
}
else if (is_tag() && is_active_sidebar( 'widget-tagsidebar' )){
	
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget-tagsidebar')) : endif; 
  
}
else if (is_page() && is_active_sidebar( 'widget-pagesidebar' )){
	
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget-pagesidebar')) : endif; 
  
}
else if (is_home()||is_front_page() && is_active_sidebar( 'sidebar-homesidebar' )){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-homesidebar')) : endif; 
}
else {
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : endif; 
}




?>
  </div>

</div><!-- #secondary -->		

