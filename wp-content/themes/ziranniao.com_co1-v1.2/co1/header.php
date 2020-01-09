<!DOCTYPE HTML>
<html>
<head>
<meta charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('-', true, 'right'); echo get_option('blogname'); if (is_home ()) echo "-", get_option('blogdescription'); if ($paged > 1) echo '-Page ', $paged; ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" media="all" />
<?php wp_head(); ?>
<?php if (is_home()){ ?>
<link rel="alternate" type="application/rss+xml" title="订阅<?php bloginfo ('name'); ?>(RSS 2.0)" href="<?php bloginfo('rss2_url'); ?>" />
<!--[if lt IE 9]>
<style>
.quick_menu a {-ms-filter: "progid:DXImageTransform.Microsoft.Matrix(M11=0.7, M12=0.7, M21=-0.7, M22=0.7, SizingMethod='auto expand')";}
.quick_menu {position:absolute;top:-45px;}
</style>
<![endif]--> 
<?php } ?>
</head>
<body>
<!-- head -->
	<div class="header"> 
		<?php if( is_home() ) echo '<h1 class="logo"><a'; else echo '<a class="logo"'; ?> href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a><?php if( is_home() ) echo '</h1>'; echo "\n"; ?>
		<ul class="nav">

			<?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'nav', 'echo' => false)) )); ?>

		</ul>

		<ul class="quick_menu">

			<?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'menu', 'echo' => false)) )); ?>

		</ul>

	</div>

 <!-- end head -->

 