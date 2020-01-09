<?php
/*
Template Name: link
*/
?>
<?php get_header(); ?>

<div id="main">
  <div id="container">
    <article class="content">
      <?php wp_list_bookmarks('title_li=&category_before=&category_after='); ?>
    </article>
  </div>
  <!--Container End-->
  <?php get_sidebar(); ?>
</div>
<!--main-->
<?php get_footer(); ?>
