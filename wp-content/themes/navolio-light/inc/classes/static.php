<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'navolio-light' ) );

if( ! class_exists( 'Navolio_Light_Static' ) ) :
class Navolio_Light_Static {

    /**
     * Allow HTML tag from escaping HTML 
     * 
     * @return void
     * @since v1.0
     */
    public static function html_allow() {
        return array(
            'a' => array(
                'href' => array(),
                'title' => array()
            ),
            'br' => array(),
            'del' => array(),
            'span' => array(),
            'em' => array(),
            'strong' => array(),
            'h1' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h2' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h3' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h4' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h5' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h6' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'div' => array(
                'class' => array(),
                'id' => array(),
            ),
            'p' => array(
                'class' => array(),
                'id' => array(),
            ),
        );
    }

    /**
     * @since v1.0
     */
    public static function total_grid() {
        return array(
            '1' => esc_html__( '1 Grid', 'navolio-light' ),
            '2' => esc_html__( '2 Grid', 'navolio-light' ),
            '3' => esc_html__( '3 Grid', 'navolio-light' ),
            '4' => esc_html__( '4 Grid', 'navolio-light' ),
            '5' => esc_html__( '5 Grid', 'navolio-light' ),
            '6' => esc_html__( '6 Grid', 'navolio-light' ),
            '7' => esc_html__( '7 Grid', 'navolio-light' ),
            '8' => esc_html__( '8 Grid', 'navolio-light' ),
            '9' => esc_html__( '9 Grid', 'navolio-light' ),
            '10' => esc_html__( '10 Grid', 'navolio-light' ),
            '11' => esc_html__( '11 Grid', 'navolio-light' ),
            '12' => esc_html__( '12 Grid', 'navolio-light' ),
        );
    }

    /**
     * @since v1.0
     */
    public static function total_items() {
        return array(
            '2' => esc_html__( 'Two', 'navolio-light' ),
            '3' => esc_html__( 'Three', 'navolio-light' ),
            '4' => esc_html__( 'Four', 'navolio-light' ),
            '5' => esc_html__( 'Five', 'navolio-light' ),
            '6' => esc_html__( 'Six', 'navolio-light' ),
            '7' => esc_html__( 'Seven', 'navolio-light' ),
        );
    }

}

// Removing this line is like not having a functions.php file
new Navolio_Light_Static;

endif;