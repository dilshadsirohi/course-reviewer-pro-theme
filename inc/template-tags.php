<?php
/**
 * Template Tags for Course Reviewer Pro
 *
 * @package Course_Reviewer_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function crp_posted_on() {
    $time_string = '<time class="entry-date" datetime="%1$s">%2$s</time>';
    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() )
    );
    echo '<span class="posted-on">' . $time_string . '</span>';
}

function crp_posted_by() {
    echo '<span class="byline"><span class="author vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>';
}

function crp_review_card( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    $rating     = get_post_meta( $post_id, 'crp_overall_rating', true );
    $price      = get_post_meta( $post_id, 'crp_price', true );
    $badge      = get_post_meta( $post_id, 'crp_badge_text', true );
    $is_featured = get_post_meta( $post_id, 'crp_is_featured', true );
    $platforms  = get_the_terms( $post_id, 'review_platform' );
    ?>
    <article class="review-card" id="review-<?php echo esc_attr( $post_id ); ?>">
        <div class="review-card-image">
            <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                <a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
                    <?php echo get_the_post_thumbnail( $post_id, 'review-card', array( 'alt' => get_the_title( $post_id ) ) ); ?>
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
                    <div style="width:100%;height:100%;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem;font-weight:700;">
                        <?php echo esc_html( mb_substr( get_the_title( $post_id ), 0, 1 ) ); ?>
                    </div>
                </a>
            <?php endif; ?>
            <?php if ( $badge ) : ?>
                <span class="review-card-badge <?php echo $is_featured ? 'featured' : ''; ?>"><?php echo esc_html( $badge ); ?></span>
            <?php endif; ?>
        </div>
        <div class="review-card-content">
            <div class="review-card-meta">
                <?php if ( $platforms && ! is_wp_error( $platforms ) ) : ?>
                    <span class="review-card-platform"><?php echo esc_html( $platforms[0]->name ); ?></span>
                <?php endif; ?>
                <span class="review-card-date"><?php echo get_the_date( '', $post_id ); ?></span>
            </div>
            <h3 class="review-card-title">
                <a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>"><?php echo get_the_title( $post_id ); ?></a>
            </h3>
            <p class="review-card-excerpt"><?php echo wp_trim_words( get_the_excerpt( $post_id ), 20 ); ?></p>
            <div class="review-card-footer">
                <div class="review-card-rating">
                    <?php if ( $rating ) : ?>
                        <?php crp_star_rating( $rating ); ?>
                        <span class="rating-number"><?php echo esc_html( $rating ); ?></span>
                    <?php endif; ?>
                </div>
                <?php if ( $price ) : ?>
                    <span class="review-card-price"><?php echo esc_html( $price ); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </article>
    <?php
}

function crp_rating_bar( $label, $value ) {
    $percentage = ( floatval( $value ) / 5 ) * 100;
    ?>
    <div class="rating-bar-item">
        <span class="rating-bar-label"><?php echo esc_html( $label ); ?></span>
        <div class="rating-bar">
            <div class="rating-bar-fill" style="width: <?php echo esc_attr( $percentage ); ?>%"></div>
        </div>
        <span class="rating-bar-value"><?php echo esc_html( $value ); ?>/5</span>
    </div>
    <?php
}

function crp_social_share() {
    $url = urlencode( get_permalink() );
    $title = urlencode( get_the_title() );
    ?>
    <div class="social-share">
        <span class="share-label"><?php _e( 'Share:', 'course-reviewer-pro' ); ?></span>
        <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer" class="share-link share-twitter" aria-label="Share on Twitter">Twitter</a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" rel="noopener noreferrer" class="share-link share-facebook" aria-label="Share on Facebook">Facebook</a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer" class="share-link share-linkedin" aria-label="Share on LinkedIn">LinkedIn</a>
    </div>
    <?php
}
