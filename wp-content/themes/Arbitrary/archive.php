<?php get_header(); ?>
<div id="content">
	<div class="container clearfix">
	<div id="primary">
		<div id="distant">
			<a rel="bookmark" href="<?php echo home_url(); ?>">首页</a>
			<?php the_post(); ?>
			<?php if ( is_category() ) : ?>
				<?php printf((__('<span class="icon-arrow-right"></span>分类<span class="icon-arrow-right"></span>%s')),single_cat_title('',false)); ?>
			<?php elseif ( is_tag() ) : ?>
				<?php printf((__('<span class="icon-arrow-right"></span>标签<span class="icon-arrow-right"></span>%s')),single_tag_title('',false)); ?>
			<?php endif; ?>
			<?php rewind_posts(); ?>		
		</div>	
		<div id="postlist">
			<?php if(have_posts()):while (have_posts()) : the_post();
				$thumbnail = mfthemes_thumbnail();
				$has_thumbnail = $thumbnail["hasThumbnail"];
				$class = $has_thumbnail ? "post post-has-thumbnail" : "post";
			?>
				<div id="post-<?php the_ID(); ?>" class="<?=$class;?>">
					<div class="post-header">
						<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a></h2>
					</div>
					<div class="post-meta">
						<ul class="inline-ul">
							<li class="inline-li"><?php the_time('Y/m/d'); ?></li>
							<li class="inline-li"><span class="post-span">|</span></li>
							<li class="inline-li"><?php the_category(' '); ?></li>
							<li class="inline-li"><span class="post-span">|</span></li>
							<li class="inline-li"><?php if(function_exists('the_views')) the_views();?></li>
							<li class="inline-li"><span class="post-span">|</span></li>
							<li class="inline-li"><?php comments_popup_link('0 Reply', '1 Reply', '% Replies'); ?></li>
						</ul>
					</div>					
					<div class="post-body">
						<?php if($has_thumbnail) :?>
							<div class="post-thumbnail"><a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?=$thumbnail["src"];?>" alt="<?php the_title();?>" /></a></div>
							<div class="post-content">
								<?php echo "<p>" . mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 420,"..."). "</p>";?>
							</div>
						<?php else :?>
							<div class="post-content">
								<?php echo "<p>" . mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 500,"..."). "</p>";?>
							</div>						
						<?php endif;?>
					</div>
				</div>
			<?php endwhile; endif;?>
		</div>
		<div id="pagenavi"><?php pagenavi();?></div>
	</div>
<?php if(!IsMobile) get_sidebar(); ?>
</div></div><!-- #content -->
<?php get_footer(); ?>