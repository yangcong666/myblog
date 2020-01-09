<?php get_header(); ?>
	<div class="wrap">
<!-- main -->
		<div class="main_wrap">
			<div class="main">
				<div class="current_nav">
					与 "<?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<strong>'); echo $key; _e('</strong>'); wp_reset_query(); ?>" 相关的文章
				</div>
			<!-- /archive-title -->
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
				<div class="posts clearfix">
							<div class="imageholder">
							  <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?>
							</div>
					  <div class="description half ">
						   <h2 class="custom-font"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2> 
						   <p>
							<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 330, '...'); ?>
						   </p>
						   <div class="custom-tip clearfix">
								<span class="date"><?php the_time('m-d') ?></span> 
								<span class="views"> <a title="<?php if(function_exists('the_views')) { the_views(); } ?> 浏览" href="<?php the_permalink(); ?>"><?php if(function_exists('the_views')) { the_views(); } ?> 浏览</a> </span>
								<span class="comment"> <a href="<?php the_permalink(); ?>"><?php comments_popup_link('0 评论', '1 评论 ', '% 条评论'); ?></a></span>
								<span class="continue"> <a href="<?php the_permalink() ?>" alt="查看更多">查看更多</a> </span> 
							</div>
						  
					   
					   </div>
				</div>
			<?php endwhile; ?>

	<?php else : ?>

		<p>对不起, 找不对相对应的内容.</p>

	<?php endif; ?>
            <!--<div class="navigation">
						<div class="alignleft"><?php next_posts_link() ?></div>
						<div class="alignright"><?php previous_posts_link() ?></div>
			</div>-->
			<?php if (function_exists("cocss_paging")) {
				cocss_paging();
			} ?>
            </div>
			</div>
		<?php get_sidebar(); ?>	
		</div>

<!-- end main -->
</div>
<?php get_footer(); ?>	
	
		


