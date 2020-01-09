<?php 
/**
 * Common Function for Consultup Theme.
 *
 * @package     Consultup
 * @author      Consultup
 * @copyright   Copyright (c) 2019, Consultup
 * @since       Consultup
 */
 

/**
 * Return Theme options.
 */
if ( ! function_exists( 'consultup_get_option' ) ){
	/**
	 * Return Theme options.
	 *
	 * @param  string $option       Option key.
	 * @param  string $default      Option default value.
	 * @param  string $deprecated   Option default value.
	 * @return Mixed               Return option value.
	 */
	function consultup_get_option( $option, $default = '', $deprecated = '' ){

		if ( '' != $deprecated ) {
			$default = $deprecated;
		}
		$theme_options = consultup_Theme_Options::get_options();
		/**
		 * Filter the options array for consultup Settings.
		 *
		 * @since  1.0.20
		 * @var Array
		 */
		$theme_options = apply_filters( 'consultup_get_option_array', $theme_options, $option, $default );

		$value = ( isset( $theme_options[ $option ] ) && '' !== $theme_options[ $option ] ) ? $theme_options[ $option ] : $default;
         
		/**
		 * Dynamic filter consultup_get_option_$option.
		 * $option is the name of the consultup Setting, Refer consultup_Theme_Options::defaults() for option names from the theme.
		 *
		 * @since  1.0.20
		 * @var Mixed.
		 */
		return apply_filters( "consultup_get_option_{$option}", $value, $option, $default );
	}
}


if ( ! function_exists( 'consultup_get_pro_url' ) ) :
	/**
	 * Returns an URL with utm tags
	 * the admin settings page.
	 *
	 * @param string $url    URL fo the site.
	 * @param string $source utm source.
	 * @param string $medium utm medium.
	 * @param string $campaign utm campaign.
	 * @return mixed
	 */
	function consultup_get_pro_url( $url, $source = '', $medium = '', $campaign = '' ) {

		$url = trailingslashit( $url );

		// Set up our URL if we have a source.
		if ( isset( $source ) ) {
			$url = add_query_arg( 'utm_source', sanitize_text_field( $source ), $url );
		}
		// Set up our URL if we have a medium.
		if ( isset( $medium ) ) {
			$url = add_query_arg( 'utm_medium', sanitize_text_field( $medium ), $url );
		}
		// Set up our URL if we have a campaign.
		if ( isset( $campaign ) ) {
			$url = add_query_arg( 'utm_campaign', sanitize_text_field( $campaign ), $url );
		}

		return esc_url( $url );
	}

endif;