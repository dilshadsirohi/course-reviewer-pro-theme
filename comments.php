<?php
/**
 * Comments Template
 *
 * @package Course_Reviewer_Pro
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2>
            <?php
            $crp_comment_count = get_comments_number();
            printf(
                _n( '%1$s Comment', '%1$s Comments', $crp_comment_count, 'course-reviewer-pro' ),
                number_format_i18n( $crp_comment_count )
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 40,
            ) );
            ?>
        </ol>

        <?php
        the_comments_navigation( array(
            'prev_text' => __( '&laquo; Older Comments', 'course-reviewer-pro' ),
            'next_text' => __( 'Newer Comments &raquo;', 'course-reviewer-pro' ),
        ) );
        ?>
    <?php endif; ?>

    <?php
    comment_form( array(
        'title_reply'        => __( 'Leave a Comment', 'course-reviewer-pro' ),
        'title_reply_to'     => __( 'Reply to %s', 'course-reviewer-pro' ),
        'cancel_reply_link'  => __( 'Cancel Reply', 'course-reviewer-pro' ),
        'label_submit'       => __( 'Post Comment', 'course-reviewer-pro' ),
        'class_submit'       => 'btn btn-primary',
    ) );
    ?>
</div>
