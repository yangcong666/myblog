<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class() ?>>
		<h1><?php the_title(); ?></h1>
		<small class="meta"><?php the_time('Y-m-d'); ?></small>
		<?php the_content(); ?>
		<small class="meta">分类：<?php the_category('、') ?> | 标签：<?php the_tags((' '), '、'); ?> | <?php if(function_exists('the_views')) { the_views(); } ?></small>
	</article>
<?php endwhile; ?>
<?php comments_template(); ?>
<?php get_footer(); ?>