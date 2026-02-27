<?php
/**
 * Search Results Template
 *
 * @package Course_Reviewer_Pro
 */

get_header();
?>

<main class="site-main" role="main">
    <div class="archive-header">
        <div class="container">
            <h1><?php printf( __( 'Search Results for: "%s"', 'course-reviewer-pro' ), get_search_query() ); ?></h1>
            <p class="archive-description">
                <?php
                global $wp_query;
                printf( _n( '%d result found', '%d results found', $wp_query->found_posts, 'course-reviewer-pro' ), $wp_query->found_posts );
                ?>
            </p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <div class="reviews-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php if ( 'course_review' === get_post_type() ) : ?>
                            <?php crp_review_card(); ?>
                        <?php else : ?>
                            <article class="review-card">
                                <div class="review-card-image">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'review-card' ); ?></a>
                                    <?php endif; ?>
                                    <span class="review-card-badge"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></span>
                                </div>
                                <div class="review-card-content">
                                    <div class="review-card-meta">
                                        <span class="review-card-date"><?php echo get_the_date(); ?></span>
                                    </div>
                                    <h3 class="review-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p class="review-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                                </div>
                            </article>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>

                <?php the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ) ); ?>
            <?php else : ?>
                <div class="error-404" style="padding: 3rem 0;">
                    <h2><?php _e( 'No results found', 'course-reviewer-pro' ); ?></h2>
                    <p><?php _e( 'Try searching with different keywords or browse our categories.', 'course-reviewer-pro' ); ?></p>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'course_review' ) ); ?>" class="btn btn-primary"><?php _e( 'Browse All Reviews', 'course-reviewer-pro' ); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
