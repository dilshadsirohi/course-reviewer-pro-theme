<?php
/**
 * 404 Template
 *
 * @package Course_Reviewer_Pro
 */

get_header();
?>

<main class="site-main" role="main">
    <section class="error-404">
        <div class="container">
            <h1>404</h1>
            <h2><?php _e( 'Page Not Found', 'course-reviewer-pro' ); ?></h2>
            <p><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'course-reviewer-pro' ); ?></p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><?php _e( 'Go Home', 'course-reviewer-pro' ); ?></a>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'course_review' ) ); ?>" class="btn btn-outline"><?php _e( 'Browse Reviews', 'course-reviewer-pro' ); ?></a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
