<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package infiniture
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php infiniture_post_thumbnail(); ?>

	<div class="entry-tags">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php infiniture_entry_footer(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</div><!-- .entry-tags -->

	<div class="entry clear">
		<div class="entry-header">
			<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
			?>
		</div><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<div class="entry-footer">
			<div class="read-more clear">
				<?php printf( '<a href="%1$s">%2$s</a>', get_permalink( get_the_ID() ), '全文' ); ?>
			</div>
		</div><!-- .entry-footer -->
	</div><!-- .entry -->
</article><!-- #post-<?php the_ID(); ?> -->
