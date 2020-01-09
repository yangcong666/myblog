<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package infiniture
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php
				printf( '%1$s by %2$s', 'Infiniture', '<a href="#">NickHopps</a>' );
			?>
			<span>&copy;2017</span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	</div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
