<?php
/*
Template Name:page
*/
?>

<?php
get_header();
?>
<div class="wrap">
<!-- main -->
		<div class="main_wrap">
			<div class="main">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="article">
					<div class="article_meta">
						<h1 class="article_tit"><?php the_title(); ?></h1>
						<div class="article_attr">
							<span><?php the_time('y-m-d') ?></span>
							<span>点击 <?php if(function_exists('the_views')) { the_views(); } ?></span>
							<span><?php comments_popup_link('还没有', '1 条', '% 条'); ?><a href="#">评论</a></span>
						</div>
					</div>
					
					<div class="article_content">
						<div class="entry">	
						<?php the_content(); ?>
				
						</div>
					</div>
				</div>
						<?php comments_template(); ?>

				<?php endwhile; else: ?>
				<p>对不起, 找不对相对应的内容.</p>
				<?php endif; ?>
			</div>
		</div>
		
<!-- end main -->
		<?php get_sidebar(); ?>	
</div>	
<?php get_footer(); ?>