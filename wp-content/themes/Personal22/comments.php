<?php if(!get_comments_number()){ ?>
<div class="hasnoComment">暂无评论</div>
<?php }else{ ?>
<div class="commentlist">
  <ol>
    <?php wp_list_comments('type=comment&callback=shejiwo_comment'); ?>
  </ol>
</div>
<!-- <div id="loading-comments"><i class="fa fa-spinner fa-pulse"></i> <span>Loading...</span></div> -->
<div id="comments-navi">
    <?php paginate_comments_links('prev_text=上一页&next_text=下一页');?>
</div>

<?php } ?>

<?php if ( comments_open() ) : ?>

<div id="respond">

<div id="respond_h3">
  <h3><?php comment_form_title( __('Leave a Reply'), __('Leave a Reply to %s' ) ); ?></h3>
</div>

<div id="cancel-comment-reply">
  <small><?php cancel_comment_reply_link() ?></small>
</div>

<div id="respond_form">

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<div class="respond_form_mustlogin"><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )); ?></div>
<?php else : ?>

<form action="<?php echo site_url(); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<div class="respond_form_islogin"><?php /* translators: %s: user profile link  */
printf( __( 'Logged in as %s.' ), sprintf( '<a href="%1$s">%2$s</a>', get_edit_user_link(), $user_identity ) ); ?>
<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php esc_attr_e( 'Log out of this account' ); ?>"><?php _e( 'Log out &raquo;' ); ?></a></div>

<?php else : ?>

<div class="form-group respond_input">
  <label for="author"><?php _e('Name'); ?> <?php if ($req) _e('(required)'); ?></label>
  <input type="text" class="form-control b-r0" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
</div>
<div class="form-group respond_input">
  <label for="email"><?php _e('Mail (will not be published)'); ?> <?php if ($req) _e('(required)'); ?></label>
  <input type="text" class="form-control b-r0" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
</div>
<div class="form-group respond_input">
  <label for="url"><?php _e('Website'); ?></label>
  <input type="text" class="form-control b-r0" name="url" id="url" value="<?php echo  esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
</div>
<?php endif; ?>

<div class="form-group respond_textarea">
  <label for="comment">评论内容</label>
  <textarea class="form-control b-r0" name="comment" id="comment" cols="58" rows="6" tabindex="4"></textarea>
</div>
<div class="form-group respond_submit">
  <button type="submit" name="submit" id="submit" tabindex="5"  class="btn btn-primary btn-block b-r0">发表评论</button>
  <?php comment_id_fields(); ?>
</div>
<?php
/** This filter is documented in wp-includes/comment-template.php */
do_action( 'comment_form', $post->ID );
?>
</form>

<?php endif; // If registration required and not logged in ?>
</div>

</div>


<?php endif; // if you delete this the sky will fall on your head ?>