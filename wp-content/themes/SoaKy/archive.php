<?php get_header()?>
<!--Central-->
<div class="col-md-8">
    <div id="Central">
      
      <div class="locations none"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>
      
      <div class="CateTitle rbox">
        <h2>
        <?php if ( is_category() ) : ?>
        <?php single_cat_title(); ?>
        <?php elseif ( is_day() ) : ?>
        Archive for
        <?php the_time( 'F jS, Y' ); ?>
        <?php elseif ( is_month() ) : ?>
        Archive for
        <?php the_time( 'F, Y' ); ?>
        <?php elseif ( is_year() ) : ?>
        Archive for
        <?php the_time('Y'); ?>
        <?php endif; ?>
        </h2>
      </div>


      <!-- postList -->
      <div class="postList">
        <?php if (have_posts()) : ?>

          <?php while (have_posts()) : the_post(); ?>

          <?php include("postloop.php");?>
          
          <?php endwhile; ?>

        <?php endif ?>
      </div>
      <!-- /postList -->

      <!-- pagenav -->
      <div class="pagenav_box rbox">
        <div class="pagenav clearfix">
            <span class="previous f_l"><?php previous_posts_link() ?></span>
            <span class="next f_r"><?php next_posts_link() ?></span>
        </div>
      </div>
      <!-- /pagenav -->

    </div>
</div>
<!--/Central-->
<?php get_footer()?>