<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php if ( is_home() ) { ?>
<title><?php echo stripslashes(get_option('tang_title')); ?></title>
<?php } ?>
<?php if ( is_search() ) { ?>
<title>搜索结果 - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_single() ) { ?>
<title><?php echo trim(wp_title('',0)); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_page() ) { ?>
<title><?php echo trim(wp_title('',0)); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_category() ) { ?>
<title><?php single_cat_title(); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_month() ) { ?>
<title><?php the_time('F'); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?>
<title><?php single_tag_title("", true); ?> - <?php bloginfo('name'); ?></title>
<?php } } ?>
<?php
if (!function_exists('utf8Substr')) {
	function utf8Substr($str, $from, $len)
	{
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s','$1',$str);
	}
}
if ( is_single() ){
	if ($post->post_excerpt) {
		$description  = $post->post_excerpt;
	} else {
		if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
			$post_content = $result['1'];
		} else {
			$post_content_r = explode("\n",trim(strip_tags($post->post_content)));
			$post_content = $post_content_r['0'];
		}
		$description = utf8Substr($post_content,0,220);
	}
	$keywords = "";
	$tags = wp_get_post_tags($post->ID);
	foreach ($tags as $tag ) {
		$keywords = $keywords . $tag->name . ",";
	}
}
?>
<?php if ( is_single() ) { ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<?php } ?>
<?php if ( is_home() ) { ?>
<meta name="description" content="<?php echo stripslashes(get_option('tang_description')); ?>" />
<meta name="keywords" content="<?php echo stripslashes(get_option('tang_keywords')); ?>" />
<?php } ?>
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/font-awesome.min.css">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
if ( is_singular() && get_option( 'thread_comments' ) )
wp_enqueue_script( 'comment-reply' );
wp_head();
?>
</head>

<body>
<header id="header">
  <div class="avatar"><img src="<?php bloginfo('template_directory'); ?>/images/avatar.jpg" alt="<?php bloginfo('name'); ?>" class="img-circle" width="50%"></div>
  <h3 id="name"><?php bloginfo('name'); ?></h3>
  <div class="sns">
    <a href="<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i></a>
    <?php if (get_option('tang_weibo') == '显示') { ?>
    <a href="<?php echo stripslashes(get_option('tang_weibo_url')); ?>" target="_blank" rel="nofollow" title="Weibo"><i class="fa fa-weibo" aria-hidden="true"></i></a>
    <?php { echo ''; } ?>
    <?php } else { } ?>
    <?php if (get_option('tang_twitter') == '显示') { ?>
    <a href="<?php echo stripslashes(get_option('tang_twitter_url')); ?>" target="_blank" rel="nofollow" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    <?php { echo ''; } ?>
    <?php } else { } ?>
    <?php if (get_option('tang_facebook') == '显示') { ?>
    <a href="<?php echo stripslashes(get_option('tang_facebook_url')); ?>" target="_blank" rel="nofollow" title="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></i></a>
    <?php { echo ''; } ?>
    <?php } else { } ?>
  </div>
  <div class="nav">
   <?php wp_nav_menu (array(
   'theme_location'  => 'header-menu',
   'container'       => false,
   'menu'            => '',
   'menu_id'         => 'nav',
   'echo'            => true,
   'fallback_cb'     => '',
   'before'          => '',
   'after'           => '',
   'link_before'     => '',
   'link_after'      => '',
   'items_wrap'      => '<ul>%3$s</ul>',
   'depth'           => 0,
   'walker'          => '',)
   ); ?>
  </div>
</header>