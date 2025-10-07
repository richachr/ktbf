<?php
/**
 * The template for displaying the footer
 * Contains the closing of the main content area and footer elements
 */
?>

</main><!-- #main -->

<!-- Site Footer -->
<footer class="site-footer" role="contentinfo">
    <div class="container">
        <!-- Footer Widgets Area -->
        <div class="footer-content">
            <div class="footer-column">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4>About KTBF</h4>
                        <p>The King of Thailand Birthplace Foundation preserves Thai royal heritage in Massachusetts and supports education and public health initiatives.</p>
                        <?php if (has_custom_logo()) : ?>
                            <div class="footer-logo">
                                <?php the_custom_logo(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="footer-column">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4>Quick Links</h4>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'container'      => 'nav',
                            'depth'          => 1,
                            'fallback_cb'    => 'ktbf_footer_menu_fallback',
                        ));
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="footer-column">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4>Contact Us</h4>
                        <address>
                            <p>
                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                15 Given Drive<br>
                                Burlington, MA 01803-4761
                            </p>
                            <p>
                                <i class="fas fa-phone" aria-hidden="true"></i>
                                <a href="tel:+17813650083">(781) 365-0083</a>
                            </p>
                            <p>
                                <i class="fas fa-envelope" aria-hidden="true"></i>
                                <a href="mailto:ktbf@thailink.com">ktbf@thailink.com</a>
                            </p>
                        </address>
                        
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Facebook" title="Follow us on Facebook">
                                <i class="fab fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Twitter" title="Follow us on Twitter">
                                <i class="fab fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="YouTube" title="Visit our YouTube channel">
                                <i class="fab fa-youtube" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram" title="Follow us on Instagram">
                                <i class="fab fa-instagram" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> 
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php bloginfo('name'); ?>
                    </a>. 
                    <?php esc_html_e('All rights reserved.', 'ktbf'); ?>
                    <?php esc_html_e('501(c)(3) Non-Profit Organization', 'ktbf'); ?>
                </p>
                
                <nav class="footer-legal-menu" aria-label="<?php esc_attr_e('Legal and privacy links', 'ktbf'); ?>">
                    <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">
                        <?php esc_html_e('Privacy Policy', 'ktbf'); ?>
                    </a>
                    <span class="separator">|</span>
                    <a href="<?php echo esc_url(home_url('/terms')); ?>">
                        <?php esc_html_e('Terms of Use', 'ktbf'); ?>
                    </a>
                    <span class="separator">|</span>
                    <a href="<?php echo esc_url(home_url('/accessibility')); ?>">
                        <?php esc_html_e('Accessibility', 'ktbf'); ?>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="scroll-top" class="scroll-top-btn" aria-label="<?php esc_attr_e('Scroll to top', 'ktbf'); ?>" style="display: none;">
    <i class="fas fa-chevron-up" aria-hidden="true"></i>
</button>

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * Footer menu fallback function
 */
function ktbf_footer_menu_fallback() {
    echo '<ul class="footer-menu">';
    echo '<li><a href="' . esc_url(home_url('/about')) . '">' . esc_html__('About', 'ktbf') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">' . esc_html__('Contact', 'ktbf') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/donate')) . '">' . esc_html__('Donate', 'ktbf') . '</a></li>';
    echo '</ul>';
}
?>