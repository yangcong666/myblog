<!-- postloop -->
<div class="postloop rbox">
    <?php if(is_sticky()){ ?>
    <div class="postloop_sticky" title="置顶"></div>
    <?php } ?>
    <div class="postloop_body">
      <?php if(has_post_thumbnail()){?>
      <div class="postloop_body_img the_hover"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo get_bloginfo("template_url");?>/icon/nopic.gif" alt="<?php the_title(); ?>" data-echo="<?php echo post_thumbnail_src();?>"></a></div>
      <?php }?>
      <div class="postloop_body_post">
        <h3 class="post_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h3>
        <div class="post_excerpt"><?php echo the_excerpt(); ?></div>
      </div>
    </div>
    <div class="postloop_info clearfix">
      <div class="pl_small f_l"><span class="pl_time"><?php the_time('Y-m-d'); ?></span></div>
      <?php if(function_exists('the_views')) { ?>
      <div class="pl_small f_l"><span class="pl_views"><?php the_views(); ?></span></div>
      <?php }?>
      <div class="pl_small f_l"><span class="pl_cate"><?php the_category(', ') ?></span></div>
      <?php if(function_exists('printLikes')) { ?>
      <div class="pl_small f_l"><span class="pl_like"><?php printLikes(get_the_ID()); ?></span></div>
      <?php }?>
      <div class="pl_small f_l"><span class="pl_comment"><?php comments_popup_link('0', '1', '%'); ?></span></div>
    </div>
</div>
<!-- /postloop -->