<?php get_header(); ?>
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
<div class="clear"></div><!-- Wrapper begin --> 
<div class="wrapper"> 

 


<!-- Content begin --> 
<div class="content"> 
	<!-- Boy begin --> 
    <div class="content_boy">
								<!-- author_name=Maize 为【男生作者的登录名称】 --> 

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle">存档 -- &#8216;<?php single_cat_title(); ?>&#8217; </h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle">标签 --  &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">存档 -- <?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">存档 -- <?php the_time('F, Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">存档 -- <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle">作者存档</h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">日志列表</h2>
 	  <?php } ?>
	                          
					
							   <?php if (have_posts()): ?>
				      	<?php while (have_posts()) : the_post(); ?>
							
							<?php if ($post->post_author == '1') { ?>
					          <div class="post boy" id="post-<?php the_ID(); ?>"> 
	      <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2> 
          <div class="sub_desc"><?php the_author() ?> 发表于: <?php the_time('F jS, Y') ?> | 阅读: <?php if(function_exists('the_views')) { the_views(); } ?> | 评论数: <?php comments_popup_link('(0)', '(1)', '(%)'); ?> </div> 
        
                            <div class="post_content"> <?php the_content('阅读更多 &raquo;'); ?> </div> 
        
                            <div class="post_meta"><div class="post_cats">分类:<?php the_category(', ') ?></div><a title="阅读全文" href="<?php the_permalink() ?>" rel="bookmark">阅读全文</a></a></div> 
               </div> 
			
			<?php } ?>
			   <?php endwhile; ?>
			   
			   <?php wp_reset_query(); ?>
			 
               <div class="clear"></div> 
                <!-- Page navi begin --> 
                <div class="pageNavi"> 
                   <div class="alignleft"><?php next_posts_link('&laquo; 较旧的') ?></div>
			<div class="alignright"><?php previous_posts_link('较新的 &raquo;') ?></div>        
                </div> 
                <!-- Page navi end --> 
            </div>    
			<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	endif;
?>

	
    <!-- Boy end --> 
    <!-- Sidebar begin --> 
	<?php get_sidebar();?>
       <!-- Sidebar end --> 
    <!-- Girl begin --> 
    <div class="content_girl"> 
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle">存档 -- &#8216;<?php single_cat_title(); ?>&#8217; </h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle">标签 --  &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">存档 -- <?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">存档 -- <?php the_time('F, Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">存档 -- <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle">作者存档</h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">日志列表</h2>
 	  <?php } ?>
        						<!-- author_name=Rosa 为【女生作者的登录名称】 --> 
							
							
								<?php if (have_posts()) : ?>
								
	                          	<?php while (have_posts()) : the_post(); ?>
								
								<?php if ($post->post_author == '2') { ?>
							
                         <div class="post girl" id="post-<?php the_ID();?>"> 
                        <h2> <a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2> 
                        <div class="sub_desc"><?php the_author() ?> 发表于: <?php the_time('F jS, Y') ?> | 阅读: <?php if(function_exists('the_views')) { the_views(); } ?> | 评论数: <?php comments_popup_link('(0)', '(1)', '(%)'); ?> </div> 
        
                            <div class="post_content"><p><span><span id="content"><?php the_content('阅读更多 &raquo;'); ?> </div> 
        
                            <div class="post_meta"><div class="post_cats">分类: <?php the_category(', ') ?></div><a title="阅读全文" href="<?php the_permalink() ?>" rel="bookmark">阅读全文</a></a></div> 
               </div> 
			   <?php }?>
               <?php endwhile; ?>
			   <?php wp_reset_query(); ?>
			   <div class="clear"></div> 
    
                <!-- Page navi begin --> 
                <div class="pageNavi2"> 
                         <div class="alignleft"><?php next_posts_link('&laquo; 较旧的') ?></div>
			<div class="alignright"><?php previous_posts_link('较新的 &raquo;') ?></div>        
                </div> 
                <!-- Page navi end --> 
            </div>    
			<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	endif;
?>
    <!-- Girl end --> 
	
</div> 
<!-- Content end --> 
 
</div> 
<!-- Wrapper end --> 


<!-- Footer begin --> 
<?php get_footer(); ?>
<!-- Footer end --> 
 
<!-- Background Music begin --> 
  
<!-- Background Music end --> 
 
</body> 
</html>
