<?php
/**
 * Comment Template
 *
 * The comment template displays an individual comment. This can be overwritten by templates specific
 * to the comment type (comment.php, comment-{$comment_type}.php, comment-pingback.php, 
 * comment-trackback.php) in a child theme.
 *
 * @package Oxygen
 * @subpackage Template
 */

	global $post, $comment;
?>

	<li id="comment-<?php comment_ID(); ?>" class="<?php hybrid_comment_class(); ?>">

		<?php do_atomic( 'before_comment' ); // oxygen_before_comment ?>

		<div class="comment-wrap">

			<?php do_atomic( 'open_comment' ); // oxygen_open_comment ?>

			<?php echo hybrid_avatar(); ?>

			<div class="comment-meta"><?php comment_author(); ?> /  <?php comment_date('n-j-Y'); ?> / <?php edit_comment_link(); ?> &middot; <?php comment_reply_link(); ?> </div>

			<div class="comment-content comment-text">
				
				<?php if ( '0' == $comment->comment_approved ) : ?>
				
					
					
				<?php endif; ?>

				<?php comment_text( $comment->comment_ID ); ?>
			</div><!-- .comment-content .comment-text -->

			<?php do_atomic( 'close_comment' ); // oxygen_close_comment ?>

		</div><!-- .comment-wrap -->

		<?php do_atomic( 'after_comment' ); // oxygen_after_comment ?>

	<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>