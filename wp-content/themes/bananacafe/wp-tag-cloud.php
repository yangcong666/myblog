<?php
/*
Template Name: wp-tag-cloud
*/
?>
<?php get_header(); ?>
<div id="main">
      <?php wp_tag_cloud('smallest=9&largest=9&number=600&format=list&orderby=count'); ?>
</div>
<!--main-->
<?php get_footer(); ?>