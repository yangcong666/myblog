<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
	<div class="title">
			<?php comments_number('没有回复', '只有1条回复', '共有%条回复' );?>(
			<a href="#commentform">
				写评论
			</a>
			)
	</div>
<?php if ( have_comments() ) : ?>

	<ul id="comment">
		<?php wp_list_comments('type=comment&callback=cleanr_theme_comment'); ?>
	</ul>


 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>不用想啦，马上<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">　"登录"　</a> 发表自已的想法.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">退出 &rarr;</a></p>

<?php else : ?>

<input type="text" name="author"  size="22" tabindex="1" value="名字<?php if ($req) echo "(必填)"; ?>" onfocus="this.value='';" onblur="if(this.value==''){this.value='名字<?php if ($req) echo "(必填)"; ?>';}" />


<input type="text" name="email"  size="22" tabindex="2" value="邮箱<?php if ($req) echo "(必填)"; ?>" onfocus="this.value='';" onblur="if(this.value==''){this.value='邮箱<?php if ($req) echo "(必填)"; ?>';}" />


<input type="text" name="url"  size="22" tabindex="3" value="网址" onfocus="this.value='';" onblur="if(this.value==''){this.value='网址';}" />


<?php endif; ?>



<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<textarea name="comment" id="comment"  rows="10" tabindex="4"></textarea>

<input name="submit" type="submit" id="submit" tabindex="2" value="提交" />
<?php comment_id_fields(); ?>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>