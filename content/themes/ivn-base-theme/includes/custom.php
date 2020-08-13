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
 * Files to include
 */

$IVN_CustomIncludes = array(
	/**
	 * Meta Boxes
	 */
	'meta-boxes/product-informations-cmb.php',

	/**
	 * Custom Post Types
	 */
	'post-types/product.php',

	/**
	 * Taxonomies
	 */
	'taxonomies/product-type.php',

	/**
	 * Other Files
	 */

	'admin.php',
	'ajax.php',
	'attachments.php',
	'enqueue.php',
	'media.php',
	'widgets.php',
);

foreach ( $IVN_CustomIncludes as $IVN_CustomInclude ) {
	require( IVN_INC_DIR . $IVN_CustomInclude );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0
 *
 * @return void
 */
function ivn_theme_setup() {
	/**
	 * Main Query Hooks
	 */
	add_action( 'pre_get_posts', 'ivn_main_query_front_end_filter' );
	add_action( 'pre_get_posts', 'ivn_main_query_back_end_filter' );

	/**
	 * Media
	 */
	add_action( 'init', 'ivn_default_image_sizes' );
	add_action( 'init', 'ivn_image_sizes' );

	/**
	 * Enqueue CSS
	 */
	add_action( 'ivn_front_end_styles', 'ivn_front_end_css' );
	add_filter( 'body_class', 'ivn_front_end_body_classes' );

	add_action( 'ivn_back_end_styles', 'ivn_back_end_css' );
	add_filter( 'admin_body_class', 'ivn_back_end_body_classes' );


	/**
	 * Enqueue JavaScript
	 */
	add_action( 'ivn_front_end_scripts', 'ivn_front_end_js' );
	add_action( 'ivn_localize_front_end_script', 'ivn_front_end_script_settings' );

	add_action( 'ivn_back_end_scripts', 'ivn_back_end_js' );
	add_action( 'ivn_localize_back_end_script', 'ivn_back_end_script_settings' );

	/**
	 * Custom Menus
	 */
	add_action( 'init', 'ivn_register_menus' );

	/**
	 * Sidebars & Widgets
	 */
	add_action( 'widgets_init', 'ivn_register_sidebars' );

	/**
	 * Template Include
	 */
	add_filter( 'template_include', 'ivn_custom_template_include', 9 );

	/**
	 * Admin Menu
	 */
	add_action( 'admin_menu', 'ivn_admin_menu' );

    /**
     * Theme Archive Title
     */
    add_filter( 'get_the_archive_title', 'ivn_theme_archive_title' );

	/**
	 * Disable Emoji's
	 */
	add_filter( 'tiny_mce_plugins', function ( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	} );

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

add_action( 'after_setup_theme', 'ivn_theme_setup' );

/**
 * @since  1.0
 * @link   http://codex.wordpress.org/Function_Reference/is_admin
 * @link   http://codex.wordpress.org/Class_Reference/WP_Query
 * @link   http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 *
 * @param  WP_Query $oQuery
 *
 * @return void
 */
function ivn_main_query_front_end_filter( $oQuery ) {
	if ( is_admin() || !$oQuery->is_main_query() ) {
		return;
	}

	/**
	 * Modify Main Query here...
	 * Use 'var_dump( $oQuery )' to get more info.
	 */

	/*
	if ( $oQuery->is_post_type_archive && $oQuery->query_vars[ 'post_type' ] === 'product' ) {
		$oQuery->set( 'orderby', 'rand' );
	}
	*/
}

/**
 * @since  1.0
 * @link   http://codex.wordpress.org/Function_Reference/is_admin
 * @link   http://codex.wordpress.org/Class_Reference/WP_Query
 * @link   http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 *
 * @param  WP_Query $oQuery
 *
 * @return void
 */
function ivn_main_query_back_end_filter( $oQuery ) {
	if ( !is_admin() || !$oQuery->is_main_query() ) {
		return;
	}

	/**
	 * Modify Main Query here...
	 * Use 'var_dump( $oQuery )' to get more info.
	 */

	$aQueryVars = $oQuery->query_vars;

	if ( $aQueryVars['post_type'] === 'product' ) {
		if ( isset( $aQueryVars['orderby'] ) && $aQueryVars['orderby'] === 'column_name' ) {
			$oQuery->set( 'meta_key', 'column_name' );
			$oQuery->set( 'orderby', 'meta_value' ); // Alphabetically (meta_value_num for numeric)
		}

		if ( isset( $aQueryVars['order'] ) ) {
			$oQuery->set( 'order', strtoupper( $aQueryVars['order'] ) );
		}
	}
}

/**
 * @since  1.0
 * @link   http://codex.wordpress.org/Function_Reference/register_nav_menus
 *
 * @return void
 */
function ivn_register_menus() {
	register_nav_menus( array(
		'primary-menu'   => __( 'Primary Menu', 'ivn-theme' ),
		'secondary-menu' => __( 'Secondary Menu', 'ivn-theme' ),
	) );
}

/**
 * @since  1.0
 * @link   http://codex.wordpress.org/Function_Reference/register_sidebar
 *
 * @return void
 */
function ivn_register_sidebars() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'ivn-theme' ),
		'id'            => 'primary-sidebar',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}

/**
 * @since  1.0
 * @link   http://codex.wordpress.org/Function_Reference/locate_template
 *
 * @param  string $sTemplateName
 *
 * @return string
 */
function ivn_custom_template_include( $sTemplateName ) {
	if ( is_singular( 'product' ) ) {
		$oProductObj = get_queried_object();

		if ( intval( get_post_meta( $oProductObj->ID, 'product_special_offer', true ) ) !== 0 ) {
			return locate_template( array(
				'includes/views/single/single-product-special-offer.php',
			) );
		}
	}

	return $sTemplateName;
}

/**
 * @param $title
 * @return string|void
 */
function ivn_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = get_the_author();
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}