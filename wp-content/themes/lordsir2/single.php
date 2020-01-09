<?php
/**
 * single.php
 *
 * @subpackage LordSir
 * @since LordSir 0.01
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

			<?php
			get_template_part( 'loop', 'single' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>