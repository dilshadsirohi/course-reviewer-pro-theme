<?php
/**
 * Main Template File
 *
 * @package Course_Reviewer_Pro
 */

get_header();
?>

<main class="site-main" role="main">
    <?php if ( is_front_page() ) : ?>
        <?php get_template_part( 'template-parts/hero' ); ?>
        <?php get_template_part( 'template-parts/platforms' ); ?>

        <section class="section">
            <div class="container">
                <div class="section-header">
                    <h2><?php _e( 'Latest Course Reviews', 'course-reviewer-pro' ); ?></h2>
                    <p><?php _e( 'Our most recent in-depth course reviews and ratings', 'course-reviewer-pro' ); ?></p>
                </div>

                <?php
                $reviews = new WP_Query( array(
                    'post_type'      => 'course_review',
                    'posts_per_page' => 6,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ) );

                if ( $reviews->have_posts() ) :
                ?>
                    <div class="reviews-grid">
                        <?php while ( $reviews->have_posts() ) : $reviews->the_post(); ?>
                            <?php crp_review_card(); ?>
                        <?php endwhile; ?>
                    </div>
                    <div style="text-align: center; margin-top: 2rem;">
                        <a href="<?php echo esc_url( get_post_type_archive_link( 'course_review' ) ); ?>" class="btn btn-outline">
                            <?php _e( 'View All Reviews', 'course-reviewer-pro' ); ?> &rarr;
                        </a>
                    </div>
                <?php else : ?>
                    <p style="text-align: center; color: var(--text-light);"><?php _e( 'No reviews published yet. Check back soon!', 'course-reviewer-pro' ); ?></p>
                <?php endif; wp_reset_postdata(); ?>
            </div>
        </section>

        <?php get_template_part( 'template-parts/cta-banner' ); ?>

        <?php if ( have_posts() ) : ?>
        <section class="section" style="background: var(--bg-white);">
            <div class="container">
                <div class="section-header">
                    <h2><?php _e( 'Latest Articles', 'course-reviewer-pro' ); ?></h2>
                    <p><?php _e( 'Tips, guides, and insights about online learning', 'course-reviewer-pro' ); ?></p>
                </div>
                <div class="reviews-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article class="review-card">
                            <div class="review-card-image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'review-card' ); ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="review-card-content">
                                <div class="review-card-meta">
                                    <?php
                                    $categories = get_the_category();
                                    if ( $categories ) :
                                    ?>
                                        <span class="review-card-platform"><?php echo esc_html( $categories[0]->name ); ?></span>
                                    <?php endif; ?>
                                    <span class="review-card-date"><?php echo get_the_date(); ?></span>
                                </div>
                                <h3 class="review-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="review-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                                <div class="review-card-footer">
                                    <span class="review-card-date"><?php _e( 'Read More', 'course-reviewer-pro' ); ?> &rarr;</span>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

    <?php else : ?>

        <section class="section">
            <div class="container">
                <?php if ( have_posts() ) : ?>
                    <div class="reviews-grid">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article class="review-card">
                                <div class="review-card-image">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'review-card' ); ?></a>
                                    <?php endif; ?>
                                </div>
                                <div class="review-card-content">
                                    <div class="review-card-meta">
                                        <span class="review-card-date"><?php echo get_the_date(); ?></span>
                                    </div>
                                    <h3 class="review-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p class="review-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                    <?php the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                    ) ); ?>
                <?php else : ?>
                    <p><?php _e( 'No posts found.', 'course-reviewer-pro' ); ?></p>
                <?php endif; ?>
            </div>
        </section>

    <?php endif; ?>
</main>

<?php get_footer(); ?>
