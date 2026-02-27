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

            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="stat-number"><?php echo esc_html( get_theme_mod( 'crp_stat_reviews', '500+' ) ); ?></span>
                    <span class="stat-label"><?php _e( 'Reviews', 'course-reviewer-pro' ); ?></span>
                </div>
                <div class="hero-stat">
                    <span class="stat-number"><?php echo esc_html( get_theme_mod( 'crp_stat_platforms', '25+' ) ); ?></span>
                    <span class="stat-label"><?php _e( 'Platforms', 'course-reviewer-pro' ); ?></span>
                </div>
                <div class="hero-stat">
                    <span class="stat-number"><?php echo esc_html( get_theme_mod( 'crp_stat_students', '50K+' ) ); ?></span>
                    <span class="stat-label"><?php _e( 'Students Helped', 'course-reviewer-pro' ); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
