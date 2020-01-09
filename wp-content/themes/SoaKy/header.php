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
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/public/nprogress.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/shejiwo.js"></script>
<?php wp_head();?>
</head>
<body>
<!-- 顶部导航栏 -->
<div class="topnav">
<?php 
    // 列出顶部导航菜单，菜单名称为mymenu，只列出一级菜单
    wp_nav_menu( array( 'menu' => 'mymenu', 'depth' => 1) );
?>
</div>

<!-- /顶部导航栏 -->
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
                <div class="pHeadPic">
					<div class="logo sm_none"><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php echo stripslashes(get_option('logo'));?>" /></a></div>
				</div>
                <div class="name"><?php bloginfo('name'); ?><div class="m_desc"> - <?php echo stripslashes(get_option('blogdescription')); ?></div></div>
                <div class="menu_btn">
                  <div class="lcbody">
                    <div class="lcitem top"><div class="rect top"></div></div>
                    <div class="lcitem bottom"><div class="rect bottom"></div></div>
                  </div>
                </div>
              </div>
              <!-- /left_top -->

  <div class="blog-sidebar-icon blog-sidebar-padding sm_none">
                <ul>
                    <li><a href="https://weibo.com/soaky" class="icon-weibo" target="_blank" data-toggle="tooltip" data-placement="top" title="新浪微博"><i class="fa fa-weibo"></i></a></li>
					<li><a href="javascript:" class="weixin" target="_blank" data-toggle="tooltip" data-placement="top" title="微信"><i class="fa fa-weixin"></i></a></li>
                    <li><a href="mailto:soaky@qq.com" class="icon-email" data-toggle="tooltip" data-placement="top" title="E-Mail"> <i class="fa fa-envelope"></i> </a></li>
                    <li><a href="<?php bloginfo('rss2_url'); ?>" class="icon-rss" data-toggle="tooltip" target="_blank" data-placement="top" title="RSS"><i class="fa fa-rss"></i></a></li>
                </ul>
            </div>
              <!-- left_description -->
              <div class="left_description sm_none"><?php echo stripslashes(get_option('blogdescription')); ?></div>
              <!-- /left_description -->
			  <!-- left_calendar -->
			  <div class="left_calendar sm_none">	
				<?php get_calendar(); ?>
			  </div>
			  <!-- /left_calendar -->
              <!-- left_menu -->
              <div class="left_menu sm_none">
                <div id="Menu">
<ul>
<?php
$currentcategory = '';

// 以下这行代码用于在导航栏添加分类列表，
// 如果你不想添加分类到导航中，
// 请删除 6 - 14 行代码
if  (is_category() || is_single()) {
	$catsy = get_the_category();
	$myCat = $catsy[0]->cat_ID;
	$currentcategory = '&current_category='.$myCat;
}
wp_list_categories('depth=1&title_li=&show_count=0&hide_empty=0&child_of=0'.$currentcategory);

?>
</ul>
                </div>
              </div>
              <!-- /left_menu -->
			  
			  <!-- Tags Cloud -->
			  <div class="sm_none">
			  <aside class="tags"><?php wp_tag_cloud('smallest=10&largest=10&number=28&order=RAND'); ?></aside>
			  </div>
			  <!-- /Tags Cloud -->
			  
			  <!-- 网站统计 -->
			  <div class="tongji sm_none">
				<ul type="disc">
					<li>日志总数：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> 篇</li>
					<li>浏览总量：<?php get_totalviews(); ?> 次</li>
					<li>运行天数：<?php echo floor((time()-strtotime("2017-9-14"))/86400); ?> 天</li>
					<li>建站时间：2017-9-14</li>
					<li>最后更新：<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y-n-j', strtotime($last[0]->MAX_m));echo $last; ?></li>
				</ul>
			  </div>
			  <!-- /网站统计 -->

              <!-- left_search -->
              <div class="left_search sm_none">
                <div class="left_search_box"><?php include("search_form.php");?></div>
              </div>
              <!-- /left_search -->
              
            </div>
            <!--/Left-->

        </div>
   </div>
      <!-- /col-md-4 -->