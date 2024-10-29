<?php

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

/**
 *
 * CSFramework Config
 *
 * @since 1.0
 * @version 1.0
 *
 */


/*Framework Settings
====================================*/
function maintenance_options_settings( $settings ) {
	$settings = array(
		'menu_title'      => __( 'Maintenance', 'maintenance-mode-free' ),
		'menu_type'       => 'menu',
		'menu_slug'       => 'maintenance-options',
		'ajax_save'       => true,
		'show_reset_all'  => false,
		'framework_title' => '<img src="' . MAINTENANCE_URL . 'templates/assets/images/logo.png' . '" alt="Maintenance" 
		title="Maintenance"> <medium>by 
		</medium><a href="https://shapedplugin.com" target="_blank"><img src="' . MAINTENANCE_URL .
		                     'admin/inc/images/shaped-logo.png' . '" alt="ShapedPlugin" 
		title="ShapedPlugin"></a>',
	);

	return $settings;
}

add_filter( 'cs_framework_settings', 'maintenance_options_settings' );


/* framework options filter
======================================*/
function maintenance_cs_framework_options( $options ) {

	$options = array(); // remove old options

// ----------------------------------------
// a option section for Main Settings  -
// ----------------------------------------
	$options[] = array(
		'name'   => 'maintenance_main_setting_area',
		'title'  => __( 'Main Settings', 'maintenance-mode-free' ),
		'icon'   => 'fa fa-wrench',

		// begin: fields
		'fields' => array(

			// My fields
			array(
				'id'      => 'maintenance_main_setting',
				'type'    => 'select',
				'title'   => __( 'Plugin Mode', 'maintenance-mode-free' ),
				'desc'    => __( 'Select plugin mode Maintenance Mode to activate the plugin and Off to deactivate.', 'maintenance-mode-free' ),
				'options' => array(
					'off'     => 'Off',
					'enabled' => 'Maintenance Mode',
				),
				'default' => 'off',
			),


			array(
				'id'         => 'maintenance_site_title',
				'type'       => 'text',
				'title'      => 'Meta Title*',
				'desc'       => __( 'Used as the Site Title and window/tab title', 'maintenance-mode-free' ),
				'after'      => __( '<p class="cs-text-info">Type the text to the meta title</p> ', 'maintenance-mode-free' ),
				'default'    => 'Maintenance - Coming Soon Plugin',
				'dependency' => array( 'maintenance_main_setting', '==', 'enabled' ) // dependency rule
			),

			array(
				'id'         => 'maintenance_favicon',
				'type'       => 'image',
				'title'      => __( 'Favicon Image', 'maintenance-mode-free' ),
				'desc'       => __( 'Upload favicon image,width and height 16px X 16px or 32px X 32px', 'maintenance-mode-free' ),
				'after'      => __( '<p>Image format must be one of PNG, GIF and ICO.</p>', 'maintenance-mode-free' ),
				'dependency' => array( 'maintenance_main_setting', '==', 'enabled' ) // dependency rule
			),


		), // end: fields
	);

// ----------------------------------------
// A section for template content  -
// ----------------------------------------
	$options[] = array(
		'name'   => 'maintenance_template_content_area',
		'title'  => __( 'Template Content', 'maintenance-mode-free' ),
		'icon'   => 'fa fa-pencil-square-o',

		// begin: fields
		'fields' => array(

			// Logo
			array(
				'id'         => 'maintenance_logo',
				'type'       => 'image',
				'title'      => __( 'Main Logo', 'maintenance-mode-free' ),
				'desc'       => __( 'Upload your site logo', 'maintenance-mode-free' ),
				'dependency' => array( 'maintenance_main_setting', '==', 'enabled' ) // dependency rule
			),


			// Title
			array(
				'id'         => 'maintenance_template_title',
				'type'       => 'text',
				'title'      => __( 'Template Title', 'maintenance-mode-free' ),
				'desc'       => __( 'Used as the main title of the coming-soon page', 'maintenance-mode-free' ),
				'default'    => 'NEW WEBSITE IS COMING SOON',
				'dependency' => array( 'maintenance_main_setting', '==', 'enabled' ) // dependency rule
			),

			// Content
			array(
				'id'         => 'maintenance_template_content',
				'type'       => 'textarea',
				'title'      => __( 'Template Content', 'maintenance-mode-free' ),
				'desc'       => __( 'Used as the main content of the coming-soon page', 'maintenance-mode-free' ),
				'default'    => 'Thanks for stopping by. I\'m working hard on creating a new website featuring an extended portfolio, list of services, design templates and more. Keep up to date by joining my mailing list or follow me on my social networking sites. Lorem ipsum dolor sit amet, consetetur',
				'dependency' => array( 'maintenance_main_setting', '==', 'enabled' ) // dependency rule
			),

			// Countdown
			array(
				'id'         => 'maintenance_countdown_heading',
				'type'       => 'heading',
				'content'    => __( 'Countdown Date Settings', 'maintenance-mode-free' ),
				'dependency' => array( 'maintenance_main_setting', '==', 'enabled' ) // dependency rule
			),
			array(
				'id'         => 'maintenance_countdown_date',
				'type'       => 'text',
				'title'      => __( 'Countdown Date', 'maintenance-mode-free' ),
				'attributes' => array(
					'placeholder' => 'Y-m-d'
				),
				'default'    => '2018-9-15',
				'class'      => 'maintenance_date',
				'after'      => '<p class="cs-text-info">Year-Month-Day.</p> ',
				/*dependency rule*/
			),
			array(
				'id'         => 'maintenance_countdown_time',
				'type'       => 'text',
				'title'      => __( 'Countdown Time', 'maintenance-mode-free' ),
				'attributes' => array(
					'placeholder' => 'H:M:S'
				),
				'default'    => '12:00:00',
				'after'      => '<p class="cs-text-info">Hour:Minute:Second.</p> ',
				/*dependency rule*/
			),


			// Footer
			array(
				'id'         => 'maintenance_footer_heading',
				'type'       => 'heading',
				'content'    => __( 'Footer', 'maintenance-mode-free' ),
				'dependency' => array( 'maintenance_main_setting', '==', 'enabled' ) // dependency rule
			),

			array(
				'id'         => 'maintenance_footer_text',
				'type'       => 'wysiwyg',
				'sanitize'   => true,
				'title'      => __( 'Footer Copyright Text', 'maintenance-mode-free' ),
				'settings'   => array(
					'textarea_rows' => 5,
					'media_buttons' => false,
				),
				'default'    => '<p>&copy; 2016 - Maintenance by <a href="https://shapedplugin.com"> ShapedPlugin</a></p>',
				'after'      => __( 'Write Copyright Text within p tag for the best look', 'maintenance-mode-free' ),
				'dependency' => array( 'maintenance_main_setting', '==', 'enabled' ),
				// dependency rule
			),

		), // end: fields
	);

// ----------------------------------------
// Background and style settings  -
// ----------------------------------------

	$options[] = array(
		'name'   => 'maintenance_style_settings',
		'title'  => __( 'Stylization', 'maintenance-mode-free' ),
		'icon'   => 'fa fa-paint-brush',
		'fields' => array(

			// Image Background
			array(
				'id'         => 'maintenance_home_image_background',
				'type'       => 'image',
				'title'      => __( 'Set Background Image', 'maintenance-mode-free' ),
				'add_title'  => __( 'Add Image', 'maintenance-mode-free' ),
				'dependency' => array( 'maintenance_main_setting', '==', 'enabled' ) // dependency rule
			),


		)
	);


	return $options;

}

add_filter( 'cs_framework_options', 'maintenance_cs_framework_options' );