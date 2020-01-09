<?php get_header(); ?>
   <!-- .site-content --> 

 <div id="content" class="site-content"> 
   <div class="clear"></div> 
   <section id="primary" class="content-area"> 
  <main id="main" class="site-main" role="main"> 
  	<?php 			while ( have_posts() ) : the_post(); 
  	
  	     global $post;
         $post_link = esc_url(get_permalink($post->ID));
         $post_title = $post->post_title;
         $user = get_userdata($post->post_author);
  	?>
   <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-wow-delay="0.3s"> 
    <header class="entry-header"> 
     <h1 class="entry-title"><a href="<?php echo $post_link;?>" rel="bookmark"><?php echo $post_title;?></a></h1> 
    </header>
    <!-- .entry-header --> 
    <div class="entry-content"> 
     <div class="single-content"> 
     <?php
		/* translators: %s: Name of current post */
		the_content( );

		wp_link_pages( array(
			'before'      => '<div class="page-links">',
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
     	
     </div> 
     <div class="clear"></div> 
     <div id="social">   </div>
     <footer class="single-footer"> 
      <ul class="single-meta"> 
       <li class="single-data"><?php echo get_the_date('Y/m/d', $post->ID); ?></li> 
       <li class="comment"><a href="<?php echo $post_link; ?>#comments" rel="external nofollow"><i class="fa fa-comment-o"></i> <?php echo esc_html($post->comment_count); ?></a></li>
       <li class="views"><i class="fa fa-eye"></i> 589</li>
       <li class="print"><a href="javascript:printme()" target="_self" title="打印"><i class="fa fa-print"></i></a></li>
       <li class="r-hide"><a href="javascript:siderhidden()" title="侧边栏"><i class="fa fa-caret-left"></i> <i class="fa fa-caret-right"></i></a></li>
      </ul>
      <ul id="fontsize">
       <li>A+</li>
      </ul>
      <div class="single-cat-tag">
       <div class="single-cat">
        <i class="fa fa-coffee"></i> 
        <?php echo get_bloginfo('description'); ?>
       </div>
      </div>
 
     </footer>
     <!-- .entry-footer --> 
     <div class="clear"></div> 
    </div>
    <!-- .entry-content --> 
   </article>
   <!-- #post -->
   <div class="authorbio wow" data-wow-delay="0.3s" > 
    <?php echo get_avatar($user->user_email, 100); ?>
    <ul class="spostinfo"> 
     <li><strong>版权声明：</strong>原创文章 | <?php echo get_the_date('Y年m月d日', $post->ID); ?>，由本站作者<b><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID') ) ?>" title="<?php echo $user->display_name ?>" rel="author"><?php echo $user->display_name ?></a></b>发表。</li> 
     <li class="reprinted"><strong>转载请注明：</strong><a href="<?php echo $post_link;?>" rel="bookmark" title="本文固定链接 <?php echo $post_link;?>"><?php echo $post_title;?></a></li> 
    </ul> 
    <div class="clear"></div>
   </div> 
   <!-- 引用 -->
  <div id="related-img" class="wow" data-wow-delay="0.3s">
<?php $mvp_related_num = 4; $category = get_the_category(); $current_cat = $category[0]->cat_ID; $recent = new WP_Query(array( 'cat' => $current_cat, 'posts_per_page' => $mvp_related_num, 'orderby' => 'rand', 'post__not_in' => array( $post->ID ) )); while($recent->have_posts()) : $recent->the_post(); 
         global $post;
         $post_link = esc_url(get_permalink($post->ID));
         $post_title = $post->post_title;
?>
   <div class="r4">
    <div class="related-site">
     <figure class="related-site-img"> 
      <a href="<?php echo $post_link; ?>"><img data-original="<?php echo get_post_featured_image($post->ID,'280*210');?>" src="http://placehold.it/280x210&text=SummerLeaf" alt="<?php echo $post_title; ?>" /></a>
     </figure>
     <div class="related-title">
      <a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a>
     </div>
    </div>
   </div>
	<?php endwhile; wp_reset_postdata(); ?>  
   <div class="clear"></div>
  </div>
   
   <!-- #comments --> 
   	<?php 
    
      if ( comments_open() || get_comments_number() ) {
				comments_template();
		  	}
    
      ?>	

   
  <?php endwhile; // End of the loop. ?>
  </main>

   </section>
   <!-- .content-area -->
    <?php get_sidebar(); ?>
   <div class="clear"></div> 
  </div>


  <?php get_footer(); ?>
  