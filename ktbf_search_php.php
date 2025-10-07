<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>

<div class="main-content search-results-page">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(
                    /* translators: %s: search query */
                    esc_html__('Search Results for: %s', 'ktbf'),
                    '<span class="search-query">' . get_search_query() . '</span>'
                );
                ?>
            </h1>
            
            <?php if (have_posts()) : ?>
                <p class="search-count">
                    <?php
                    printf(
                        /* translators: %s: number of results */
                        esc_html(_n('%s result found', '%s results found', $wp_query->found_posts, 'ktbf')),
                        number_format_i18n($wp_query->found_posts)
                    );
                    ?>
                </p>
            <?php endif; ?>
            
            <!-- Search form to refine results -->
            <div class="search-form-wrapper">
                <?php get_search_form(); ?>
            </div>
        </header>
        
        <div class="row">
            <div class="col-lg-8">
                <?php if (have_posts()) : ?>
                    <div class="search-results">
                        <?php
                        while (have_posts()) :
                            the_post();
                            $post_type_obj = get_post_type_object(get_post_type());
                            $post_type_name = $post_type_obj ? $post_type_obj->labels->singular_name : 'Post';
                        ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                                <div class="post-type-badge">
                                    <?php echo esc_html($post_type_name); ?>
                                </div>
                                
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid')); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="post-content-wrapper">
                                    <header class="entry-header">
                                        <h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                        
                                        <div class="entry-meta">
                                            <span class="posted-on">
                                                <time datetime="<?php echo get_the_date('c'); ?>">
                                                    <?php echo get_the_date(); ?>
                                                </time>
                                            </span>
                                        </div>
                                    </header>
                                    
                                    <div class="entry-summary">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    
                                    <footer class="entry-footer">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm">
                                            <?php esc_html_e('View Details', 'ktbf'); ?>
                                        </a>
                                    </footer>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                    
                    <?php
                    // Pagination
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fas fa-chevron-left" aria-hidden="true"></i> ' . esc_html__('Previous', 'ktbf'),
                        'next_text' => esc_html__('Next', 'ktbf') . ' <i class="fas fa-chevron-right" aria-hidden="true"></i>',
                    ));
                    ?>
                    
                <?php else : ?>
                    <div class="no-results">
                        <h2><?php esc_html_e('No Results Found', 'ktbf'); ?></h2>
                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'ktbf'); ?></p>
                        
                        <div class="search-suggestions">
                            <h3><?php esc_html_e('Search Suggestions:', 'ktbf'); ?></h3>
                            <ul>
                                <li><?php esc_html_e('Check your spelling', 'ktbf'); ?></li>
                                <li><?php esc_html_e('Try more general keywords', 'ktbf'); ?></li>
                                <li><?php esc_html_e('Try different keywords', 'ktbf'); ?></li>
                            </ul>
                        </div>
                        
                        <div class="popular-pages mt-5">
                            <h3><?php esc_html_e('Popular Pages', 'ktbf'); ?></h3>
                            <ul>
                                <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About KTBF', 'ktbf'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/centennial-event')); ?>"><?php esc_html_e('2027 Centennial Event', 'ktbf'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/thai-scholars-program')); ?>"><?php esc_html_e('Thai Scholars Program', 'ktbf'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/trail-of-thai-royalty')); ?>"><?php esc_html_e('Trail of Thai Royalty', 'ktbf'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <aside class="col-lg-4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</div>

<?php
get_footer();
?>