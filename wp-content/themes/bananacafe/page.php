<?php
/*
Template Name: page
*/
?>
<?php get_header(); ?>
<div id="main">
  <div id="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="content">
      <div class="content-text">
        <?php the_content(); ?>
      </div>
      <!--content_text--> 
    </article>
    <?php endwhile;?>
    <?php endif; ?>
  </div>
  <!--Container End--> 
   <?php get_sidebar(); ?>
</div>
<!--main-->
<?php get_footer(); ?>
