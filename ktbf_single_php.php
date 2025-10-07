<?php
/**
 * The template for displaying single posts
 */

get_header();
?>

<div class="main-content single-post">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                while (have_posts()) :
                    the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="entry-featured-image">
                                    <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                                </div>
                            <?php endif; ?>
                            
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            
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
                                
                                <?php if (get_the_author()) : ?>
                                    <span class="author-name">
                                        <i class="far fa-user" aria-hidden="true"></i>
                                        <?php the_author(); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </header>
                        
                        <div class="entry-content">
                            <?php
                            the_content();
                            
                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'ktbf'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>
                        
                        <?php if (has_tag()) : ?>
                            <footer class="entry-footer">
                                <div class="tags-links">
                                    <i class="fas fa-tags" aria-hidden="true"></i>
                                    <?php the_tags('', ', ', ''); ?>
                                </div>
                            </footer>
                        <?php endif; ?>
                    </article>
                    
                    <?php
                    // Post navigation
                    the_post_navigation(array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'ktbf') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'ktbf') . '</span> <span class="nav-title">%title</span>',
                    ));
                    
                    // Comments
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                    
                <?php endwhile; ?>
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