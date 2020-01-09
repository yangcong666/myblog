<?php
/*
Template Name: 读者百强榜
*/
?>
<?php get_header();?>
<style type="text/css">
.page-template-template-readers #primary {width: 100%}#dzq h3{margin:10px 0 5px}#dzq ul{margin:0 0 1px;list-style:outside none none}#dzq .readers-list{overflow:hidden;text-align:left;text-overflow:ellipsis;white-space:nowrap;font-size:9pt;line-height:18px}#dzq .readers-list li{float:left;margin:0 5px 0 0;width:230px;list-style:none}#dzq .readers-list a,#dzq .readers-list a:hover strong{background-color:#f7faff;background-image:-webkit-linear-gradient(#f8f8f8,#f7faff);background-image:linear-gradient(#f8f8f8,#f7faff)}#dzq .readers-list a{position:relative;display:block;overflow:hidden;margin:4px;padding:4px 4px 4px 44px;height:3pc;border:1px solid #ccc;border-radius:2px;box-shadow:#eee 0 0 2px;color:#999}#dzq .readers-list em,#dzq .readers-list img,#dzq .readers-list strong{-webkit-transition:all .2s ease-out;transition:all .2s ease-out}#dzq .readers-list img{float:left;margin:0 8px 0 -40px;width:36px;height:36px;border-radius:2px}#dzq .readers-list em{margin-right:10px;color:#666;font-style:normal}#dzq .readers-list strong{position:absolute;top:4px;right:6px;width:40px;color:#ddd;text-align:right;font:700 14px/1pc microsoft yahei}#dzq .readers-list a:hover{border-color:#c01e22;background-color:#fff;background-image:none;box-shadow:#ccc 0 0 2px}#dzq .readers-list a:hover img{margin-left:0;opacity:.6}#dzq .readers-list a:hover em{color:#c01e22;font:700 14px/36px microsoft yahei}#dzq .readers-list a:hover strong{top:0;right:180px;height:44px;border-right:1px solid #ccc;color:#c01e22;text-align:center;line-height:40px}.readers,.readers a{overflow:hidden}.readers a{float:left;margin:0 5px 25px;width:72px;height:60px;color:#999;text-align:center;text-decoration:none;font-size:9pt}.readers .avatar{display:block;margin:0 auto;margin-bottom:5px;border-radius:5px}.readers a.item-top{margin:0 1% 30px;padding:10px;width:23%;height:100%;border-radius:5px;background-color:#f6f6f6;color:#bbb;text-align:left}.readers a.item-top .avatar{float:left;margin-right:10px;margin-left:10px}.readers a.item-top h4{padding:10px 30px 0 0;color:#ff5e52;text-align:center;font-size:1pc}.readers a.item-top strong{display:block;color:#ff5e52}.readers a.item-top:hover{background-color:#f1f1f1}.readers a.item-2 h4{color:#7ccd38}.readers a.item-2 strong{display:block;color:#7ccd38}.readers a.item-3 h4{color:#52baf5}.readers a.item-3 strong{display:block;color:#52baf5}.readers a.item-4 h4{color:#ecb842}.readers a.item-4 strong{display:block;color:#ecb842}@media screen and (max-width:768px){.readers a.item-top{width:48%}}@media screen and (max-width:480px){.readers a.item-top{width:98%}}
</style>
<div id="content" class="site-content">	
<div class="clear"></div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php while ( have_posts() ) : the_post(); ?>
			
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>	
		<div class="single_info">
					<span class="date"><?php the_time( 'Y-m-d H:i' ) ?></span>
					<span class="views"><?php if( function_exists( 'the_views' ) ) { the_views(); print '人阅读 '; } ?></span>			
					<span class="edit"><?php edit_post_link('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;编辑', '  ', '  '); ?></span>
				</div>			
	</header><!-- .entry-header -->

	<div class="entry-content">
					<div class="single-content">									
	<?php the_content(); ?>
<?php

function readers_wall($limit = "100")
{
	global $wpdb;
	$counts = $wpdb->get_results("SELECT count(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email FROM $wpdb->comments WHERE user_id!='1' AND comment_author!='1' AND comment_approved='1' AND comment_type='' GROUP BY comment_author ORDER BY cnt DESC LIMIT $limit");
	$i = 0;
    $type='';
	foreach ($counts as $count ) {
		$i++;
		$c_url = $count->comment_author_url;

		if (!$c_url) {
			$c_url = "http://boke123.net";
		}

		$tt = $i;

		if ($i == 1) {
			$tt = "读者之青龙";
		}
		else if ($i == 2) {
			$tt = "读者之白虎";
		}
		else if ($i == 3) {
			$tt = "读者之朱雀";
		}
		else if ($i == 4) {
			$tt = "读者之玄武";
		}
		else {
			$tt = "第" . $i . "名";
		}
		$avatar = my_avatar( $count->comment_author_email,36,$default='',$count->comment_author);
		if ($i < 5) {
			$type .= "<a class=\"item-top item-" . $i . "\" target=\"_blank\" href=\"" . $c_url . "\" title=\"【" . $tt . "】评论：" . $count->cnt . "\"><h4>【" . $tt . "】</h4>".$avatar."<strong>" . $count->comment_author . "</strong>" . $c_url . "</a>";
		}
		else {
			$type .= "<a target=\"_blank\" href=\"" . $c_url . "\" title=\"【" . $tt . "】评论：" . $count->cnt . "\">" . $avatar . $count->comment_author . "</a>";
		}
	}

	echo $type;
}
?>
<div class="readers">
<?php readers_wall(100);?>
</div>
			</div>
<div class="clear"></div>
<?php get_template_part( 'inc/social' ); ?>
				<div class="clear"></div>
	</div><!-- .entry-content -->

	</article><!-- #post -->	
	<?php if (get_option('ygj_g_full') == '显示') { get_template_part( 'inc/ad/ad_full' ); } ?>		
	<?php comments_template( '', true ); ?>			
			<?php endwhile; ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<div class="clear"></div>
</div><!-- .site-content -->
<?php get_footer();?>