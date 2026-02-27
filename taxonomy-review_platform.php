<?php
/**
 * Platform Taxonomy Archive Template
 *
 * @package Course_Reviewer_Pro
 */

get_header();

$term = get_queried_object();
?>

<main class="site-main" role="main">
    <div class="archive-header">
        <div class="container">
            <h1><?php echo esc_html( $term->name ); ?> <?php _e( 'Course Reviews', 'course-reviewer-pro' ); ?></h1>
            <?php if ( $term->description ) : ?>
                <p class="archive-description"><?php echo esc_html( $term->description ); ?></p>
            <?php else : ?>
                <p class="archive-description"><?php printf( __( 'Browse all our reviews of courses on %s.', 'course-reviewer-pro' ), esc_html( $term->name ) ); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <?php
            $all_platforms = get_terms( array(
                'taxonomy'   => 'review_platform',
                'hide_empty' => true,
            ) );
            if ( $all_platforms && ! is_wp_error( $all_platforms ) ) :
            ?>
                <div class="archive-filters">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'course_review' ) ); ?>" class="archive-filter"><?php _e( 'All', 'course-reviewer-pro' ); ?></a>
                    <?php foreach ( $all_platforms as $platform ) : ?>
                        <a href="<?php echo esc_url( get_term_link( $platform ) ); ?>" class="archive-filter <?php echo $platform->term_id === $term->term_id ? 'active' : ''; ?>">
                            <?php echo esc_html( $platform->name ); ?>
                        </a>
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
                    <?php printf( __( 'No reviews found for %s. Check back soon!', 'course-reviewer-pro' ), esc_html( $term->name ) ); ?>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <?php get_template_part( 'template-parts/cta-banner' ); ?>
</main>

<?php get_footer(); ?>
