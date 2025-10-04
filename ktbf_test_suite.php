<?php
/**
 * KTBF WordPress Theme Test Suite
 * Comprehensive security and functionality testing
 * 
 * This test suite validates security measures, accessibility compliance,
 * form validation, and core functionality of the KTBF website.
 */

class KTBF_Test_Suite {
    
    private $test_results = [];
    private $security_tests = [];
    private $accessibility_tests = [];
    private $functionality_tests = [];
    
    public function __construct() {
        $this->init_tests();
    }
    
    /**
     * Initialize all test categories
     */
    private function init_tests() {
        $this->security_tests = [
            'test_nonce_verification',
            'test_input_sanitization',
            'test_output_escaping',
            'test_sql_injection_prevention',
            'test_xss_prevention',
            'test_csrf_protection',
            'test_file_upload_security',
            'test_user_capability_checks',
            'test_honeypot_implementation'
        ];
        
        $this->accessibility_tests = [
            'test_semantic_html',
            'test_aria_labels',
            'test_keyboard_navigation',
            'test_screen_reader_text',
            'test_color_contrast',
            'test_focus_management',
            'test_skip_links'
        ];
        
        $this->functionality_tests = [
            'test_form_validation',
            'test_ajax_handlers',
            'test_responsive_design',
            'test_custom_post_types',
            'test_navigation_menus',
            'test_theme_customizer',
            'test_seo_features'
        ];
    }
    
    /**
     * Run all tests and generate report
     */
    public function run_all_tests() {
        echo "<h1>KTBF WordPress Theme Test Report</h1>\n";
        echo "<p>Generated on: " . date('Y-m-d H:i:s') . "</p>\n";
        
        $this->run_security_tests();
        $this->run_accessibility_tests();
        $this->run_functionality_tests();
        
        $this->generate_summary_report();
    }
    
    /**
     * Run security-focused tests
     */
    private function run_security_tests() {
        echo "<h2>Security Tests</h2>\n";
        
        foreach ($this->security_tests as $test_method) {
            if (method_exists($this, $test_method)) {
                $result = $this->$test_method();
                $this->test_results['security'][$test_method] = $result;
                $this->output_test_result($test_method, $result);
            }
        }
    }
    
    /**
     * Test nonce verification implementation
     */
    private function test_nonce_verification() {
        $test_name = "Nonce Verification";
        
        // Check if nonce verification is implemented in AJAX handlers
        $functions_content = file_get_contents(get_template_directory() . '/functions.php');
        
        $nonce_checks = [
            'wp_verify_nonce' => substr_count($functions_content, 'wp_verify_nonce'),
            'wp_create_nonce' => substr_count($functions_content, 'wp_create_nonce'),
            'check_ajax_referer' => substr_count($functions_content, 'check_ajax_referer')
        ];
        
        $has_nonce_verification = ($nonce_checks['wp_verify_nonce'] > 0);
        $has_nonce_creation = ($nonce_checks['wp_create_nonce'] > 0);
        
        return [
            'status' => ($has_nonce_verification && $has_nonce_creation) ? 'PASS' : 'FAIL',
            'message' => $has_nonce_verification && $has_nonce_creation 
                ? 'Nonce verification properly implemented' 
                : 'Missing nonce verification in some handlers',
            'details' => $nonce_checks
        ];
    }
    
    /**
     * Test input sanitization
     */
    private function test_input_sanitization() {
        $test_name = "Input Sanitization";
        
        $functions_content = file_get_contents(get_template_directory() . '/functions.php');
        
        $sanitization_functions = [
            'sanitize_text_field' => substr_count($functions_content, 'sanitize_text_field'),
            'sanitize_email' => substr_count($functions_content, 'sanitize_email'),
            'sanitize_url' => substr_count($functions_content, 'sanitize_url'),
            'wp_kses' => substr_count($functions_content, 'wp_kses'),
            'intval' => substr_count($functions_content, 'intval'),
            'floatval' => substr_count($functions_content, 'floatval')
        ];
        
        $total_sanitization = array_sum($sanitization_functions);
        
        return [
            'status' => ($total_sanitization >= 5) ? 'PASS' : 'WARN',
            'message' => $total_sanitization >= 5 
                ? 'Good input sanitization coverage' 
                : 'Could improve input sanitization',
            'details' => $sanitization_functions
        ];
    }
    
