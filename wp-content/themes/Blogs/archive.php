<?php get_header();?>
<div id="content" class="site-content">	
	<div class="clear"></div>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div id="post_list_box" class="border_gray">
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="archive-list <?php $postds=$wp_query->current_post;if($postds % 2 ==0){echo "shuangshu";}?>">
		<?php get_template_part( '/inc/content'); ?>
		</article><!-- #post -->
 	<!-- ad -->
	<?php if ($wp_query->current_post == 1) : ?>
	<?php if (get_option('ygj_adh') == '显示') { get_template_part('/inc/ad/ad_h'); } ?>
	<?php endif; ?>	
	<?php if ($wp_query->current_post == 5) : ?>
	<?php if (get_option('ygj_adhx') == '显示') { get_template_part('/inc/ad/ad_hx'); } ?>
	<?php endif; ?>	
	<!-- end: ad -->
<?php endwhile; ?>
		<?php else : ?>
		<section class="content">
			<p>目前还没有文章！</p>
			<p><a href="<?php echo get_option('siteurl'); ?>/wp-admin/post-new.php">点击这里发布您的第一篇文章</a></p>
		</section>
		<?php endif; ?>	
</div>		
		</main><!-- .site-main -->		
		<?php if (get_option('ygj_gdjz') !== '标准页码') {ygj_pagenav();}else{pagenavi();} ?>
	</section><!-- .content-area -->
<?php get_sidebar();?>
<div class="clear"></div>
</div><!-- .site-content -->
<?php get_footer();?>