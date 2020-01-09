<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function nevler_custom_css_mods() {

	echo "<style id='custom-css-mods'>";
	
	//If Highlighting Nav active item is disabled
	if ( get_theme_mod('nevler_disable_active_nav') ) :
		echo "#site-navigation ul .current_page_item > a, #site-navigation ul .current-menu-item > a, #site-navigation ul .current_page_ancestor > a { border:none; background: inherit; }"; 
	endif;
	
	//If Title and Desc is set to Show Below the Logo
	if (  get_theme_mod('nevler_branding_below_logo') ) :
		
		echo "#masthead #text-title-desc { display: block; clear: both; } ";
		
	endif;
	
	//If Logo is Centered
	if ( get_theme_mod('nevler_center_logo',true) ) :
		
		echo "#masthead #text-title-desc, #masthead #site-logo { float: none; } .site-branding { text-align: center; } #text-title-desc { display: inline-block; }";
		
	endif;
	
	//Exception: When Logo is Centered, and Title Not Set to display in next line.
	if ( get_theme_mod('nevler_center_logo') && !get_theme_mod('nevler_branding_below_logo') ) :
		echo ".site-branding #text-title-desc { text-align: left; }";
	endif;
	
	//Exception: When Logo is centered, but there is no logo.
	if ( get_theme_mod('nevler_center_logo') && !get_theme_mod('nevler_logo') ) :
		echo ".site-branding #text-title-desc { text-align: center; }";
	endif;
	
	//Exception: IMage transform origin should be left on Left Alignment, i.e. Default
	if ( !get_theme_mod('nevler_center_logo') ) :
		echo "#masthead #site-logo img { transform-origin: left; }";
	endif;	
	
	
	if ( get_theme_mod('nevler_title_font') ) :
		echo ".title-font, h1, h2, .section-title { font-family: ".esc_html(get_theme_mod('nevler_title_font','Roboto Condensed'))."; }";
	endif;
	
	if ( get_theme_mod('nevler_body_font') ) :
		echo "body { font-family: ".esc_html(get_theme_mod('nevler_body_font','Lato'))."; }";
	endif;
	
	if ( get_theme_mod('nevler_site_titlecolor') ) :
		echo "#masthead h1.site-title a { color: ".esc_html(get_theme_mod('nevler_site_titlecolor', '#FFF'))."; }";
	endif;
	
	
	if ( get_theme_mod('nevler_header_desccolor','#777') ) :
		echo "#masthead h2.site-description { color: ".esc_html(get_theme_mod('nevler_header_desccolor','#FFF'))."; }";
	endif;
	
	if ( get_theme_mod('nevler_hide_title_tagline') ) :
		echo "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	

	echo "</style>";
}

add_action('wp_head', 'nevler_custom_css_mods');