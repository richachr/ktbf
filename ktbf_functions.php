<?php
/**
 * KTBF WordPress Theme Functions
 * King of Thailand Birthplace Foundation Website
 * Built for 2027 Centennial Celebration
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup and Support
 * Establishes foundational theme features including post thumbnails,
 * navigation menus, and HTML5 support for modern web standards
 */
function ktbf_theme_support() {
    // Add theme support for post thumbnails (featured images)
    add_theme_support('post-thumbnails');
    
    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Add theme support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add theme support for title tag
    add_theme_support('title-tag');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ktbf'),
        'footer'  => __('Footer Menu', 'ktbf'),
        'centennial' => __('Centennial Event Menu', 'ktbf'),
    ));
    
    // Add support for custom header
    add_theme_support('custom-header', array(
        'default-image' => get_template_directory_uri() . '/assets/images/header-bg.jpg',
        'width'         => 1920,
        'height'        => 600,
        'flex-height'   => true,
    ));
}
add_action('after_setup_theme', 'ktbf_theme_support');

/**
 * Enqueue Scripts and Styles
 * Loads CSS and JavaScript files with proper dependencies and versioning
 * for optimal performance and caching
 */
function ktbf_enqueue_assets() {
    // Enqueue main stylesheet
    wp_enqueue_style('ktbf-style', get_template_directory_uri() . '/assets/css/styles.css');
    
    // Enqueue Bootstrap for responsive grid system
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');
    
    // Enqueue Font Awesome for icons
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Enqueue main JavaScript
    wp_enqueue_script('ktbf-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Enqueue Bootstrap JavaScript
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);
    
    // Localize script for AJAX calls
    wp_localize_script('ktbf-main', 'ktbf_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ktbf_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'ktbf_enqueue_assets');

/**
 * Register Custom Post Types
 * Creates specialized content types for events, scholars, and legacy content
 * to organize information effectively
 */
function ktbf_register_post_types() {
    // Events Post Type
    register_post_type('ktbf_event', array(
        'labels' => array(
            'name' => 'Events',
            'singular_name' => 'Event',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'view_item' => 'View Event',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-calendar-alt',
        'show_in_rest' => true,
    ));
    
    // Thai Scholars Post Type
    register_post_type('ktbf_scholar', array(
        'labels' => array(
            'name' => 'Thai Scholars',
            'singular_name' => 'Scholar',
            'add_new_item' => 'Add New Scholar',
            'edit_item' => 'Edit Scholar',
            'view_item' => 'View Scholar',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_rest' => true,
    ));

    // Registration post type
    register_post_type('ktbf_registration', array(
        'labels' => array(
            'name' => 'Registrations',
            'singular_name' => 'Registration',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'capabilities' => array(
            'create_posts' => false, // Users can't manually create
        ),
        'map_meta_cap' => true,
        'supports' => array('title', 'custom-fields'),
        'menu_icon' => 'dashicons-clipboard',
    ));
    
    // Legacy Timeline Post Type
    register_post_type('ktbf_timeline', array(
        'labels' => array(
            'name' => 'Timeline Events',
            'singular_name' => 'Timeline Event',
            'add_new_item' => 'Add New Timeline Event',
            'edit_item' => 'Edit Timeline Event',
            'view_item' => 'View Timeline Event',
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-clock',
        'show_in_rest' => true,
    ));
    
    // Board Members Post Type
    register_post_type('ktbf_board', array(
        'labels' => array(
            'name' => 'Board Members',
            'singular_name' => 'Board Member',
            'add_new_item' => 'Add New Board Member',
            'edit_item' => 'Edit Board Member',
            'view_item' => 'View Board Member',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-groups',
        'show_in_rest' => true,
    ));
}
add_action('init', 'ktbf_register_post_types');

/**
 * Register Custom Taxonomies
 * Creates organizational categories for different types of content
 */
function ktbf_register_taxonomies() {
    // Event Categories
    register_taxonomy('event_category', 'ktbf_event', array(
        'labels' => array(
            'name' => 'Event Categories',
            'singular_name' => 'Event Category',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
    ));
    
    // Scholar Fields of Study
    register_taxonomy('scholar_field', 'ktbf_scholar', array(
        'labels' => array(
            'name' => 'Fields of Study',
            'singular_name' => 'Field of Study',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
    ));
}
add_action('init', 'ktbf_register_taxonomies');

/**
 * Register Widget Areas
 * Creates sidebars and widget areas for flexible content placement
 */
function ktbf_register_sidebars() {
    register_sidebar(array(
        'name' => 'Main Sidebar',
        'id' => 'main-sidebar',
        'description' => 'Main sidebar for blog and general pages',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => 'Footer Widget Area 1',
        'id' => 'footer-1',
        'description' => 'First footer widget area',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
        'name' => 'Footer Widget Area 2',
        'id' => 'footer-2',
        'description' => 'Second footer widget area',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
        'name' => 'Footer Widget Area 3',
        'id' => 'footer-3',
        'description' => 'Third footer widget area',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'ktbf_register_sidebars');

/**
 * Custom Theme Customizer Options
 * Allows easy customization of colors, fonts, and other design elements
 */
function ktbf_customize_register($wp_customize) {
    // Color Palette Section
    $wp_customize->add_section('ktbf_colors', array(
        'title' => 'KTBF Color Palette',
        'priority' => 30,
    ));
    
    // Primary Color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#0066cc',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => 'Primary Color',
        'section' => 'ktbf_colors',
    )));
    
    // Secondary Color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#ffcc00',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => 'Secondary Color (Thai Gold)',
        'section' => 'ktbf_colors',
    )));
    
    // Accent Color
    $wp_customize->add_setting('accent_color', array(
        'default' => '#cc0000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label' => 'Accent Color (Thai Red)',
        'section' => 'ktbf_colors',
    )));
    
    // Centennial Event Settings
    $wp_customize->add_section('ktbf_centennial', array(
        'title' => 'Centennial Event Settings',
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('centennial_date', array(
        'default' => 'December 3-7, 2027',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('centennial_date', array(
        'label' => 'Event Date',
        'section' => 'ktbf_centennial',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('registration_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('registration_url', array(
        'label' => 'Registration URL',
        'section' => 'ktbf_centennial',
        'type' => 'url',
    ));
}
add_action('customize_register', 'ktbf_customize_register');

/**
 * Security Enhancements
 * Implements security measures to protect the website from common vulnerabilities
 */
function ktbf_security_headers() {
    // Remove WordPress version from head
    remove_action('wp_head', 'wp_generator');
    
    // Remove WLW Manifest
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove RSD Link
    remove_action('wp_head', 'rsd_link');
    
    // Disable XML-RPC
    add_filter('xmlrpc_enabled', '__return_false');
    
    // Hide login errors
    add_filter('login_errors', function() {
        return 'Login failed. Please check your credentials.';
    });
}
add_action('init', 'ktbf_security_headers');

/**
 * AJAX Handler for Donation Form
 * Processes secure donation form submissions with proper validation
 */
function ktbf_process_donation() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'ktbf_nonce')) {
        wp_die('Security check failed');
    }
    
    // Sanitize and validate input data
    $amount = floatval($_POST['amount']);
    $donor_name = sanitize_text_field($_POST['donor_name']);
    $donor_email = sanitize_email($_POST['donor_email']);
    $fund_type = sanitize_text_field($_POST['fund_type']);
    
    // Basic validation
    if (empty($amount) || $amount <= 0) {
        wp_send_json_error('Please enter a valid donation amount.');
    }
    
    if (empty($donor_name) || empty($donor_email)) {
        wp_send_json_error('Please fill in all required fields.');
    }
    
    // Here you would integrate with your payment processor
    // For now, we'll log the donation attempt
    error_log("Donation attempt: $amount from $donor_name ($donor_email) for $fund_type");
    
    wp_send_json_success('Thank you for your donation! You will be redirected to complete payment.');
}
add_action('wp_ajax_ktbf_donate', 'ktbf_process_donation');
add_action('wp_ajax_nopriv_ktbf_donate', 'ktbf_process_donation');

/**
 * AJAX Handler for Event Registration
 * Processes centennial event registration with validation and email confirmation
 */
function ktbf_process_registration() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'ktbf_nonce')) {
        wp_die('Security check failed');
    }
    
    // Sanitize input data
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $affiliation = sanitize_text_field($_POST['affiliation']);
    $events = array_map('sanitize_text_field', $_POST['events']);
    
    // Validation
    if (empty($first_name) || empty($last_name) || empty($email)) {
        wp_send_json_error('Please fill in all required fields.');
    }
    
    if (!is_email($email)) {
        wp_send_json_error('Please enter a valid email address.');
    }
    
    // Store registration data
    $registration_data = array(
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'phone' => $phone,
        'affiliation' => $affiliation,
        'events' => $events,
        'registration_date' => current_time('mysql'),
    );
    
    // Save to database (you might want to create a custom table for this)
    $result = wp_insert_post(array(
        'post_type' => 'ktbf_registration',
        'post_title' => $first_name . ' ' . $last_name,
        'post_content' => serialize($registration_data),
        'post_status' => 'publish',
    ));
    
    if ($result) {
        wp_send_json_success('Registration successful! You will receive a confirmation email shortly.');
        $to = $email;
        $subject = 'Registration Confirmation - KTBF 2027 Centennial';
        $message = "Dear $first_name $last_name,\n\nThank you for registering...";
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $subject, $message, $headers);
    } else {
        wp_send_json_error('Registration failed. Please try again.');
    }
}
add_action('wp_ajax_ktbf_register', 'ktbf_process_registration');
add_action('wp_ajax_nopriv_ktbf_register', 'ktbf_process_registration');

/**
 * Custom Excerpt Length
 * Adjusts excerpt length for better content preview
 */
function ktbf_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'ktbf_excerpt_length');

/**
 * SEO Enhancements
 * Adds structured data and meta tags for better search engine optimization
 */
function ktbf_add_structured_data() {
    if (is_singular('ktbf_event')) {
        global $post;
        $event_date = get_post_meta($post->ID, 'event_date', true);
        $event_location = get_post_meta($post->ID, 'event_location', true);
        
        $structured_data = array(
            '@context' => 'https://schema.org',
            '@type' => 'Event',
            'name' => get_the_title(),
            'description' => get_the_excerpt(),
            'startDate' => $event_date,
            'location' => array(
                '@type' => 'Place',
                'name' => $event_location,
            ),
            'organizer' => array(
                '@type' => 'Organization',
                'name' => 'King of Thailand Birthplace Foundation',
                'url' => home_url(),
            ),
        );
        
        echo '<script type="application/ld+json">' . json_encode($structured_data) . '</script>';
    }
}
add_action('wp_head', 'ktbf_add_structured_data');

/**
 * Accessibility Enhancements
 * Ensures WCAG compliance for better accessibility
 */
function ktbf_accessibility_features() {
    // Skip to content link
    echo '<a class="skip-link screen-reader-text" href="#main">Skip to content</a>';
}
add_action('wp_body_open', 'ktbf_accessibility_features');
?>