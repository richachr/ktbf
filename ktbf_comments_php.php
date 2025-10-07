<?php
/**
 * The template for displaying comments
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    /* translators: 1: title */
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'ktbf'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title */
                    esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'ktbf')),
                    number_format_i18n($comment_count),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'ktbf_comment_callback',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => '<i class="fas fa-chevron-left" aria-hidden="true"></i> ' . esc_html__('Older Comments', 'ktbf'),
            'next_text' => esc_html__('Newer Comments', 'ktbf') . ' <i class="fas fa-chevron-right" aria-hidden="true"></i>',
        ));
        ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'ktbf'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
        'class_submit'       => 'btn btn-primary',
        'label_submit'       => esc_html__('Post Comment', 'ktbf'),
        'comment_field'      => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'ktbf') . ' <span class="required">*</span></label><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" required></textarea></p>',
        'fields'             => array(
            'author' => '<p class="comment-form-author"><label for="author">' . esc_html__('Name', 'ktbf') . ' <span class="required">*</span></label><input id="author" name="author" type="text" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" size="30" required /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__('Email', 'ktbf') . ' <span class="required">*</span></label><input id="email" name="email" type="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" required /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__('Website', 'ktbf') . '</label><input id="url" name="url" type="url" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>',
        ),
    ));
    ?>
</div>

<?php
/**
 * Custom comment callback function
 */
function ktbf_comment_callback($comment, $args, $depth) {
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
    <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <?php endif; ?>
    
    <div class="comment-author vcard">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
        <?php printf(__('<cite class="fn">%s</cite>', 'ktbf'), get_comment_author_link()); ?>
    </div>
    
    <div class="comment-meta commentmetadata">
        <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
            <?php printf(__('%1$s at %2$s', 'ktbf'), get_comment_date(), get_comment_time()); ?>
        </a>
        <?php edit_comment_link(__('(Edit)', 'ktbf'), '  ', ''); ?>
    </div>

    <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'ktbf'); ?></em>
        <br />
    <?php endif; ?>

    <div class="comment-content">
        <?php comment_text(); ?>
    </div>

    <div class="reply">
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
    </div>
    
    <?php if ('div' != $args['style']) : ?>
        </div>
    <?php endif; ?>
    <?php
}
?>