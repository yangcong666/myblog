<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package nevler
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site container">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'nevler' ); ?></a>
	<div id="jumbosearch">
		<span class="fa fa-remove closeicon"></span>
		<div class="form">
			<?php get_search_form(); ?>
		</div>
	</div>	
	
	
	
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding">
				<?php if ( nevler_has_logo() ) : ?>
				<div id="site-logo">
					<?php nevler_logo(); ?>
				</div>
				<?php endif; ?>
				<div id="text-title-desc">
				<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
			</div>	
		</div>	
		
	</header><!-- #masthead -->
	<?php if (has_header_image()) : ?>
	<div id="header-image">
		<img src="<?php header_image(); ?>" width="100%">
	</div>
	<?php endif; ?>
	
	<div id="top-bar">
		<div class="container top-bar-inner">
			<div id="top-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</div>
		</div>
	</div>
	
	
	<div id="social-icons">
		<?php get_template_part('social', 'fa'); ?>
		<div id="top-search-form"><?php get_search_form(); ?></div>
	</div>
	
	<div class="mega-container">
			
		<?php get_template_part('featured', 'area1'); ?>				
	
		<div id="content" class="site-content container">