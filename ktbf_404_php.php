<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header();
?>

<div class="main-content error-404-page">
    <div class="container">
        <div class="error-404-content text-center">
            <div class="error-404-icon">
                <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
            </div>
            
            <h1 class="page-title">
                <?php esc_html_e('404', 'ktbf'); ?>
            </h1>
            
            <h2 class="error-subtitle">
                <?php esc_html_e('Page Not Found', 'ktbf'); ?>
            </h2>
            
            <p class="error-message">
                <?php esc_html_e('Sorry, the page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'ktbf'); ?>
            </p>
            
            <div class="error-404-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-home" aria-hidden="true"></i>
                    <?php esc_html_e('Go to Homepage', 'ktbf'); ?>
                </a>
                
                <a href="javascript:history.back()" class="btn btn-outline btn-lg">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    <?php esc_html_e('Go Back', 'ktbf'); ?>
                </a>
            </div>
            
            <div class="search-form-wrapper mt-5">
                <h3><?php esc_html_e('Try searching for what you need:', 'ktbf'); ?></h3>
                <?php get_search_form(); ?>
            </div>
            
            <div class="helpful-links mt-5">
                <h3><?php esc_html_e('Helpful Links', 'ktbf'); ?></h3>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="helpful-link-item">
                            <i class="fas fa-info-circle fa-2x text-primary mb-3" aria-hidden="true"></i>
                            <h4><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About Us', 'ktbf'); ?></a></h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="helpful-link-item">
                            <i class="fas fa-calendar-alt fa-2x text-primary mb-3" aria-hidden="true"></i>
                            <h4><a href="<?php echo esc_url(home_url('/centennial-event')); ?>"><?php esc_html_e('2027 Event', 'ktbf'); ?></a></h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="helpful-link-item">
                            <i class="fas fa-graduation-cap fa-2x text-primary mb-3" aria-hidden="true"></i>
                            <h4><a href="<?php echo esc_url(home_url('/thai-scholars-program')); ?>"><?php esc_html_e('Scholarships', 'ktbf'); ?></a></h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="helpful-link-item">
                            <i class="fas fa-envelope fa-2x text-primary mb-3" aria-hidden="true"></i>
                            <h4><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact', 'ktbf'); ?></a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>