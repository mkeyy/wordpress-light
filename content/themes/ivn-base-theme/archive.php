<?php
/**
 * The template for displaying Archive pages.
 *
 * @package IVN Base Theme
 */
?>
<?php get_header(); ?>

<section class="ivn-section ivn-section--archive">
    <h1 class="ivn-h1"><?php _e('Archiwum: ' . get_the_archive_title(), 'ivn-theme'); ?></h1>

    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <article class="ivn-article ivn-article--<?= get_the_title(); ?>">
                <h2 class="ivn-h2">
                    <a href="<?= get_the_permalink(); ?>" title="<?= get_the_title(); ?>">
                        <?= get_the_title(); ?>
                    </a>
                </h2>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
