<!-- postloop -->
<div class="postloop rbox">
	<?php if(is_sticky()):?>
    <div class="postloop_sticky" title="置顶"></div>
	<div class="postloop_body_top">
      <div class="postloop_body_post">
        <h3 class="post_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
      </div> 
	</div>
	<?php else: ?>
    <div class="postloop_body">
      <?php if(has_post_thumbnail()){?>
      <div class="postloop_body_img the_hover"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_bloginfo("template_url");?>/icon/nopic.gif" alt="<?php the_title(); ?>" data-echo="<?php echo post_thumbnail_src();?>"></a></div>
      <?php }?>
      <div class="postloop_body_post">
        <h3 class="post_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
        <div class="post_excerpt Con"><?php echo the_excerpt(); ?></div>
      </div>
    </div>
    <div class="postloop_info clearfix">
      <div class="pl_info f_l"><span class="pl_time"><i class="fa fa-calendar"> </i> <?php the_time('Y-m-d'); ?></span></div>
      <?php if(function_exists('the_views')) { ?>
      <div class="pl_info f_l"><span class="pl_views"><i class="fa fa-user-o"></i> <?php the_views(); ?></span></div>
      <?php }?>
      <div class="pl_info f_l"><span class="pl_cate"><i class="fa fa-clone"></i> <?php the_category(', ') ?></span></div>
      <?php if(function_exists('printLikes')) { ?>
      <div class="pl_info f_l"><span class="pl_like"><i class="fa fa-heart-o"></i> <?php printLikes(get_the_ID()); ?></span></div>
      <?php }?>
      <div class="pl_info f_l sm_none"><span class="pl_comment"><i class="fa fa-comments-o"></i> <?php comments_popup_link('0', '1', '%'); ?> 评论</span></div>
	</div>
	<?php endif;?>  
</div>
<!-- /postloop -->