<?php
/**
 * Template Name: Course Comparison
 *
 * @package Course_Reviewer_Pro
 */

get_header();
?>

<main class="site-main" role="main">
    <div class="archive-header">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <p class="archive-description"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <section class="section comparison-section">
        <div class="container">
            <?php
            $reviews = new WP_Query( array(
                'post_type'      => 'course_review',
                'posts_per_page' => 20,
                'meta_key'       => 'crp_overall_rating',
                'orderby'        => 'meta_value_num',
                'order'          => 'DESC',
            ) );

            if ( $reviews->have_posts() ) :
            ?>
                <div style="overflow-x: auto;">
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th><?php _e( 'Course', 'course-reviewer-pro' ); ?></th>
                                <th><?php _e( 'Platform', 'course-reviewer-pro' ); ?></th>
                                <th><?php _e( 'Rating', 'course-reviewer-pro' ); ?></th>
                                <th><?php _e( 'Price', 'course-reviewer-pro' ); ?></th>
                                <th><?php _e( 'Level', 'course-reviewer-pro' ); ?></th>
                                <th><?php _e( 'Duration', 'course-reviewer-pro' ); ?></th>
                                <th><?php _e( 'Action', 'course-reviewer-pro' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ( $reviews->have_posts() ) : $reviews->the_post();
                                $rating    = get_post_meta( get_the_ID(), 'crp_overall_rating', true );
                                $price     = get_post_meta( get_the_ID(), 'crp_price', true );
                                $level     = get_post_meta( get_the_ID(), 'crp_level', true );
                                $duration  = get_post_meta( get_the_ID(), 'crp_duration', true );
                                $platforms = get_the_terms( get_the_ID(), 'review_platform' );
                            ?>
                                <tr>
                                    <td class="course-name">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </td>
                                    <td>
                                        <?php
                                        if ( $platforms && ! is_wp_error( $platforms ) ) {
                                            echo esc_html( $platforms[0]->name );
                                        } else {
                                            echo '&mdash;';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <?php if ( $rating ) crp_star_rating( $rating ); ?>
                                            <span class="rating-number"><?php echo esc_html( $rating ?: '&mdash;' ); ?></span>
                                        </div>
                                    </td>
                                    <td><?php echo esc_html( $price ?: '&mdash;' ); ?></td>
                                    <td><?php echo esc_html( $level ?: '&mdash;' ); ?></td>
                                    <td><?php echo esc_html( $duration ?: '&mdash;' ); ?></td>
                                    <td>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary"><?php _e( 'Read Review', 'course-reviewer-pro' ); ?></a>
                                    </td>
                                </tr>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p style="text-align: center; color: var(--text-light);"><?php _e( 'No courses to compare yet.', 'course-reviewer-pro' ); ?></p>
            <?php endif; ?>

            <?php
            the_content();
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
