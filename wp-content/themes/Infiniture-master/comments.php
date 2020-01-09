<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package infiniture
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() )
	return;
?>

	<?php if ( have_comments() ) : ?>
		<div class="comments">
			<a name="comments"></a>
			<h2 class="comments-title">
				<?php printf( _n( '%s 条评论', '%s 条评论', get_comments_number() ), get_comments_number() ); ?>
			</h2><!-- .comments-title -->
	
			<ol class="commentlist">
				<?php
					wp_list_comments( array(
						'style'      => 'ol',
						'type' => 'comment',
						'callback' => 'infiniture_comment'
					) );
				?>
			</ol>
				
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<div class="comment-nav-below" role="navigation">				
					<div class="post-nav-older"><?php previous_comments_link( '旧的评论 &raquo;' ); ?></div>
					<div class="post-nav-newer"><?php next_comments_link( '&laquo; 新的评论' ); ?></div>
					<div class="clear"></div>
				</div> <!-- /comment-nav-below -->
			<?php endif; ?>
			
		</div><!-- /comments -->
		
	<?php endif; ?>
	
	<?php if ( ! comments_open() && !is_page() ) : ?>
		<p class="no-comments"><?php echo '评论功能已经关闭'; ?></p>
	<?php endif; ?>
	
	<?php
		infiniture_comment_form();
	?>