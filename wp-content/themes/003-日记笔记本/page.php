<?php get_header()?>

		<!-- Begin Main Content ( left col ) -->
		<section id="main-content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
				<!-- Begin Article -->
				<article class="page">
					<header class="pageHeader">
					  <h2><?php the_title(); ?></h2>
					</header>
					<section class="pageText">
					 <?php the_content(); ?>		
					</section>
				<div class="sidebadge"></div>
				</article>
				<!-- End Article -->
			<?php endwhile; ?>
	<?php else : ?>
		<p><?php _e("Sorry, but you are looking for something that isn't here.", "site5framework"); ?></p>
	<?php endif; ?>
		</section>
		<!-- End Main Content ( left col ) -->
		
<?php get_sidebar();?>
<?php get_footer();?>
		

