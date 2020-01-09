<?php
/*
Template Name: 全屏页面模板
*/
?>
<?php get_header();?>
<style type="text/css">.page-template-template-full #primary{width: 100%}</style>
<div id="content" class="site-content">	
<div class="clear"></div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php while ( have_posts() ) : the_post(); ?>
			
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>	
		<div class="single_info">
					<span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php the_time( 'Y-m-d H:i' ) ?></span>
					<span class="views"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;<?php if( function_exists( 'the_views' ) ) { the_views(); print ' 人阅读'; } ;?></span>
					<span class="comment"><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( '0 条评论', '1 条评论', '% 条评论' ); ?></span>
					<span class="edit"><?php edit_post_link('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;编辑', '  ', '  '); ?></span>
				</div>			
	</header><!-- .entry-header -->

	<div class="entry-content">
					<div class="single-content">									
	<?php the_content(); ?>
		<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span><i class="fa fa-angle-left"></i></span>', 'nextpagelink' => "")); ?><?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
		<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => '<span><i class="fa fa-angle-right"></i></span>')); ?>		
	</div>
<div class="clear"></div>
<?php get_template_part( 'inc/social' ); ?>		
<?php get_template_part('inc/file'); ?>
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