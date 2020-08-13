<?php
/**
 * Product - Post Type
 *
 * @package IVN Base Theme
 */
?>
<?php

/**
 * @link   http://codex.wordpress.org/Function_Reference/add_action
 * @link   http://codex.wordpress.org/Function_Reference/add_filter
 *
 * @return void
 */
function ivn_product_post_type_setup() {
    add_action( 'init', 'ivn_product_post_type' );

    add_action( 'load-post-new.php', 'ivn_product_meta_boxes_load' );
    add_action( 'load-post.php', 'ivn_product_meta_boxes_load' );

    add_filter( 'manage_edit-product_columns' , 'ivn_product_columns' );
    add_filter( 'manage_edit-product_sortable_columns', 'ivn_product_sortable_columns' );
    add_action( 'manage_product_posts_custom_column', 'ivn_product_columns_content', 10, 2 );
}

add_action( 'after_setup_theme', 'ivn_product_post_type_setup', 11 );

/**
 * @link   http://codex.wordpress.org/Function_Reference/register_post_type
 * @link   http://codex.wordpress.org/Post_Types
 *
 * @return void
 */
function ivn_product_post_type() {
    $aPostTypeLabels = array(
        'name'                  => _x( 'Products', 'Post Type General Name', 'ivn-theme' ),
        'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'ivn-theme' ),
        'menu_name'             => __( 'Product', 'ivn-theme' ),
        'parent_item_colon'     => __( 'Parent Product:', 'ivn-theme' ),
        'all_items'             => __( 'All Products', 'ivn-theme' ),
        'view_item'             => __( 'View Product', 'ivn-theme' ),
        'add_new_item'          => __( 'Add New Product', 'ivn-theme' ),
        'add_new'               => __( 'New Product', 'ivn-theme' ),
        'edit_item'             => __( 'Edit Product', 'ivn-theme' ),
        'update_item'           => __( 'Update Product', 'ivn-theme' ),
        'search_items'          => __( 'Search products', 'ivn-theme' ),
        'not_found'             => __( 'No products found.', 'ivn-theme' ),
        'not_found_in_trash'    => __( 'No products found in Trash.', 'ivn-theme' ),
    );

    $aPostTypeArguments = array(
        'label'                 => __( 'Product', 'ivn-theme' ),
        'description'           => '',
        'labels'                => $aPostTypeLabels,
        'public'                => true,
        'publicly_queryable'    => true,
        'exclude_from_search'   => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'supports'              => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'trackbacks',
            'revisions',
            'custom-fields',
            'page-attributes',
            'post-formats',
        ),
        'taxonomies'            => array( ),
        'has_archive'           => true,
        'rewrite'               => array(
            'slug'          => 'product',
            'with_front'    => false,
        ),
        'can_export'            => true,
        'show_in_nav_menus'     => false,
    );

    register_post_type( 'product', $aPostTypeArguments );
}

/**
 * @link   http://codex.wordpress.org/Function_Reference/get_current_screen
 * @link   http://codex.wordpress.org/Function_Reference/add_action
 * @link   http://codex.wordpress.org/Function_Reference/add_filter
 *
 * @return void
 */
function ivn_product_meta_boxes_load() {
    if ( $oScreenObj = get_current_screen() ) {
        if ( $oScreenObj->post_type === 'product' ) {
            add_action( 'edit_form_after_title', 'ivn_product_after_title' );
            add_action( 'edit_form_after_editor', 'ivn_product_after_editor' );
            add_action( 'add_meta_boxes', 'ivn_product_meta_boxes', 10, 2 );
            add_action( 'save_post', 'ivn_product_meta_boxes_save', 10, 2 );
        }
    }
}

/**
 * @link   http://codex.wordpress.org/Class_Reference/WP_Post
 *
 * @param  WP_Post $oPostObj
 *
 * @return void
 */
function ivn_product_after_title( $oPostObj ) {
    /**
     * Custom code here...
     */
}

/**
 * @link   http://codex.wordpress.org/Class_Reference/WP_Post
 *
 * @param  WP_Post $oPostObj
 *
 * @return void
 */
function ivn_product_after_editor( $oPostObj ) {
    /**
     * Nonce field. Don't remove.
     */
    wp_nonce_field( $oPostObj->post_type . '_post_type', $oPostObj->post_type . '_post_nonce' );

    /**
     * Custom code here...
     */
}

/**
 * @link   http://codex.wordpress.org/Class_Reference/WP_Post
 * @link   http://codex.wordpress.org/Function_Reference/add_meta_box
 * @link   http://codex.wordpress.org/Function_Reference/remove_meta_box
 *
 * @param  string $sPostType
 * @param  WP_Post $oPostObj
 *
 * @return void
 */
function ivn_product_meta_boxes( $sPostType, $oPostObj ) {
//    add_meta_box( 'product_informations',
//        __( 'Informations', 'ivn-theme' ),
//        'ivn_product_informations_meta_box_html',
//        $sPostType,
//        'normal',
//        'high'
//    );
//    add_action( 'ivn_save_' . $sPostType . '_meta_boxes', 'ivn_product_informations_meta_box_save', 10, 2 );

    //remove_meta_box( 'product_informations', $sPostType, 'normal' );
}

/**
 * @link   http://codex.wordpress.org/Class_Reference/WP_Post
 * @link   http://codex.wordpress.org/Function_Reference/get_post_type_object
 * @link   http://codex.wordpress.org/Function_Reference/wp_verify_nonce
 * @link   http://codex.wordpress.org/Function_Reference/current_user_can
 *
 * @param  integer $iPostID
 * @param  WP_Post $oPostObj
 *
 * @return void|integer
 */
function ivn_product_meta_boxes_save( $iPostID, $oPostObj ) {
    global $post_type;

    $oPostTypeObj = get_post_type_object( $post_type );

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $iPostID;
    } elseif ( $post_type !== $oPostObj->post_type ) {
        return $iPostID;
    } elseif ( ( ! isset( $_POST[ $oPostObj->post_type . '_post_nonce' ] ) || ! wp_verify_nonce( $_POST[ $oPostObj->post_type . '_post_nonce' ], $oPostObj->post_type . '_post_type' ) ) ) {
        return $iPostID;
    } elseif ( ! current_user_can( $oPostTypeObj->cap->edit_post, $iPostID ) ) {
        return $iPostID;
    }

    do_action( 'ivn_save_' . $oPostObj->post_type . '_meta_boxes', $iPostID, $oPostObj );
}

/**
 * @param  array $aColumns
 *
 * @return array
 */
function ivn_product_columns( $aColumns ) {
    /**
     * Modify columns here...
     */
    $aColumns[ 'column_name' ] = __( 'Column Name', 'ivn-theme' );

    return $aColumns;
}

/**
 * @param  array $aColumns
 *
 * @return array
 */
function ivn_product_sortable_columns( $aColumns ) {
    /**
     * Modify columns here...
     */
    $aColumns[ 'column_name' ] = 'column_name';

    return $aColumns;
}

/**
 * @param  string $sColumn
 * @param  integer $iPostID
 *
 * @return void
 */
function ivn_product_columns_content( $sColumn, $iPostID ) {
    switch( $sColumn ) {
        case 'column_name' :
            echo "Column Content";
            break;
    }
}

?>
