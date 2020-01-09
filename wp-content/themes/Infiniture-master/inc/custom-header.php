<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package infiniture
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses infiniture_header_style()
 */
function infiniture_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'infiniture_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'wp-head-callback'       => 'infiniture_header_style',
	) ) );
}
/* Turn off custom header */
add_action( 'after_setup_theme', 'infiniture_custom_header_setup' );

if ( ! function_exists( 'infiniture_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see infiniture_custom_header_setup().
	 */
	function infiniture_header_style() {
		$header_text_color = get_header_textcolor();
		$header_image = get_header_image();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( empty( $header_image ) && get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		<?php 
		// Has a Custom Header been added?
		if ( ! empty( $header_image ) ) :
		?>
			.sidebar {
				background-image: url(<?php header_image(); ?>);
				background-repeat: no-repeat;
				background-position: 50% 50%;
				-webkit-background-size: cover;
				-moz-background-size:    cover;
				-o-background-size:      cover;
				background-size:         cover;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
