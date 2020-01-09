<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package consultup
 */

get_header(); ?>
<!--==================== ti breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
<main id="content">
  <div class="container">
    <div class="row">
        <div class="col-md-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'9' ); ?> col-sm-8">
          <?php 
    		  while(have_posts()){ the_post();
              get_template_part('content','');
    		  } ?>
          <div class="col-md-12 text-center">
      			<?php //Previous / next page navigation
      			the_posts_pagination( array(
      			'prev_text'          => '<i class="fa fa-arrow-left"></i>',
      			'next_text'          => '<i class="fa fa-arrow-right"></i>',
      			) ); ?>
          </div>
      </div>
	    <aside class="col-md-3 col-sm-4">
        <?php get_sidebar(); ?>
      </aside>
    </div>
  </div>
 </main>
<?php
get_footer();
?>