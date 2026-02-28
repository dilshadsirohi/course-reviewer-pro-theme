<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <h3><?php bloginfo( 'name' ); ?></h3>
                <p><?php echo esc_html( get_theme_mod( 'crp_footer_about', 'We help learners find the best online courses through honest, in-depth reviews. Our team of experts evaluates each course to give you the most accurate information.' ) ); ?></p>
            </div>

            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                <div class="footer-links">
                    <h3><?php _e( 'Quick Links', 'course-reviewer-pro' ); ?></h3>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'depth'          => 1,
                    ) );
                    ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                <div class="footer-links">
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                <div class="footer-links">
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php
        $social_networks = array(
            'facebook'  => array( 'label' => 'Facebook',  'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>' ),
            'twitter'   => array( 'label' => 'Twitter/X', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>' ),
            'youtube'   => array( 'label' => 'YouTube',   'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58zM9.75 15.02V8.98L15.5 12l-5.75 3.02z"/></svg>' ),
            'instagram' => array( 'label' => 'Instagram', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>' ),
            'linkedin'  => array( 'label' => 'LinkedIn',  'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>' ),
        );
        $has_social = false;
        foreach ( $social_networks as $key => $data ) {
            if ( get_theme_mod( 'crp_social_' . $key ) ) { $has_social = true; break; }
        }
        if ( $has_social ) : ?>
        <div class="footer-social">
            <?php foreach ( $social_networks as $key => $data ) :
                $url = get_theme_mod( 'crp_social_' . $key );
                if ( ! $url ) continue; ?>
                <a href="<?php echo esc_url( $url ); ?>" class="social-link social-<?php echo esc_attr( $key ); ?>" aria-label="<?php echo esc_attr( $data['label'] ); ?>" target="_blank" rel="noopener noreferrer">
                    <?php echo $data['icon']; ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="footer-bottom">
            <p>
                <?php
                $copyright = get_theme_mod( 'crp_footer_copyright' );
                if ( $copyright ) {
                    echo esc_html( $copyright );
                } else {
                    printf(
                        __( '&copy; %1$s %2$s. All rights reserved.', 'course-reviewer-pro' ),
                        date( 'Y' ),
                        get_bloginfo( 'name' )
                    );
                }
                ?>
            </p>
            <p>
                <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php _e( 'Privacy Policy', 'course-reviewer-pro' ); ?></a>
                &middot;
                <a href="#"><?php _e( 'Terms of Service', 'course-reviewer-pro' ); ?></a>
                &middot;
                <a href="#"><?php _e( 'Disclaimer', 'course-reviewer-pro' ); ?></a>
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
