<?php
/**
 * The template for displaying the header.
 *
 * @package IVN Base Theme
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="ivn-header--site">
    <a href="<?php echo esc_url(home_url('/')); ?>"
       title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
       rel="home"><?php bloginfo('name'); ?></a>

    <nav class="ivn-navigation--primary">
        <?php

        wp_nav_menu(array(
            'theme_location' => 'primary-menu',
            'container' => false,
            'fallback_cb' => false,
        ));

        ?>
    </nav>
</header>
