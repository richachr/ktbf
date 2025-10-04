<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    
    <!-- Security Headers -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="SAMEORIGIN">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    
    <!-- Preconnect to external domains for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Open Graph Meta Tags for social sharing -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta property="og:description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/ktbf-social-share.jpg">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/ktbf-social-share.jpg">
    
    <!-- Favicon and Touch Icons -->
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon-16x16.png">
    
    <!-- Theme Color for mobile browsers -->
    <meta name="theme-color" content="<?php echo esc_attr(get_theme_mod('primary_color', '#0066cc')); ?>">
    
    <?php wp_head(); ?>
    
    <!-- Structured Data for Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "King of Thailand Birthplace Foundation",
        "alternateName": "KTBF",
        "url": "<?php echo esc_url(home_url('/')); ?>",
        "logo": "<?php echo get_template_directory_uri(); ?>/assets/images/ktbf-logo.png",
        "description": "<?php echo esc_attr(get_bloginfo('description')); ?>",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "15 Given Drive",
            "addressLocality": "Burlington",
            "addressRegion": "MA",
            "postalCode": "01803-4761",
            "addressCountry": "US"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+1-781-365-0083",
            "contactType": "customer service",
            "email": "ktbf@thailink.com"
        },
        "foundingDate": "1998",
        "nonprofitStatus": "NonprofitType501c3",
        "sameAs": [
            "https://www.facebook.com/ktbfoundation",
            "https://www.twitter.com/ktbfoundation"
        ]
    }
    </script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to content link for accessibility -->
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'ktbf'); ?></a>

<!-- Site Header -->
<header class="site-header" role="banner">
    <div class="container">
        <div class="header-content">
            <!-- Site Branding -->
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                    <?php if (get_bloginfo('description', 'display')) : ?>
                        <p class="site-description"><?php echo get_bloginfo('description', 'display'); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <!-- Primary Navigation -->
            <nav class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e('Main navigation', 'ktbf'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'ktbf_default_menu',
                    'walker'         => new KTBF_Walker_Nav_Menu(),
                ));
                ?>
                
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation menu', 'ktbf'); ?>">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'ktbf'); ?></span>
                </button>
            </nav>

            <!-- Language Switcher (if multilingual) -->
            <?php if (function_exists('pll_the_languages')) : ?>
                <div class="language-switcher" role="navigation" aria-label="<?php esc_attr_e('Language selection', 'ktbf'); ?>">
                    <?php
                    pll_the_languages(array(
                        'dropdown' => 1,
                        'show_names' => 1,
                        'display_names_as' => 'name',
                        'show_flags' => 1,
                    ));
                    ?>
                </div>
            <?php endif; ?>

            <!-- Search Form -->
            <div class="header-search">
                <button class="search-toggle" aria-controls="search-form" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle search', 'ktbf'); ?>">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <span class="screen-reader-text"><?php esc_html_e('Search', 'ktbf'); ?></span>
                </button>
                
                <div class="search-form-container" id="search-form">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <label for="search-field" class="screen-reader-text"><?php esc_html_e('Search for:', 'ktbf'); ?></label>
                        <input type="search" 
                               id="search-field" 
                               class="search-field" 
                               placeholder="<?php esc_attr_e('Search...', 'ktbf'); ?>" 
                               value="<?php echo get_search_query(); ?>" 
                               name="s">
                        <button type="submit" class="search-submit">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <span class="screen-reader-text"><?php esc_html_e('Search', 'ktbf'); ?></span>
                        </button>
                    </form>
                    <div class="search-results" aria-live="polite"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Centennial Event Banner (if event is approaching) -->
    <?php
    $show_banner = get_theme_mod('show_centennial_banner', true);
    $banner_text = get_theme_mod('centennial_banner_text', 'Join us for the 2027 Centennial Celebration - Registration Now Open!');
    $banner_link = get_theme_mod('centennial_banner_link', '/centennial-event');
    
    if ($show_banner) :
    ?>
        <div class="centennial-banner" role="banner" aria-label="<?php esc_attr_e('Important announcement', 'ktbf'); ?>">
            <div class="container">
                <div class="banner-content">
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <span class="banner-text"><?php echo esc_html($banner_text); ?></span>
                    <a href="<?php echo esc_url($banner_link); ?>" class="banner-cta btn btn-sm btn-secondary">
                        <?php esc_html_e('Learn More', 'ktbf'); ?>
                    </a>
                    <button class="banner-close" aria-label="<?php esc_attr_e('Close banner', 'ktbf'); ?>">
                        <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
</header>

<!-- Breadcrumb Navigation (for non-homepage) -->
<?php if (!is_front_page()) : ?>
    <nav class="breadcrumb-navigation" aria-label="<?php esc_attr_e('Breadcrumb navigation', 'ktbf'); ?>">
        <div class="container">
            <?php ktbf_breadcrumbs(); ?>
        </div>
    </nav>
