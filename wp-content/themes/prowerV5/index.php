<?php get_header(); ?>
<article id="post_list">
	<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
	<section <?php post_class(); ?>>
		<?php if ( is_sticky() ) : ?>
			<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			<small class="meta"><?php the_time('Y-m-d'); ?></small>
		<?php else : ?>
			<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			<small class="meta"><?php the_time('Y-m-d'); ?></small>
			<?php the_content(('阅读全文 &raquo;')); ?>
		<?php endif; ?>
	</section>
	<?php endwhile; else: ?>
		<div id="nopage">也许以前这里有一个页面，但是现在没有了，有可能被强拆了！</div>
	<?php endif; ?>
</article>
<nav class="navigation">
	<span class="alignleft"><?php previous_posts_link(('&laquo; 上一页')) ?></span>
	<span class="alignright"><?php next_posts_link(('下一页 &raquo;')) ?></span>
</nav>
<?php get_footer(); ?>