<?php
/**
 * The sidebar containing the main widget area
 */

if (!is_active_sidebar('main-sidebar')) {
    return;
}
?>

<div id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e('Sidebar', 'ktbf'); ?>">
    <?php dynamic_sidebar('main-sidebar'); ?>
</div>