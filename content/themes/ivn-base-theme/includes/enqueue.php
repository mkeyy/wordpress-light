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
 * @link   http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 *
 * @global WP_Styles $wp_styles
 *
 * @return void
 */
function ivn_front_end_css() {
	global $wp_styles;

	//wp_enqueue_style( 'ivn-custom', IVN_CSS_URI . 'style-custom.css', array(), false );

	//wp_enqueue_style( 'ivn-style-ie7', IVN_CSS_URI . 'style-ie7.css', array(), array(), false );
	//$wp_styles->add_data( 'ivn-style-ie7', 'conditional', 'lte IE 7' );
}

/**
 * @since  1.0
 *
 * @global WP_POST $post
 *
 * @param  array   $classes
 *
 * @return array
 */
function ivn_front_end_body_classes( $classes ) {
	global $post;

	//$classes[] = 'custom-body-class';

	return $classes;
}

/**
 * @link   http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 *
 * @return void
 */
function ivn_front_end_js() {
	//wp_enqueue_script( 'ivn-custom', IVN_JS_URI . 'custom.js', array(), false, true );
}

/**
 * @link   http://codex.wordpress.org/Class_Reference/WP_Post
 * @link   http://codex.wordpress.org/Conditional_Tags
 *
 * @param  array $scriptSettings
 *
 * @return array
 */
function ivn_front_end_script_settings( $scriptSettings ) {
	global $post;

	return $scriptSettings;
}