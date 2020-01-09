<?php get_header()?>

		<!-- Begin Main Content ( left col ) -->
		<section id="main-content">
		<div id="archive-title">
			<?php _e("Search results for", "site5framework"); ?> <strong>"<?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('"'); echo $key; _e('"'); wp_reset_query(); ?>"</strong>
		</div>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
				<!-- Begin Article -->
				<article class="post">
					<header class="postHeader">
					  <div class="date"><?php the_time('M j, Y') ?> - <span><img src="<?php bloginfo('template_directory'); ?>/images/ico_file.png" alt=""> <?php the_category(', ') ?> &nbsp;&nbsp;<img src="<?php bloginfo('template_directory'); ?>/images/ico_comment.png" alt=""> <?php comments_popup_link('No Comments', '1 Comment ', '% Comments'); ?></span> </div>
					  <h2><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h2>
					</header>
					<section class="postText">
					 <?php the_excerpt(); ?>		
					</section>
				<div class="sidebadge"></div>
				</article>
				<!-- End Article -->
			<?php endwhile; ?>
	<?php else : ?>
		<p><?php _e("Sorry, but you are looking for something that isn't here.", "site5framework"); ?></p>
	<?php endif; ?>
		<?php if (function_exists("emm_paginate")) {
				emm_paginate();
			} ?>
		</section>
		<!-- End Main Content ( left col ) -->
		
<?php get_sidebar();?>
<?php get_footer();?>
		

