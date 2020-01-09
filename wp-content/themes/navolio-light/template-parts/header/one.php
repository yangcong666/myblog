<?php
/**
 * This template for displaying header part
 *
 * @package Navolio_Light
 * @since 1.0
 */
/* ================================================== */

/**
 * Preloader
 * @package Navolio_Light
 * @since 1.0
 */
navolio_light_preloader(); 

/**
 * Header Part show/hide condition
 * @package Navolio_Light
 * @since 1.0
 */
if( get_post_meta( get_the_ID(), 'navolio_light_header_show_header', true) == 'no' ) {
    return;
}

/**
 * Header Sticky/Fixed Background Status
 * @package Navolio_Light
 * @since 1.0
 */
if( get_post_meta( get_the_ID(), 'navolio_light_header_menu_sticky', true) == 'yes' ) {
    $sticky_menu = 'sticky-header sticky-bg';
} else {
    $sticky_menu = '';
}

/**
 * Header Background Status
 * @package Navolio_Light
 * @since 1.0
 */
if ( get_post_meta( get_the_ID(), 'navolio_light_header_status', true) == 'transparent') {
    $header_bg_class = 'transparent-bg';
} else {
    $header_bg_class = 'header-bg'; 
} ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'navolio-light' ); ?></a>

<!-- Header
================================================== --> 
<header class="site-header <?php echo esc_attr($sticky_menu .' '. $header_bg_class); ?>" id="site-header" role="banner">
    <?php 
    $header_layout = navolio_light_get_options(array('header_layout_dispay','header_one'));
    $header_layout_post = get_post_meta( get_the_ID(), 'navolio_light_header_variation', true); ?>
    
    <div class="header-ver-one">
        <div class="container">
            <div class="row">
                <div class="col-8 col-sm-6 col-lg-2 col-xl-2">
                    <div class="header-left">                    
                        <div class="site-logo main-logo">
                            <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                                the_custom_logo();
                            } else { 
                                if ( function_exists( 'display_header_text' ) ) { 
                                    if( display_header_text() == true ) { ?>
                                    <div class="site-branding-text">
                                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

                                        <?php $description = get_bloginfo( 'description', 'display' );
                                        if ( $description || is_customize_preview() ) : ?>
                                        <p class="site-description"><?php echo esc_html($description); ?></p>
                                        <?php endif; ?>
                                    </div><!-- .site-branding-text -->
                                    <?php }
                                }
                            } ?>
                        </div><!-- /.site-logo -->
                        <div class="site-logo sticky-logo">
                            <?php if(navolio_light_get_options('sticky_menu_logo')) : ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link">
                                <img src="<?php echo esc_url(navolio_light_get_options('sticky_menu_logo')); ?>" alt="<?php echo esc_attr__('Site Logo', 'navolio-light'); ?>" />
                            </a>
                            <?php else :
                                if ( function_exists( 'display_header_text' ) ) { 
                                    if( display_header_text() == true ) { ?>
                                    <div class="site-branding-text">
                                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

                                        <?php $description = get_bloginfo( 'description', 'display' );
                                        if ( $description || is_customize_preview() ) : ?>
                                        <p class="site-description"><?php echo esc_html($description); ?></p>
                                        <?php endif; ?>
                                    </div><!-- .site-branding-text -->
                                    <?php }
                                }
                            ?>
                            <?php endif; ?>
                        </div><!-- /.site-logo -->
                    </div><!-- /.header-left -->
                </div><!-- /.col-md-6 -->

                <div class="col-4 col-sm-6 col-lg-10 col-xl-10">
                    <div class="header-right header-one-right">
                        <nav class="social-nav float-right mrt-35 mrl-30">
                            <ul class="social-item">
                                <?php 
                                    $social_url_field = navolio_light_get_options('social_url');
                                    $item_json_decode = json_decode($social_url_field);
                                    $item_open = navolio_light_get_options(array('social_profile_target','_blank'));
                                    if( !empty($social_url_field) ) :
                                    foreach ($item_json_decode as $key ) { ?>
                                        <li><a href="<?php echo esc_url($key->link); ?>" target="<?php echo esc_attr( $item_open ); ?>" class="social-btn-lg rd-p-50 color-white">
                                            <?php if( !empty( $key->icon_value )  ) :?>
                                                <i class="fa <?php echo esc_attr($key->icon_value); ?>"></i>
                                            <?php elseif( !empty( $key->image_url ) ) : ?>
                                                <img src="<?php echo esc_attr( navolio_light_get_image_crop_size_by_url( $key->image_url, 45, 45) ); ?>" width="45" height="45" alt="<?php esc_attr_e('Social Profile','navolio-light'); ?>">
                                            <?php endif; ?>
                                        </a></li>
                                    <?php }
                                    endif;
                                ?>
                            </ul>
                        </nav><!-- /.social-nav -->  

                        <a href="#" class="hamburger-btn-wrap mrt-15">
                            <div class="hamburger-btn">
                                <span class="hamburger-content"></span>    
                            </div>
                        </a>   

                        <nav class="navigation float-right mrt-15">
                            <!-- Main Menu -->
                            <div class="menu-wrapper">
                                <div class="menu-content">
                                    <?php 
                                        wp_nav_menu ( array(
                                            'container'=> 'ul',
                                            'theme_location' => 'main-menu',
                                            'items_wrap' => '<ul class="mainmenu" role="navigation">%3$s</ul>'  
                                        )); 
                                    ?> 
                                </div> <!-- /.hours-content-->
                            </div><!-- /.menu-wrapper --> 
                        </nav><!-- /.site-navigation -->
                    </div><!-- /.header-right -->
                </div><!-- /.col-xl-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div> <!-- /.header-ver-one -->
</header><!-- /.site-header -->