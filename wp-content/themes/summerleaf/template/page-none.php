<?php 
/**
 Template Name: PAGE NONE

 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage SummerLeaf
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
   <!-- .site-content --> 
 <div id="content" class="site-content"> 
   <div class="clear"></div> 
   <section id="primary" class="content-area"> 
  <main id="main" class="site-main" role="main"> 

  	<?php 			while ( have_posts() ) : the_post(); 
  	
  	     global $post;
         $post_link = esc_url(get_permalink($post->ID));
         $post_title = $post->post_title;
         $user = get_userdata($post->post_author);
  	?>

     <?php
		/* translators: %s: Name of current post */
		the_content( );

		wp_link_pages( array(
			'before'      => '<div class="page-links">',
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
     <div class="clear"></div> 
    <!-- .entry-content --> 

  <?php endwhile; // End of the loop. ?>

    
  </main>

   </section>
   <!-- .content-area -->
    <?php get_sidebar(); ?>
   <div class="clear"></div> 
  </div>


  <?php get_footer(); ?>
  