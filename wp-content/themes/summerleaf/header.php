<?php
/**
 * @package WordPress
 * @subpackage Options Framework Theme
 */

 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
 <head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta http-equiv="Cache-Control" content="no-transform" />
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <meta name="applicable-device" content="pc,mobile" />
  <meta name="HandheldFriendly" content="true" />
  <?php wp_head(); ?>
 </head>
 <body class="<?php body_class(); ?>">
  <div id="page" class="hfeed site"> 
   <header id="masthead" class="site-header"> 
    <nav id="top-header"> 
     <div class="top-nav"> 
     	 <?php if (function_exists('wp_nav_menu')) {
            	  	
            	 wp_nav_menu(array('container' => 'div','menu_class' => 'top-menu','echo' => true ,'depth' => 1, 'items_wrap' =>  '<ul id="%1$s" class="%2$s">%3$s</ul>', 'theme_location' => 'top','link_before'  => '<span class="font-text">','link_after' => '</span>','walker' => new description_walker())); 
              } 
       ?>
      <div id="inf-d"> 
       <div id="inf-b">
        <span id="localtime"><?php echo of_get_option( 'summer_top_text', 'no entry' ); ?></span>
        <!----> 
       </div> 
       <div id="inf-e"></div>
      </div> 
     </div> 
    </nav>
    <!-- #top-header --> 
    <div id="menu-box" class=""> 
     <div id="top-menu"> 
      <span class="nav-search"><i class="fa fa-search"></i></span> 
      <div class="logo-sites"> 
      	<?php if (is_home() || is_front_page() ) {?> 
       <h1 class="site-title"> <a href="/"><img src="<?php 
       	$websitelog = of_get_option( 'summer_weblogo');
       	
       	echo ($websitelog) ? $websitelog : get_theme_file_uri('/images/logo.png') ;


       	
       ?>" title="<?php echo $websitename =get_bloginfo( 'name' );?>" alt="<?php echo $websitename; ?>" rel="home" /><span class="site-name"><?php echo $websitename; ?></span></a> </h1> 
      <?php } else {?> 
       <p class="site-title"> <a href="/"><img src="<?php 
       	$websitelog = of_get_option( 'summer_weblogo');
       	
       	echo ($websitelog) ? $websitelog : get_theme_file_uri('/images/logo.png') ;


       	
       ?>" title="<?php echo $websitename =get_bloginfo( 'name' );?>" alt="<?php echo $websitename; ?>" rel="home" /><span class="site-name"><?php echo $websitename; ?></span></a> </p> 
      <?php }?> 
      </div>
      <!-- .logo-site --> 
      <div id="site-nav-wrap"> 
       <div id="sidr-close">
        <a href="#sidr-close" class="toggle-sidr-close">&times;</a>
       </div> 
       <nav id="site-nav" class="main-nav"> 
        <a href="#sidr-main" id="navigation-toggle" class="bars"><i class="fa fa-bars"></i></a> 
        
       <?php if (function_exists('wp_nav_menu')) {
            	  	
            	 wp_nav_menu(array('container' => 'div','menu_class' => 'down-menu nav-menu','echo' => true , 'items_wrap' =>  '<ul id="%1$s" class="%2$s">%3$s</ul>', 'theme_location' => 'main','link_before'  => '<span class="font-text">','link_after' => '</span>','walker' => new description_walker())); 
              } 
       ?>
       </nav>
       <!-- #site-nav --> 
      </div>
      <!-- #site-nav-wrap --> 
      <div class="clear"></div> 
     </div>
     <!-- #top-menu --> 
    </div>
    <!-- #menu-box -->
   </header>
   <!-- #masthead -->
   <div id="search-main" class=""> 
    <a title="关闭" class="fancybox-close" href="javascript:;" id="search-close"><i class="fa fa-times"></i></a> 
    <div class="searchbar"> 
     <form method="get" id="searchform" action="/" target="_blank"> 
      <span> <input class="swap_value" placeholder="请输入搜索关键词" name="s" /> <button type="submit" id="searchsubmit">搜索</button> <span> </span></span>
     </form>
    </div>
    <div class="clear"></div>
   </div> 
   <nav class="breadcrumb">
    <?php if(function_exists('breadcrumbs')) breadcrumbs();?>
<div class="right summeraddthis">
<div class="addthis_toolbox addthis_default_style right">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
</div>




   </nav> 
