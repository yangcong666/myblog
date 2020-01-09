<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">这是一篇受密码保护的文章，请输入密码查看回复！</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number('尚无回复', '1 枚回复', '% 枚回复' );?></h3>
<br/>
	<ol class="commentlist">
	<?php wp_list_comments(); ?>
	</ol>
        <?php previous_comments_link('&laquo; 翻翻以前的') ?>   <?php next_comments_link('看看最新的 &raquo;') ?>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">回复已关闭</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">
<h3><br/><?php comment_form_title( '发表回复', '回复 %s' ); ?></h3>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>您必须 <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">登录</a> 才能发表回复！</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>您是： <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">登出 &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small>昵称 <?php if ($req) echo "*"; ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small>邮箱 (不公布) <?php if ($req) echo "*"; ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>网址</small></label></p>

<?php endif; ?>


<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
<p><input name="submit" type="submit" id="submit" tabindex="5" value="提交回复(Ctrl+Enter)" />
<br/>
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>
<script type="text/javascript">
document.getElementById("comment").onkeydown = function (moz_ev) {
	var ev = null;
 
	if (window.event){
		ev = window.event;
	}
	else{
		ev = moz_ev;
	}
 
	if (ev != null && ev.ctrlKey && ev.keyCode == 13) {
		document.getElementById("submit").click();
	}
}
</script>
</form>

<?php endif; ?>
</div>

<?php endif; ?>