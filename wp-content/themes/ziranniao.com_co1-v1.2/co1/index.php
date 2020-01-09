<?php get_header(); ?>

	<div class="wrap">

<!-- main -->

		<div class="main_wrap">

			<div class="main">
				<?php if(dopt('co_onlytip_b') !="") { ?>
				<div class="notice"><span><?php echo dopt('co_onlytip'); ?></span></div>
				<?php } ?>

				<?php if(is_month()) { ?>

				<div class="current_nav">

					分类 <strong>"<?php the_time('F, Y') ?>"</strong> 的文章列表

				</div>

				<?php } ?>

				<?php if(is_category()) { ?>

				<div class="current_nav">

					分类 <strong>"<?php $current_category = single_cat_title("", true); ?>"</strong> 的文章列表

				</div>

				<?php } ?>

				<?php if(is_tag()) { ?>

				<div class="current_nav">

					与 <strong>"<?php wp_title('',true,''); ?>"</strong>” 相关的文章列表

				</div>

				<?php } ?>

				<?php if(is_author()) { ?>

				<div class="current_nav">

					<strong>"<?php wp_title('',true,''); ?>"</strong> 的文章列表

				</div>

				<?php } ?>


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		

				<div class="posts clearfix">

							<div class="imageholder">

							  <a href="<?php the_permalink() ?>">

<?php if ( has_post_thumbnail() ) { ?> <?php the_post_thumbnail(); ?> <?php } else {?> <img src="<?php bloginfo('template_directory')

 ?>/img/thumbmail.png" /> <?php } ?>

							  </a>

							</div>

					  <div class="description half ">

						   <h2 class="custom-font"><a href=" <?php the_permalink() ?> "><?php the_title(); ?></a></h2> 

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

	

		





