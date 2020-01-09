<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'navolio-light' ) );

class Navolio_Light_Backend_Master {

    /**
     * Call all loading functions for the theme. They will be started right after theme setup.
     * 
     * @since v1.0
     */
    public function __construct() { 
        // Run after instalation setup.
        $this->theme_setup();

        // Register actions using add_actions() custom function.
        $this->add_actions();
    }

    /**
     * Initial theme setup
     * 
     * Loading scripts and stylesheets. Register custom elements
     * and functionality in the theme.
     * 
     * @uses get_template_directory_uri()
     * @uses add_theme_support()
     * @since v1.0
     */
    public function theme_setup() {

        // Add after_setup_theme() for specific functions.
        // The action call is here, because it fits more just for the theme
        // setup, instead for all other actions during using of Subtle.
        add_action( 'after_setup_theme', array( $this, 'theme_setup_core' ) );

    }

    /**
     * The core functionality that has to be registred after the theme is setted up
     * 
     * @since v1.0
     */
    public function theme_setup_core() {
        get_template_part('inc/classes/backend/partials/action_after_setup_theme');
    }

    /**
     * Add actions and filters in wordpress theme. All the actions will be here.
     * 
     * @uses add_action()
     * @uses add_filter()
     * @since v1.0
     */
    public function add_actions() {
        // Register our Widgets
        add_action( 'widgets_init', array( $this, 'widgets_init' ) );
    }

    /**
    * Loading scripts and stylesheets for Innocence
    * The order of initialising bootstrap css files is important
    * for the theme responsivness work proerly.
    * 
    * @uses admin_enqueue_style()
    * @since v1.0
    */
    public function widgets_init() {
        get_template_part('inc/classes/backend/partials/action_widgets_init');
    }

}

new Navolio_Light_Backend_Master; 
