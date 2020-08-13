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
 * @link   http://codex.wordpress.org/Plugin_API/Action_Reference/wp_ajax_(action)
 * @link   http://codex.wordpress.org/AJAX_in_Plugins
 *
 * @return void
 */
function ivn_custom_ajax_setup() {
	add_filter( 'nonce_life', 'ivn_nonce_life' );
	add_filter( 'ivn_nonces_front_end', 'ivn_generate_ajax_nonces' );
	add_filter( 'ivn_nonces_back_end', 'ivn_generate_ajax_nonces' );

	add_action( 'wp_ajax_product_change', 'ivn_product_change_ajax' );
	add_action( 'wp_ajax_nopriv_product_change', 'ivn_product_change_ajax' );

	/**
	 * Executes for users that are logged in.
	 */
	//add_action( 'wp_ajax_{{ action name | slug }}', 'ivn_{{ action name | slug }}_ajax' );

	/**
	 * Executes for users that are not logged in.
	 */
	//add_action( 'wp_ajax_nopriv_{{ action name | slug }}', 'ivn_{{ action name | slug }}_ajax' );
}

add_action( 'after_setup_theme', 'ivn_custom_ajax_setup' );

/**
 * Applied to the lifespan of a nonce to generate or verify the nonce.
 * Can be used to generate nonces which expire earlier.
 * The value returned by the filter should be in seconds.
 *
 * @since  1.0
 *
 * @global WP_Post $post
 *
 * @return int
 */
function ivn_nonce_life() {
	global $post;

	/**
	 * WordPress predefined constants.
	 *
	 * MINUTE_IN_SECONDS
	 * HOUR_IN_SECONDS
	 * DAY_IN_SECONDS
	 * WEEK_IN_SECONDS
	 * YEAR_IN_SECONDS
	 */

	return DAY_IN_SECONDS / 6;
}

/**
 * @since  1.0
 * @link   http://codex.wordpress.org/Function_Reference/is_admin
 * @link   http://codex.wordpress.org/Function_Reference/wp_create_nonce
 *
 * @param  array $aNonces
 *
 * @return array
 */
function ivn_generate_ajax_nonces( $aNonces ) {
	if ( is_admin() ) {
		/**
		 * Back-End Nonces
		 */
	} else {
		/**
		 * Front-End Nonces
		 */
	}

	/**
	 * Back-End & Front-End Nonces
	 */
	$aNonces['ProductChange'] = wp_create_nonce( 'product-change' );

	return $aNonces;
}

/**
 * @link   http://codex.wordpress.org/Function_Reference/wp_send_json
 * @link   http://codex.wordpress.org/Function_Reference/check_ajax_referer
 *
 * @return void
 */
function ivn_product_change_ajax() {
	if ( !check_ajax_referer( 'product-change', 'AjaxNonce', false ) ) {
		wp_send_json( array(
			'Success' => false,
		) );
	}

	/**
	 * Custom code here...
	 */
	/*
	wp_send_json( array(
		'Success' => true,
	) );
	*/
}