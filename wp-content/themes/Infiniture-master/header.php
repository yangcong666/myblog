<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package infiniture
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php echo '跳转至内容'; ?></a>

	<div id="sidebar" class="sidebar">
		<header id="masthead" class="masthead">
			<div class="site-branding clear">
				<div class="branding">
					<?php the_custom_logo(); ?>
				</div>
				<div class="branding">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php 
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php
					endif; ?>
				</div>
			</div><!-- .site-branding -->
		</header><!-- #masthead -->

		<?php get_sidebar(); ?>
	</div><!-- .sidebar -->

	<div id="content" class="content">
		<div class="site-header clear">
			<nav id="site-navigation" class="main-navigation clear">
				<div class="toggle-container hidden clear">
					<div class="menu-toggle toggle">
						<div class="bar"></div>
						<div class="bar"></div>
						<div class="bar"></div>
					</div>

					<div class="search-toggle toggle">	
						<div class="metal"></div>
						<div class="glass"></div>
						<div class="handle"></div>					
					</div>
				</div>
				<ul class="blog-menu hidden clear">
					<?php 
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu'
						) );
			    ?>
				</ul> 
				<div class="blog-search hidden clear">
					<?php
					if ( ! is_active_sidebar( 'sidebar-2' ) ) {
						get_search_form();
					} else {
						dynamic_sidebar( 'sidebar-2' );
					}
					?>
				</div>
		  </nav><!-- #site-navigation -->
		</div>
