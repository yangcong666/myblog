<?php
/**
 * @package Nevler
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 col-sm-12 grid nevler'); ?>>
		<header>
			<h2 class="entry-title title-font"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
		
		<div class="out-thumb col-md-8 col-sm-8">
			<header class="entry-header">
				<div class="postedon"><?php nevler_posted_on_icon(); ?></div>
				<span class="entry-excerpt"><?php the_excerpt(); ?></span>
				<span class="readmore"><a class="hvr-underline-from-center" href="<?php the_permalink() ?>"><?php _e('Read More','nevler'); ?></a></span>
			</header><!-- .entry-header -->
		</div><!--.out-thumb-->
		
		<div class="featured-thumb col-md-4 col-sm-4">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('nevler-pop-thumb'); ?></a>
			<?php else: ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
			<?php endif; ?>
		</div><!--.featured-thumb-->
			
		
		
</article><!-- #post-## -->