<?php endif; ?>

<!-- Main Content Container -->
<main id="main" class="site-main" role="main">

<?php
/**
 * Default menu fallback if no menu is assigned
 * Creates a basic navigation menu with essential pages
 */
function ktbf_default_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'ktbf') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about')) . '">' . esc_html__('About', 'ktbf') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/centennial-event')) . '">' . esc_html__('2027 Centennial', 'ktbf') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/programs')) . '">' . esc_html__('Programs', 'ktbf') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/news')) . '">' . esc_html__('News', 'ktbf') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/donate')) . '">' . esc_html__('Donate', 'ktbf') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">' . esc_html__('Contact', 'ktbf') . '</a></li>';
    echo '</ul>';
}

/**
 * Custom Walker for Navigation Menus
 * Adds accessibility attributes and proper markup
 */
class KTBF_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
     * Starts the list before the elements are added
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\" role=\"menu\">\n";
    }
    
    /**
     * Ends the list after the elements are added
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    
    /**
     * Starts the element output
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $has_children = in_array('menu-item-has-children', $classes);
        $role = $has_children ? ' role="menuitem" aria-haspopup="true"' : ' role="menuitem"';
        
        $output .= $indent . '<li' . $id . $class_names . $role . '>';
        
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        if ($has_children) {
            $attributes .= ' aria-expanded="false"';
        }
        
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        
        if ($has_children) {
            $item_output .= ' <i class="fas fa-chevron-down" aria-hidden="true"></i>';
        }
        
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * Ends the element output
     */
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}

/**
 * Breadcrumb Navigation Function
 * Generates accessible breadcrumb navigation
 */
function ktbf_breadcrumbs() {
    $separator = '<i class="fas fa-chevron-right" aria-hidden="true"></i>';
    $home_title = __('Home', 'ktbf');
    
    // Start breadcrumb
    echo '<ol class="breadcrumb" vocab="https://schema.org/" typeof="BreadcrumbList">';
    
    // Home link
    echo '<li class="breadcrumb-item" property="itemListElement" typeof="ListItem">';
    echo '<a property="item" typeof="WebPage" href="' . esc_url(home_url('/')) . '">';
    echo '<span property="name">' . esc_html($home_title) . '</span>';
    echo '</a>';
    echo '<meta property="position" content="1">';
    echo '</li>';
    
    if (is_category() || is_single()) {
        $position = 2;
        
        if (is_single()) {
            $categories = get_the_category();
            if ($categories) {
                foreach ($categories as $category) {
                    echo '<li class="breadcrumb-item" property="itemListElement" typeof="ListItem">';
                    echo '<a property="item" typeof="WebPage" href="' . esc_url(get_category_link($category->term_id)) . '">';
                    echo '<span property="name">' . esc_html($category->name) . '</span>';
                    echo '</a>';
                    echo '<meta property="position" content="' . $position . '">';
                    echo '</li>';
                    $position++;
                }
            }
        }
        
        echo '<li class="breadcrumb-item active" property="itemListElement" typeof="ListItem">';
        echo '<span property="name">' . get_the_title() . '</span>';
        echo '<meta property="position" content="' . $position . '">';
        echo '</li>';
        
    } elseif (is_page()) {
        $position = 2;
        
        if ($post = get_post()) {
            $parents = get_post_ancestors($post->ID);
            $parents = array_reverse($parents);
            
            foreach ($parents as $parent) {
                echo '<li class="breadcrumb-item" property="itemListElement" typeof="ListItem">';
                echo '<a property="item" typeof="WebPage" href="' . esc_url(get_permalink($parent)) . '">';
                echo '<span property="name">' . get_the_title($parent) . '</span>';
                echo '</a>';
                echo '<meta property="position" content="' . $position . '">';
                echo '</li>';
                $position++;
            }
            
            echo '<li class="breadcrumb-item active" property="itemListElement" typeof="ListItem">';
            echo '<span property="name">' . get_the_title() . '</span>';
            echo '<meta property="position" content="' . $position . '">';
            echo '</li>';
        }
        
    } elseif (is_search()) {
        echo '<li class="breadcrumb-item active" property="itemListElement" typeof="ListItem">';
        echo '<span property="name">' . sprintf(__('Search Results for "%s"', 'ktbf'), get_search_query()) . '</span>';
        echo '<meta property="position" content="2">';
        echo '</li>';
        
    } elseif (is_archive()) {
        echo '<li class="breadcrumb-item active" property="itemListElement" typeof="ListItem">';
        echo '<span property="name">' . get_the_archive_title() . '</span>';
        echo '<meta property="position" content="2">';
        echo '</li>';
    }
    
    echo '</ol>';
}
?>