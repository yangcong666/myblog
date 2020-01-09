<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package infiniture
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="articles clear">

				<?php
				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</div>

			<?php
				if ( $GLOBALS['wp_query']->max_num_pages > 1 ):
			?>

			<nav class="navigation pagination clear" role="navigation">
				<h2 class="screen-reader-text">文章导航</h2>
				<div class="previous"><?php previous_posts_link( '上一页' ); ?></div>
				<div class="next"><?php next_posts_link( '下一页' ); ?></div>
			</nav>

			<?php endif ?>
					
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
