<?php


defined('ABSPATH') or die('This file can not be loaded directly.');

global $comment_ids; $comment_ids = array();

foreach ( $comments as $comment ) {

	if (get_comment_type() == "comment") {

		$comment_ids[get_comment_id()] = ++$comment_i;

	}

} 



if ( have_comments() ) { 

	$my_email = get_bloginfo ( 'admin_email' );

	$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_approved = '1' AND comment_type = '' AND comment_author_email";

	$count_t = $post->comment_count;

	$count_v = $wpdb->get_var("$str != '$my_email'");

	$count_h = $wpdb->get_var("$str = '$my_email'");

?>

<div id="postcomments">

	<h3 class="base-tit" id="comments">

		<span><a href="#"></a></span><strong><?php echo $count_v; ?></strong>访客评论

		<?php if($count_h>0){ echo '，博主回复<strong>'.$count_h.'</strong>条'; } ?>

	</h3>

	<ol class="commentlist">

		<?php wp_list_comments('type=comment&callback=dtheme_comment_list') ?>

	</ol>

	<div class="pagenav">

		<?php paginate_comments_links('prev_next=0');?>

	</div>

</div>

<?php 

} 



if ( comments_open() ) { 

?>

<div id="respond" class="no_webshot">

	<h3 class="base-tit">

		<?php comment_form_title('我来说说', '评论回复 %s'); ?>

	</h3>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>

	<h3 class="queryinfo">

		<?php printf('发表评论您必须先<a href="%s">登录</a>！', wp_login_url( get_permalink() ) );?>

	</h3>

	<?php } else { ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) { ?>

		<div class="user-logged">

			<?php printf('欢迎 %s！！', '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php echo '换个马甲 &raquo;'; ?>"><?php echo '退出 &raquo;'; ?></a>

		</div>

		<?php } else { ?>

		<div id="comment-author-info">

			<p><label for="author">签个名呗</label><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="14" tabindex="1" /><small>（必须）</small></p>

			<p><label for="email">写个邮件</label><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="25" tabindex="2" /><small>（必须，保密）</small></p>

			<p><label for="url">你的网站</label><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="36" tabindex="3" /></p>

		</div>

		<?php if ( !empty($comment_author) ) { ?>

		<div id="author-info">

			<?php if ($comment_author_email == get_bloginfo ('admin_email')){ ?>

			<img src="<?php echo bloginfo('template_directory'),'/img/my-avatar.png' ?>" class="avatar" />

			<?php } else { echo get_avatar( $comment->comment_author_email, $size = '36' ); } ?>

			<span class="author-name"><?php echo $comment_author ?></span><a href="javascript:showCommentAuthorInfo();">(更改)</a>

		</div>

		<?php } } ?>

		<div class="post-area">

			<div id="smiley" class="toggle"><?php cotheme_smilies(); ?></div>

			<div class="post-area-txt">留言威武！</div>

			<textarea id="comment" cols="100%" rows="7" tabindex="4" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false};" name="comment"></textarea>

		</div>

		<div class="subcon">

			<input class="btn primary" type="submit" name="submit" id="submit" tabindex="5" value="提交评论（Ctrl+Enter）" />

			<a rel="nofollow" id="cancel-comment-reply-link" href="javascript:;">取消</a>

			<?php comment_id_fields(); do_action('comment_form', $post->ID); ?>

		</div>

	</form>

	<?php } ?>

</div>

<?php } else { ?>

	<h3 class="queryinfo" style="margin:0 6px 15px">访客评论被关闭！</h3>

<?php } ?>