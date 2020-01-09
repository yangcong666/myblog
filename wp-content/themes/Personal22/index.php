<?php get_header()?>
<!--Central-->
<div class="col-md-8">
    <div id="Central">



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