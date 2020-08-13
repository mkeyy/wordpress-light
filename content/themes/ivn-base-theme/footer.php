<?php
/**
 * The template for displaying the footer.
 *
 * @package IVN Base Theme
 */
?>

<footer class="ivn-footer">
    <div class="ivn-footer--info">
        <a href="http://wordpress.org/"
           title="<?php esc_attr_e('A Semantic Personal Publishing Platform', 'ivn-theme'); ?>"
           rel="generator"><?php printf(__('Proudly powered by %s', 'ivn-theme'), 'WordPress'); ?></a>
        <span class="ivn-sep"> | </span>
        <?php printf(__('Theme: %1$s by %2$s.', 'ivn_theme'), 'IVN Base Theme', '<a href="http://www.ivision.pl/">Agencja Interaktywna ivision.pl</a>'); ?>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
