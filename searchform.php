<?php
/**
 * Search Form Template
 *
 * @package Course_Reviewer_Pro
 */
?>
<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="search-field"><?php _e( 'Search', 'course-reviewer-pro' ); ?></label>
    <input type="search" id="search-field" placeholder="<?php esc_attr_e( 'Search courses...', 'course-reviewer-pro' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
    <button type="submit" aria-label="<?php esc_attr_e( 'Search', 'course-reviewer-pro' ); ?>">&#128269;</button>
</form>
