<?php get_header(); ?>
   <!-- .site-content --> 

 <div id="content" class="site-content"> 
   <div class="clear"></div> 
   <section id="primary" class="content-area"> 
    <main id="main" class="site-main" role="main"> 
     <div  class="article-grid" data-wow-delay="0.3s"> 
     	<div class="title-div">
     	<h1><?php 
     		
     		if (is_category()) {
     			 echo '<i class="fa fa-sun-o"></i> ';
     		} else if (is_tag()) {
     		   echo '<i class="fa fa-tag"></i> ';
     		} else {
     		   echo '<i class="fa fa-inbox"></i> ';	
     		}
     		
     		the_archive_title();?></h1>
      <?php echo wpautop(explode('||',get_the_archive_description())[0]); ?>
     		
     </div>
     <?php  
     if ( have_posts() ) {
         while ( have_posts() ) : the_post();
         
         global $post;
         $post_link = esc_url(get_permalink($post->ID));
         $post_title = $post->post_title;
         $excerpt_symbols_count = 50;
     	?>
     <article id="post-<?php echo $post->ID; ?>"  <?php post_class('large-6'); ?>> 
    <a href="<?php echo $post_link; ?>" class="image-post item-overlay "><img data-original="<?php echo get_post_featured_image($post->ID,'450*240');?>" src="http://placehold.it/450x240&text=SummerLeaf" alt="<?php echo $post_title; ?>" /></a> 
    <header class="entry-header"> 
     <h2 class="entry-title"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></h3> 
    </header> 
    <div class="entry-content"> 
     <p>	<?php
	        if( strpos( $post->post_content, '<!--more-->' ) ){
	            the_content();
	        } else {
	            if (empty($post->post_excerpt)) {
	                $txt = do_shortcode($post->post_content);
	                $txt = strip_tags($txt);

	                echo (mb_strlen($txt) > $excerpt_symbols_count ) ? (mb_substr($txt, 0, $excerpt_symbols_count) . " ...") : $txt;
	            } else {
	                echo (mb_strlen($post->post_excerpt) > $excerpt_symbols_count) ? (mb_substr($post->post_excerpt, 0, $excerpt_symbols_count) . " ...") : $post->post_excerpt;
	            }
	        }
	        ?></p> 
    </div> 
    <footer class="entry-footer"> 
     <div class="left margin-top-5"> 
      <i class="fa fa-tags"></i> <span class="cat-links"><?php echo get_the_category_list(', ', '', $post->ID); ?></span> 
     </div> 
     <div class="right margin-top-5"> 
      <span class="posted-on"> <i class="fa fa-calendar-check-o"></i> <?php echo get_the_date('Y/m/d', $post->ID); ?></span> 
      <i class="fa fa-comment"></i> <span class="comments-link"><a href="<?php echo $post_link; ?>#comments"><?php echo esc_html($post->comment_count); ?></a></span> 
     </div> 
    </footer> 
     </article>       
     <!-- #post --> 
     <?php  
     
         endwhile;
         


     } else {

     ?>
     <div class="searchbar">
     	<form method="get" id="searchform" action="/"> 
       <span>
       	<input class="swap_value" placeholder="请输入搜索关键词" name="s"> 
       	<button type="submit" id="searchsubmit">搜索</button> 
       	<span></span>
       </span>
      </form>
     </div>
      <?php
         	echo __( '<article class="post" >很抱歉，这个页面没有内容。要不，你试一试搜索吧!</article> ', 'summerleaf' );
     	} 
     	
     	?>      
     </div>
     

    
    </main> 
    <?php 
    				the_posts_pagination( array(
							'mid_size' => 10,
							'prev_text'          => __( '<i class="fa fa-angle-left"></i>', 'summerleaf' ),
							'next_text'          => __( '<i class="fa fa-angle-right"></i>', 'summerleaf' ),
							'screen_reader_text'  => null,
							) );
    ?>

   </section>
   <!-- .content-area -->
    <?php get_sidebar(); ?>
   <div class="clear"></div> 
  </div>


  <?php get_footer(); ?>
  