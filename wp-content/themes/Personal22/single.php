
<?php get_header()?>
<!--Central-->
<div class="col-md-8">
    <div id="Central">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <!-- postSingle -->
      <div class="postSingle">

        <!-- postsingle -->
        <div class="postsingle rbox">

            <!-- 主要内容 -->
            <div class="postsingle_body">
              <div class="postsingle_body_post">
                <h3 class="post_title"><?php the_title(); ?></h3>
                <div class="post_content Con">
                  <?php the_content(''); ?>
                  <?php wp_link_pages( array( 'before' => '<p class="pages">' . __( '分页:'), 'after' => '</p>' ) ); ?>
                </div>
              </div>
            </div>
            <!-- 主要内容 -->


            <?php if(stripslashes(get_option('share_grey'))==1){?>
            <!-- pl_share -->
            <div class="pl_share">
              <div class="bdsharebuttonbox clearfix" id="single_share"><span href="#" class="share_text">分享到：</span><a href="#" class="bds_qzone share_icon share_icon_qzone" data-cmd="qzone" data-toggle="tooltip" data-placement="top" title="分享到QQ空间"></a><a href="#" class="bds_tsina share_icon share_icon_sina" data-cmd="tsina" data-toggle="tooltip" data-placement="top" title="分享到新浪微博"></a><a href="#" class="bds_weixin share_icon share_icon_weixin" data-cmd="weixin" data-toggle="tooltip" data-placement="top" title="分享到微信"></a></div>
              <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
            </div>
            <!-- pl_share -->
            <?php } ?>



            <!-- 属性 -->
            <div class="postsingle_info clearfix">
              <div class="pl_small f_l"><span class="pl_time"><?php the_time('Y-m-d'); ?></span></div>
              <?php if(function_exists('the_views')) { ?>
              <div class="pl_small f_l"><span class="pl_views"><?php the_views(); ?></span></div>
              <?php }?>
              <?php if(function_exists('printLikes')) { ?>
              <div class="pl_small f_l"><span class="pl_like"><?php printLikes(get_the_ID()); ?></span></div>
              <?php }?>
              <div class="pl_small f_l"><span class="pl_comment"><?php comments_popup_link('0', '1', '%'); ?></span></div>
            </div>
            <!-- 属性 -->

            <!-- 关键字 -->
            <div class="postsingle_bottom clearfix">
              <div class="pl_small f_l"><?php the_category(', ') ?></div>
              <div class="pl_small f_l"><?php the_tags('关键字: ', ', ', ''); ?></div>
            </div>
            <!-- 关键字 -->


            <?php if(stripslashes(get_option('related_grey'))==1){?>
            <!-- 相关阅读 -->
            <div class="postsingle_related clearfix">
                  <div class="related_post clearfix">
                    <?php
                    $post_tags=wp_get_post_tags($post->ID); //如果存在tag标签，列出tag相关文章
                    $pos=1;
                    $rpls=3;
                    $renum=3;   //文章数量
                    if($post_tags) {
                    foreach($post_tags as $tag) $tag_list[] .= $tag->term_id;
                    $args = array(
                      'tag__in' => $tag_list,
                      'category__not_in' => array(NULL), // 不包括的分类ID,可以把NULL换成分类ID
                      'post__not_in' => array($post->ID),
                      'showposts' => 0, // 显示相关文章数量
                      'caller_get_posts' => 1,
                      'orderby' => 'rand'
                    );
                    query_posts($args);
                    if(have_posts()):
                    $i==1;
                    while (have_posts()&&$pos<=$renum) : the_post(); update_post_caches($posts); ?>

                    <!-- loop -->
                    <div class="case_loop">
                      <div class="case_loop_img the_hover"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank" style="background-image:url(<?php echo post_thumbnail_src(); ?>);"></a></div>
                    </div>
                    <!-- end -->

                    <?php $i++; $pos++;endwhile;wp_reset_query();endif; ?>
                    <?php } //end of rand by tags ?>

                    <?php if($pos<=$renum): //如果tag相关文章少于10篇，那么继续以分类作为相关因素列出相关文章
                    $cats = wp_get_post_categories($post->ID);
                    if($cats){
                    $cat = get_category( $cats[0] );
                    $first_cat = $cat->cat_ID;
                    $args = array(
                      'category__in' => array($first_cat),
                      'post__not_in' => array($post->ID),
                      'showposts' => 0,
                      'caller_get_posts' => 1,
                      'orderby' => 'rand'
                    );
                    query_posts($args);
                    if(have_posts()): 
                    $i==1;
                    while (have_posts()&&$pos<=$renum) : the_post(); update_post_caches($posts); ?>

                    <!-- loop -->
                    <div class="case_loop">
                      <div class="case_loop_img the_hover"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank" style="background-image:url(<?php echo post_thumbnail_src(); ?>);"></a></div>
                    </div>
                    <!-- end -->

                    <?php $i++; $pos++;endwhile;wp_reset_query();endif; ?>
                    <?php } endif; //end of rand by category ?>

                    <?php if($pos<=$renum){ //如果上面两种相关都还不够10篇文章，再随机挑几篇凑成10篇 ?>
                    <?php query_posts('showposts='.$renum.'&orderby=rand');
                    $i==1;
                    while(have_posts()&&$pos<=$renum):the_post(); ?>

                    <!-- loop -->
                    <div class="case_loop">
                      <div class="case_loop_img the_hover"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank" style="background-image:url(<?php echo post_thumbnail_src(); ?>);"></a></div>
                    </div>
                    <!-- end -->

                    <?php $i++; $pos++;endwhile;wp_reset_query();?>
                    <?php } ?>
              </div>
            </div>
            <!-- 相关阅读 -->
            <?php } ?>


            <!-- 上下篇 -->
            <div class="postsingle_pagenav clearfix">
              <span class="prev f_l"><?php previous_post_link('%link', '<i class="icon-caret-left"></i> 上一篇', TRUE); ?></span>
              <span class="next f_r"><?php next_post_link('%link', '下一篇 <i class="icon-caret-right"></i>', TRUE); ?></span>
            </div>
            <!-- 上下篇 -->

        </div>
        <!-- /postsingle -->

        <?php if ( comments_open() ) : ?>
        <!-- 评论 -->
        <div class="postcomments rbox">
          <div class="post_comments"><?php comments_template(); ?></div>
        </div>
        <!-- /评论 -->
        <?php endif; ?>
        

      </div>
      <!-- /postSingle -->

      <?php endwhile; else: ?>
      <?php endif; ?>

    </div>
</div>
<!--/Central-->
<?php get_footer()?>