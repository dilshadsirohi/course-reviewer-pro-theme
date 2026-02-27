<?php
/**
 * Course Review Archive Template
 *
 * @package Course_Reviewer_Pro
 */

get_header();
?>

<main class="site-main" role="main">
    <div class="archive-header">
        <div class="container">
            <h1><?php _e( 'Course Reviews', 'course-reviewer-pro' ); ?></h1>
            <p class="archive-description"><?php _e( 'Browse our comprehensive collection of honest, in-depth course reviews.', 'course-reviewer-pro' ); ?></p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <?php
            $platforms = get_terms( array(
                'taxonomy'   => 'review_platform',
                'hide_empty' => true,
            ) );
            if ( $platforms && ! is_wp_error( $platforms ) ) :
            ?>
                <div class="archive-filters">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'course_review' ) ); ?>" class="archive-filter active"><?php _e( 'All', 'course-reviewer-pro' ); ?></a>
                    <?php foreach ( $platforms as $platform ) : ?>
                        <a href="<?php echo esc_url( get_term_link( $platform ) ); ?>" class="archive-filter"><?php echo esc_html( $platform->name ); ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ( have_posts() ) : ?>
                <div class="reviews-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php crp_review_card(); ?>
                    <?php endwhile; ?>
                </div>

                <?php the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ) ); ?>
            <?php else : ?>
                <p style="text-align: center; padding: 3rem 0; color: var(--text-light);">
                    <?php _e( 'No course reviews found. Check back soon!', 'course-reviewer-pro' ); ?>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <?php get_template_part( 'template-parts/cta-banner' ); ?>
</main>

<?php get_footer(); ?>
