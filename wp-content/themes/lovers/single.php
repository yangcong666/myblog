<?php get_header(); ?>
<!-- Wrapper begin -->
    <body> 
     
	<?php if (is_page())  { 
$style_item = 'page'; 
} elseif (is_single()) { 
if ($post->post_author == '1') { 
$style_item = 'boy'; 
} 
elseif ($post->post_author == '2') { 
$style_item = 'girl'; 
} 
} else { 
$style_item = 'normal'; 
} ?>	 
<!-- Header begin --> 
<div class="header"> 
    <div class="header-inner header_<?php  echo $style_item ;?>">
        <a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
    </div>
</div> 
<!-- Header end --> 
<div class="wrapper wrapper_<?php  echo $style_item ;?>">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!-- Content begin -->
<div class="content content_nng">
	<!-- Girl begin -->
	
    <div class="content_<?php  echo $style_item ;?> single_content_<?php  echo $style_item ;?>">
	          
                                    <div class="post <?php  echo $style_item ;?> post_<?php  echo $style_item ;?>" id="post-<?php the_ID(); ?>">
                        <h2><?php the_title(); ?></h2>
                        <div class="sub_desc"><?php the_author() ?> 发表于: <?php the_time('F jS, Y') ?> | 阅读: <?php if(function_exists('the_views')) { the_views(); } ?> | 评论数: <?php comments_popup_link('(0)', '(1)', '(%)'); ?> </div>
        
                            <div class="post_content">
							<?php the_content('<p class="serif">' . __('Read the rest of this entry &raquo;', 'kubrick') . '</p>'); ?>
                       <?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'kubrick') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p>' . __('Tags:', 'kubrick') . ' ', ', ', '</p>'); ?>
				<p class="postmetadata alt">
				</p>
</div>
     <div class="post_meta post_meta2">
                            	<div class="post_cats">分类:<?php the_category(', ') ?></div>
                            </div>
               </div>
               <div class="clear"></div>
                            
        <div class="post_pro_next">
            
		</div>
        
        
<!-- You can start editing here. -->
	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.', 'kubrick'); ?></p>

<?php endif; ?>
    <!-- Girl end -->
    
	

</div>

<!-- Content end -->
<!-- Sidebar begin -->
<?php get_sidebar(); ?>
   <!-- Sidebar end -->
</div></div>
<!-- Wrapper end -->

<!-- Footer begin -->
<?php get_footer(); ?>
<!-- Footer end -->
<!-- Background Music begin -->

<!-- Background Music end -->

</body>
</html><!-- 修改 '3' 中的 3 为你建立的女生作者的ID -->

