<?php
/**
 * Single Course Review Template
 *
 * @package Course_Reviewer_Pro
 */

get_header();
?>

<main class="site-main single-review" role="main">
    <div class="container">
        <?php while ( have_posts() ) : the_post();
            $post_id       = get_the_ID();
            $rating        = get_post_meta( $post_id, 'crp_overall_rating', true );
            $content_q     = get_post_meta( $post_id, 'crp_content_quality', true );
            $instructor_r  = get_post_meta( $post_id, 'crp_instructor_rating', true );
            $value_m       = get_post_meta( $post_id, 'crp_value_for_money', true );
            $support_r     = get_post_meta( $post_id, 'crp_support_rating', true );
            $price         = get_post_meta( $post_id, 'crp_price', true );
            $price_note    = get_post_meta( $post_id, 'crp_price_note', true );
            $course_url    = get_post_meta( $post_id, 'crp_course_url', true );
            $instructor    = get_post_meta( $post_id, 'crp_instructor', true );
            $duration      = get_post_meta( $post_id, 'crp_duration', true );
            $level         = get_post_meta( $post_id, 'crp_level', true );
            $language      = get_post_meta( $post_id, 'crp_language', true );
            $last_updated  = get_post_meta( $post_id, 'crp_last_updated', true );
            $verdict       = get_post_meta( $post_id, 'crp_verdict', true );
            $pros          = crp_get_pros_list( $post_id );
            $cons          = crp_get_cons_list( $post_id );
            $platforms     = get_the_terms( $post_id, 'review_platform' );
        ?>

        <div class="review-header">
            <div class="review-header-top">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="review-header-image">
                        <?php the_post_thumbnail( 'review-header' ); ?>
                    </div>
                <?php endif; ?>

                <div class="review-header-info">
                    <?php if ( $platforms && ! is_wp_error( $platforms ) ) : ?>
                        <span class="review-platform"><?php echo esc_html( $platforms[0]->name ); ?></span>
                    <?php endif; ?>

                    <h1><?php the_title(); ?></h1>

                    <?php if ( has_excerpt() ) : ?>
                        <p class="review-subtitle"><?php echo get_the_excerpt(); ?></p>
                    <?php endif; ?>

                    <div class="review-quick-stats">
                        <?php if ( $rating ) : ?>
                            <div class="review-quick-stat">
                                <span class="stat-label"><?php _e( 'Rating', 'course-reviewer-pro' ); ?></span>
                                <span class="stat-value">
                                    <?php crp_star_rating( $rating ); ?>
                                    <?php echo esc_html( $rating ); ?>/5
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ( $price ) : ?>
                            <div class="review-quick-stat">
                                <span class="stat-label"><?php _e( 'Price', 'course-reviewer-pro' ); ?></span>
                                <span class="stat-value"><?php echo esc_html( $price ); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ( $level ) : ?>
                            <div class="review-quick-stat">
                                <span class="stat-label"><?php _e( 'Level', 'course-reviewer-pro' ); ?></span>
                                <span class="stat-value"><?php echo esc_html( $level ); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ( $duration ) : ?>
                            <div class="review-quick-stat">
                                <span class="stat-label"><?php _e( 'Duration', 'course-reviewer-pro' ); ?></span>
                                <span class="stat-value"><?php echo esc_html( $duration ); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ( $rating ) : ?>
                    <div class="review-overall-score">
                        <span class="score-number"><?php echo esc_html( $rating ); ?></span>
                        <span class="score-label"><?php _e( 'Overall', 'course-reviewer-pro' ); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="review-content-layout">
            <div class="review-main-content">
                <?php if ( ! empty( $pros ) || ! empty( $cons ) ) : ?>
                    <div class="pros-cons">
                        <?php if ( ! empty( $pros ) ) : ?>
                            <div class="pros-list">
                                <h3><?php _e( 'Pros', 'course-reviewer-pro' ); ?></h3>
                                <ul>
                                    <?php foreach ( $pros as $pro ) : ?>
                                        <li><?php echo esc_html( $pro ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $cons ) ) : ?>
                            <div class="cons-list">
                                <h3><?php _e( 'Cons', 'course-reviewer-pro' ); ?></h3>
                                <ul>
                                    <?php foreach ( $cons as $con ) : ?>
                                        <li><?php echo esc_html( $con ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php the_content(); ?>

                <?php if ( $content_q || $instructor_r || $value_m || $support_r ) : ?>
                    <h2><?php _e( 'Detailed Ratings', 'course-reviewer-pro' ); ?></h2>
                    <div class="rating-breakdown">
                        <?php if ( $content_q ) crp_rating_bar( __( 'Content Quality', 'course-reviewer-pro' ), $content_q ); ?>
                        <?php if ( $instructor_r ) crp_rating_bar( __( 'Instructor', 'course-reviewer-pro' ), $instructor_r ); ?>
                        <?php if ( $value_m ) crp_rating_bar( __( 'Value for Money', 'course-reviewer-pro' ), $value_m ); ?>
                        <?php if ( $support_r ) crp_rating_bar( __( 'Support & Community', 'course-reviewer-pro' ), $support_r ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $verdict ) : ?>
                    <h2><?php _e( 'Final Verdict', 'course-reviewer-pro' ); ?></h2>
                    <p><?php echo esc_html( $verdict ); ?></p>
                <?php endif; ?>

                <?php crp_social_share(); ?>
            </div>

            <aside class="review-sidebar">
                <div class="sidebar-widget sidebar-cta">
                    <?php if ( $price ) : ?>
                        <div class="cta-price"><?php echo esc_html( $price ); ?></div>
                        <?php if ( $price_note ) : ?>
                            <p class="cta-price-note"><?php echo esc_html( $price_note ); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ( $course_url ) : ?>
                        <a href="<?php echo esc_url( $course_url ); ?>" class="btn btn-accent btn-lg" target="_blank" rel="noopener noreferrer nofollow">
                            <?php _e( 'Visit Course', 'course-reviewer-pro' ); ?> &rarr;
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo esc_url( $course_url ?: '#' ); ?>" class="btn btn-outline" target="_blank" rel="noopener noreferrer nofollow">
                        <?php _e( 'Try Free Preview', 'course-reviewer-pro' ); ?>
                    </a>
                </div>

                <div class="sidebar-widget">
                    <h3><?php _e( 'Course Details', 'course-reviewer-pro' ); ?></h3>
                    <dl class="sidebar-details">
                        <?php if ( $instructor ) : ?>
                            <dt><?php _e( 'Instructor', 'course-reviewer-pro' ); ?></dt>
                            <dd><?php echo esc_html( $instructor ); ?></dd>
                        <?php endif; ?>
                        <?php if ( $duration ) : ?>
                            <dt><?php _e( 'Duration', 'course-reviewer-pro' ); ?></dt>
                            <dd><?php echo esc_html( $duration ); ?></dd>
                        <?php endif; ?>
                        <?php if ( $level ) : ?>
                            <dt><?php _e( 'Level', 'course-reviewer-pro' ); ?></dt>
                            <dd><?php echo esc_html( $level ); ?></dd>
                        <?php endif; ?>
                        <?php if ( $language ) : ?>
                            <dt><?php _e( 'Language', 'course-reviewer-pro' ); ?></dt>
                            <dd><?php echo esc_html( $language ); ?></dd>
                        <?php endif; ?>
                        <?php if ( $last_updated ) : ?>
                            <dt><?php _e( 'Last Updated', 'course-reviewer-pro' ); ?></dt>
                            <dd><?php echo esc_html( $last_updated ); ?></dd>
                        <?php endif; ?>
                        <?php if ( $platforms && ! is_wp_error( $platforms ) ) : ?>
                            <dt><?php _e( 'Platform', 'course-reviewer-pro' ); ?></dt>
                            <dd>
                                <?php
                                $platform_links = array();
                                foreach ( $platforms as $platform ) {
                                    $platform_links[] = '<a href="' . esc_url( get_term_link( $platform ) ) . '">' . esc_html( $platform->name ) . '</a>';
                                }
                                echo implode( ', ', $platform_links );
                                ?>
                            </dd>
                        <?php endif; ?>
                    </dl>
                </div>

                <?php
                $related = new WP_Query( array(
                    'post_type'      => 'course_review',
                    'posts_per_page' => 3,
                    'post__not_in'   => array( $post_id ),
                    'orderby'        => 'rand',
                    'tax_query'      => $platforms ? array(
                        array(
                            'taxonomy' => 'review_platform',
                            'field'    => 'term_id',
                            'terms'    => wp_list_pluck( $platforms, 'term_id' ),
                        ),
                    ) : array(),
                ) );

                if ( $related->have_posts() ) :
                ?>
                    <div class="sidebar-widget">
                        <h3><?php _e( 'Related Reviews', 'course-reviewer-pro' ); ?></h3>
                        <div class="related-reviews-list">
                            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                                <div class="related-review-item">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'review-related' ); ?></a>
                                    <?php endif; ?>
                                    <div class="related-review-info">
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <?php
                                        $rel_rating = get_post_meta( get_the_ID(), 'crp_overall_rating', true );
                                        if ( $rel_rating ) crp_star_rating( $rel_rating );
                                        ?>
                                    </div>
                                </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( is_active_sidebar( 'sidebar-review' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-review' ); ?>
                <?php endif; ?>
            </aside>
        </div>

        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
