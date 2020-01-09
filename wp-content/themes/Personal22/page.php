
<?php get_header()?>
<!--Central-->
<div class="col-md-8">
    <div id="Central">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <div class="locations none"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>
      


      <!-- postSingle -->
      <div class="postSingle">
        

        <!-- postsingle -->
        <div class="postsingle rbox">

            <!-- 主要内容 -->
            <div class="postsingle_body">
              <div class="postsingle_body_post">
                <h3 class="post_title"><?php the_title(); ?></h3>
                <div class="post_content Con">
                  <?php the_content(''); ?>
                  <?php wp_link_pages( array( 'before' => '<p class="pages">' . __( '分页:'), 'after' => '</p>' ) ); ?>
                </div>
              </div>
            </div>
            <!-- 主要内容 -->

            <!-- 属性 -->
            <div class="postsingle_info clearfix">
              <div class="pl_small f_l"><span class="pl_time"><?php the_time('Y-m-d'); ?></span></div>
              <?php if(function_exists('the_views')) { ?>
              <div class="pl_small f_l"><span class="pl_views"><?php the_views(); ?></span></div>
              <?php }?>
            </div>
            <!-- 属性 -->

        </div>
        <!-- /postsingle -->


<?php if ( comments_open() ) : ?>
        <!-- 评论 -->
        <div class="postcomments rbox">
          <div class="post_comments"><?php comments_template(); ?></div>
        </div>
        <!-- /评论 -->
<?php endif; ?>


      </div>
      <!-- /postSingle -->

      <?php endwhile; else: ?>
      <?php endif; ?>

    </div>
</div>
<!--/Central-->
<?php get_footer()?>
