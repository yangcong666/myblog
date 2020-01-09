<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="keywords" content="<?php echo of_get_option('diary_keywords'); ?>" />
<meta name="description" content="<?php echo of_get_option('diary_description'); ?>" />
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Droid+Serif:regular,bold' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Kristi' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Bevan' rel='stylesheet' type='text/css'>

<!-- [if IE 7]>
<link rel="stylesheet" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" />
<![endif]-->


<!-- custom typography-->   
<?php if(of_get_option('diary_main_font_link') != '') { ?>
<?php echo of_get_option('diary_main_font_link');?>
<?php } ?>
<?php if(of_get_option('diary_font_title_link') != '') { ?>
<?php echo of_get_option('diary_font_title_link');?>
<?php } ?>
<?php if(of_get_option('diary_font_date_link') != '') { ?>
<?php echo of_get_option('diary_font_date_link');?>
<?php } ?>
<?php if(of_get_option('diary_font_more_link') != '') { ?>
<?php echo of_get_option('diary_font_more_link');?>
<?php } ?>
<?php if(of_get_option('diary_font_heading_link') != '') { ?>
<?php echo of_get_option('diary_font_heading_link');?>
<?php } ?>
<?php if(of_get_option('diary_font_sideheading_link') != '') { ?>
<?php echo of_get_option('diary_font_sideheading_link');?>
<?php } ?>
<!-- custom typography -->


<?php if(of_get_option('diary_css_code') != '') { ?> 
<!-- custom css -->  
	<?php load_template( get_template_directory() . '/custom.css.php' );?>
<!-- custom css -->
<?php } ?>

<!-- wp hook-->
<?php
	if ( is_singular() && of_get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		wp_head();
?>
<!-- wp hook--> 

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
	<!-- Begin Header -->
	<header id="page-header">
	  <div id="logo">
			<h1 id="title"><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<span><?php bloginfo( 'description');?></span>	  </div>
	 <div id="topSearch">
		<form id="searchform" action="<?php bloginfo( 'url' ); ?>" method="get">
			<input type="text" id="s" name="s" value="<?php _e("type your search and hit enter", "site5framework"); ?>" onFocus="this.value=''" />
		</form>
	</div>
	</header>
	<!-- End Header -->
	<!-- Begin Content -->
	<div id="content-wrapper">
		<div id="content-inner-wrapper">
