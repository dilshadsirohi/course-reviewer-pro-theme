<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" role="banner">
    <div class="header-inner">
        <div class="site-branding">
            <?php if ( has_custom_logo() ) : ?>
                <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>
            <?php
            $hide_title = get_theme_mod( 'crp_hide_title_with_logo', 0 );
            if ( ! $hide_title || ! has_custom_logo() ) : ?>
            <div class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
            </div>
            <?php endif; ?>
        </div>

        <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'course-reviewer-pro' ); ?>">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">&#9776;</button>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => 'crp_fallback_menu',
            ) );
            ?>
        </nav>

        <div class="header-actions">
            <button class="search-toggle" aria-label="<?php esc_attr_e( 'Toggle Search', 'course-reviewer-pro' ); ?>">&#128269;</button>
            <div class="header-search">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</header>

<?php crp_breadcrumbs(); ?>
