<?php
/**
 * CTA Banner Template Part
 *
 * @package Course_Reviewer_Pro
 */
?>

<section class="cta-banner">
    <div class="container">
        <h2><?php _e( 'Ready to Start Learning?', 'course-reviewer-pro' ); ?></h2>
        <p><?php _e( 'Browse our collection of reviews to find the perfect course for your goals.', 'course-reviewer-pro' ); ?></p>
        <a href="<?php echo esc_url( get_post_type_archive_link( 'course_review' ) ); ?>" class="btn">
            <?php _e( 'Browse All Reviews', 'course-reviewer-pro' ); ?> &rarr;
        </a>
    </div>
</section>
