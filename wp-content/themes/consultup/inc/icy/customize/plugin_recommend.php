<?php
/* Notify in customizer */
require get_template_directory() . '/inc/icy/customizer-notify/consultup-customizer-notify.php';

$config_customizer = array(
	'recommended_plugins'       => array(
		'icyclub' => array(
			'recommended' => true,
			'description' => sprintf('Activate by installing <strong>ICYCLUB</strong> plugin to use front page and all theme features %s.', 'consultup'),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'consultup' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'consultup' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'consultup' ),
	'activate_button_label'     => esc_html__( 'Activate', 'consultup' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'consultup' ),
);
Consultup_Customizer_Notify::init( apply_filters( 'consultup_customizer_notify_array', $config_customizer ) );