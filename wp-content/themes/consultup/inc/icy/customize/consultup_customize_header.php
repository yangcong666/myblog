<?php
function consultup_header_setting( $wp_customize ) {
$wp_customize->remove_control('header_textcolor');

	/* Header Section */
	$wp_customize->add_panel( 'header_options', array(
		'priority' => 90,
		'capability' => 'edit_theme_options',
		'title' => __('Header Settings', 'consultup'),
	) );

	$wp_customize->add_section( 'header_contact' , array(
		'title' => __('Header Top Bar Setting', 'consultup'),
		'panel' => 'header_options',
		'priority' => 10,
   	) );

    $wp_customize->add_setting(
        'consultup_head_info_icon_one', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'consultup_head_info_icon_one', array(
        'label' => __('Icon', 'consultup'),
        'section' => 'header_contact',
        'type' => 'text',
    ) );
	
	$wp_customize->add_setting(
		'consultup_head_info_icon_one_text', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'consultup_sanitize_text_content',
    ) );
    $wp_customize->add_control( 'consultup_head_info_icon_one_text', array(
        'label' => __('Text', 'consultup'),
        'section' => 'header_contact',
        'type' => 'text',
    ) );
	

    $wp_customize->add_setting(
        'consultup_head_info_icon_two', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'consultup_head_info_icon_two', array(
        'label' => __('Icon', 'consultup'),
        'section' => 'header_contact',
        'type' => 'text',
    ) );
	
	$wp_customize->add_setting(
		'consultup_head_info_icon_two_text', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'consultup_sanitize_text_content',
    ) );
    $wp_customize->add_control( 'consultup_head_info_icon_two_text', array(
        'label' => __('Text', 'consultup'),
        'section' => 'header_contact',
        'type' => 'text',
    ) );

	 $wp_customize->add_section('header_social_icon', array(
        'title' => __('Header Social Icon Settings','consultup'),
        'priority' => 20,
        'panel' => 'header_options',
    ) );
	
	
	//Enable and disable social icon
	$wp_customize->add_setting(
	'header_social_icon_enable'
    ,
    array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'consultup_header_sanitize_checkbox',
    )	
	);
	$wp_customize->add_control(
    'header_social_icon_enable',
    array(
        'label' => __('Hide / Show','consultup'),
        'section' => 'header_social_icon',
        'type' => 'checkbox',
    )
	);

	
	

	// Soical facebook link
	$wp_customize->add_setting(
    'consultup_header_fb_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'consultup_header_fb_link',
    array(
        'label' => __('Facebook URL','consultup'),
        'section' => 'header_social_icon',
        'type' => 'url',
    )
	);

	$wp_customize->add_setting(
	'consultup_header_fb_target',array(
	'sanitize_callback' => 'consultup_header_sanitize_checkbox',
	'default' => 1,
	));

	$wp_customize->add_control(
    'consultup_header_fb_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','consultup'),
        'section' => 'header_social_icon',
    )
	);
	
	
	//Social Twitter link
	$wp_customize->add_setting(
    'consultup_header_twt_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'consultup_header_twt_link',
    array(
        'label' => __('Twitter URL','consultup'),
        'section' => 'header_social_icon',
        'type' => 'url',
    )
	);

	$wp_customize->add_setting(
	'consultup_header_twt_target',array(
	'sanitize_callback' => 'consultup_header_sanitize_checkbox',
	'default' => 1,
	));

	$wp_customize->add_control(
    'consultup_header_twt_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','consultup'),
        'section' => 'header_social_icon',
    )
	);
	
	//Soical Linkedin link
	$wp_customize->add_setting(
    'consultup_header_lnkd_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'consultup_header_lnkd_link',
    array(
        'label' => __('Linkedin URL','consultup'),
        'section' => 'header_social_icon',
        'type' => 'url',
    )
	);

	$wp_customize->add_setting(
	'consultup_twitter_lnkd_target',array(
	'default' => 1,
	'sanitize_callback' => 'consultup_header_sanitize_checkbox',
	));

	$wp_customize->add_control(
    'consultup_twitter_lnkd_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','consultup'),
        'section' => 'header_social_icon',
    )
	);
	
	
	//Soical Instagram link
	$wp_customize->add_setting(
    'consultup_header_insta_link',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'consultup_header_insta_link',
    array(
        'label' => __('Instagram URL','consultup'),
        'section' => 'header_social_icon',
        'type' => 'url',
    )
	);

	$wp_customize->add_setting(
	'consultup_insta_lnkd_target',array(
	'default' => 1,
	'sanitize_callback' => 'consultup_header_sanitize_checkbox',
	));

	$wp_customize->add_control(
    'consultup_insta_lnkd_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','consultup'),
        'section' => 'header_social_icon',
    )
	);
	
	$wp_customize->add_section( 'header_widget_one' , array(
		'title' => __('Header Widget One Setting', 'consultup'),
		'panel' => 'header_options',
		'priority'    => 600,
   	) );

   	$wp_customize->add_setting(
    	'consultup_header_widget_one_icon', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'consultup_header_widget_one_icon', array(
        'label' => __('Icon','consultup'),
        'section' => 'header_widget_one',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'consultup_header_widget_one_title', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'consultup_header_widget_one_title',array(
        'label'   => __('Title','consultup'),
        'section' => 'header_widget_one',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'consultup_header_widget_one_description', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'consultup_header_widget_one_description', array(
        'label' => __('Description','consultup'),
        'section' => 'header_widget_one',
        'type' => 'text',
    ) );

    // add Header widget Two Setting
    
    $wp_customize->add_section( 'header_widget_two' , array(
		'title' => __('Header Widget Two Setting', 'consultup'),
		'panel' => 'header_options',
		'priority'    => 620,
   	) );

   	$wp_customize->add_setting(
    	'consultup_header_widget_two_icon', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'consultup_header_widget_two_icon', array(
        'label' => __('Icon','consultup'),
        'section' => 'header_widget_two',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'consultup_header_widget_two_title', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'consultup_header_widget_two_title',array(
        'label'   => __('Title','consultup'),
        'section' => 'header_widget_two',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'consultup_header_widget_two_description', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'consultup_header_widget_two_description', array(
        'label' => __('Description','consultup'),
        'section' => 'header_widget_two',
        'type' => 'text',
    ) );

    // add Header widget Three Setting
    $wp_customize->add_section( 'header_widget_three' , array(
		'title' => __('Header Widget Three Setting', 'consultup'),
		'panel' => 'header_options',
		'priority'    => 620,
   	) );


    $wp_customize->add_setting(
        'consultup_header_widget_four_label', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'consultup_header_widget_four_label', array(
        'label' => __('Button Text','consultup'),
        'section' => 'header_widget_three',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'consultup_header_widget_four_link', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );  
    $wp_customize->add_control( 
        'consultup_header_widget_four_link',array(
        'label'   => __('Button Link','consultup'),
        'section' => 'header_widget_three',
        'type' => 'url',
    ) );

    $wp_customize->add_setting(
        'consultup_header_widget_four_target', array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultup_header_sanitize_checkbox',
    ) );  
    $wp_customize->add_control( 
        'consultup_header_widget_four_target', array(
        'label' => __('Open link in a new tab','consultup'),
        'section' => 'header_widget_three',
        'type' => 'checkbox',
    ) );
	

	
	function consultup_header_info_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

    }
	
	if ( ! function_exists( 'consultup_sanitize_text_content' ) ) :

	/**
	 * Sanitize text content.
	 *
	 * @since 1.0.0
	 *
	 * @param string               $input Content to be sanitized.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return string Sanitized content.
	 */
	function consultup_sanitize_text_content( $input, $setting ) {

		return ( stripslashes( wp_filter_post_kses( addslashes( $input ) ) ) );

	}
endif;
	
	function consultup_header_sanitize_checkbox( $input ) {
			// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
	
	}
	}
	add_action( 'customize_register', 'consultup_header_setting' );