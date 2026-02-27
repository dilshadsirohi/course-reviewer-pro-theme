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
