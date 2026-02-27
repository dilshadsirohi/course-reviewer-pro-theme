<?php
/**
 * Single Blog Post Template
 *
 * @package Course_Reviewer_Pro
 */

get_header();
?>

<main class="site-main" role="main">
    <div class="page-content">
        <div class="container">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content" style="max-width: 800px; margin: 0 auto;">
                        <header class="entry-header">
                            <div class="review-card-meta" style="margin-bottom: 1rem;">
                                <?php
                                $categories = get_the_category();
                                if ( $categories ) :
                                ?>
                                    <span class="review-card-platform"><?php echo esc_html( $categories[0]->name ); ?></span>
                                <?php endif; ?>
                                <span class="review-card-date"><?php echo get_the_date(); ?></span>
                                <span class="review-card-date"><?php _e( 'by', 'course-reviewer-pro' ); ?> <?php the_author(); ?></span>
                            </div>
                            <h1><?php the_title(); ?></h1>
                        </header>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div style="margin: 1.5rem 0; border-radius: var(--radius-lg); overflow: hidden;">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php the_content(); ?>

                        <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . __( 'Pages:', 'course-reviewer-pro' ),
                            'after'  => '</div>',
                        ) );
                        ?>

                        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-light);">
                            <?php
                            the_tags( '<div class="post-tags" style="display:flex;gap:0.5rem;flex-wrap:wrap;"><span style="font-weight:600;">Tags:</span> ', ', ', '</div>' );
                            ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
