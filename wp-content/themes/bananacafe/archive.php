<?php get_header(); ?>
<div id="main">
  <div id="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section class="list">
     <span><a href="<?php the_permalink() ?>">
      <?php if ( has_post_thumbnail() ) { ?>
      <?php the_post_thumbnail(thumbnail); ?>
      <?php } else {?>
      <img src="<?php bloginfo('template_url'); ?>/images/xxx.jpg" />
      <?php } ?>
      </a> </span>
      <div class="mecc">
        <h2> <a href="<?php the_permalink() ?>">
          <?php the_title(); ?>
          </a> </h2>
        <address>
        <?php the_category(',') ?>
        -
        <?php the_author(); ?>
        -
        <time>
          <?php the_time('Y.m.d'); ?>
        </time>
        - View:
        <?php post_views(' ', ' 次'); ?>
        </address>
        <p>
          <?php the_excerpt(); ?>
        </p>
      </div>
      <?php comments_popup_link('0', '1', '%', 'up'); ?>
    </section>
    <!--list-->
    <?php endwhile;?>
    <?php endif; ?>
    
    <!--Page-->
    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <div class="pagenavi">
      <?php pagenavi(); ?>
    </div>
    <?php endif; ?>
    <!--Page End--> 
    
  </div>
  <!--Container-->
  <?php get_sidebar(); ?>
</div>
<!--main-->
<?php get_footer(); ?>
