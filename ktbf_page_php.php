<?php
/**
 * The template for displaying all pages
 */

get_header();
?>

<div class="main-content page-content">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
        ?>
            <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if (!is_front_page()) : ?>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                <?php endif; ?>
                
                <?php if (has_post_thumbnail() && !is_front_page()) : ?>
                    <div class="entry-featured-image">
                        <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                    </div>
                <?php endif; ?>
                
                <div class="entry-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'ktbf'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </article>
            
            <?php
            // Comments (if enabled on pages)
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
            
        <?php endwhile; ?>
    </div>
</div>

<?php
get_footer();
?>