<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package infiniture
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="articles clear">

				<?php
				if ( have_posts() ) : ?>

					<header class="search-result">
						<h1 class="search-title"><?php
							if ( '' == get_search_query() ) {
								printf( '搜索: 全部' );
							} else {
								printf( '搜索: %s', '<span>' . get_search_query() . '</span>' );
							}
						?></h1>
						<span class="underline"></span>
					</header><!-- .page-header -->

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

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
	</section><!-- #primary -->

<?php
get_footer();
