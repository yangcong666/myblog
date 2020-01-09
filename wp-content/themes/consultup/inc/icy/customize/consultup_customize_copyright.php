<?php // Footer copyright section 
function consultup_footer_copyright( $wp_customize ) {
	$wp_customize->add_panel('consultup_copyright', array(
		'priority' => 100,
		'capability' => 'edit_theme_options',
		'title' => __('Footer Settings', 'consultup'),
	) );

    $wp_customize->add_section('footer_social_icon', array(
        'title' => __('Footer social icon settings','consultup'),
        'priority' => 20,
        'panel' => 'consultup_copyright',
    ) );
	
	
	//Enable and disable social icon
	$wp_customize->add_setting(
	'footer_social_icon_enable'
    ,
    array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'consultup_social_sanitize_checkbox',
    )	
	);
	$wp_customize->add_control(
    'footer_social_icon_enable',
    array(
        'label' => __('Hide / Show','consultup'),
        'section' => 'footer_social_icon',
        'type' => 'checkbox',
    )
	);

	// Soical facebook link
	$wp_customize->add_setting(
    'consultup_footer_fb_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'consultup_footer_fb_link',
    array(
        'label' => __('Facebook URL','consultup'),
        'section' => 'footer_social_icon',
        'type' => 'text',
    )
	);

	$wp_customize->add_setting(
	'consultup_footer_fb_target',array(
	'sanitize_callback' => 'consultup_social_sanitize_checkbox',
	'default' => 1,
	));

	$wp_customize->add_control(
    'consultup_footer_fb_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','consultup'),
        'section' => 'footer_social_icon',
    )
	);
	
	
	//Social Twitter link
	$wp_customize->add_setting(
    'consultup_footer_twt_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'consultup_footer_twt_link',
    array(
        'label' => __('Twitter URL','consultup'),
        'section' => 'footer_social_icon',
        'type' => 'text',
    )
	);

	$wp_customize->add_setting(
	'consultup_footer_twt_target',array(
	'sanitize_callback' => 'consultup_social_sanitize_checkbox',
	'default' => 1,
	));

	$wp_customize->add_control(
    'consultup_footer_twt_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','consultup'),
        'section' => 'footer_social_icon',
    )
	);
	
	//Soical Linkedin link
	$wp_customize->add_setting(
    'consultup_footer_lnkd_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'consultup_footer_lnkd_link',
    array(
        'label' => __('Linkedin URL','consultup'),
        'section' => 'footer_social_icon',
        'type' => 'text',
    )
	);

	$wp_customize->add_setting(
	'consultup_footer_lnkd_target',array(
	'default' => 1,
	'sanitize_callback' => 'consultup_social_sanitize_checkbox',
	));

	$wp_customize->add_control(
    'consultup_footer_lnkd_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','consultup'),
        'section' => 'footer_social_icon',
    )
	);
	
	
	//Soical Instagram link
	$wp_customize->add_setting(
    'consultup_footer_insta_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'consultup_footer_insta_link',
    array(
        'label' => __('Instagram URL','consultup'),
        'section' => 'footer_social_icon',
        'type' => 'text',
    )
	);

	$wp_customize->add_setting(
	'consultup_footer_indta_target',array(
	'default' => 1,
	'sanitize_callback' => 'consultup_social_sanitize_checkbox',
	));

	$wp_customize->add_control(
    'consultup_footer_indta_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','consultup'),
        'section' => 'footer_social_icon',
    )
	);

	
	$wp_customize->add_section('footer_widget_back', array(
        'title' => __('Footer background setting','consultup'),
        'priority' => 30,
        'panel' => 'consultup_copyright',
    ) );
    
    
    
     //Funfact Background image
    $wp_customize->add_setting( 
        'consultup_footer_widget_background', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'consultup_footer_widget_background', array(
        'label'    => __( 'Background Image', 'consultup' ),
        'section'  => 'footer_widget_back',
        'settings' => 'consultup_footer_widget_background',
    ) ) );

	
	$wp_customize->add_section('footer_widget_column', array(
        'title' => __('Footer widget column layout','consultup'),
        'priority' => 30,
		'panel' => 'consultup_copyright',
    ) );
	
	
	
	 $wp_customize->add_setting(
                'consultup_footer_column_layout', array(
                'default' => 3,
                'sanitize_callback' => 'consultup_sanitize_select',
            ) );

            $wp_customize->add_control(
                'consultup_footer_column_layout', array(
                'type' => 'select',
                'label' => __('Select Column Layout','consultup'),
                'section' => 'footer_widget_column',
                'choices' => array(1=>1, 2=>2,3=>3,4=>4),
	) );
	
	$wp_customize->add_section('footer social icon', array(
        'title' => __('Footer social icon','consultup'),
        'priority' => 40,
		'panel' => 'consultup_copyright',
    ) );
	
	function consultup_social_sanitize_checkbox( $input ) {
			// Boolean check 
			return ( ( isset( $input ) && true == $input ) ? true : false );
			}
	
			
	if ( ! function_exists( 'consultup_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function consultup_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;		
}
add_action( 'customize_register', 'consultup_footer_copyright' );