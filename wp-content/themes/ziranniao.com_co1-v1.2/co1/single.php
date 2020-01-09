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
							<span>分类：<?php the_category(' // ') ?></span>
							<span>点击 <?php if(function_exists('the_views')) { the_views(); } ?></span>
							<span><?php comments_popup_link('还没有', '1 条', '% 条'); ?><a href="#">评论</a></span>
						</div>
					</div>
					
					<div class="article_content">
						<?php the_content(); ?>
						<?php if( get_post_custom_values("code") != "") {?>
<div class="article_foot"><a target="_blank" class="code_demo" href="<?php bloginfo('template_directory');?>/code.php?id=<?php the_ID()?>">点击查看演示DEMO</a>
</div>
						<?php } ?>
<p>转载请注明：<a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a> >> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>

					</div>
                                        <?php comments_template('', true); ?>

				</div>
				<?php endwhile; else: ?>
				<p>对不起, 找不对相对应的内容.</p>
				<?php endif; ?>
			</div>
		</div>
<!-- end main -->
		<?php get_sidebar(); ?>	
</div>	
<?php get_footer(); ?>	
			