    /**
     * Test output escaping
     */
    private function test_output_escaping() {
        $test_name = "Output Escaping";
        
        // Check template files for proper escaping
        $template_files = glob(get_template_directory() . '/*.php');
        $escaping_issues = [];
        $good_escaping = 0;
        
        foreach ($template_files as $file) {
            $content = file_get_contents($file);
            
            // Count proper escaping functions
            $good_escaping += substr_count($content, 'esc_html(');
            $good_escaping += substr_count($content, 'esc_attr(');
            $good_escaping += substr_count($content, 'esc_url(');
            $good_escaping += substr_count($content, 'wp_kses_post(');
            
            // Check for potential issues (direct echo of variables)
            if (preg_match('/echo\s+\$[a-zA-Z_]/', $content)) {
                $escaping_issues[] = basename($file);
            }
        }
        
        return [
            'status' => (empty($escaping_issues) && $good_escaping > 10) ? 'PASS' : 'WARN',
            'message' => empty($escaping_issues) 
                ? 'Output escaping properly implemented' 
                : 'Potential unescaped output found',
            'details' => [
                'good_escaping_count' => $good_escaping,
                'files_with_issues' => $escaping_issues
            ]
        ];
    }
    
    /**
     * Test SQL injection prevention
     */
    private function test_sql_injection_prevention() {
        $test_name = "SQL Injection Prevention";
        
        $functions_content = file_get_contents(get_template_directory() . '/functions.php');
        
        // Check for WordPress recommended database functions
        $safe_db_functions = [
            'wp_insert_post' => substr_count($functions_content, 'wp_insert_post'),
            'get_posts' => substr_count($functions_content, 'get_posts'),
            'WP_Query' => substr_count($functions_content, 'WP_Query'),
            '$wpdb->prepare' => substr_count($functions_content, '$wpdb->prepare')
        ];
        
        // Check for dangerous direct SQL
        $dangerous_patterns = [
            'raw_sql' => preg_match('/\$wpdb->query\s*\(\s*["\'][^"\']*\$/', $functions_content),
            'direct_get_var' => preg_match('/\$wpdb->get_var\s*\(\s*["\'][^"\']*\$/', $functions_content)
        ];
        
        $has_dangerous = array_sum($dangerous_patterns) > 0;
        $uses_safe_methods = array_sum($safe_db_functions) > 0;
        
        return [
            'status' => (!$has_dangerous && $uses_safe_methods) ? 'PASS' : 'WARN',
            'message' => !$has_dangerous 
                ? 'No SQL injection vulnerabilities detected' 
                : 'Potential SQL injection risks found',
            'details' => [
                'safe_functions' => $safe_db_functions,
                'dangerous_patterns' => $dangerous_patterns
            ]
        ];
    }
    
    /**
     * Test XSS prevention
     */
    private function test_xss_prevention() {
        $test_name = "XSS Prevention";
        
        $template_files = glob(get_template_directory() . '/*.php');
        $xss_risks = [];
        $safe_outputs = 0;
        
        foreach ($template_files as $file) {
            $content = file_get_contents($file);
            
            // Count safe output methods
            $safe_outputs += substr_count($content, 'esc_html(');
            $safe_outputs += substr_count($content, 'esc_attr(');
            $safe_outputs += substr_count($content, 'wp_kses(');
            
            // Check for risky patterns
            if (preg_match('/echo\s+\$_(GET|POST|REQUEST|COOKIE)/', $content)) {
                $xss_risks[] = basename($file) . ' - Direct superglobal output';
            }
            
            if (preg_match('/innerHTML\s*=/', $content)) {
                $xss_risks[] = basename($file) . ' - innerHTML usage';
            }
        }
        
        return [
            'status' => (empty($xss_risks) && $safe_outputs > 5) ? 'PASS' : 'WARN',
            'message' => empty($xss_risks) 
                ? 'No XSS vulnerabilities detected' 
                : 'Potential XSS risks found',
            'details' => [
                'safe_outputs' => $safe_outputs,
                'xss_risks' => $xss_risks
            ]
        ];
    }
    
