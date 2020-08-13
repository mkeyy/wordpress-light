<?php
add_action( 'cmb2_admin_init', 'ivn_metaboxes' );

/**
 * Define the metabox and field configurations.
 */
function ivn_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'ivn_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'test_metabox',
		'title'         => __( 'Test Metabox', 'cmb2' ),
		'object_types'  => array( 'product', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	// Regular text field
	$cmb->add_field( array(
		'name'       => __( 'Test Text', 'cmb2' ),
		'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'text',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	// URL text field
	$cmb->add_field( array(
		'name' => __( 'Website URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'url',
		'type' => 'text_url',
		// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
		// 'repeatable' => true,
	) );

	// Email text field
	$cmb->add_field( array(
		'name' => __( 'Test Text Email', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'email',
		'type' => 'text_email',
		// 'repeatable' => true,
	) );

	// Textarea
	$cmb->add_field( array(
		'name' => 'Test Text Area',
		'desc' => 'field description (optional)',
		'default' => 'standard value (optional)',
		'id' => 'wiki_test_textarea',
		'type' => 'textarea'
	) );

	// Date field
	$cmb->add_field( array(
		'name' => 'Test Date Picker (UNIX timestamp)',
		'id'   => 'wiki_test_textdate_timestamp',
		'type' => 'text_date_timestamp',
		// 'timezone_meta_key' => 'wiki_test_timezone',
		// 'date_format' => 'l jS \of F Y',
	) );

	// Colorpicker
	$cmb->add_field( array(
		'name'    => 'Test Color Picker',
		'id'      => 'wiki_test_colorpicker',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

	// Checkbox
	$cmb->add_field( array(
		'name' => 'Test Checkbox',
		'desc' => 'field description (optional)',
		'id'   => 'wiki_test_checkbox',
		'type' => 'checkbox'
	) );

	// Multicheck
	$cmb->add_field( array(
		'name'    => 'Test Multi Checkbox',
		'desc'    => 'field description (optional)',
		'id'      => 'wiki_test_multicheckbox',
		'type'    => 'multicheck',
		'options' => array(
			'check1' => 'Check One',
			'check2' => 'Check Two',
			'check3' => 'Check Three',
		)
	) );

	// Radio
	$cmb->add_field( array(
		'name'             => 'Test Radio',
		'id'               => 'wiki_test_radio',
		'type'             => 'radio',
		'show_option_none' => true,
		'options'          => array(
			'standard' => __( 'Option One', 'cmb2' ),
			'custom'   => __( 'Option Two', 'cmb2' ),
			'none'     => __( 'Option Three', 'cmb2' ),
		),
	) );

	// Select
	$cmb->add_field( array(
		'name'             => 'Test Select',
		'desc'             => 'Select an option',
		'id'               => 'wiki_test_select',
		'type'             => 'select',
		'show_option_none' => true,
		'default'          => 'custom',
		'options'          => array(
			'standard' => __( 'Option One', 'cmb2' ),
			'custom'   => __( 'Option Two', 'cmb2' ),
			'none'     => __( 'Option Three', 'cmb2' ),
		),
	) );

	// Add other metaboxes as needed

}