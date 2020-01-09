<?php 
/* This template for theme function */

/*
 * Template parts functions
*/
if ( ! function_exists( 'navolio_light_get_template_part' ) ) :
    function navolio_light_get_template_part($part_name = "") {
        $part_style_url = (isset($_GET["{$part_name}_style"])) ? sanitize_text_field( wp_unslash( $_GET["{$part_name}_style"] ) ) : '';
        switch($part_style_url) { 
            case 'one': 
            case 'two': 
                $part_style = $part_style_url; break;
            default: $part_style = "one"; break;
        }  
        return get_template_part( "template-parts/$part_name/$part_style" );
    }
endif;