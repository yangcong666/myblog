<?php
/**
 * Post Template
 *
 * This is the default post template.  It is used when a more specific template can't be found to display
 * singular views of the 'post' post type.
 *
 * @package Oxygen
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<div class="aside">
	
		<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template.  ?>
		
		<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
	
	</div>

	<?php do_atomic( 'before_content' ); // oxygen_before_content ?>
	
	<div class="content-wrap">

		<div id="content">
	
			<?php do_atomic( 'open_content' ); // oxygen_open_content ?>
	
			<div class="hfeed">
	
				<?php if ( have_posts() ) : ?>
	
					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php do_atomic( 'before_entry' ); // oxygen_before_entry ?>
	
						<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
	
							<?php do_atomic( 'open_entry' ); // oxygen_open_entry ?>
							
							<div class="post-content">
							
								<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'single-thumbnail', 'link_to_post' => false, 'image_class' => 'featured', 'attachment' => false, 'width' => 470, 'height' => 260 ) ); ?>
								
								<h2 class="post-title entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	
								<div class="byline"><?php the_author_posts_link(); ?> / <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a> / <?php comments_popup_link( __( 'Leave a comment', 'oxygen' ), __( '1 Comment', 'oxygen' ), __( '% Comments', 'oxygen' ) ); ?> / <?php the_category(', '); ?></div>
	
								<div class="entry-content">
									
									<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'oxygen' ) ); ?>
									
									<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'oxygen' ), 'after' => '</p>' ) ); ?>
									
								</div><!-- .entry-content -->
	
								<div class="entry-meta"><?php the_tags(); ?></div>
	
								<?php do_atomic( 'close_entry' ); // oxygen_close_entry ?>
							
							</div><!-- .post-content -->
	
						</div><!-- .hentry -->
	
						<?php do_atomic( 'after_entry' ); // oxygen_after_entry ?>
	
						<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>
	
						<?php do_atomic( 'after_singular' ); // oxygen_after_singular ?>
	
						<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>
	
					<?php endwhile; ?>
	
				<?php endif; ?>
	
			</div><!-- .hfeed -->
	
			<?php do_atomic( 'close_content' ); // oxygen_close_content ?>
	
			<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>
	
		</div><!-- #content -->
	
		<?php do_atomic( 'after_content' ); // oxygen_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>