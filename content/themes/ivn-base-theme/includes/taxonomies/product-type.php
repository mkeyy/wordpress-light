<?php
/**
 * Product Type - Taxonomy
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
function ivn_product_type_taxonomy_setup() {
    add_action( 'init', 'ivn_product_type_taxonomy' );

    add_filter( 'manage_edit-product_type_columns', 'ivn_product_type_taxonomy_columns' );
    add_filter( 'manage_product_type_custom_column', 'ivn_product_type_taxonomy_columns_content', 10, 3 );

    add_action( 'product_type_add_form_fields', 'ivn_product_type_taxonomy_metabox_add' );
    add_action( 'product_type_edit_form_fields', 'ivn_product_type_taxonomy_metabox_edit', 10, 2 );

    add_action( 'created_product_type', 'ivn_product_type_taxonomy_save_meta_data' );
    add_action( 'edited_product_type', 'ivn_product_type_taxonomy_save_meta_data' );
}

add_action( 'after_setup_theme', 'ivn_product_type_taxonomy_setup', 11 );

/**
 * @link   http://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @return void
 */
function ivn_product_type_taxonomy() {
    $aTaxonomyLabels = array(
        'name'                          => _x( 'Types', 'Taxonomy General Name', 'ivn-theme' ),
        'singular_name'                 => _x( 'Type', 'Taxonomy Singular Name', 'ivn-theme' ),
        'menu_name'                     => __( 'Type', 'ivn-theme' ),
        'all_items'                     => __( 'All Types', 'ivn-theme' ),
        'parent_item'                   => __( 'Parent Type', 'ivn-theme' ),
        'parent_item_colon'             => __( 'Parent Type:', 'ivn-theme' ),
        'new_item_name'                 => __( 'New Type Name', 'ivn-theme' ),
        'add_new_item'                  => __( 'Add New Type', 'ivn-theme' ),
        'edit_item'                     => __( 'Edit Type', 'ivn-theme' ),
        'update_item'                   => __( 'Update Type', 'ivn-theme' ),
        'separate_items_with_commas'    => __( 'Separate types with commas', 'ivn-theme' ),
        'search_items'                  => __( 'Search types', 'ivn-theme' ),
        'add_or_remove_items'           => __( 'Add or remove types', 'ivn-theme' ),
        'choose_from_most_used'         => __( 'Choose from the most used types', 'ivn-theme' ),
    );

    $aTaxonomyArguments = array(
        'labels'                => $aTaxonomyLabels,
        'public'                => true,
        'show_ui'               => true,
        'hierarchical'          => true,
        'show_tagcloud'         => true,
        'show_in_nav_menus'     => true,
        'show_admin_column'     => true,
        'show_in_filter_area'   => true,
        'rewrite'               => array(
            'slug'          => 'product-type-category',
            'with_front'    => false,
            'hierarchical'  => true,
        ),
    );

    register_taxonomy( 'product_type', array( 'product' ), $aTaxonomyArguments );
}

/**
 * @param  array $aColumns
 *
 * @return array
 */
function ivn_product_type_taxonomy_columns( $aColumns ) {
    /**
     * Modify columns here...
     */
    //$aColumns[ 'column_name' ] = __( 'Column Name', 'ivn-theme' );

    return $aColumns;
}

/**
 * @param  string $sRowContent
 * @param  string $sColumn
 * @param  integer $iTermID
 *
 * @return void
 */
function ivn_product_type_taxonomy_columns_content( $sRowContent = '', $sColumn, $iTermID ) {
    /*
    switch ( $sColumn ) {
        case 'column_name':
            echo "Column Content";
            break;
    }
    */
}

/**
 * @param  string $sTaxonomyName
 *
 * @return void
 */
function ivn_product_type_taxonomy_metabox_add( $sTaxonomyName ) {
    ?>
    <div class="form-field form-required">
        <label for="product-type-name-short"><?php _e( 'Name Short', 'ivn-theme' ); ?></label>
        <input name="product_type_name_short" id="product-type-name-short" type="text" value="" aria-required="true" />
        <p>...</p>
    </div>
    <?php
}

/**
 * @param  object $oTermObj
 * @param  string $sTaxonomyName
 *
 * @return void
 */
function ivn_product_type_taxonomy_metabox_edit( $oTermObj, $sTaxonomyName ) {
    ?>
    <tr class="form-field form-required">
        <th scope="row" valign="top">
            <label for="product-type-name-short"><?php _e( 'Name Short', 'ivn-theme' ); ?></label>
        </th>
        <td>
            <input name="product_type_name_short" id="product-type-name-short" type="text" value="<?php echo ivn_get_term_meta( $oTagObj->term_id, 'product_type_name_short', '' ); ?>" aria-required="true" />
            <p class="description">...</p>
        </td>
    </tr>
    <?php
}

/**
 * @param  integer $iTermID
 *
 * @return void
 */
function ivn_product_type_taxonomy_save_meta_data( $iTermID ) {
    //ivn_set_term_meta( $iTermID, 'product_type_name_short', $_POST[ 'product_type_name_short' ], false );
}

?>