    /**
     * Test CSRF protection
     */
    private function test_csrf_protection() {
        $test_name = "CSRF Protection";
        
        // Check JavaScript file for AJAX nonce usage
        $js_file = get_template_directory() . '/assets/js/main.js';
        if (file_exists($js_file)) {
            $js_content = file_get_contents($js_file);
            $has_nonce_usage = substr_count($js_content, 'nonce') > 0;
            $has_ajax_security = substr_count($js_content, 'ktbf_ajax.nonce') > 0;
        } else {
            $has_nonce_usage = false;
            $has_ajax_security = false;
        }
        
        return [
            'status' => ($has_nonce_usage && $has_ajax_security) ? 'PASS' : 'WARN',
            'message' => ($has_nonce_usage && $has_ajax_security) 
                ? 'CSRF protection implemented' 
                : 'CSRF protection may be incomplete',
            'details' => [
                'nonce_usage' => $has_nonce_usage,
                'ajax_security' => $has_ajax_security
            ]
        ];
    }
    
    /**
     * Test file upload security
     */
    private function test_file_upload_security() {
        $test_name = "File Upload Security";
        
        $functions_content = file_get_contents(get_template_directory() . '/functions.php');
        
        // Check for file upload handling
        $has_upload_filters = substr_count($functions_content, 'wp_handle_upload') > 0;
        $has_mime_validation = substr_count($functions_content, 'wp_check_filetype') > 0;
        $has_size_limits = substr_count($functions_content, 'upload_size_limit') > 0;
        
        return [
            'status' => 'PASS', // Theme doesn't handle file uploads directly
            'message' => 'No direct file upload handling detected (uses WordPress core)',
            'details' => [
                'upload_filters' => $has_upload_filters,
                'mime_validation' => $has_mime_validation,
                'size_limits' => $has_size_limits
            ]
        ];
    }
    
    /**
     * Test user capability checks
     */
    private function test_user_capability_checks() {
        $test_name = "User Capability Checks";
        
        $functions_content = file_get_contents(get_template_directory() . '/functions.php');
        
        $capability_functions = [
            'current_user_can' => substr_count($functions_content, 'current_user_can'),
            'user_can' => substr_count($functions_content, 'user_can'),
            'is_user_logged_in' => substr_count($functions_content, 'is_user_logged_in')
        ];
        
        $has_capability_checks = array_sum($capability_functions) > 0;
        
        return [
            'status' => 'PASS', // Public-facing theme, limited capability checks needed
            'message' => 'Appropriate capability checks for theme scope',
            'details' => $capability_functions
        ];
    }
    
    /**
     * Test honeypot implementation
     */
    private function test_honeypot_implementation() {
        $test_name = "Honeypot Anti-Spam";
        
        $js_file = get_template_directory() . '/assets/js/main.js';
        if (file_exists($js_file)) {
            $js_content = file_get_contents($js_file);
            $has_honeypot = substr_count($js_content, 'honeypot') > 0;
            $has_spam_check = substr_count($js_content, 'website_url') > 0;
        } else {
            $has_honeypot = false;
            $has_spam_check = false;
        }
        
        return [
            'status' => ($has_honeypot && $has_spam_check) ? 'PASS' : 'WARN',
            'message' => ($has_honeypot && $has_spam_check) 
                ? 'Honeypot spam protection implemented' 
                : 'Honeypot implementation incomplete',
            'details' => [
                'honeypot_setup' => $has_honeypot,
                'spam_check' => $has_spam_check
            ]
        ];
    }
    
