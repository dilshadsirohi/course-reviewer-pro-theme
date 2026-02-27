<?php
/**
 * Hero Section Template Part
 *
 * @package Course_Reviewer_Pro
 */
?>

<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1><?php echo esc_html( get_theme_mod( 'crp_hero_title', 'Find the Best Online Courses' ) ); ?></h1>
            <p><?php echo esc_html( get_theme_mod( 'crp_hero_subtitle', 'Honest, in-depth reviews to help you choose the right course for your learning goals.' ) ); ?></p>

            <div class="hero-search">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" placeholder="<?php esc_attr_e( 'Search for a course or platform...', 'course-reviewer-pro' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
                    <button type="submit"><?php _e( 'Search', 'course-reviewer-pro' ); ?></button>
                </form>
            </div>

        </div>
    </div>
</section>
