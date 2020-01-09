<?php
/*
Template Name: Archive
*/
?>
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

                <!-- pageArchive -->
                <div class="pageArchive">
                  
                  <?php 
                  $args = array(
                  'posts_per_page'      => -1,
                  'post_type'           => 'post',
                  'post_status'         => 'publish',
                  'ignore_sticky_posts' => 1, 
                  );
                  $yearpost = new WP_Query( $args );
                  $i = 1; 

                  if($yearpost->have_posts()) : ?>
                  <?php while($yearpost->have_posts()) : $yearpost->the_post() ?>
                  <?php if( $date != date( 'Y', strtotime($post->post_date) ) ){ ?>
                  </ul>
                  <div id="<?php echo date( 'Y', strtotime($post->post_date) ); ?>" class="mod-archive-year"><?php echo date( 'Y', strtotime($post->post_date) ); ?></div>
                  <ul class="mod-archive-list">
                  <?php }else{ 
                  if( $i == 1 ){ ?>
                  <div id="2015" class="mod-archive-year"><?php echo date( 'Y', strtotime($post->post_date) ); ?></div>
                  <ul class="mod-archive-list">
                  <?php } } ?>
                  <li><time class="mod-archive-time" datetime="<?php the_time('m-d h:i:s'); ?>"><?php the_time('m-d'); ?></time><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                  <?php $i++; $ul = 0; $date  =  date( 'Y', strtotime($post->post_date) ); endwhile; endif; wp_reset_query(); ?>

                </div>
                <!-- /pageArchive -->


              </div>
            </div>
            <!-- 主要内容 -->

        </div>
        <!-- /postsingle -->



      </div>
      <!-- /postSingle -->

      <?php endwhile; else: ?>
      <?php endif; ?>

    </div>
</div>
<!--/Central-->
<?php get_footer()?>
