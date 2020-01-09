<?php
/**
 * Render the site title for the selective refresh partial.
 *
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_is_static_front_page() {
    return ( is_front_page() && ! is_home() );
}

/**
 * Render the color.
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_hex_color( $hex_color, $setting ) {

  $hex_color = sanitize_hex_color( $hex_color );

  return ( ! null( $hex_color ) ? $hex_color : $setting->default );
}

/**
 * Return Header Variations
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_header_varaitions( $input ) {
    $valid = array(
        'one'  => esc_html__( 'Header One', 'navolio-light' ),
        'two'   => esc_html__( 'Header Two', 'navolio-light' ),
        'three' => esc_html__( 'Header Three', 'navolio-light' ),
        'four' => esc_html__( 'Header Four', 'navolio-light' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }

    return 'one';
}
/**
 * Return Footer Widget Columns
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_footer_widget_callback( $input ) {
    $valid = array(
        '1'  => esc_html__( 'One', 'navolio-light' ),
        '2'   => esc_html__( 'Two', 'navolio-light' ),
        '3' => esc_html__( 'Three', 'navolio-light' ),
        '4' => esc_html__( 'Four', 'navolio-light' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'four';
}
/**
 * Return Container Callback
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_container_callback( $input ) {
    $valid = array(
        'container'  => esc_html__( 'Default', 'navolio-light' ),
        'container_full'   => esc_html__( 'Full Width', 'navolio-light' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'container_full';
}
/**
 * Return Blog Style
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_blog_style_callback( $input ) {
    $valid = array(
        'style_one'  => esc_html__( 'Style One', 'navolio-light' ),
        'style_two'   => esc_html__( 'Style Two', 'navolio-light' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'style_one';
}
/**
 * Return Blog Sidebar
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_blog_sidebar_callback( $input ) {
    $valid = array(
        'left_side'  => esc_html__( 'Left Sidebar', 'navolio-light' ),
        'right_side'   => esc_html__( 'Right Sidebar', 'navolio-light' ),
        'no_side'   => esc_html__( 'No Sidebar', 'navolio-light' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'right_side';
}

/**
 * Return Woo Single Page Style
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_woo_single_style_callback( $input ) {
    $valid = array(
        'style_one'  => esc_html__( 'Style One', 'navolio-light' ),
        'style_two'   => esc_html__( 'Style Two', 'navolio-light' ),
        'style_three'   => esc_html__( 'Style Three', 'navolio-light' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'style_one';
}
/**
 * Return Woo Single Page Related Query
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_woo_related_query_callback( $input ) {
    $valid = array(
        'category'  => esc_html__( 'Category', 'navolio-light' ),
        'tag'   => esc_html__( 'Tags', 'navolio-light' ),
        'author'   => esc_html__( 'Author', 'navolio-light' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'category';
}

function navolio_light_on_of_radio_callback( $input ) {
    $valid = array(
        'on'  => esc_html__( 'Enable', 'navolio-light' ),
        'off'   => esc_html__( 'Disable', 'navolio-light' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'on';
}

/**
 * Return Check box
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * CSS Sanitation
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_css( $css ) {
	return wp_strip_all_tags( $css );
}

/**
 * Dropdown Pages Sanitization
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_dropdown_pages( $page_id, $setting ) {
	// Ensure $input is an absolute integer.
	$page_id = absint( $page_id );
	
	// If $page_id is an ID of a published page, return it; otherwise, return the default.
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/**
 * Email Sanitization
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_email( $email, $setting ) {
	// Strips out all characters that are not allowable in an email address.
	$email = sanitize_email( $email );
	
	// If $email is a valid email, return it; otherwise, return the default.
	return ( ! is_null( $email ) ? $email : $setting->default );
}

/**
 * HTML Sanitaization Callback
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_html( $html ) {
	return wp_filter_post_kses( $html );
}

function navolio_light_sanitize_advance_html( $input ) { 
    return wp_kses( $input, Navolio_Light_Static::html_allow() );
}

/**
 * Image Sanitization Callback
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

/**
 * No HTML Sanitization
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_nohtml( $nohtml ) {
	return wp_filter_nohtml_kses( $nohtml );
}

/**
 * Number Sanitization
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );
	
	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}
/**
 * Number Range sanitization callback example.
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_number_range( $number, $setting ) {
	
	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
/**
 * Select sanitization callbacke.
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * URL sanitization
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_url( $url ) {
	return esc_url_raw( $url );
}

/**
 * Multiselect sanitize functions.
 *
 * @since Navolio_Light 1.0
 */
if ( ! function_exists( 'navolio_light_sanitize_multiselect' ) ) :
    /**
     * Sanitize multi select output.
     *
     * @since Navolio_Light 1.0
     */
    function navolio_light_sanitize_multiselect( $input ) {
        if ( ! is_array( $input ) ) {
            $output = explode( ',', $input );
        } else {
            $output = $input;
        }
        if ( ! empty( $output ) ) {
            return array_map( 'sanitize_text_field', $output );
        } else {
            return array();
        }
    }
endif;

/**
 * Array sanitization callback for array and string.
 * @since Navolio_Light 1.0
 * @see navolio_light_customize_register()
 *
 * @return void
 */
function navolio_light_sanitize_text_or_array_field( $array_or_string ) {
    if( is_string( $array_or_string ) ) {
        $array_or_string = sanitize_text_field( $array_or_string );
    } elseif( is_array( $array_or_string ) ){
        foreach ( $array_or_string as $key => &$value ) {
            if ( is_array( $value ) ) {
                $value = navolio_light_sanitize_text_or_array_field( $value );
            }
            else {
                $value = sanitize_text_field( $value );
            }
        }
    }
    return $array_or_string;
}

/**
 * Customizer Repeater Sanitize Callback
 *
 * @since Navolio_Light 1.0
 */
function navolio_light_customizer_repeater_sanitize($input){
    $input_decoded = json_decode($input,true);
    if(!empty($input_decoded)) {
        foreach ($input_decoded as $boxk => $box ) {
            foreach ($box as $key => $value) {
                $input_decoded[$boxk][$key] = wp_kses_post( navolio_light_fource_balance_tag( $value ) );
            }
        }
        return json_encode($input_decoded);
    }
    return $input;
}
function navolio_light_fource_balance_tag( $markup ) {
    $dom = new DOMDocument();
    $html = '<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"></head><body>';
    $html .= $markup;
    $html .= '</body></html>';
    $dom->loadHTML( $html );
    $body = $dom->getElementsByTagName( 'body' )->item( 0 );
    $markup = str_replace( array( '<body>', '</body>' ), '', $dom->saveHTML( $body ) );
    return $markup;
}

/**
 * Number sanitization callback
 *
 * @since 1.0
 */
function navolio_light_sanitize_number( $val ) {
    return is_numeric( $val ) ? $val : 0;
}

/**
 * Number with blank value sanitization callback
 *
 * @since 1.0
 */
function navolio_light_sanitize_number_blank( $val ) {
    return is_numeric( $val ) ? $val : '';
}