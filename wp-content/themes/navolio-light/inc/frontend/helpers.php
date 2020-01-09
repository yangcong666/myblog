<?php
/**
 * Theme Helpers
 *
 * @package Navolio_Light
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if(! class_exists( 'Navolio_Light_Helpers' ) ) {
    /**
     * The Navolio_Light Helpers
     */
    class Navolio_Light_Helpers {
        
        public function __construct() {
            //Print Theme Colors
            $this->navolio_light_color();

            //Print Heading Colors
            $this->navolio_light_main_headings_color();

            //Header Color Background and styles
            $this->navolio_light_backgound_image_cover_bg();

            //Spacing Elements
            $this->navolio_light_spaing_elements( );            

            //Page Elements
            $this->navolio_light_page_elements( );
        }
        /**
         * Hexa to RGBA Convector
         *
         * @package Navolio_Light
         * @since 1.0
         */
        private function navolio_light_hex_2_rgba($color, $opacity = false) {
            $default = 'rgb(0,0,0)';
            //Return default if no color provided
            if(empty($color))
                return $default; 
         
            //Sanitize $color if "#" is provided 
            if ($color[0] == '#' ) {
                $color = substr( $color, 1 );
            }
         
            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
            } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
            } else {
                return $default;
            }
         
            //Convert hexadec to rgb
            $rgb =  array_map('hexdec', $hex);
         
            //Check if opacity is set(rgba or rgb)
            if($opacity){
                if(abs($opacity) > 1)
                    $opacity = 1.0;
                $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
            } else {
                $output = 'rgb('.implode(",",$rgb).')';
            }
         
            //Return rgb(a) color string
            return $output;
        }

        /**
         * Theme Colors
         *
         * @package Navolio_Light
         * @since 1.0
         */
        public function navolio_light_color() {  
            $setting_color = navolio_light_get_options(array('theme_color', '#e53632'));
            switch( $setting_color ) {
                case '1':  
                    // add a condition to show demo color scheme by url
                    ( isset($_GET["color_scheme_color"]) ) ? $color_scheme_color = sanitize_text_field( wp_unslash( $_GET["color_scheme_color"] ) )  : $color_scheme_color = "" ;
                    if (preg_match('/^[A-Z0-9]{6}$/i', $color_scheme_color)) {
                        $demo_color_scheme = sanitize_text_field( wp_unslash( $_GET["color_scheme_color"] ) );
                    }
                    else {
                       $demo_color_scheme = "e7272d";
                    }
                    $navolio_light_color = "#".$demo_color_scheme; 
                    break;
                case '2': 
                    $navolio_light_color = "#d12a5c";
                    break;
                case '3': 
                    $navolio_light_color = "#49ca9f";
                    break;
                case '4': 
                    $navolio_light_color = "#1f1f1f";
                    break;
                case '5': 
                    $navolio_light_color = "#808080";
                    break;
                case '6': 
                    $navolio_light_color = "#ebebeb";
                    break;
                default: 
                    $navolio_light_color = navolio_light_get_options(array('theme_color', '#e53632'));
                    break; 
            }
            //rgba color
            $navolio_light_rgba_color = $this->navolio_light_hex_2_rgba($navolio_light_color, 0.8); ?>
            ::selection {background: <?php echo esc_attr($navolio_light_color); ?> none repeat scroll 0 0; } *::-moz-selection {background: <?php echo esc_attr($navolio_light_color); ?> none repeat scroll 0 0; } a:hover, a:focus, a:active {color: <?php echo esc_attr($navolio_light_color); ?>; } label a {color: <?php echo esc_attr($navolio_light_color); ?>; } .top-nav-collapse.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li.active > a, .navbar-default .navbar-nav > li.active > a:focus, .navbar-default .navbar-nav > li.active > a:hover { color: <?php echo esc_attr($navolio_light_color); ?> !important; } .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {background-color: <?php echo esc_attr($navolio_light_color); ?>; border-color: <?php echo esc_attr($navolio_light_color); ?>;} .blog-item .blog-content .post-meta a { color: <?php echo esc_attr($navolio_light_color); ?> } .blog-item.sticky {border-bottom-color: <?php echo esc_attr($navolio_light_color); ?>} .signle-post-content .entry-content a { color: <?php echo esc_attr($navolio_light_color); ?> } .signle-post-content .entry-tag a {background: <?php echo esc_attr($navolio_light_color); ?> } .post-password-form input[type="submit"] {background: <?php echo esc_attr($navolio_light_color); ?>} .comments .single-comment-content .single-comment-content-head a.comment-reply-link {color: <?php echo esc_attr($navolio_light_rgba_color); ?>} .btn-dark, .comment-navigation a {background: <?php echo esc_attr($navolio_light_rgba_color); ?>} .btn-dark:hover, .btn-dark:active, .btn-dark:focus, .btn-dark:active:focus, .btn-dark.active.focus, .btn-dark.active:focus, .btn-dark.focus, .btn-dark:active:focus, .btn-dark:focus { color: <?php echo esc_attr($navolio_light_rgba_color); ?>; border-color: <?php echo esc_attr($navolio_light_rgba_color); ?>; } .single-comment-content a {color: <?php echo esc_attr($navolio_light_rgba_color); ?>} .comment-respond .logged-in-as a {color: <?php echo esc_attr($navolio_light_rgba_color); ?>} .searchform .btn {background: <?php echo esc_attr($navolio_light_rgba_color); ?>} .widget_calendar a, .widget a:hover {color: <?php echo esc_attr($navolio_light_rgba_color); ?>} .bg-blue-violet {background: <?php echo esc_attr($navolio_light_color); ?>} .pagination-block .pagination li.active a {background: <?php echo esc_attr($navolio_light_color); ?>} .blog-sidebar-content .widget-title:before {background: <?php echo esc_attr($navolio_light_color); ?>} .woocommerce nav.woocommerce-pagination ul li > span.current, .woocommerce-single-content .woocommerce-tabs ul.tabs li.active a {background: <?php echo esc_attr($navolio_light_color); ?>} .woocommerce span.onsale {background-color: <?php echo esc_attr($navolio_light_color); ?>} .woocommerce-single-content .single_add_to_cart_button {background: <?php echo esc_attr($navolio_light_color); ?> !important;} .contact-sticky-button {background: <?php echo esc_attr($navolio_light_color); ?>} .blog-page-content:not(.blog-single-page) .more-link:hover { background: <?php echo esc_attr($navolio_light_color); ?>; border-color: <?php echo esc_attr($navolio_light_color); ?> } .blog-page-content .post-meta-content:after { background: <?php echo esc_attr($navolio_light_color); ?> } .blog-page-content .post-meta-content { color: <?php echo esc_attr($navolio_light_color); ?> } blockquote { border-left-color: <?php echo esc_attr($navolio_light_color); ?> } .tagcloud a:hover, .single-post-footer .entry-tag a:hover {  background: <?php echo esc_attr($navolio_light_color); ?>; border-color: <?php echo esc_attr($navolio_light_color); ?> } .comment-reply-link {color: <?php echo esc_attr($navolio_light_color); ?>; } .comment-reply-link:hover { background: <?php echo esc_attr($navolio_light_color); ?>; border-color: <?php echo esc_attr($navolio_light_color); ?>; }
            <?php
        } // end navolio_light_color function

        /**
         * Title Color
         *
         * @package Navolio_Light
         * @since 1.0
         */
        public function navolio_light_main_headings_color() {
            if( is_front_page() && get_option( 'show_on_front' ) !== "posts" ) {
                $home_site_title = navolio_light_get_options(array('home_site_title_color', '#000000'));
                $home_sub_title = navolio_light_get_options(array('home_description_title_color', '#ebebeb'));
                $home_menu_color = navolio_light_get_options(array('home_menu_color', '#191919'));
                ?>
                .home-branding-text .site-branding-text .site-description {color: <?php echo esc_attr($home_sub_title); ?>} .home-branding-text .navbar-nav > li > a {color: <?php echo esc_attr($home_menu_color); ?>}
                <?php
            } else { 
                $others_site_title = navolio_light_get_options(array('others_site_title_color', '#ffffff'));
                $others_sub_title = navolio_light_get_options(array('others_description_title_color', '#cacaca'));
                $others_menu_color = navolio_light_get_options(array('others_menu_color', '#ffffff'));
                ?>
                .other-branding-text .site-branding-text .site-description {color: <?php echo esc_attr($others_sub_title); ?>} .other-branding-text .navbar-nav > li > a {color: <?php echo esc_attr($others_menu_color); ?>} @media only screen and (max-width: 767px) { .other-branding-text .site-branding-text .site-title, .home-branding-text .site-branding-text .site-title {color: <?php echo esc_attr(navolio_light_get_options(array('sticky_site_title', '#191919'))); ?>}}
            <?php }
                $main_menu_color = navolio_light_get_options(array('menu_color', '#ffffff'));
                $sticky_menu_color = navolio_light_get_options(array('sticky_menu_color', '#191919'));
                $sticky_title_color = navolio_light_get_options(array('sticky_site_title', '#191919'));
                $sticky_des_color = navolio_light_get_options(array('sticky_site_description', '#cccccc'));
                $footer_background = navolio_light_get_options(array('footer_background', '#191d21'));
                $footer_text_color = navolio_light_get_options(array('footer_color', '#7f7f7f'));
                $footer_heading_color = navolio_light_get_options(array('footer_heading_color', '#ffffff'));
                $footer_link_color = navolio_light_get_options(array('footer_link_color', '#7f7f7f'));
                $header_text_color = get_theme_mod('header_textcolor');

                $menu_submenu_bg = navolio_light_get_options(array('dropdown_menu_bg', '#232323'));
                $menu_submenu_color = navolio_light_get_options(array('dropdown_menu_color', '#f7f7f7'));

                if(!empty( $header_text_color ) ) {
                    $head_text_color = $header_text_color;
                } else {
                    $head_text_color = '000000';
                } ?>
                .navigation .mainmenu > li > a {color: <?php echo esc_attr($main_menu_color); ?>} .top-nav-collapse .site-title { color: <?php echo esc_attr($sticky_title_color); ?> !important; } .top-nav-collapse .site-description { color: <?php echo esc_attr($sticky_des_color); ?> !important;} .site-branding-text .site-title {color: #<?php echo esc_attr($head_text_color); ?>} footer {background: <?php echo esc_attr($footer_background); ?>; color: <?php echo esc_attr($footer_text_color); ?>  } footer h1, footer h2, footer h3, footer h4, footer h5, footer h6 {color: <?php echo esc_attr($footer_heading_color); ?>} footer a {color: <?php echo esc_attr($footer_link_color); ?>} @media only screen and (min-width: 992px) {.mainmenu .sub-menu, .mainmenu .sub-menu .sub-menu, .mainmenu .sub-menu .sub-menu .sub-menu {background: <?php echo esc_attr($menu_submenu_bg); ?>  } .mainmenu .sub-menu li a {color: <?php echo esc_attr($menu_submenu_color); ?>}}
            <?php
        }

        /**
         * Theme Background Colors
         *
         * @package Navolio_Light
         * @since 1.0
         */
        public function navolio_light_backgound_image_cover_bg() { ?>
            .blog-page-home { background-image: url(<?php header_image(); ?>); } .blog-page-home.banner-post {height: <?php echo esc_attr( navolio_light_get_options(array('blog_banner_height', 648))); ?>px;} .site-footer {background: <?php echo esc_attr( navolio_light_get_options(array('footer_background', '#191d21' ))); ?>; color: <?php echo esc_attr( navolio_light_get_options(array('footer_color', '#dedede' ))); ?>;  } .site-footer a {color: <?php echo esc_attr( navolio_light_get_options(array('footer_link_color', '#ffffff' ))); ?>;}
            <?php if(get_post_meta( get_the_ID(), 'navolio_light_header_sticky_menu_background', true) !=="" ) { ?>
            .sticky-header.sticky-bg.sticky-show {background: <?php echo esc_attr( get_post_meta( get_the_ID(), 'navolio_light_header_sticky_menu_background', true) ); ?>;}
            <?php } ?>
            <?php if( get_post_meta( get_the_ID(), 'navolio_light_header_sticky_menu_text', true) !=="" ) { ?>
            @media only screen and (min-width: 992px) { .sticky-header.sticky-bg.sticky-show, .sticky-header.sticky-bg.sticky-show .header-ver-one .navigation .mainmenu > li > a {color: <?php echo esc_attr( get_post_meta( get_the_ID(), 'navolio_light_header_sticky_menu_text', true) ); ?>;} }
            .sticky-header.sticky-bg.sticky-show .hamburger-btn-wrap .hamburger-btn .hamburger-content, .sticky-header.sticky-bg.sticky-show .hamburger-btn-wrap .hamburger-btn .hamburger-content:before, .sticky-header.sticky-bg.sticky-show .hamburger-btn-wrap .hamburger-btn .hamburger-content:after {background: <?php echo esc_attr( get_post_meta( get_the_ID(), 'navolio_light_header_sticky_menu_text', true) ); ?> !important;}
            <?php } ?>

            <?php if( get_post_meta( get_the_ID(), 'navolio_light_header_status', true) !=="transparent" && get_post_meta( get_the_ID(), 'navolio_light_header_backgtound_color', true) !== "" ) { ?>
            .bg-lavender.header-bg { background: <?php echo esc_attr( get_post_meta( get_the_ID(), 'navolio_light_header_backgtound_color', true) ); ?>; }
            <?php } ?>

            <?php if( get_post_meta( get_the_ID(), 'navolio_light_header_status', true) !=="transparent" && get_post_meta( get_the_ID(), 'navolio_light_header_text_color', true) !== "" ) { ?>
            @media only screen and (min-width: 992px) { .bg-lavender.header-bg, .bg-lavender.header-bg .header-ver-one .navigation .mainmenu > li > a { color: <?php echo esc_attr( get_post_meta( get_the_ID(), 'navolio_light_header_text_color', true) ); ?>; } }
            .bg-lavender.header-bg .hamburger-btn-wrap .hamburger-btn .hamburger-content, .bg-lavender.header-bg .hamburger-btn-wrap .hamburger-btn .hamburger-content:before, .bg-lavender.header-bg .hamburger-btn-wrap .hamburger-btn .hamburger-content:after {background: <?php echo esc_attr( get_post_meta( get_the_ID(), 'navolio_light_header_text_color', true) ); ?> !important;}
            <?php } ?>
            <?php 
        }

        /**
         * Theme Spacing Element
         *
         * @package Navolio_Light
         * @since 1.0
         */
        public function navolio_light_spaing_elements() {
            //Blog Wrapper Padding
            $blog_wrap_desktop_top = navolio_light_get_options( array('top_padding', 90) );
            $blog_wrap_desktop_bottom = navolio_light_get_options( array('bottom_padding', 90) );            
            $blog_wrap_tablet_top = navolio_light_get_options( array('tablet_top_padding', 90) );
            $blog_wrap_tablet_bottom = navolio_light_get_options( array('tablet_bottom_padding', 90) );

            $blog_wrap_mobile_top = navolio_light_get_options( array('mobile_top_padding', 175) );
            $blog_wrap_mobile_bottom = navolio_light_get_options( array('mobile_bottom_padding', 135) );

            //Logo Padding
            $logo_desktop_top = navolio_light_get_options( array('logo_top_padding', 20) );
            $logo_desktop_bottom = navolio_light_get_options( array('logo_bottom_padding', 20) );

            $logo_tablet_top = navolio_light_get_options( array('logo_tablet_top_padding', 20) );
            $logo_tablet_bottom = navolio_light_get_options( array('logo_tablet_bottom_padding', 20) );

            $logo_mobile_top = navolio_light_get_options( array('logo_mobile_top_padding', 20) );
            $logo_mobile_bottom = navolio_light_get_options( array('logo_mobile_bottom_padding', 20) );

            $css = '';
            $content_padding_css = '';
            $tablet_content_padding_css = '';
            $mobile_content_padding_css = '';
            $logo_desktop_padding_css = '';
            $logo_tablet_padding_css = '';
            $logo_mobile_padding_css = '';

            // Content top padding
            if ( isset( $blog_wrap_desktop_top ) && '' != $blog_wrap_desktop_top ) {
                $content_padding_css .= 'padding-top:'. $blog_wrap_desktop_top .'px;';
            }

            // Content bottom padding
            if ( isset( $blog_wrap_desktop_bottom ) && '' != $blog_wrap_desktop_bottom ) {
                $content_padding_css .= 'padding-bottom:'. $blog_wrap_desktop_bottom .'px;';
            }

            // Content padding css
            if ( isset( $blog_wrap_desktop_top ) && '' != $blog_wrap_desktop_top
                || isset( $blog_wrap_desktop_bottom ) && '' != $blog_wrap_desktop_bottom ) {
                $css .= '.blog-page-block {'. $content_padding_css .'}';
            }

            // Tablet content top padding
            if ( isset( $blog_wrap_tablet_top ) && '' != $blog_wrap_tablet_top ) {
                $tablet_content_padding_css .= 'padding-top:'. $blog_wrap_tablet_top .'px;';
            }

            // Tablet content bottom padding
            if ( isset( $blog_wrap_tablet_bottom ) && '' != $blog_wrap_tablet_bottom ) {
                $tablet_content_padding_css .= 'padding-bottom:'. $blog_wrap_tablet_bottom .'px;';
            }

            // Tablet content padding css
            if ( isset( $blog_wrap_tablet_top ) && '' != $blog_wrap_tablet_top
                || isset( $blog_wrap_tablet_bottom ) && '' != $blog_wrap_tablet_bottom ) {
                $css .= '@media (max-width: 768px){.blog-page-block {'. $tablet_content_padding_css .'}}';
            }

            // Mobile content top padding
            if ( isset( $blog_wrap_mobile_top ) && '' != $blog_wrap_mobile_top ) {
                $mobile_content_padding_css .= 'padding-top:'. $blog_wrap_mobile_top .'px;';
            }

            // Mobile content bottom padding
            if ( isset( $blog_wrap_mobile_bottom ) && '' != $blog_wrap_mobile_bottom ) {
                $mobile_content_padding_css .= 'padding-bottom:'. $blog_wrap_mobile_bottom .'px;';
            }

            // Mobile content padding css
            if ( isset( $blog_wrap_mobile_bottom ) && '' != $blog_wrap_mobile_bottom
                || isset( $mobile_content_bottom_padding ) && '' != $mobile_content_bottom_padding ) {
                $css .= '@media (max-width: 480px){.blog-page-block{'. $mobile_content_padding_css .'}}';
            }

            //logo top padding
            if ( isset( $logo_tablet_top ) && '' != $logo_tablet_top ) {
                $logo_desktop_padding_css .= 'padding-top:'. $logo_tablet_top .'px;';
            }            

            //logo bottom padding
            if ( isset( $logo_desktop_bottom ) && '' != $logo_desktop_bottom ) {
                $logo_desktop_padding_css .= 'padding-bottom:'. $logo_desktop_bottom .'px;';
            }

            // logo padding css
            if ( isset( $logo_desktop_top ) && '' != $logo_desktop_top
                || isset( $logo_desktop_bottom ) && '' != $logo_desktop_bottom ) {
                $css .= '.site-header .site-logo {'. $logo_desktop_padding_css .'}';
            }

            //logo tablet top padding
            if ( isset( $logo_tablet_top ) && '' != $logo_tablet_top ) {
                $logo_tablet_padding_css .= 'padding-top:'. $logo_tablet_top .'px;';
            }            

            //logo tablet bottom padding
            if ( isset( $logo_tablet_bottom ) && '' != $logo_tablet_bottom ) {
                $logo_tablet_padding_css .= 'padding-bottom:'. $logo_tablet_bottom .'px;';
            }

            // logo tablet padding css
            if ( isset( $logo_tablet_top ) && '' != $logo_tablet_top
                || isset( $logo_tablet_bottom ) && '' != $logo_tablet_bottom ) {
                $css .= '@media (max-width: 768px){ .site-header .site-logo {'. $logo_tablet_padding_css .'}}';
            }

            //logo tablet top padding
            if ( isset( $logo_mobile_top ) && '' != $logo_mobile_top ) {
                $logo_mobile_padding_css .= 'padding-top:'. $logo_mobile_top .'px;';
            }            

            //logo tablet bottom padding
            if ( isset( $logo_mobile_bottom ) && '' != $logo_mobile_bottom ) {
                $logo_mobile_padding_css .= 'padding-bottom:'. $logo_mobile_bottom .'px;';
            }

            // logo tablet padding css
            if ( isset( $logo_mobile_top ) && '' != $logo_mobile_top
                || isset( $logo_mobile_bottom ) && '' != $logo_mobile_bottom ) {
                $css .= '@media (max-width: 480px){ .site-header .site-logo {'. $logo_mobile_padding_css .'}}';
            }

            // Return CSS
            if ( ! empty( $css ) ) {
                echo esc_attr( $css );
            }
        }

        /**
         * Page Spacing Element
         *
         * @package Navolio_Light
         * @since 1.0
         */
        public function navolio_light_page_elements() { ?>
            <?php if( get_post_meta( get_the_ID(), 'navolio_light_content_padding_top', true) !== '' ) { ?> .content-area-main { padding-top: <?php echo esc_attr( get_post_meta( get_the_ID(), 'navolio_light_content_padding_top', true) ); ?> } <?php } ?>
            <?php if( get_post_meta( get_the_ID(), 'navolio_light_content_padding_bottom', true) !== '' ) { ?> .content-area-main { padding-bottom: <?php echo esc_attr( get_post_meta( get_the_ID(), 'navolio_light_content_padding_bottom', true) ); ?> } <?php } ?>
        <?php
        }

    }
}

new Navolio_Light_Helpers;