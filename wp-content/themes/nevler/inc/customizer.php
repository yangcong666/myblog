<?php
/**
 * nevler Theme Customizer
 *
 * @package nevler
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nevler_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'nevler' ),
	    'priority'   => 30,
	) );
	
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override nevler_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('nevler_site_titlecolor', array(
	    'default'     => '#FFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'nevler_site_titlecolor', array(
			'label' => __('Site Title Color','nevler'),
			'section' => 'colors',
			'settings' => 'nevler_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('nevler_header_desccolor', array(
	    'default'     => '#FFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'nevler_header_desccolor', array(
			'label' => __('Site Tagline Color','nevler'),
			'section' => 'colors',
			'settings' => 'nevler_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'nevler_hide_title_tagline',
		array( 'sanitize_callback' => 'nevler_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nevler_hide_title_tagline', array(
		    'settings' => 'nevler_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'nevler' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'nevler_branding_below_logo',
		array( 'sanitize_callback' => 'nevler_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nevler_branding_below_logo', array(
		    'settings' => 'nevler_branding_below_logo',
		    'label'    => __( 'Display Site Title and Tagline Below the Logo.', 'nevler' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		    'active_callback' => 'nevler_title_visible'
		)
	);
	
	function nevler_title_visible( $control ) {
		$option = $control->manager->get_setting('nevler_hide_title_tagline');
	    return $option->value() == false ;
	}
	
	$wp_customize->add_setting(
		'nevler_center_logo',
		array( 
			'sanitize_callback' => 'nevler_sanitize_checkbox',
			'default' => true )
	);
	
	$wp_customize->add_control(
			'nevler_center_logo', array(
		    'settings' => 'nevler_center_logo',
		    'label'    => __( 'Center Align.', 'nevler' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);	

	
	// CREATE THE FCA PANEL
	$wp_customize->add_panel( 'nevler_fca_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Featured Content Areas','nevler'),
	    'description'    => '',
	) );
	
	
	//FEATURED AREA 1
	$wp_customize->add_section(
	    'nevler_fc_boxes',
	    array(
	        'title'     => __('Featured Area 1','nevler'),
	        'priority'  => 10,
	        'panel'     => 'nevler_fca_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'nevler_box_enable',
		array( 'sanitize_callback' => 'nevler_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nevler_box_enable', array(
		    'settings' => 'nevler_box_enable',
		    'label'    => __( 'Enable Featured Area 1.', 'nevler' ),
		    'section'  => 'nevler_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'nevler_box_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'nevler_box_title', array(
		    'settings' => 'nevler_box_title',
		    'label'    => __( 'Title for the Boxes','nevler' ),
		    'section'  => 'nevler_fc_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'nevler_box_cat',
	    array( 'sanitize_callback' => 'nevler_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new Nevler_WP_Customize_Category_Control(
	        $wp_customize,
	        'nevler_box_cat',
	        array(
	            'label'    => __('Category For Square Boxes.','nevler'),
	            'settings' => 'nevler_box_cat',
	            'section'  => 'nevler_fc_boxes'
	        )
	    )
	);
	
	
	// Layout and Design
	$wp_customize->add_panel( 'nevler_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','nevler'),
	) );
	
	$wp_customize->add_section(
	    'nevler_design_options',
	    array(
	        'title'     => __('Blog Layout','nevler'),
	        'priority'  => 0,
	        'panel'     => 'nevler_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'nevler_blog_layout',
		array( 'sanitize_callback' => 'nevler_sanitize_blog_layout' )
	);
	
	function nevler_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','nevler') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'nevler_blog_layout',array(
				'label' => __('Select Layout','nevler'),
				'settings' => 'nevler_blog_layout',
				'section'  => 'nevler_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Basic Blog Layout','nevler'),
						'nevler' => __('Nevler Default Layout','nevler'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'nevler_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','nevler'),
	        'priority'  => 0,
	        'panel'     => 'nevler_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'nevler_disable_sidebar',
		array( 'sanitize_callback' => 'nevler_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nevler_disable_sidebar', array(
		    'settings' => 'nevler_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','nevler' ),
		    'section'  => 'nevler_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'nevler_disable_sidebar_home',
		array( 'sanitize_callback' => 'nevler_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nevler_disable_sidebar_home', array(
		    'settings' => 'nevler_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','nevler' ),
		    'section'  => 'nevler_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'nevler_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'nevler_disable_sidebar_front',
		array( 'sanitize_callback' => 'nevler_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'nevler_disable_sidebar_front', array(
		    'settings' => 'nevler_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','nevler' ),
		    'section'  => 'nevler_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'nevler_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'nevler_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'nevler_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'nevler_sidebar_width', array(
		    'settings' => 'nevler_sidebar_width',
		    'label'    => __( 'Sidebar Width','nevler' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','nevler'),
		    'section'  => 'nevler_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'nevler_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function nevler_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('nevler_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	$wp_customize-> add_section(
    'nevler_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','nevler'),
    	'description'	=> __('Enter your Own Copyright Text.','nevler'),
    	'priority'		=> 11,
    	'panel'			=> 'nevler_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'nevler_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'nevler_footer_text',
	        array(
	            'section' => 'nevler_custom_footer',
	            'settings' => 'nevler_footer_text',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize->add_section(
	    'nevler_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','nevler'),
	        'priority'  => 41,
	    )
	);
	
	$font_array = array('Lato','Roboto Condensed','Open Sans','Oswald','Slabo','Lora');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'nevler_title_font',
		array(
			'default'=> 'Roboto Condensed',
			'sanitize_callback' => 'nevler_sanitize_gfont' 
			)
	);
	
	function nevler_sanitize_gfont( $input ) {
		if ( in_array($input, array('Lato','Roboto Condensed','Open Sans','Oswald','Slabo','Lora') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'nevler_title_font',array(
				'label' => __('Title','nevler'),
				'settings' => 'nevler_title_font',
				'section'  => 'nevler_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'nevler_body_font',
			array(	'default'=> 'Lato',
					'sanitize_callback' => 'nevler_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'nevler_body_font',array(
				'label' => __('Body','nevler'),
				'settings' => 'nevler_body_font',
				'section'  => 'nevler_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	// Social Icons
	$wp_customize->add_section('nevler_social_section', array(
			'title' => __('Social Icons','nevler'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','nevler'),
					'facebook' => __('Facebook','nevler'),
					'twitter' => __('Twitter','nevler'),
					'google-plus' => __('Google Plus','nevler'),
					'instagram' => __('Instagram','nevler'),
					'rss' => __('RSS Feeds','nevler'),
					'vine' => __('Vine','nevler'),
					'vimeo-square' => __('Vimeo','nevler'),
					'youtube' => __('Youtube','nevler'),
					'flickr' => __('Flickr','nevler'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'nevler_social_'.$x, array(
				'sanitize_callback' => 'nevler_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'nevler_social_'.$x, array(
					'settings' => 'nevler_social_'.$x,
					'label' => __('Icon ','nevler').$x,
					'section' => 'nevler_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'nevler_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'nevler_social_url'.$x, array(
					'settings' => 'nevler_social_url'.$x,
					'description' => __('Icon ','nevler').$x.__(' Url','nevler'),
					'section' => 'nevler_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function nevler_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function nevler_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function nevler_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function nevler_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
		
}
add_action( 'customize_register', 'nevler_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nevler_customize_preview_js() {
	wp_enqueue_script( 'nevler_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'nevler_customize_preview_js' );
