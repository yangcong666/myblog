<?php
/**
 * 
 *
 * index.php
 *
 *
 * @subpackage LordSir
 * @since LordSir 0.01
 */

get_header(); ?>

		<div id="container">
<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<h5>『<?php the_time('Y-m-d') ?> 』<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
			<?php endwhile; ?>

			<div class="nav-previous"><?php next_posts_link(__('旧文章')) ?></div>
			<div class="nav-next"><?php previous_posts_link(__('新文章')) ?></div><br>
		</div>
		</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>