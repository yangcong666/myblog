<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="height=device-height,width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no" />
<title><?php
/*
* Print the <title> tag based on what is being viewed.
*/
global $page, $paged;
wp_title(' | ', true, 'right');
// Add the blog name.
bloginfo( 'name' );
// Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
echo " | $site_description";
// Add a page number if necessary:
// if ( $paged >= 2 || $page >= 2 )
// echo '   ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
?></title>
<?php echo stripslashes(get_option('head_code')); ?>
<?php if(is_home()){ //首页附加代码 ?>
<?php echo stripslashes(get_option('head_home_code')); ?>
<?php } ?>
<?php if(is_single()){?>
<?php if(get_post_meta($post->ID, "keywords_value", true)){ ?>
<meta name="keywords" content="<?php echo get_post_meta($post->ID, "keywords_value", true); ?>"/>
<?php }else{ ?>
<meta name="keywords" content="<?php echo stripslashes(get_option('S_Keyword')); ?>"/>
<?php } ?>
<?php }else{ ?>
<meta name="keywords" content="<?php echo stripslashes(get_option('S_Keyword')); ?>"/>
<?php } ?>
<?php if(is_single()){?>
<?php if(get_post_meta($post->ID, "description_value", true)){ ?>
<meta name="description" content="<?php echo get_post_meta($post->ID, "description_value", true); ?>"/>
<?php }else{ ?>
<meta name="description" content="<?php echo stripslashes(get_option('S_Description')); ?>"/>
<?php } ?>
<?php }else{ ?>
<meta name="description" content="<?php echo stripslashes(get_option('S_Description')); ?>"/>
<?php } ?>
<?php if(stripslashes(get_option('favicon'))){?>
<link rel="icon" href="<?php echo stripslashes(get_option('favicon'));?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo stripslashes(get_option('favicon'));?>" type="image/x-icon" />
<?php };?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?ver=20161122" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/public/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/public/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/public/jquery.lazyload.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/public/nprogress.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/shejiwo.js"></script>
<?php wp_head();?>
<script>
$().ready(function(){
	$("#Central img").lazyload({
		effect : "fadeIn",
		failurelimit : 5
	});
});
</script>
</head>
<body>
<!-- container -->
<div class="container container_box container_body">

  <div class="mobile_menu">
    <div class="mobile_menu_box"><?php wp_nav_menu( array( 'theme_location' => 'mobile-header-menu' ) ); ?></div>
  </div>

  <!-- row -->
  <div class="row">


      <!-- col-md-4 -->
      <div class="col-md-4 left">
        <div class="left_box">

            <!--Left-->
            <div id="Left">

              <!-- left_top -->
              <div class="left_top">
                <div class="logo"><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>" class="the_hover"><img src="<?php echo stripslashes(get_option('logo'));?>" /></a></div>
                <div class="name"><?php bloginfo('name'); ?></div>
                <div class="menu_btn">
                  <div class="lcbody">
                    <div class="lcitem top"><div class="rect top"></div></div>
                    <div class="lcitem bottom"><div class="rect bottom"></div></div>
                  </div>
                </div>
              </div>
              <!-- /left_top -->


              <!-- left_description -->
              <div class="left_description sm_none"><?php echo stripslashes(get_option('blogdescription')); ?></div>
              <!-- /left_description -->


              <!-- left_menu -->
              <div class="left_menu sm_none">
                <div id="Menu">
                  <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
                </div>
              </div>
              <!-- /left_menu -->

              <!-- left_search -->
              <div class="left_search sm_none">
                <div class="left_search_box"><?php include("search_form.php");?></div>
              </div>
              <!-- /left_search -->

              <!-- left_copy -->
              <div class="left_copy sm_none">
                <div id="Copys"><?php echo stripslashes(get_option('S_Copy')); ?> <?php echo stripslashes(get_option('foot_count')); ?></div>
              </div>
              <!-- /left_copy -->
              
            </div>
            <!--/Left-->

        </div>
      </div>
      <!-- /col-md-4 -->