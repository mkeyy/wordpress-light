<?php
/**
 * The Template for displaying all single posts.
 *
 * @package IVN Base Theme
 */
?>
<?php get_header(); ?>

<section class="ivn-section ivn-section--single">
    <h1 class="ivn-h1"><?php _e(get_the_title(), 'ivn-theme'); ?></h1>

    <?php while (have_posts()) : the_post(); ?>
        <?php if (get_the_content()): ?>
            <div class="ivn-block ivn-block--content">
                <p class="ivn-paragraph"><?= get_the_content(); ?></p>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
</section>

<?php get_footer(); ?>