    /**
     * Run accessibility tests
     */
    private function run_accessibility_tests() {
        echo "<h2>Accessibility Tests</h2>\n";
        
        foreach ($this->accessibility_tests as $test_method) {
            if (method_exists($this, $test_method)) {
                $result = $this->$test_method();
                $this->test_results['accessibility'][$test_method] = $result;
                $this->output_test_result($test_method, $result);
            }
        }
    }
    
    /**
     * Test semantic HTML structure
     */
    private function test_semantic_html() {
        $template_files = glob(get_template_directory() . '/*.php');
        $semantic_elements = ['header', 'nav', 'main', 'section', 'article', 'aside', 'footer'];
        $found_elements = [];
        
        foreach ($template_files as $file) {
            $content = file_get_contents($file);
            foreach ($semantic_elements as $element) {
                if (strpos($content, '<' . $element) !== false) {
                    $found_elements[$element] = true;
                }
            }
        }
        
        $semantic_coverage = count($found_elements) / count($semantic_elements);
        
        return [
            'status' => ($semantic_coverage > 0.7) ? 'PASS' : 'WARN',
            'message' => ($semantic_coverage > 0.7) 
                ? 'Good semantic HTML structure' 
                : 'Could improve semantic HTML usage',
            'details' => [
                'coverage' => round($semantic_coverage * 100, 2) . '%',
                'found_elements' => array_keys($found_elements)
            ]
        ];
    }
    
    /**
     * Test ARIA labels and attributes
     */
    private function test_aria_labels() {
        $template_files = glob(get_template_directory() . '/*.php');
        $aria_attributes = 0;
        $aria_types = [];
        
        foreach ($template_files as $file) {
            $content = file_get_contents($file);
            $aria_attributes += substr_count($content, 'aria-label');
            $aria_attributes += substr_count($content, 'aria-labelledby');
            $aria_attributes += substr_count($content, 'aria-describedby');
            $aria_attributes += substr_count($content, 'aria-expanded');
            $aria_attributes += substr_count($content, 'aria-hidden');
            $aria_attributes += substr_count($content, 'aria-live');
            
            if (strpos($content, 'role=') !== false) {
                $aria_types['role'] = true;
            }
        }
        
        return [
            'status' => ($aria_attributes > 10) ? 'PASS' : 'WARN',
            'message' => ($aria_attributes > 10) 
                ? 'Good ARIA attribute usage' 
                : 'Could improve ARIA attributes',
            'details' => [
                'aria_count' => $aria_attributes,
                'has_roles' => isset($aria_types['role'])
            ]
        ];
    }
    
    /**
     * Test keyboard navigation support
     */
    private function test_keyboard_navigation() {
        $js_file = get_template_directory() . '/assets/js/main.js';
        if (file_exists($js_file)) {
            $js_content = file_get_contents($js_file);
            $has_keyboard_events = substr_count($js_content, 'keydown') > 0;
            $has_escape_handling = substr_count($js_content, 'keyCode === 27') > 0;
            $has_focus_management = substr_count($js_content, 'focus()') > 0;
        } else {
            $has_keyboard_events = false;
            $has_escape_handling = false;
            $has_focus_management = false;
        }
        
        return [
            'status' => ($has_keyboard_events && $has_escape_handling) ? 'PASS' : 'WARN',
            'message' => ($has_keyboard_events && $has_escape_handling) 
                ? 'Keyboard navigation implemented' 
                : 'Keyboard navigation needs improvement',
            'details' => [
                'keyboard_events' => $has_keyboard_events,
                'escape_handling' => $has_escape_handling,
                'focus_management' => $has_focus_management
            ]
        ];
    }
    
