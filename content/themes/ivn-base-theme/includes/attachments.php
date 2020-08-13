<?php
/**
 * ...
 *
 * @package IVN Base Theme
 * @since   1.0
 */
?>
<?php

/**
 * @since  1.0
 * @link   http://codex.wordpress.org/Function_Reference/add_action
 * @link   http://codex.wordpress.org/Function_Reference/add_filter
 *
 * @return void
 */
function ivn_attachments_setup() {
	/**
	 * Product Attachments
	 */
	add_action( 'attachments_register', 'ivn_product_attachments' );
	//add_filter( 'attachments_get_product_attachments', 'ivn_product_attachments_modify' );
	//add_filter( 'attachments_location_product_attachments', 'ivn_product_attachments_visibility', 10, 2 );
}

add_action( 'after_setup_theme', 'ivn_attachments_setup' );

/**
 * @param  Attachments $oAttachments
 *
 * @return void
 */
function ivn_product_attachments( $oAttachments ) {
	$aAttachmentFields = array(
		array(
			'name'    => 'title',                            // unique field name
			'type'    => 'text',                            // registered field type
			'label'   => __( 'Title', 'attachments' ),        // label to display
			'default' => 'title',                            // default value upon selection
		),
		array(
			'name'    => 'caption',                        // unique field name
			'type'    => 'textarea',                        // registered field type
			'label'   => __( 'Caption', 'attachments' ),    // label to display
			'default' => 'caption',                        // default value upon selection
		),
		array(
			'name'  => 'option',                            // unique field name
			'type'  => 'select',                            // registered field type
			'label' => __( 'Option', 'attachments' ),       // label to display
			'meta'  => array(                               // field-specific meta as defined by field class
				'allow_null' => true,                        // allow null value? (adds 'empty' <option>)
				'multiple'   => true,                        // multiple <select>?
				'options'    => array(                    // the <option>s to use
					'1' => 'Option 1',
					'2' => 'Option 2',
				),
			),
		),
		array(
			'name'    => 'description',                       // unique field name
			'type'    => 'wysiwyg',                           // registered field type
			'label'   => __( 'Description', 'attachments' ),  // label to display
			'default' => 'description',                       // default value upon selection
		),
	);

	$aAttachmentArguments = array(
		// Title of the meta box (string)
		'label'       => __( 'My Attachments', 'ivn-theme' ),

		// All post types to utilize (string|array)
		'post_type'   => array( 'product' ),

		// Meta box position (string) (normal, side or advanced)
		'position'    => 'normal',

		// Meta box priority (string) (high, default, low, core)
		'priority'    => 'high',

		// Allowed file type(s) (array) (image|video|text|audio|application), null - no filetype limit
		'filetype'    => array( 'image' ),

		// Include a note within the meta box (string)
		'note'        => __( 'Attach files here!', 'ivn-theme' ),

		// By default new Attachments will be appended to the list but you can have then prepend if you set this to false
		'append'      => true,

		// Text for 'Attach' button in meta box (string)
		'button_text' => __( 'Attach Files', 'ivn-theme' ),

		// Text for modal 'Attach' button (string)
		'modal_text'  => __( 'Attach', 'ivn-theme' ),

		// Which tab should be the default in the modal (string) (browse|upload)
		'router'      => 'browse',

		// Fields array
		'fields'      => $aAttachmentFields,
	);

	$oAttachments->register( 'product_attachments', $aAttachmentArguments );
}

/**
 * @param  array $aAttachments
 *
 * @return array
 */
function ivn_product_attachments_modify( $aAttachments ) {
	shuffle( $aAttachments );

	return $aAttachments;
}

/**
 * [ivn_product_attachments_visibility description]
 *
 * @param  [type] $bShowAttachments [description]
 * @param  [type] $sInstanceName    [description]
 *
 * @return [type]                   [description]
 */
function ivn_product_attachments_visibility( $bShowAttachments, $sInstanceName ) {
	global $post;

	if ( intval( get_post_meta( $post->ID, 'product_special_offer', true ) ) === 0 ) {
		$bShowAttachments = false;
	}

	return $bShowAttachments;
}