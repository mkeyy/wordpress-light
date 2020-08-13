<?php
/**
 * Template Name: Ivision
 */

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('tpl-ivision--css', IVN_CSS_URI . 'routes/tpl-ivision.css', array(), false);

    wp_enqueue_script('tpl-ivision--vendor', IVN_JS_URI . 'vendor/vendor.js' . '#async', array('jquery'), false, true);
    wp_enqueue_script('tpl-ivision--js', IVN_JS_URI . 'routes/tpl-ivn.js' . '#async', array('jquery', 'tpl-ivn--vendor'), false, true);
});

get_header();
?>

<section class="ivn-section ivn-section--template-ivision">
    <h1 class="ivn-h1">TEST</h1>
</section>

<?php get_footer(); ?>