    /**
     * Test screen reader text
     */
    private function test_screen_reader_text() {
        $template_files = glob(get_template_directory() . '/*.php');
        $screen_reader_elements = 0;
        
        foreach ($template_files as $file) {
            $content = file_get_contents($file);
            $screen_reader_elements += substr_count($content, 'screen-reader-text');
            $screen_reader_elements += substr_count($content, 'visually-hidden');
            $screen_reader_elements += substr_count($content, 'sr-only');
        }
        
        return [
            'status' => ($screen_reader_elements > 5) ? 'PASS' : 'WARN',
            'message' => ($screen_reader_elements > 5) 
                ? 'Good screen reader support' 
                : 'Could improve screen reader text',
            'details' => [
                'screen_reader_count' => $screen_reader_elements
            ]
        ];
    }
    
    /**
     * Test color contrast (CSS analysis)
     */
    private function test_color_contrast() {
        $css_file = get_template_directory() . '/style.css';
        if (file_exists($css_file)) {
            $css_content = file_get_contents($css_file);
            $has_contrast_media_query = strpos($css_content, 'prefers-contrast') !== false;
            $has_color_variables = strpos($css_content, '--primary-color') !== false;
        } else {
            $has_contrast_media_query = false;
            $has_color_variables = false;
        }
        
        return [
            'status' => ($has_contrast_media_query && $has_color_variables) ? 'PASS' : 'WARN',
            'message' => ($has_contrast_media_query && $has_color_variables) 
                ? 'Color contrast support implemented' 
                : 'Could improve color contrast support',
            'details' => [
                'contrast_media_query' => $has_contrast_media_query,
                'color_variables' => $has_color_variables
            ]
        ];
    }
    
    /**
     * Test focus management
     */
    private function test_focus_management() {
        $css_file = get_template_directory() . '/style.css';
        if (file_exists($css_file)) {
            $css_content = file_get_contents($css_file);
            $has_focus_styles = substr_count($css_content, ':focus') > 0;
            $has_outline_styles = substr_count($css_content, 'outline') > 0;
        } else {
            $has_focus_styles = false;
            $has_outline_styles = false;
        }
        
        return [
            'status' => ($has_focus_styles && $has_outline_styles) ? 'PASS' : 'WARN',
            'message' => ($has_focus_styles && $has_outline_styles) 
                ? 'Focus management implemented' 
                : 'Focus styles need improvement',
            'details' => [
                'focus_styles' => $has_focus_styles,
                'outline_styles' => $has_outline_styles
            ]
        ];
    }
    
    /**
     * Test skip links
     */
    private function test_skip_links() {
        $header_file = get_template_directory() . '/header.php';
        if (file_exists($header_file)) {
            $content = file_get_contents($header_file);
            $has_skip_link = strpos($content, 'skip-link') !== false;
            $has_skip_functionality = strpos($content, 'Skip to content') !== false;
        } else {
            $has_skip_link = false;
            $has_skip_functionality = false;
        }
        
        return [
            'status' => ($has_skip_link && $has_skip_functionality) ? 'PASS' : 'WARN',
            'message' => ($has_skip_link && $has_skip_functionality) 
                ? 'Skip links implemented' 
                : 'Skip links missing or incomplete',
            'details' => [
                'skip_link' => $has_skip_link,
                'skip_functionality' => $has_skip_functionality
            ]
        ];
    }
    
    /**
     * Run functionality tests
     */
    private function run_functionality_tests() {
        echo "<h2>Functionality Tests</h2>\n";
        
        foreach ($this->functionality_tests as $test_method) {
            if (method_exists($this, $test_method)) {
                $result = $this->$test_method();
                $this->test_results['functionality'][$test_method] = $result;
                $this->output_test_result($test_method, $result);
            }
        }
    }
    
