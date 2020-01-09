<!DOCTYPE html>
<html><head>
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />
<meta name="description" content="<?php bloginfo( 'description' ); ?>">
<meta name="keywords" content="<?php bloginfo( 'name' ); ?>">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/bananacafe-pc.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/bananacafe-phone.css" />
<?php wp_head(); ?>
</head>
<body>
<header id="header-web">
  <div class="header-main">
    <hgroup>
      <h1><a href="http://www.bananacafe.cn" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>"></a></h1>
      <h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
      <h3><?php bloginfo( 'description' ); ?></h3>
    </hgroup>
    <!--logo-->
    <nav class="header-nav">
      <?php wp_nav_menu( array( 'theme_location'=>'top-menu','container' => '') ); ?>
    </nav>
    <!--header-nav-->
    
    <div class="rss">
    <a href="<?php bloginfo('rss2_url'); ?>" title="RSS订阅本站" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/rss.png" alt="<?php bloginfo( 'name' ); ?>"></a>
    </div>
    
  </div>
</header>
<!--header-web-->