<?php
/**
 * tag.php
 *
 * @subpackage LordSir
 * @since LordSir 0.01
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<h1 class="page-title"><?php
					printf( __( 'Tag Archives: %s', 'lordsir' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?></h1>

<?php
 get_template_part( 'loop', 'tag' );
?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>