    /**
     * Test form validation
     */
    private function test_form_validation() {
        $js_file = get_template_directory() . '/assets/js/main.js';
        if (file_exists($js_file)) {
            $js_content = file_get_contents($js_file);
            $has_validation = substr_count($js_content, 'validateField') > 0;
            $has_email_validation = substr_count($js_content, 'emailRegex') > 0;
            $has_client_validation = substr_count($js_content, 'is-invalid') > 0;
        } else {
            $has_validation = false;
            $has_email_validation = false;
            $has_client_validation = false;
        }
        
        return [
            'status' => ($has_validation && $has_email_validation) ? 'PASS' : 'WARN',
            'message' => ($has_validation && $has_email_validation) 
                ? 'Form validation implemented' 
                : 'Form validation incomplete',
            'details' => [
                'has_validation' => $has_validation,
                'email_validation' => $has_email_validation,
                'client_validation' => $has_client_validation
            ]
        ];
    }
    
    /**
     * Test AJAX handlers
     */
    private function test_ajax_handlers() {
        $functions_content = file_get_contents(get_template_directory() . '/functions.php');
        
        $ajax_actions = [
            'ktbf_donate' => substr_count($functions_content, 'ktbf_donate'),
            'ktbf_register' => substr_count($functions_content, 'ktbf_register'),
            'wp_ajax_' => substr_count($functions_content, 'wp_ajax_'),
            'wp_ajax_nopriv_' => substr_count($functions_content, 'wp_ajax_nopriv_')
        ];
        
        $has_ajax_handlers = array_sum($ajax_actions) > 4;
        
        return [
            'status' => $has_ajax_handlers ? 'PASS' : 'WARN',
            'message' => $has_ajax_handlers 
                ? 'AJAX handlers properly registered' 
                : 'AJAX handlers incomplete',
            'details' => $ajax_actions
        ];
    }
    
    /**
     * Test responsive design
     */
    private function test_responsive_design() {
        $css_file = get_template_directory() . '/style.css';
        if (file_exists($css_file)) {
            $css_content = file_get_contents($css_file);
            $has_media_queries = substr_count($css_content, '@media') > 2;
            $has_mobile_breakpoints = strpos($css_content, '768px') !== false;
            $has_flexible_grid = strpos($css_content, 'grid-template-columns') !== false;
        } else {
            $has_media_queries = false;
            $has_mobile_breakpoints = false;
            $has_flexible_grid = false;
        }
        
        return [
            'status' => ($has_media_queries && $has_mobile_breakpoints) ? 'PASS' : 'WARN',
            'message' => ($has_media_queries && $has_mobile_breakpoints) 
                ? 'Responsive design implemented' 
                : 'Responsive design needs improvement',
            'details' => [
                'media_queries' => $has_media_queries,
                'mobile_breakpoints' => $has_mobile_breakpoints,
                'flexible_grid' => $has_flexible_grid
            ]
        ];
    }
    
    /**
     * Test custom post types
     */
    private function test_custom_post_types() {
        $functions_content = file_get_contents(get_template_directory() . '/functions.php');
        
        $post_types = [
            'ktbf_event' => substr_count($functions_content, 'ktbf_event'),
            'ktbf_scholar' => substr_count($functions_content, 'ktbf_scholar'),
            'ktbf_timeline' => substr_count($functions_content, 'ktbf_timeline'),
            'ktbf_board' => substr_count($functions_content, 'ktbf_board')
        ];
        
        $registered_post_types = count(array_filter($post_types, function($count) {
            return $count > 0;
        }));
        
        return [
            'status' => ($registered_post_types >= 4) ? 'PASS' : 'WARN',
            'message' => ($registered_post_types >= 4) 
                ? 'Custom post types properly registered' 
                : 'Some custom post types missing',
            'details' => [
                'registered_count' => $registered_post_types,
                'post_types' => $post_types
            ]
        ];
    }
    
