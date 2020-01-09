<?php
/**
 * Hooks for template footer
 *
 * @package Navolio_Light
 */

/**
 * Custom scripts  on footer
 *
 * @since  1.0
 */
function navolio_light_footer_scripts() {
	// Custom javascript
    ob_start(); ?>
    function navolio_light_PopupWindow(url, title, w, h) {
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }  

    <?php $custom_code = ob_get_clean();
	wp_add_inline_script( 'navolio-light-scripts', $custom_code );
}
add_action( 'wp_enqueue_scripts', 'navolio_light_footer_scripts', 200 );
