<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>

					<?php
					endif;

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