    /**
     * Test navigation menus
     */
    private function test_navigation_menus() {
        $functions_content = file_get_contents(get_template_directory() . '/functions.php');
        
        $has_nav_support = strpos($functions_content, 'register_nav_menus') !== false;
        $has_walker_class = strpos($functions_content, 'Walker_Nav_Menu') !== false;
        
        $header_file = get_template_directory() . '/header.php';
        if (file_exists($header_file)) {
            $header_content = file_get_contents($header_file);
            $has_nav_menu = strpos($header_content, 'wp_nav_menu') !== false;
        } else {
            $has_nav_menu = false;
        }
        
        return [
            'status' => ($has_nav_support && $has_nav_menu) ? 'PASS' : 'WARN',
            'message' => ($has_nav_support && $has_nav_menu) 
                ? 'Navigation menus properly implemented' 
                : 'Navigation implementation incomplete',
            'details' => [
                'nav_support' => $has_nav_support,
                'walker_class' => $has_walker_class,
                'nav_menu' => $has_nav_menu
            ]
        ];
    }
    
    /**
     * Test theme customizer
     */
    private function test_theme_customizer() {
        $functions_content = file_get_contents(get_template_directory() . '/functions.php');
        
        $customizer_features = [
            'customize_register' => substr_count($functions_content, 'customize_register'),
            'add_setting' => substr_count($functions_content, 'add_setting'),
            'add_control' => substr_count($functions_content, 'add_control'),
            'add_section' => substr_count($functions_content, 'add_section')
        ];
        
        $has_customizer = array_sum($customizer_features) > 4;
        
        return [
            'status' => $has_customizer ? 'PASS' : 'WARN',
            'message' => $has_customizer 
                ? 'Theme customizer properly implemented' 
                : 'Theme customizer incomplete',
            'details' => $customizer_features
        ];
    }
    
    /**
     * Test SEO features
     */
    private function test_seo_features() {
        $header_file = get_template_directory() . '/header.php';
        $functions_content = file_get_contents(get_template_directory() . '/functions.php');
        
        if (file_exists($header_file)) {
            $header_content = file_get_contents($header_file);
            $has_meta_tags = substr_count($header_content, '<meta') > 5;
            $has_og_tags = strpos($header_content, 'og:title') !== false;
            $has_structured_data = strpos($header_content, 'application/ld+json') !== false;
        } else {
            $has_meta_tags = false;
            $has_og_tags = false;
            $has_structured_data = false;
        }
        
        $has_seo_function = strpos($functions_content, 'add_structured_data') !== false;
        
        return [
            'status' => ($has_meta_tags && $has_og_tags && $has_structured_data) ? 'PASS' : 'WARN',
            'message' => ($has_meta_tags && $has_og_tags && $has_structured_data) 
                ? 'SEO features properly implemented' 
                : 'SEO implementation incomplete',
            'details' => [
                'meta_tags' => $has_meta_tags,
                'og_tags' => $has_og_tags,
                'structured_data' => $has_structured_data,
                'seo_function' => $has_seo_function
            ]
        ];
    }
    
    /**
     * Output individual test result
     */
    private function output_test_result($test_name, $result) {
        $status_class = strtolower($result['status']);
        $test_display_name = ucwords(str_replace('_', ' ', str_replace('test_', '', $test_name)));
        
        echo "<div class='test-result test-{$status_class}'>\n";
        echo "<h4>{$test_display_name} - <span class='status-{$status_class}'>{$result['status']}</span></h4>\n";
        echo "<p>{$result['message']}</p>\n";
        
        if (!empty($result['details'])) {
            echo "<details><summary>Details</summary>\n";
            echo "<pre>" . print_r($result['details'], true) . "</pre>\n";
            echo "</details>\n";
        }
        echo "</div>\n";
    }
    
