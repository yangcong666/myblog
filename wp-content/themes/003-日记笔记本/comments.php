<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments.", "site5framework"); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h2 class="h2comments" id="comments"><?php comments_number('No Comments', '1 Comment', '% Comments' );?></h2>

	<ul class="commentlist" >
	<?php wp_list_comments('callback=mytheme_comment'); ?>
	</ul>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e("Comments are closed.", "site5framework"); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h2 id="commentsForm"><?php comment_form_title( 'Got anything to say? Go ahead and leave a comment!', 'Leave a comment to %s' ); ?></h2>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( of_get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e("You must be", "site5framework"); ?> <a href="<?php echo of_get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e("logged in", "site5framework"); ?></a> <?php _e("to post a comment.", "site5framework"); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><?php _e("Logged in as", "site5framework"); ?> <a href="<?php echo of_get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e("Log out &raquo;", "site5framework"); ?></a></p>

<?php else : ?>

<p><label for="author"><?php _e("Name", "site5framework"); ?> <?php if ($req) echo "(required)"; ?></label>
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
</p>

<p><label for="email"><?php _e("Mail (will not be published)", "site5framework"); ?> <?php if ($req) echo "(required)"; ?></label>
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
</p>

<p><label for="url"><?php _e("Website", "site5framework"); ?></label>
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
</p>

<?php endif; ?>


<p><label for="comment"><?php _e("Comment", "site5framework"); ?></label>
<textarea name="comment" id="comment" rows="10" tabindex="4"></textarea></p>
<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e("POST COMMENT", "site5framework"); ?>" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
