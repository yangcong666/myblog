<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package consultup
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="col-md-12">
<div id="comments" class="comments-area consultup-card-box padding-20">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<div class="consultup-heading-bor-bt">
		<h5 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( esc_html__( 'One thought on &ldquo;%s&rdquo;', 'consultup' ), esc_html(get_the_title()) );
			} else {
				printf(
				   	esc_html(
				      	/* translators: 1: number of comments, 2: post title */
				     	_nx( 
				          	'%1$s thought on &ldquo;%2$s&rdquo;',
				          	'%1$s thoughts on &ldquo;%2$s&rdquo;',
				          	$comments_number,
				          	'comments title',
				          	'consultup'
				       	)
				   	),
				   	esc_html (number_format_i18n( $comments_number ) ),
				   	esc_html(get_the_title())
				);
			}
			?>
		</h5>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'consultup' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'consultup' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'consultup' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'consultup_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h5 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'consultup' ); ?></h5>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'consultup' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'consultup' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php

	endif; // Check for comment navigation.
	endif; // Check for have_comments().
	
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'consultup' ); ?></p>
	<?php
	endif;

	comment_form();
	?>
</div><!-- #comments -->
</div>