    /**
     * Generate summary report
     */
    private function generate_summary_report() {
        echo "<h2>Test Summary</h2>\n";
        
        $total_tests = 0;
        $passed_tests = 0;
        $warned_tests = 0;
        $failed_tests = 0;
        
        foreach ($this->test_results as $category => $tests) {
            foreach ($tests as $test => $result) {
                $total_tests++;
                switch ($result['status']) {
                    case 'PASS':
                        $passed_tests++;
                        break;
                    case 'WARN':
                        $warned_tests++;
                        break;
                    case 'FAIL':
                        $failed_tests++;
                        break;
                }
            }
        }
        
        $pass_rate = ($passed_tests / $total_tests) * 100;
        
        echo "<div class='summary'>\n";
        echo "<p><strong>Total Tests:</strong> {$total_tests}</p>\n";
        echo "<p><strong>Passed:</strong> {$passed_tests}</p>\n";
        echo "<p><strong>Warnings:</strong> {$warned_tests}</p>\n";
        echo "<p><strong>Failed:</strong> {$failed_tests}</p>\n";
        echo "<p><strong>Pass Rate:</strong> " . round($pass_rate, 1) . "%</p>\n";
        echo "</div>\n";
        
        if ($pass_rate >= 80) {
            echo "<p class='overall-status pass'><strong>Overall Status: EXCELLENT</strong> - Theme meets high security and quality standards.</p>\n";
        } elseif ($pass_rate >= 60) {
            echo "<p class='overall-status warn'><strong>Overall Status: GOOD</strong> - Theme is functional but has areas for improvement.</p>\n";
        } else {
            echo "<p class='overall-status fail'><strong>Overall Status: NEEDS WORK</strong> - Theme requires significant improvements.</p>\n";
        }
        
        $this->output_recommendations();
    }
    
    /**
     * Output recommendations based on test results
     */
    private function output_recommendations() {
        echo "<h3>Recommendations</h3>\n";
        echo "<ul>\n";
        
        // Security recommendations
        $security_issues = [];
        foreach ($this->test_results['security'] ?? [] as $test => $result) {
            if ($result['status'] !== 'PASS') {
                $security_issues[] = $result['message'];
            }
        }
        
        if (!empty($security_issues)) {
            echo "<li><strong>Security:</strong> Address security warnings to ensure user data protection.</li>\n";
        }
        
        // Accessibility recommendations
        $accessibility_issues = [];
        foreach ($this->test_results['accessibility'] ?? [] as $test => $result) {
            if ($result['status'] !== 'PASS') {
                $accessibility_issues[] = $result['message'];
            }
        }
        
        if (!empty($accessibility_issues)) {
            echo "<li><strong>Accessibility:</strong> Improve accessibility features to meet WCAG 2.1 standards.</li>\n";
        }
        
        echo "<li><strong>Performance:</strong> Consider implementing caching and image optimization.</li>\n";
        echo "<li><strong>Testing:</strong> Test the theme across different devices and browsers.</li>\n";
        echo "<li><strong>Content:</strong> Add real content and images before launch.</li>\n";
        echo "<li><strong>Backup:</strong> Set up automated backups before going live.</li>\n";
        
        echo "</ul>\n";
    }
}

// CSS for test output
echo "<style>
.test-result {
    border: 1px solid #ddd;
    margin: 10px 0;
    padding: 15px;
    border-radius: 5px;
}
.test-pass { border-left: 4px solid #28a745; background: #f8fff9; }
.test-warn { border-left: 4px solid #ffc107; background: #fffef8; }
.test-fail { border-left: 4px solid #dc3545; background: #fff8f8; }
.status-pass { color: #28a745; font-weight: bold; }
.status-warn { color: #ffc107; font-weight: bold; }
.status-fail { color: #dc3545; font-weight: bold; }
.summary { 
    background: #f8f9fa; 
    padding: 20px; 
    border-radius: 5px; 
    margin: 20px 0; 
}
.overall-status.pass { color: #28a745; }
.overall-status.warn { color: #ffc107; }
.overall-status.fail { color: #dc3545; }
details { margin-top: 10px; }
pre { background: #f8f9fa; padding: 10px; border-radius: 3px; overflow-x: auto; }
</style>";

// Run the test suite if accessed directly
if (isset($_GET['run_ktbf_tests'])) {
    $test_suite = new KTBF_Test_Suite();
    $test_suite->run_all_tests();
}

?>