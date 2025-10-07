<?php
/**
 * Custom search form template
 */
$unique_id = uniqid('search-');
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="<?php echo esc_attr($unique_id); ?>" class="screen-reader-text">
        <?php esc_html_e('Search for:', 'ktbf'); ?>
    </label>
    <div class="search-form-wrapper">
        <input type="search" 
               id="<?php echo esc_attr($unique_id); ?>" 
               class="search-field form-control" 
               placeholder="<?php esc_attr_e('Search...', 'ktbf'); ?>" 
               value="<?php echo get_search_query(); ?>" 
               name="s"
               required>
        <button type="submit" class="search-submit btn btn-primary">
            <i class="fas fa-search" aria-hidden="true"></i>
            <span class="screen-reader-text"><?php esc_html_e('Search', 'ktbf'); ?></span>
        </button>
    </div>
</form>