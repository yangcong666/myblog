<?php get_header(); ?>

<!--当前位置-->

<div class="crumb"><a href="http://mohuansenlin.com">Home</a> &gt; <span><?php echo '<span style="color: #cc0000">'.$s.'</span> 的搜索结果'; ?></span></div>

<div id="all">			
<!--Container-->
<div id="container">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php
		$title = get_the_title();
		$excerpt = mb_strimwidth(strip_tags(apply_filters('the_excerpt', $post->post_content)), 0, 250,"......");
		$keys = explode(" ",$s);
		$title = preg_replace('/('.implode('|', $keys) .')/iu','<span style="color: #cc0000">\0</span>',$title);
		$excerpt = preg_replace('/('.implode('|', $keys) .')/iu','<span style="color: #cc0000">\0</span>',$excerpt);
		?>	
		<!--content_text-->
		<div class="content_text">
		<div class="title">
			    <a href="<?php the_author_meta('user_url'); ?>" class="avatar"><?php echo get_avatar( get_the_author_meta('user_email'), '43', '' ); ?><span><?php echo get_avatar( get_the_author_meta('user_email'), '43', '' ); ?></span></a> 
    <i class="line_h"></i> 
				<h3>
					 
					 <a href="<?php the_permalink() ?>">
						<?php the_title(); ?>
					</a>
				</h3>			
					<p><?php the_author_posts_link(); ?> - <?php the_category(',') ?> - <?php the_time('Y.m.d'); ?> - <a href="<?php the_permalink() ?>" >
					<font color="#2b8109">阅读全文</font></a>
				</p> 
		   <span><?php comments_popup_link('0', '1', '%', 'up'); ?></span>	
		</div><!--title-->
			
			<div class="top">
			    <a href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail() ) { ?>
<?php the_post_thumbnail(full); ?>
<?php } else {?>
<img src="<?php bloginfo('template_url'); ?>/images/xxx.jpg" />
<?php } ?>  </a> 	
			</div><!--top-->
			
			<?php $postimg = get_post_meta($post->ID, "postimg_value", true); $postimg = trim(strip_tags($postimg)); ?>
			<div class="banner">
					<?php the_excerpt(); ?>
			</div><!--content_banner-->	
			
			<div class="article-tag">
<?php the_tags('  ', ' , ' , ''); ?>
　　　　　　</div><!--tag-->	

		</div><!--content_text End-->
		<?php endwhile;?><?php endif; ?>
		
		<!--Page-->
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div class="pagenavi"><?php pagenavi(); ?></div>
<?php endif; ?>
		<!--Page End-->

</div><!--Container End-->

</div><!--all-->
<?php get_footer(); ?>