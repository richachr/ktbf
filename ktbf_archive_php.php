<?php
/**
 * The template for displaying archive pages
 */

get_header();
?>

<div class="main-content archive-page">
    <div class="container">
        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </header>
        
        <div class="row">
            <div class="col-lg-8">
                <?php if (have_posts()) : ?>
                    <div class="archive-posts">
                        <?php
                        while (have_posts()) :
                            the_post();
                        ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('archive-post-item'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
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
                                                <i class="far fa-calendar" aria-hidden="true"></i>
                                                <time datetime="<?php echo get_the_date('c'); ?>">
                                                    <?php echo get_the_date(); ?>
                                                </time>
                                            </span>
                                            
                                            <?php if (has_category()) : ?>
                                                <span class="category-links">
                                                    <i class="far fa-folder" aria-hidden="true"></i>
                                                    <?php the_category(', '); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </header>
                                    
                                    <div class="entry-summary">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    
                                    <footer class="entry-footer">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm">
                                            <?php esc_html_e('Read More', 'ktbf'); ?>
                                            <span class="screen-reader-text"><?php esc_html_e('about', 'ktbf'); ?> <?php the_title(); ?></span>
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
                        <h2><?php esc_html_e('Nothing Found', 'ktbf'); ?></h2>
                        <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'ktbf'); ?></p>
                        <?php get_search_form(); ?>
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