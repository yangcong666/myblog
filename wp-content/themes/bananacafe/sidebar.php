<aside id="sitebar">
     <form class="search" action="index.html" method="get">
      <input class="text" type="text" name="wen" placeholder="<?php bloginfo( 'name' ); ?>">
      <input class="button" type="button" value="" type="submit">
    </form>
    <!--search-->
  <div class="erweima"><img src="<?php bloginfo('template_directory'); ?>/images/erweima.jpg" > </div>
  <!--erweima-->
  <div class="random">
    <div class="title">随机文章</div>
    <?php 
$pop = $wpdb->get_results("SELECT id, post_title
FROM {$wpdb->prefix}posts
WHERE post_type='post' AND post_status='publish' AND
post_password='' AND comment_count = 0
ORDER BY rand()
LIMIT 10"); ?>
    <ul>
      <?php foreach($pop as $post) : ?>
      <li> <a href="<?php echo get_permalink($post->id); ?>"> <?php echo $post->post_title; ?> </a> </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <!--random-->
  <div class="tagcloud">
    <div class="title">随机标签 </div>
    <div class="tag">
    <?php wp_tag_cloud('smallest=9&largest=9&number=15');?>
    </div>
  </div>
  <!--tagclound--> 
</aside>
