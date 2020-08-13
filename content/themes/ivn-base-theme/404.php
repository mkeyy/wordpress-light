<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package IVN Base Theme
 */
?>
<?php get_header(); ?>

<section class="ivn-section ivn-section--404">
    <h1 class="ivn-h1"><?php _e('404', 'ivn-theme'); ?></h1>
    <h2 class="ivn-h2"><?php _e('Oops! Nie mogliśmy znaleźć tej strony.', 'ivn-theme'); ?></h2>

    <div class="ivn-block ivn-block--content">
        <p class="ivn-paragraph"><?php _e('Wygląda na to że nic tu nie ma.', 'ivn-theme'); ?></p>
    </div>
</section>

<?php get_footer(); ?>
