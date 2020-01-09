<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package infiniture
 */

if ( ! function_exists( 'infiniture_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time, author and comments.
	 */
	function infiniture_entry_footer() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'infiniture' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'infiniture' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( '0 评论', '1 评论', sprintf( '%s 评论 <span class="screen-reader-text">%s</span>', get_comments_number(), get_the_title() ) );
			echo '</span>';
		}
		if ( current_user_can( 'manage_options' ) ) {
			edit_post_link(
				sprintf( '编辑 <span class="screen-reader-text">%s</span>', get_the_title() ),
				'<span class="edit-link">',
				'</span>'
			);
		}
	}
endif;

if ( ! function_exists( 'infiniture_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Twenty Fifteen 1.0
 */
function infiniture_post_thumbnail() {
	if ( post_password_required() || is_attachment() ) {
		return;
	}

	if ( ! has_post_thumbnail() ):
	?>

		<a href="<?php the_permalink(); ?>" >
			<div class="post-thumbnail"><?php bloginfo( 'name' ); ?></div>
		</a><!-- .post-thumbnail -->

	<?php else: ?>

		<a href="<?php the_permalink(); ?>" >
			<div class="post-thumbnail" style="background: url(<?php the_post_thumbnail_url();?>) center/cover no-repeat #fff;"></div>
		</a><!-- .post-thumbnail -->

	<?php endif;
}
endif;

if ( ! function_exists( 'infiniture_comment_form' ) ) :
/**
 * Display an optional comment form.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Twenty Fifteen 1.0
 */
function infiniture_comment_form() {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	$fields = array(
			'author' => '<p class="comment-form-author">' . '<input id="author" name="author" type="text" placeholder="姓名" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',

			'email'  => '<p class="comment-form-email">' . '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="邮箱" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>'
	);

	$comments_args = array(
		'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">您的邮件地址不会被公开</span></p>',
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="评论" cols="45" rows="4" maxlength="65525" aria-required="true" required="required"></textarea></p>',
    'fields' => $fields
	);

	comment_form( $comments_args );
}
endif;