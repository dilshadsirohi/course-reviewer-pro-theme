<?php
/**
 * Archive Template
 *
 * @package Course_Reviewer_Pro
 */

get_header();
?>

<main class="site-main" role="main">
    <div class="archive-header">
        <div class="container">
            <?php
            the_archive_title( '<h1>', '</h1>' );
            the_archive_description( '<p class="archive-description">', '</p>' );
            ?>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="archive-layout">
                <div>
                    <?php if ( have_posts() ) : ?>
                        <div class="reviews-grid" style="grid-template-columns: 1fr;">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <article class="review-card" style="flex-direction: row;">
                                    <div class="review-card-image" style="width: 250px; min-width: 250px; height: auto;">
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
                                        <p class="review-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 30 ); ?></p>
                                        <div class="review-card-footer">
                                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary"><?php _e( 'Read More', 'course-reviewer-pro' ); ?></a>
                                        </div>
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

                <aside class="sidebar">
                    <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
                        <?php dynamic_sidebar( 'sidebar-blog' ); ?>
                    <?php endif; ?>
                </aside>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
