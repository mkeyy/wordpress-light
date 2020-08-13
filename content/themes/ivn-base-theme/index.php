<?php
/**
 * The main template file.
 *
 * @package IVN Base Theme
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <section class="ivn-section ivn-section--page">
        <?php while (have_posts()) : the_post(); ?>
            <div class="ivn-block ivn-block--content">
                <p class="ivn-paragraph"><?= get_the_content(); ?></p>
            </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
