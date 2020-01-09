<?php
/**
 *
 * Header.php
 *
 * @subpackage LordSir
 * @since LordSir 0.01
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />


<title>
<?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'lordsir' ), max( $paged, $page ) );

?>

</title>

<?php if (is_home()) { 
?>
<meta name="keywords" content="域名拍卖,域名交易,域名删除,域名工具,域名投资,wordpress模板,wordpress函数,英语学习,幽默笑话,经典笑话,格言语录,网站建设,vps,外汇黄金,外汇EA,外汇代理的个人博客"/>
<meta name="description" content="域名拍卖,域名交易,域名删除,域名工具,域名投资,wordpress模板,wordpress函数,英语学习,幽默笑话,经典笑话,格言,语录,网站建设,vps,外汇黄金,外汇EA,外汇代理的个人博客"/>
<link rel="canonical" href="<?php echo get_settings('home'); ?>" />
<?php } ?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
</head>


<body <?php body_class(); ?>>


<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
					<span>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</<?php echo $heading_tag; ?>>

			</div>


			<div id="access">
				<a href="http://www.woyard.com">首页</a><a href="http://www.woyard.com/tools">工具箱</a>
			</div>
		</div>
	</div>

	<div id="main">