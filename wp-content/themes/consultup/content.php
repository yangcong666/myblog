<?php
/**
 * The template for displaying the content.
 * @package consultup
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="consultup-blog-post-box">
		<div class="consultup-blog-thumb">
			<?php 
			if(has_post_thumbnail()){
			echo '<a class="consultup-blog-thumb" href="'.esc_url(get_the_permalink()).'">';
			the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
			echo '</a>';
			?>
			<div class="consultup-blog-category"> 
			 
				<i class="fa fa-folder-open-o"></i> 
				<?php   $cat_list = get_the_category_list();
				if(!empty($cat_list)) { ?>
				<?php the_category(', '); ?>
				<?php } ?>
			</div>
			<?php } else { ?>
			<div class="consultup-blog-category-left"> 
			 	<i class="fa fa-folder-open-o"></i> 
				<?php   $cat_list = get_the_category_list();
				if(!empty($cat_list)) { ?>
				<?php the_category(', '); ?>
				<?php } ?>
			</div>

			<?php } ?>
		</div>


		<article class="small"> 
			<h1 class="title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ','after'  => '') ); ?>">
			<?php the_title(); ?></a>
			</h1>	
				<div class="consultup-blog-meta">
				<span class="consultup-blog-date"><i class="fa fa-clock-o"></i><a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>">
			<?php echo esc_html(get_the_date('M j, Y')); ?></a></span>
			<?php $tag_list = get_the_tag_list();
				if($tag_list){ ?>
				<span class="consultup-tags"><a href="<?php the_permalink(); ?>"><?php the_tags('', ', ', ''); ?></a></span>
			<?php } ?>
			<a class="consultup-icon" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><i class="fa fa-newspaper-o"></i> <?php esc_html_e('by','consultup'); ?>
				<?php the_author(); ?>
				</a>
			</div>	
    		

			
				<?php the_content(__('Read More','consultup'));
				wp_link_pages( array( 'before' => '<div class="link btn-theme">' . __( 'Pages:', 'consultup' ), 'after' => '</div>' ) ); ?>
		</article>
	</div>
</div>