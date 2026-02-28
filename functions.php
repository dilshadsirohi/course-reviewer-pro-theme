<?php
/**
 * Course Reviewer Pro - Theme Functions
 *
 * @package Course_Reviewer_Pro
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'CRP_VERSION', '1.0.0' );
define( 'CRP_DIR', get_template_directory() );
define( 'CRP_URI', get_template_directory_uri() );

function crp_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'customize-selective-refresh-widgets' );

    add_image_size( 'review-card', 400, 250, true );
    add_image_size( 'review-header', 800, 400, true );
    add_image_size( 'review-related', 120, 120, true );

    register_nav_menus( array(
        'primary'   => __( 'Primary Menu', 'course-reviewer-pro' ),
        'footer'    => __( 'Footer Menu', 'course-reviewer-pro' ),
    ) );
}
add_action( 'after_setup_theme', 'crp_theme_setup' );

function crp_enqueue_scripts() {
    wp_enqueue_style( 'crp-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null );
    wp_enqueue_style( 'crp-style', get_stylesheet_uri(), array(), CRP_VERSION );
    wp_enqueue_style( 'crp-responsive', CRP_URI . '/assets/css/responsive.css', array( 'crp-style' ), CRP_VERSION );

    wp_enqueue_script( 'crp-navigation', CRP_URI . '/assets/js/navigation.js', array(), CRP_VERSION, true );
    wp_enqueue_script( 'crp-main', CRP_URI . '/assets/js/main.js', array(), CRP_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'crp_enqueue_scripts' );

function crp_register_widgets() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'course-reviewer-pro' ),
        'id'            => 'sidebar-blog',
        'description'   => __( 'Widgets for the blog sidebar.', 'course-reviewer-pro' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Review Sidebar', 'course-reviewer-pro' ),
        'id'            => 'sidebar-review',
        'description'   => __( 'Widgets for single review pages.', 'course-reviewer-pro' ),
        'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 1', 'course-reviewer-pro' ),
        'id'            => 'footer-1',
        'description'   => __( 'First footer widget area.', 'course-reviewer-pro' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 2', 'course-reviewer-pro' ),
        'id'            => 'footer-2',
        'description'   => __( 'Second footer widget area.', 'course-reviewer-pro' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'crp_register_widgets' );

function crp_register_course_review_cpt() {
    $labels = array(
        'name'                  => __( 'Course Reviews', 'course-reviewer-pro' ),
        'singular_name'         => __( 'Course Review', 'course-reviewer-pro' ),
        'menu_name'             => __( 'Course Reviews', 'course-reviewer-pro' ),
        'add_new'               => __( 'Add New Review', 'course-reviewer-pro' ),
        'add_new_item'          => __( 'Add New Course Review', 'course-reviewer-pro' ),
        'edit_item'             => __( 'Edit Course Review', 'course-reviewer-pro' ),
        'new_item'              => __( 'New Course Review', 'course-reviewer-pro' ),
        'view_item'             => __( 'View Course Review', 'course-reviewer-pro' ),
        'search_items'          => __( 'Search Course Reviews', 'course-reviewer-pro' ),
        'not_found'             => __( 'No course reviews found', 'course-reviewer-pro' ),
        'not_found_in_trash'    => __( 'No course reviews found in trash', 'course-reviewer-pro' ),
        'all_items'             => __( 'All Reviews', 'course-reviewer-pro' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'review' ),
        'capability_type'    => 'post',
        'has_archive'        => 'reviews',
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-star-filled',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'course_review', $args );
}
add_action( 'init', 'crp_register_course_review_cpt' );

function crp_register_taxonomies() {
    register_taxonomy( 'review_platform', 'course_review', array(
        'labels' => array(
            'name'              => __( 'Platforms', 'course-reviewer-pro' ),
            'singular_name'     => __( 'Platform', 'course-reviewer-pro' ),
            'search_items'      => __( 'Search Platforms', 'course-reviewer-pro' ),
            'all_items'         => __( 'All Platforms', 'course-reviewer-pro' ),
            'edit_item'         => __( 'Edit Platform', 'course-reviewer-pro' ),
            'add_new_item'      => __( 'Add New Platform', 'course-reviewer-pro' ),
            'new_item_name'     => __( 'New Platform Name', 'course-reviewer-pro' ),
            'menu_name'         => __( 'Platforms', 'course-reviewer-pro' ),
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'platform' ),
        'show_in_rest'      => true,
    ) );

    register_taxonomy( 'review_category', 'course_review', array(
        'labels' => array(
            'name'              => __( 'Review Categories', 'course-reviewer-pro' ),
            'singular_name'     => __( 'Review Category', 'course-reviewer-pro' ),
            'search_items'      => __( 'Search Categories', 'course-reviewer-pro' ),
            'all_items'         => __( 'All Categories', 'course-reviewer-pro' ),
            'edit_item'         => __( 'Edit Category', 'course-reviewer-pro' ),
            'add_new_item'      => __( 'Add New Category', 'course-reviewer-pro' ),
            'new_item_name'     => __( 'New Category Name', 'course-reviewer-pro' ),
            'menu_name'         => __( 'Review Categories', 'course-reviewer-pro' ),
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'review-category' ),
        'show_in_rest'      => true,
    ) );
}
add_action( 'init', 'crp_register_taxonomies' );

function crp_register_meta_boxes() {
    add_meta_box(
        'crp_review_details',
        __( 'Review Details', 'course-reviewer-pro' ),
        'crp_review_details_callback',
        'course_review',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'crp_register_meta_boxes' );

function crp_review_details_callback( $post ) {
    wp_nonce_field( 'crp_review_details_nonce', 'crp_review_nonce' );

    $fields = array(
        'crp_overall_rating'    => get_post_meta( $post->ID, 'crp_overall_rating', true ),
        'crp_content_quality'   => get_post_meta( $post->ID, 'crp_content_quality', true ),
        'crp_instructor_rating' => get_post_meta( $post->ID, 'crp_instructor_rating', true ),
        'crp_value_for_money'   => get_post_meta( $post->ID, 'crp_value_for_money', true ),
        'crp_support_rating'    => get_post_meta( $post->ID, 'crp_support_rating', true ),
        'crp_price'             => get_post_meta( $post->ID, 'crp_price', true ),
        'crp_price_note'        => get_post_meta( $post->ID, 'crp_price_note', true ),
        'crp_course_url'        => get_post_meta( $post->ID, 'crp_course_url', true ),
        'crp_instructor'        => get_post_meta( $post->ID, 'crp_instructor', true ),
        'crp_duration'          => get_post_meta( $post->ID, 'crp_duration', true ),
        'crp_level'             => get_post_meta( $post->ID, 'crp_level', true ),
        'crp_language'          => get_post_meta( $post->ID, 'crp_language', true ),
        'crp_last_updated'      => get_post_meta( $post->ID, 'crp_last_updated', true ),
        'crp_pros'              => get_post_meta( $post->ID, 'crp_pros', true ),
        'crp_cons'              => get_post_meta( $post->ID, 'crp_cons', true ),
        'crp_verdict'           => get_post_meta( $post->ID, 'crp_verdict', true ),
        'crp_is_featured'       => get_post_meta( $post->ID, 'crp_is_featured', true ),
        'crp_badge_text'        => get_post_meta( $post->ID, 'crp_badge_text', true ),
    );
    ?>
    <style>
        .crp-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px; }
        .crp-meta-field { margin-bottom: 0; }
        .crp-meta-field label { display: block; font-weight: 600; margin-bottom: 5px; font-size: 13px; }
        .crp-meta-field input, .crp-meta-field textarea, .crp-meta-field select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .crp-meta-field textarea { min-height: 80px; }
        .crp-meta-section { margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee; }
        .crp-meta-section h4 { margin-bottom: 10px; color: #1e40af; }
        .crp-full-width { grid-column: 1 / -1; }
    </style>

    <h4 style="color: #1e40af; margin-bottom: 10px;">Ratings (out of 5)</h4>
    <div class="crp-meta-grid">
        <div class="crp-meta-field">
            <label for="crp_overall_rating"><?php _e( 'Overall Rating', 'course-reviewer-pro' ); ?></label>
            <input type="number" id="crp_overall_rating" name="crp_overall_rating" value="<?php echo esc_attr( $fields['crp_overall_rating'] ); ?>" min="0" max="5" step="0.1">
        </div>
        <div class="crp-meta-field">
            <label for="crp_content_quality"><?php _e( 'Content Quality', 'course-reviewer-pro' ); ?></label>
            <input type="number" id="crp_content_quality" name="crp_content_quality" value="<?php echo esc_attr( $fields['crp_content_quality'] ); ?>" min="0" max="5" step="0.1">
        </div>
        <div class="crp-meta-field">
            <label for="crp_instructor_rating"><?php _e( 'Instructor', 'course-reviewer-pro' ); ?></label>
            <input type="number" id="crp_instructor_rating" name="crp_instructor_rating" value="<?php echo esc_attr( $fields['crp_instructor_rating'] ); ?>" min="0" max="5" step="0.1">
        </div>
        <div class="crp-meta-field">
            <label for="crp_value_for_money"><?php _e( 'Value for Money', 'course-reviewer-pro' ); ?></label>
            <input type="number" id="crp_value_for_money" name="crp_value_for_money" value="<?php echo esc_attr( $fields['crp_value_for_money'] ); ?>" min="0" max="5" step="0.1">
        </div>
        <div class="crp-meta-field">
            <label for="crp_support_rating"><?php _e( 'Support & Community', 'course-reviewer-pro' ); ?></label>
            <input type="number" id="crp_support_rating" name="crp_support_rating" value="<?php echo esc_attr( $fields['crp_support_rating'] ); ?>" min="0" max="5" step="0.1">
        </div>
    </div>

    <div class="crp-meta-section">
        <h4><?php _e( 'Course Information', 'course-reviewer-pro' ); ?></h4>
        <div class="crp-meta-grid">
            <div class="crp-meta-field">
                <label for="crp_price"><?php _e( 'Price', 'course-reviewer-pro' ); ?></label>
                <input type="text" id="crp_price" name="crp_price" value="<?php echo esc_attr( $fields['crp_price'] ); ?>" placeholder="e.g., $49.99">
            </div>
            <div class="crp-meta-field">
                <label for="crp_price_note"><?php _e( 'Price Note', 'course-reviewer-pro' ); ?></label>
                <input type="text" id="crp_price_note" name="crp_price_note" value="<?php echo esc_attr( $fields['crp_price_note'] ); ?>" placeholder="e.g., one-time payment">
            </div>
            <div class="crp-meta-field crp-full-width">
                <label for="crp_course_url"><?php _e( 'Course URL (Affiliate Link)', 'course-reviewer-pro' ); ?></label>
                <input type="url" id="crp_course_url" name="crp_course_url" value="<?php echo esc_url( $fields['crp_course_url'] ); ?>" placeholder="https://">
            </div>
            <div class="crp-meta-field">
                <label for="crp_instructor"><?php _e( 'Instructor', 'course-reviewer-pro' ); ?></label>
                <input type="text" id="crp_instructor" name="crp_instructor" value="<?php echo esc_attr( $fields['crp_instructor'] ); ?>">
            </div>
            <div class="crp-meta-field">
                <label for="crp_duration"><?php _e( 'Duration', 'course-reviewer-pro' ); ?></label>
                <input type="text" id="crp_duration" name="crp_duration" value="<?php echo esc_attr( $fields['crp_duration'] ); ?>" placeholder="e.g., 42 hours">
            </div>
            <div class="crp-meta-field">
                <label for="crp_level"><?php _e( 'Level', 'course-reviewer-pro' ); ?></label>
                <select id="crp_level" name="crp_level">
                    <option value=""><?php _e( 'Select Level', 'course-reviewer-pro' ); ?></option>
                    <option value="Beginner" <?php selected( $fields['crp_level'], 'Beginner' ); ?>><?php _e( 'Beginner', 'course-reviewer-pro' ); ?></option>
                    <option value="Intermediate" <?php selected( $fields['crp_level'], 'Intermediate' ); ?>><?php _e( 'Intermediate', 'course-reviewer-pro' ); ?></option>
                    <option value="Advanced" <?php selected( $fields['crp_level'], 'Advanced' ); ?>><?php _e( 'Advanced', 'course-reviewer-pro' ); ?></option>
                    <option value="All Levels" <?php selected( $fields['crp_level'], 'All Levels' ); ?>><?php _e( 'All Levels', 'course-reviewer-pro' ); ?></option>
                </select>
            </div>
            <div class="crp-meta-field">
                <label for="crp_language"><?php _e( 'Language', 'course-reviewer-pro' ); ?></label>
                <input type="text" id="crp_language" name="crp_language" value="<?php echo esc_attr( $fields['crp_language'] ); ?>" placeholder="e.g., English">
            </div>
            <div class="crp-meta-field">
                <label for="crp_last_updated"><?php _e( 'Last Updated', 'course-reviewer-pro' ); ?></label>
                <input type="text" id="crp_last_updated" name="crp_last_updated" value="<?php echo esc_attr( $fields['crp_last_updated'] ); ?>" placeholder="e.g., January 2024">
            </div>
        </div>
    </div>

    <div class="crp-meta-section">
        <h4><?php _e( 'Pros & Cons', 'course-reviewer-pro' ); ?></h4>
        <div class="crp-meta-grid">
            <div class="crp-meta-field">
                <label for="crp_pros"><?php _e( 'Pros (one per line)', 'course-reviewer-pro' ); ?></label>
                <textarea id="crp_pros" name="crp_pros" placeholder="Enter each pro on a new line"><?php echo esc_textarea( $fields['crp_pros'] ); ?></textarea>
            </div>
            <div class="crp-meta-field">
                <label for="crp_cons"><?php _e( 'Cons (one per line)', 'course-reviewer-pro' ); ?></label>
                <textarea id="crp_cons" name="crp_cons" placeholder="Enter each con on a new line"><?php echo esc_textarea( $fields['crp_cons'] ); ?></textarea>
            </div>
        </div>
    </div>

    <div class="crp-meta-section">
        <h4><?php _e( 'Display Options', 'course-reviewer-pro' ); ?></h4>
        <div class="crp-meta-grid">
            <div class="crp-meta-field">
                <label for="crp_verdict"><?php _e( 'Final Verdict (Short Summary)', 'course-reviewer-pro' ); ?></label>
                <textarea id="crp_verdict" name="crp_verdict"><?php echo esc_textarea( $fields['crp_verdict'] ); ?></textarea>
            </div>
            <div class="crp-meta-field">
                <label>
                    <input type="checkbox" name="crp_is_featured" value="1" <?php checked( $fields['crp_is_featured'], '1' ); ?>>
                    <?php _e( 'Featured Review', 'course-reviewer-pro' ); ?>
                </label>
                <br><br>
                <label for="crp_badge_text"><?php _e( 'Badge Text', 'course-reviewer-pro' ); ?></label>
                <input type="text" id="crp_badge_text" name="crp_badge_text" value="<?php echo esc_attr( $fields['crp_badge_text'] ); ?>" placeholder="e.g., Top Pick, Editor's Choice">
            </div>
        </div>
    </div>
    <?php
}

function crp_save_review_meta( $post_id ) {
    if ( ! isset( $_POST['crp_review_nonce'] ) || ! wp_verify_nonce( $_POST['crp_review_nonce'], 'crp_review_details_nonce' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $text_fields = array(
        'crp_overall_rating', 'crp_content_quality', 'crp_instructor_rating',
        'crp_value_for_money', 'crp_support_rating', 'crp_price', 'crp_price_note',
        'crp_instructor', 'crp_duration', 'crp_level', 'crp_language',
        'crp_last_updated', 'crp_badge_text',
    );

    foreach ( $text_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }

    if ( isset( $_POST['crp_course_url'] ) ) {
        update_post_meta( $post_id, 'crp_course_url', esc_url_raw( $_POST['crp_course_url'] ) );
    }

    $textarea_fields = array( 'crp_pros', 'crp_cons', 'crp_verdict' );
    foreach ( $textarea_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_textarea_field( $_POST[ $field ] ) );
        }
    }

    $featured = isset( $_POST['crp_is_featured'] ) ? '1' : '0';
    update_post_meta( $post_id, 'crp_is_featured', $featured );
}
add_action( 'save_post_course_review', 'crp_save_review_meta' );

function crp_star_rating( $rating, $echo = true ) {
    $rating = floatval( $rating );
    $full_stars = floor( $rating );
    $half_star = ( $rating - $full_stars ) >= 0.5 ? 1 : 0;
    $empty_stars = 5 - $full_stars - $half_star;

    $output = '<div class="star-rating" aria-label="' . sprintf( __( 'Rating: %s out of 5', 'course-reviewer-pro' ), $rating ) . '">';
    for ( $i = 0; $i < $full_stars; $i++ ) {
        $output .= '<span class="star">★</span>';
    }
    if ( $half_star ) {
        $output .= '<span class="star half">★</span>';
    }
    for ( $i = 0; $i < $empty_stars; $i++ ) {
        $output .= '<span class="star empty">★</span>';
    }
    $output .= '</div>';

    if ( $echo ) {
        echo $output;
    }
    return $output;
}

function crp_get_pros_list( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $pros = get_post_meta( $post_id, 'crp_pros', true );
    if ( empty( $pros ) ) {
        return array();
    }
    return array_filter( array_map( 'trim', explode( "\n", $pros ) ) );
}

function crp_get_cons_list( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $cons = get_post_meta( $post_id, 'crp_cons', true );
    if ( empty( $cons ) ) {
        return array();
    }
    return array_filter( array_map( 'trim', explode( "\n", $cons ) ) );
}

function crp_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    echo '<nav class="breadcrumbs" aria-label="Breadcrumb"><div class="container">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'course-reviewer-pro' ) . '</a>';

    if ( is_singular( 'course_review' ) ) {
        $platforms = get_the_terms( get_the_ID(), 'review_platform' );
        echo '<span>/</span>';
        echo '<a href="' . esc_url( get_post_type_archive_link( 'course_review' ) ) . '">' . __( 'Reviews', 'course-reviewer-pro' ) . '</a>';
        if ( $platforms && ! is_wp_error( $platforms ) ) {
            echo '<span>/</span>';
            echo '<a href="' . esc_url( get_term_link( $platforms[0] ) ) . '">' . esc_html( $platforms[0]->name ) . '</a>';
        }
        echo '<span>/</span>';
        echo '<span class="current">' . get_the_title() . '</span>';
    } elseif ( is_post_type_archive( 'course_review' ) ) {
        echo '<span>/</span>';
        echo '<span class="current">' . __( 'All Reviews', 'course-reviewer-pro' ) . '</span>';
    } elseif ( is_tax( 'review_platform' ) ) {
        echo '<span>/</span>';
        echo '<a href="' . esc_url( get_post_type_archive_link( 'course_review' ) ) . '">' . __( 'Reviews', 'course-reviewer-pro' ) . '</a>';
        echo '<span>/</span>';
        echo '<span class="current">' . single_term_title( '', false ) . '</span>';
    } elseif ( is_tax( 'review_category' ) ) {
        echo '<span>/</span>';
        echo '<a href="' . esc_url( get_post_type_archive_link( 'course_review' ) ) . '">' . __( 'Reviews', 'course-reviewer-pro' ) . '</a>';
        echo '<span>/</span>';
        echo '<span class="current">' . single_term_title( '', false ) . '</span>';
    } elseif ( is_singular( 'post' ) ) {
        echo '<span>/</span>';
        echo '<a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . __( 'Blog', 'course-reviewer-pro' ) . '</a>';
        echo '<span>/</span>';
        echo '<span class="current">' . get_the_title() . '</span>';
    } elseif ( is_page() ) {
        echo '<span>/</span>';
        echo '<span class="current">' . get_the_title() . '</span>';
    } elseif ( is_category() ) {
        echo '<span>/</span>';
        echo '<span class="current">' . single_cat_title( '', false ) . '</span>';
    } elseif ( is_search() ) {
        echo '<span>/</span>';
        echo '<span class="current">' . sprintf( __( 'Search: %s', 'course-reviewer-pro' ), get_search_query() ) . '</span>';
    } elseif ( is_404() ) {
        echo '<span>/</span>';
        echo '<span class="current">' . __( 'Page Not Found', 'course-reviewer-pro' ) . '</span>';
    }

    echo '</div></nav>';
}

function crp_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'crp_excerpt_length' );

function crp_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'crp_excerpt_more' );

function crp_review_schema() {
    if ( ! is_singular( 'course_review' ) ) {
        return;
    }

    $post_id = get_the_ID();
    $rating = get_post_meta( $post_id, 'crp_overall_rating', true );
    $price = get_post_meta( $post_id, 'crp_price', true );

    if ( empty( $rating ) ) {
        return;
    }

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Review',
        'name'        => get_the_title(),
        'description' => get_the_excerpt(),
        'datePublished' => get_the_date( 'c' ),
        'author'      => array(
            '@type' => 'Person',
            'name'  => get_the_author(),
        ),
        'itemReviewed' => array(
            '@type' => 'Course',
            'name'  => get_the_title(),
        ),
        'reviewRating' => array(
            '@type'       => 'Rating',
            'ratingValue' => $rating,
            'bestRating'  => '5',
            'worstRating' => '1',
        ),
    );

    if ( ! empty( $price ) ) {
        $schema['itemReviewed']['offers'] = array(
            '@type' => 'Offer',
            'price' => preg_replace( '/[^0-9.]/', '', $price ),
            'priceCurrency' => 'USD',
        );
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'crp_review_schema' );

function crp_adjust_color_brightness( $hex, $steps ) {
    $hex = ltrim( $hex, '#' );
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    $r = max( 0, min( 255, hexdec( substr( $hex, 0, 2 ) ) + $steps ) );
    $g = max( 0, min( 255, hexdec( substr( $hex, 2, 2 ) ) + $steps ) );
    $b = max( 0, min( 255, hexdec( substr( $hex, 4, 2 ) ) + $steps ) );
    return sprintf( '#%02x%02x%02x', $r, $g, $b );
}

function crp_output_customizer_css() {
    $primary      = get_theme_mod( 'crp_primary_color', '#1e40af' );
    $secondary    = get_theme_mod( 'crp_secondary_color', '#f59e0b' );
    $header_bg    = get_theme_mod( 'crp_header_bg_color', '#ffffff' );
    $logo_width   = absint( get_theme_mod( 'crp_logo_max_width', 180 ) );

    $primary_dark  = crp_adjust_color_brightness( $primary, -25 );
    $primary_light = crp_adjust_color_brightness( $primary, 40 );
    $secondary_dark = crp_adjust_color_brightness( $secondary, -25 );

    echo '<style id="crp-customizer-css">' . "\n";
    echo ':root {' . "\n";
    echo '  --primary: ' . esc_attr( $primary ) . ';' . "\n";
    echo '  --primary-dark: ' . esc_attr( $primary_dark ) . ';' . "\n";
    echo '  --primary-light: ' . esc_attr( $primary_light ) . ';' . "\n";
    echo '  --secondary: ' . esc_attr( $secondary ) . ';' . "\n";
    echo '  --secondary-dark: ' . esc_attr( $secondary_dark ) . ';' . "\n";
    echo '}' . "\n";
    echo '.site-header { background-color: ' . esc_attr( $header_bg ) . '; }' . "\n";
    if ( $logo_width ) {
        echo '.site-logo img { max-width: ' . $logo_width . 'px; height: auto; }' . "\n";
    }
    echo '</style>' . "\n";
}
add_action( 'wp_head', 'crp_output_customizer_css' );

function crp_customizer_register( $wp_customize ) {

    /* ── Brand Colors ── */
    $wp_customize->add_section( 'crp_colors_section', array(
        'title'    => __( 'Brand Colors', 'course-reviewer-pro' ),
        'priority' => 20,
    ) );

    $wp_customize->add_setting( 'crp_primary_color', array(
        'default'           => '#1e40af',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'crp_primary_color', array(
        'label'   => __( 'Primary Color (header, links, buttons)', 'course-reviewer-pro' ),
        'section' => 'crp_colors_section',
    ) ) );

    $wp_customize->add_setting( 'crp_secondary_color', array(
        'default'           => '#f59e0b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'crp_secondary_color', array(
        'label'   => __( 'Accent Color (search button, CTAs)', 'course-reviewer-pro' ),
        'section' => 'crp_colors_section',
    ) ) );

    /* ── Header & Logo ── */
    $wp_customize->add_section( 'crp_header_section', array(
        'title'    => __( 'Header & Logo', 'course-reviewer-pro' ),
        'priority' => 25,
    ) );

    $wp_customize->add_setting( 'crp_header_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'crp_header_bg_color', array(
        'label'   => __( 'Header Background Color', 'course-reviewer-pro' ),
        'section' => 'crp_header_section',
    ) ) );

    $wp_customize->add_setting( 'crp_logo_max_width', array(
        'default'           => 180,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'crp_logo_max_width', array(
        'label'       => __( 'Logo Max Width (px)', 'course-reviewer-pro' ),
        'section'     => 'crp_header_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 60, 'max' => 400, 'step' => 10 ),
    ) );

    $wp_customize->add_setting( 'crp_hide_title_with_logo', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'crp_hide_title_with_logo', array(
        'label'   => __( 'Hide site title when logo is set', 'course-reviewer-pro' ),
        'section' => 'crp_header_section',
        'type'    => 'checkbox',
    ) );

    /* ── Hero Section ── */
    $wp_customize->add_section( 'crp_hero_section', array(
        'title'    => __( 'Hero Section', 'course-reviewer-pro' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'crp_hero_title', array(
        'default'           => 'Find the Best Online Courses',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'crp_hero_title', array(
        'label'   => __( 'Hero Title', 'course-reviewer-pro' ),
        'section' => 'crp_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'crp_hero_subtitle', array(
        'default'           => 'Honest, in-depth reviews to help you choose the right course for your learning goals.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'crp_hero_subtitle', array(
        'label'   => __( 'Hero Subtitle', 'course-reviewer-pro' ),
        'section' => 'crp_hero_section',
        'type'    => 'textarea',
    ) );

    /* ── Reviews Archive ── */
    $wp_customize->add_section( 'crp_reviews_section', array(
        'title'    => __( 'Reviews Archive', 'course-reviewer-pro' ),
        'priority' => 40,
    ) );

    $wp_customize->add_setting( 'crp_reviews_heading', array(
        'default'           => 'Course Reviews',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'crp_reviews_heading', array(
        'label'   => __( 'Archive Page Heading', 'course-reviewer-pro' ),
        'section' => 'crp_reviews_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'crp_reviews_subheading', array(
        'default'           => 'Browse our comprehensive collection of honest, in-depth course reviews.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'crp_reviews_subheading', array(
        'label'   => __( 'Archive Page Subheading', 'course-reviewer-pro' ),
        'section' => 'crp_reviews_section',
        'type'    => 'textarea',
    ) );

    /* ── Social Media ── */
    $wp_customize->add_section( 'crp_social_section', array(
        'title'    => __( 'Social Media Links', 'course-reviewer-pro' ),
        'priority' => 80,
    ) );

    $social_networks = array(
        'facebook'  => __( 'Facebook URL', 'course-reviewer-pro' ),
        'twitter'   => __( 'Twitter / X URL', 'course-reviewer-pro' ),
        'youtube'   => __( 'YouTube URL', 'course-reviewer-pro' ),
        'instagram' => __( 'Instagram URL', 'course-reviewer-pro' ),
        'linkedin'  => __( 'LinkedIn URL', 'course-reviewer-pro' ),
    );
    foreach ( $social_networks as $network => $label ) {
        $wp_customize->add_setting( 'crp_social_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'crp_social_' . $network, array(
            'label'       => $label,
            'section'     => 'crp_social_section',
            'type'        => 'url',
            'input_attrs' => array( 'placeholder' => 'https://' ),
        ) );
    }

    /* ── Footer Settings ── */
    $wp_customize->add_section( 'crp_footer_section', array(
        'title'    => __( 'Footer Settings', 'course-reviewer-pro' ),
        'priority' => 90,
    ) );

    $wp_customize->add_setting( 'crp_footer_about', array(
        'default'           => 'We help learners find the best online courses through honest, in-depth reviews. Our team of experts evaluates each course to give you the most accurate information.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'crp_footer_about', array(
        'label'   => __( 'Footer About Text', 'course-reviewer-pro' ),
        'section' => 'crp_footer_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'crp_footer_copyright', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'crp_footer_copyright', array(
        'label'   => __( 'Copyright Text', 'course-reviewer-pro' ),
        'section' => 'crp_footer_section',
        'type'    => 'text',
    ) );
}
add_action( 'customize_register', 'crp_customizer_register' );

require_once CRP_DIR . '/inc/template-tags.php';
