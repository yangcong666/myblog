<?php
/**
 *  Navolio_Light Get Featured Image
 *
 * @package Navolio_Light
 * @since 1.0
 */
if ( ! function_exists( 'navolio_light_post_featured_image' ) ) :
function navolio_light_post_featured_image($width = 900, $height = 600, $crop = false, $mobile = true) {
    if ( wp_is_mobile() && $mobile = true ) {
        if( function_exists('navolio_light_aq_resize') ) { 
            $featured_image = navolio_light_aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ,'full' ), 409, 275, false ); 
        } else {
            $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full');
        }
        if( $featured_image == false ) {
            the_post_thumbnail( 'full', array( 'alt' => get_the_title() ));
        } else { ?>
        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title_attribute( 'before="&after="' ); ?>" />
        <?php }
    } else {
        if( function_exists('navolio_light_aq_resize') ) {
            $featured_image = navolio_light_aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ,'full' ), $width, $height, $crop );
        } else {
            $featured_image = get_the_post_thumbnail_url(get_the_ID(),'full');
        }
        if( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ) {
            $image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
        } else {
            $image_alt = get_the_title();
        }
        $img_meta = wp_prepare_attachment_for_js( get_post_thumbnail_id() );

        if($img_meta['title'] !== "") {
            $imgtitle = 'title=" '. esc_attr( $img_meta['title'] ) .' "';
        } else {
            $imgtitle = '';
        }
        if( $featured_image == false ) {
            the_post_thumbnail( 'full', array( 'alt' => esc_attr( $image_alt ), 'title' => esc_attr( $img_meta['title'] ) ));
        } else { ?>
            <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" <?php echo wp_kses_post( $imgtitle ); ?> />
        <?php }
    }
}
endif;

/**
 *  Navolio_Light Get Image Crop Size By Image ID
 *
 * @package Navolio_Light
 * @since 1.0
 */
if ( ! function_exists( 'navolio_light_get_image_crop_size' ) ) :
function navolio_light_get_image_crop_size($img_id = false, $width = null, $height = null, $crop = false, $mobile = true) {
    $url = wp_get_attachment_url( $img_id ,'full' );
    if ( wp_is_mobile() && $mobile = true ) {
        if( function_exists(' navolio_light_aq_resize ') ) {
            $crop_image = navolio_light_aq_resize( $url, 409, 275, false ); 
        } else {
            $crop_images = wp_get_attachment_image_src( $img_id, array(409, 278 ), false );
            $crop_image = $crop_images[0];
        }
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    } else {
        if( function_exists(' navolio_light_aq_resize ') ) {
            $crop_image = navolio_light_aq_resize( $url, $width, $height, $crop ); 
        } else {
            $crop_images = wp_get_attachment_image_src( $img_id, array($width, $crop ), false );
            $crop_image = $crop_images[0];
        }
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    }
}
endif;

/**
 *  Navolio_Light Get Image By Post ID
 *
 * @package Navolio_Light
 * @since 1.0
 */
if ( ! function_exists( 'navolio_light_get_image_crop_size_by_id' ) ) :
function navolio_light_get_image_crop_size_by_id($post_id = false, $width = null, $height = null, $crop = false) {
    $url = get_the_post_thumbnail_url($post_id, 'full');
    if ( wp_is_mobile() ) { 
        if( function_exists('navolio_light_aq_resize') ) {
            $crop_image = navolio_light_aq_resize( $url, 409, 275, false ); 
        } else {
            $crop_images = wp_get_attachment_image_src( $url, array(409, 715 ), false ); 
            $crop_image = $crop_images[0];
        }
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    } else {
        if( function_exists('navolio_light_aq_resize') ) {
            $crop_image = navolio_light_aq_resize( $url, $width, $height, $crop ); 
        } else {
            $crop_images = wp_get_attachment_image_src( $url, array($width, $crop ), false );
            $crop_image = $crop_images[0];
        }
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    }
}
endif;

/**
 *  Navolio_Light Get Image By URL
 *
 * @package Navolio_Light
 * @since 1.0
 */
if ( ! function_exists( 'navolio_light_get_image_crop_size_by_url' ) ) :
    function navolio_light_get_image_crop_size_by_url($url = false, $width = null, $height = null, $crop = false) {
        if( function_exists('navolio_light_aq_resize') ) {
            $crop_image = navolio_light_aq_resize( $url, $width, $height, $crop ); 
        } else {
            $crop_image = $url;
        }
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    }
endif;

/**
 *  Navolio_Light Return Page Title
 *
 * @package Navolio_Light
 * @since 1.0
 */
if(! function_exists('navolio_light_return_page_title') ) :
    function navolio_light_return_page_title() {
        $page_ID = get_queried_object_id();
        return get_the_title($page_ID);
    }
endif;

/**
 *  Navolio_Light Generate Custom Link
 *
 * @package Navolio_Light
 * @since 1.0
 */
if ( ! function_exists( 'navolio_light_theme_kc_custom_link' ) ) :
function navolio_light_theme_kc_custom_link( $link, $default = array( 'url' => '', 'title' => '', 'target' => '' ) ) {
    $result = $default;
    $params_link = explode('|', $link);

    if( !empty($params_link) ){
        $result['url'] = rawurldecode(isset($params_link[0])?$params_link[0]:'#');
        $result['title'] = isset($params_link[1])?$params_link[1]:'';
        $result['target'] = isset($params_link[2])?$params_link[2]:'';
    }

    return $result;
}
endif;


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function navolio_light_skip_link_focus_fix() {
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
    </script>
    <?php
}
add_action( 'wp_print_footer_scripts', 'navolio_light_skip_link_focus_fix' );