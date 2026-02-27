<?php
/**
 * Platforms Section Template Part
 *
 * @package Course_Reviewer_Pro
 */

$platforms = get_terms( array(
    'taxonomy'   => 'review_platform',
    'hide_empty' => false,
    'number'     => 6,
    'orderby'    => 'count',
    'order'      => 'DESC',
) );

if ( empty( $platforms ) || is_wp_error( $platforms ) ) {
    return;
}
?>

<section class="section platforms-section">
    <div class="container">
        <div class="section-header">
            <h2><?php _e( 'Browse by Platform', 'course-reviewer-pro' ); ?></h2>
            <p><?php _e( 'Explore reviews from the most popular online learning platforms', 'course-reviewer-pro' ); ?></p>
        </div>

        <div class="platforms-grid">
            <?php foreach ( $platforms as $platform ) : ?>
                <a href="<?php echo esc_url( get_term_link( $platform ) ); ?>" class="platform-badge">
                    <div class="platform-icon">
                        <?php echo esc_html( mb_substr( $platform->name, 0, 1 ) ); ?>
                    </div>
                    <span class="platform-name"><?php echo esc_html( $platform->name ); ?></span>
                    <span class="platform-count">
                        <?php printf( _n( '%d review', '%d reviews', $platform->count, 'course-reviewer-pro' ), $platform->count ); ?>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
