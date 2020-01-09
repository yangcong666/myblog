<?php
/**
 *  Navolio_Light Besic Theme Settings
 *
 * @since Navolio_Light 1.0
 *
 * @return array navolio_light_customize_register
 *
*/
function navolio_light_customize_register( $wp_customize ) {
    //Basic Post Message Settings
    $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'custom_logo' )->transport     = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->active_callback = '__return_false';

    // Changing for site Identity
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
        'selector' => '.site-title a',
        'render_callback' => 'navolio_light_customize_partial_blogname',
    ));
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => 'navolio_light_customize_partial_blogdescription',
    ));

    $wp_customize->add_setting( 'navolio_light_options[home_page_logo]' , array(
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'navolio_light_sanitize_url',
       'type'  =>  'theme_mod',
       'transport'   => 'postMessage',
    )); 

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
        'navolio_light_options[home_page_logo]', array(
            'label'   => esc_html__('Home page Logo','navolio-light'),
            'section' => 'title_tagline',
            'priority' => 20,
    ) ) );    

    $wp_customize->add_setting( 'navolio_light_options[sticky_menu_logo]' , array(
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'navolio_light_sanitize_url',
       'type'  =>  'theme_mod',
       'transport'   => 'postMessage',
    )); 

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
        'navolio_light_options[sticky_menu_logo]', array(
            'label'   => esc_html__('Sticky Header Logo','navolio-light'),
            'section' => 'title_tagline',
            'priority' => 20,
    ) ) );

    if( class_exists('Navolio_Light_Customizer_Dimensions_Control') ) {
        /**
         * Blog Padding
         */
        $wp_customize->add_setting( 'navolio_light_options[logo_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number',
            'default'               => 20,
        ) );
        $wp_customize->add_setting( 'navolio_light_options[logo_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number',
            'default'               => 20,
        ) );

        $wp_customize->add_setting( 'navolio_light_options[logo_tablet_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number_blank',
            'default'               => 20,
        ) );
        $wp_customize->add_setting( 'navolio_light_options[logo_tablet_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number_blank',
            'default'               => 20,
        ) );

        $wp_customize->add_setting( 'navolio_light_options[logo_mobile_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number_blank',
            'default'               => 20,
        ) );
        $wp_customize->add_setting( 'navolio_light_options[logo_mobile_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number_blank',
            'default'               => 20,
        ) );

        $wp_customize->add_control( new Navolio_Light_Customizer_Dimensions_Control( $wp_customize, 'navolio_light_options[logo_padding]', array(
            'label'                 => esc_html__( 'Logo Padding (px)', 'navolio-light' ),
            'section'               => 'title_tagline',             
            'settings'   => array(
                'desktop_top'       => 'navolio_light_options[logo_top_padding]',
                'desktop_bottom'    => 'navolio_light_options[logo_bottom_padding]',
                'tablet_top'        => 'navolio_light_options[logo_tablet_top_padding]',
                'tablet_bottom'     => 'navolio_light_options[logo_tablet_bottom_padding]',
                'mobile_top'        => 'navolio_light_options[logo_mobile_top_padding]',
                'mobile_bottom'     => 'navolio_light_options[logo_mobile_bottom_padding]',
            ),
            'priority'              => 20,
            'input_attrs'           => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 1,
            ),
        ) ) );
    }

    $wp_customize->add_setting( 'navolio_light_options[theme_color]' , array(
       'default'   => '#e53632',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'navolio_light_options[theme_color]', array(
           'label'    => esc_html__( 'Theme Color', 'navolio-light' ),
           'section'  => 'colors',
        ) 
    ));    

    $wp_customize->add_setting( 'navolio_light_options[menu_color]' , array(
       'default'   => '#ffffff',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'navolio_light_options[menu_color]', array(
           'label'    => esc_html__( 'Menu Color', 'navolio-light' ),
           'section'  => 'colors',
        ) 
    ));      

    $wp_customize->add_setting( 'navolio_light_options[dropdown_menu_bg]' , array(
       'default'   => '#232323',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'navolio_light_options[dropdown_menu_bg]', array(
           'label'    => esc_html__( 'Dropdown Menu Background', 'navolio-light' ),
           'section'  => 'colors',
        ) 
    ));    

    $wp_customize->add_setting( 'navolio_light_options[dropdown_menu_color]' , array(
       'default'   => '#f7f7f7',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
       'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'navolio_light_options[dropdown_menu_color]', array(
           'label'    => esc_html__( 'Dropdown Menu Color', 'navolio-light' ),
           'section'  => 'colors',
        ) 
    ));

    $wp_customize->add_setting( 'navolio_light_options[footer_background]' , array(
        'default'     => '#191d21',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'navolio_light_options[footer_background]', array(
           'label'    => esc_html__( 'Footer Background Color: ', 'navolio-light' ),
           'section'  => 'colors',
        ) 
    ));

    $wp_customize->add_setting( 'navolio_light_options[footer_color]' , array(
        'default'     => '#dedede',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'navolio_light_options[footer_color]', array(
           'label'    => esc_html__( 'Footer Text Color: ', 'navolio-light' ),
           'section'  => 'colors',
        ) 
    ));    

    $wp_customize->add_setting( 'navolio_light_options[footer_link_color]' , array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'navolio_light_options[footer_link_color]', array(
           'label'    => esc_html__( 'Footer Link Color: ', 'navolio-light' ),
           'section'  => 'colors',
        ) 
    ));

    /**
     * Navolio_Light WordPress Theme Header Settings
     */  
    $wp_customize->add_section( 'navolio_light_header_settings' , array(
        'title'      => esc_html__( 'Header Settings', 'navolio-light' ),
        'priority'   => 28,
    ) ); 

    if ( class_exists( 'Navolio_Light_Customizer_Repeater_Control' ) ) { 
        $wp_customize->add_setting( 'navolio_light_options[social_url]', array(
            'sanitize_callback' => 'navolio_light_customizer_repeater_sanitize',
            'capability' => 'edit_theme_options',
        )); 
    
        $wp_customize->add_control( new Navolio_Light_Customizer_Repeater_Control( $wp_customize, 'navolio_light_options[social_url]', array(
            'label'   => esc_html__('Social URL','navolio-light'),
            'section' => 'navolio_light_header_settings',
            'priority' => 12,
            'customizer_repeater_image_control' => true,
            'customizer_repeater_icon_control' => true,
            'customizer_repeater_link_control' => true,
        ) ) );
    }

    /**
     * Navolio_Light WordPress Theme General Settings
     */  
    $wp_customize->add_section( 'navolio_light_general_settings' , array(
        'title'      => esc_html__( 'General Settings', 'navolio-light' ),
        'priority'   => 28,
    ) ); 

    if ( class_exists( 'Navolio_Light_Toggle_Control' ) ) {
        $wp_customize->add_setting( 'navolio_light_options[preloader]', array(
            'default'     => false,
            'transport'   => 'postMessage', 
            'sanitize_callback' => 'navolio_light_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control( new Navolio_Light_Toggle_Control( $wp_customize, 
            'navolio_light_options[preloader]', 
            array(
                'label'  => esc_html__( 'Preloader:', 'navolio-light' ),
                'type'   => 'ios',
                'section'  => 'navolio_light_general_settings',
                'priority' => 10, 
                
            ) 
        ));            

        $wp_customize->add_setting( 'navolio_light_options[scroll_top_btn]', array(
            'default'     => false,
            'transport'   => 'postMessage', 
            'sanitize_callback' => 'navolio_light_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control( new Navolio_Light_Toggle_Control( $wp_customize, 
            'navolio_light_options[scroll_top_btn]', 
            array(
                'label'  => esc_html__( 'Scroll Top:', 'navolio-light' ),
                'type'   => 'ios',
                'section'  => 'navolio_light_general_settings',
                'priority' => 10, 
                
            ) 
        ));        

        $wp_customize->add_setting( 'navolio_light_options[sticky_contact_btn]', array(
            'default'     => false,
            'transport'   => 'postMessage', 
            'sanitize_callback' => 'navolio_light_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control( new Navolio_Light_Toggle_Control( $wp_customize, 
            'navolio_light_options[sticky_contact_btn]', 
            array(
                'label'  => esc_html__( 'Sticky Contact Button:', 'navolio-light' ),
                'type'   => 'ios',
                'section'  => 'navolio_light_general_settings',
                'priority' => 10, 
                
            ) 
        ));        
    }   
    $wp_customize->add_setting( 'navolio_light_options[sticky_contact_url]', array(
        'default'     => '#',
        'transport'   => 'postMessage', 
        'sanitize_callback' => 'navolio_light_sanitize_url',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_control(
        'navolio_light_options[sticky_contact_url]', array(
            'label' => esc_html__( 'Contact URL:', 'navolio-light' ),
            'type' => 'text',
            'section' => 'navolio_light_general_settings',
        )
    );

     /**
     * Navolio_Light WordPress Theme Blog Settings
     */ 
    $wp_customize->add_section( 'navolio_light_blog_settings' , array(
        'title'      => esc_html__( 'Blog Settings', 'navolio-light' ),
        'priority'   => 90,   
    ));

    if( class_exists('Navolio_Light_Customizer_Dimensions_Control') ) {
        /**
         * Blog Padding
         */
        $wp_customize->add_setting( 'navolio_light_options[top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number',
            'default'               => 90,
        ) );
        $wp_customize->add_setting( 'navolio_light_options[bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number',
            'default'               => 90,
        ) );

        $wp_customize->add_setting( 'navolio_light_options[tablet_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number_blank',
            'default'               => 90,
        ) );
        $wp_customize->add_setting( 'navolio_light_options[tablet_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number_blank',
            'default'               => 90,
        ) );

        $wp_customize->add_setting( 'navolio_light_options[mobile_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number_blank',
            'default'               => 90,
        ) );
        $wp_customize->add_setting( 'navolio_light_options[mobile_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'navolio_light_sanitize_number_blank',
            'default'               => 90,
        ) );

        $wp_customize->add_control( new Navolio_Light_Customizer_Dimensions_Control( $wp_customize, 'navolio_light_options[blog_padding]', array(
            'label'                 => esc_html__( 'Blog Padding (px)', 'navolio-light' ),
            'section'               => 'navolio_light_blog_settings',             
            'settings'   => array(
                'desktop_top'       => 'navolio_light_options[top_padding]',
                'desktop_bottom'    => 'navolio_light_options[bottom_padding]',
                'tablet_top'        => 'navolio_light_options[tablet_top_padding]',
                'tablet_bottom'     => 'navolio_light_options[tablet_bottom_padding]',
                'mobile_top'        => 'navolio_light_options[mobile_top_padding]',
                'mobile_bottom'     => 'navolio_light_options[mobile_bottom_padding]',
            ),
            'priority'              => 10,
            'input_attrs'           => array(
                'min'   => 0,
                'max'   => 400,
                'step'  => 1,
            ),
        ) ) );
    }

    if ( class_exists( 'Navolio_Light_Customize_Control_Radio_Image' ) ) { 
        $sidebar_choices = array(
            'full'    => array(
                'url'   =>  get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/full-width.png' ),
                'label' => esc_html__( 'Full Width', 'navolio-light' ),
            ),
            'left'  => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-left.png' ),
                'label' => esc_html__( 'Left Sidebar', 'navolio-light' ),
            ),
            'right' => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-right.png' ),
                'label' => esc_html__( 'Right Sidebar', 'navolio-light' ),
            ),
        );

        $wp_customize->add_setting( 'navolio_light_options[blog_sidebar_dispay]' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_key',
            'type'      =>  'theme_mod',
            'default' => 'right',
        ));

        $wp_customize->add_control(
            new Navolio_Light_Customize_Control_Radio_Image(
                $wp_customize, 'navolio_light_options[blog_sidebar_dispay]', array(
                    'label'    => esc_html__( 'Blog Sidebar Layout', 'navolio-light' ),
                    'section'  => 'navolio_light_blog_settings',
                    'priority' => 10,
                    'choices'  => $sidebar_choices,
                )
            )
        );
    }

    $wp_customize->add_setting( 'navolio_light_options[excerpt_length]' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'type'      =>  'theme_mod',
        'default' => 25,
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 'navolio_light_options[excerpt_length]', array(
        'label' => esc_html__( 'Excerpt Length: ', 'navolio-light' ),
        'description' => esc_html__( 'How many words want to show per page?', 'navolio-light' ),
        'section' => 'navolio_light_blog_settings',
        'type'        => 'number',
        'priority' => 20,
        'input_attrs' => array(
            'min'  => 1,
            'max'   => 100,
            'step' => 1,
        ),
    ));


    /**
     * End Navolio_Light WordPress Theme Footer Control Panel
     */
    $wp_customize->add_section( 'navolio_light_footer' , array(
        'title'      => esc_html__( 'Footer Settings', 'navolio-light' ),
        'priority'   => 100,   
    ));

    if ( class_exists( 'Navolio_Light_Toggle_Control' ) ) {
        $wp_customize->add_setting( 'navolio_light_options[mail_chimp_visivility]', array(
            'default'     => false,
            'transport'   => 'postMessage', 
            'sanitize_callback' => 'navolio_light_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control( new Navolio_Light_Toggle_Control( $wp_customize, 
            'navolio_light_options[mail_chimp_visivility]', 
            array(
                'label'  => esc_html__( 'Enable Mailchimp:', 'navolio-light' ),
                'description' => esc_html__('Note: This option available for Blog page, Blog Single Page, Service single page, Portfolio single and Portfolio archive page.', 'navolio-light'),
                'type'   => 'ios',
                'section'  => 'navolio_light_footer',
                'priority' => 10, 
                
            ) 
        ));
    }


    $wp_customize->add_setting(
        'navolio_light_options[footer_copyright_info]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'navolio_light_sanitize_advance_html',
            'type'      =>  'theme_mod',
            'transport' => 'postMessage',
            'default'   => 'Copyright &copy; 2019 Navolio Light All rights Reserved.',
        )
    );

    $wp_customize->add_control(
        'navolio_light_options[footer_copyright_info]', array(
            'label' => esc_html__( 'Footer Copyright Text:', 'navolio-light' ),
            'type' => 'text',
            'priority' => 10,
            'section' => 'navolio_light_footer',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'navolio_light_options[footer_copyright_info]', array(
        'selector' => '.copyright-text', 
    ) );

    /**
     * End Navolio_Light WordPress Theme Footer Control Panel
     */    
}
add_action( 'customize_register', 'navolio_light_customize_register' );