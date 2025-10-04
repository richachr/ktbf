/**
 * KTBF Main JavaScript
 * Handles interactive functionality for the King of Thailand Birthplace Foundation website
 * Built with security, accessibility, and performance in mind
 */

(function($) {
    'use strict';

    /**
     * Main KTBF object to namespace our functionality
     * Prevents global namespace pollution and provides organized structure
     */
    const KTBF = {
        
        /**
         * Initialize all functionality when DOM is ready
         * Sets up event listeners and initial state
         */
        init: function() {
            this.setupNavigation();
            this.setupForms();
            this.setupDonationHandler();
            this.setupRegistrationHandler();
            this.setupTimeline();
            this.setupImageLazyLoading();
            this.setupAccessibilityFeatures();
            this.setupAnalytics();
        },

        /**
         * Mobile Navigation Setup
         * Handles responsive navigation menu with accessibility support
         */
        setupNavigation: function() {
            const mobileToggle = $('.mobile-menu-toggle');
            const navMenu = $('.nav-menu');
            
            // Toggle mobile menu
            mobileToggle.on('click', function(e) {
                e.preventDefault();
                navMenu.toggleClass('active');
                
                // Update ARIA attributes for screen readers
                const isExpanded = navMenu.hasClass('active');
                $(this).attr('aria-expanded', isExpanded);
                
                // Change icon
                const icon = $(this).find('i');
                if (isExpanded) {
                    icon.removeClass('fa-bars').addClass('fa-times');
                } else {
                    icon.removeClass('fa-times').addClass('fa-bars');
                }
            });

            // Close menu when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.primary-navigation').length) {
                    navMenu.removeClass('active');
                    mobileToggle.attr('aria-expanded', 'false');
                    mobileToggle.find('i').removeClass('fa-times').addClass('fa-bars');
                }
            });

            // Close menu on escape key
            $(document).on('keydown', function(e) {
                if (e.keyCode === 27 && navMenu.hasClass('active')) {
                    navMenu.removeClass('active');
                    mobileToggle.attr('aria-expanded', 'false').focus();
                }
            });

            // Smooth scrolling for anchor links
            $('a[href^="#"]').on('click', function(e) {
                const target = $(this.getAttribute('href'));
                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 600);
                }
            });
        },

        /**
         * Form Enhancement
         * Adds validation, styling, and security features to forms
         */
        setupForms: function() {
            // Real-time form validation
            $('.form-control').on('blur', function() {
                this.validateField($(this));
            }.bind(this));

            // Form submission handling
            $('form').on('submit', function(e) {
                const form = $(this);
                let isValid = true;

                // Validate all fields
                form.find('.form-control').each(function() {
                    if (!this.validateField($(this))) {
                        isValid = false;
                    }
                }.bind(this));

                if (!isValid) {
                    e.preventDefault();
                    this.showMessage('Please correct the errors below.', 'error');
                }
            }.bind(this));

            // Honeypot spam protection
            this.setupHoneypot();
        },

        /**
         * Field Validation
         * Validates individual form fields with real-time feedback
         * @param {jQuery} field - The field to validate
         * @returns {boolean} - Whether the field is valid
         */
        validateField: function(field) {
            const value = field.val().trim();
            const type = field.attr('type') || 'text';
            const required = field.prop('required');
            let isValid = true;
            let message = '';

            // Remove existing validation classes
            field.removeClass('is-valid is-invalid');
            field.siblings('.invalid-feedback').remove();

            // Required field check
            if (required && !value) {
                isValid = false;
                message = 'This field is required.';
            }

            // Type-specific validation
            if (value && isValid) {
                switch (type) {
                    case 'email':
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(value)) {
                            isValid = false;
                            message = 'Please enter a valid email address.';
                        }
                        break;
                    
                    case 'tel':
                        const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
                        if (!phoneRegex.test(value.replace(/\s|-|\(|\)/g, ''))) {
                            isValid = false;
                            message = 'Please enter a valid phone number.';
                        }
                        break;
                    
                    case 'url':
                        try {
                            new URL(value);
                        } catch {
                            isValid = false;
                            message = 'Please enter a valid URL.';
                        }
                        break;
                }
            }

            // Update field appearance
            if (isValid) {
                field.addClass('is-valid');
            } else {
                field.addClass('is-invalid');
                field.after('<div class="invalid-feedback">' + message + '</div>');
            }

            return isValid;
        },

        /**
         * Honeypot Spam Protection
         * Adds invisible fields to catch bots
         */
        setupHoneypot: function() {
            $('form').each(function() {
                const honeypot = $('<input>')
                    .attr({
                        type: 'text',
                        name: 'website_url',
                        tabindex: '-1',
                        autocomplete: 'off'
                    })
                    .css({
                        position: 'absolute',
                        left: '-9999px',
                        width: '1px',
                        height: '1px',
                        opacity: '0'
                    });
                
                $(this).prepend(honeypot);
            });
        },

        /**
         * Donation Form Handler
         * Securely processes donation form submissions
         */
        setupDonationHandler: function() {
            // Amount button selection
            $(document).on('click', '.amount-btn', function() {
                $('.amount-btn').removeClass('selected');
                $(this).addClass('selected');
                $('#donation-amount').val($(this).data('amount'));
            });

            // Custom amount input
            $('#donation-amount').on('input', function() {
                $('.amount-btn').removeClass('selected');
                const amount = parseFloat($(this).val());
                if (amount > 0) {
                    $(this).addClass('is-valid').removeClass('is-invalid');
                }
            });

            // Fund selection
            $(document).on('click', '.fund-option', function() {
                $('.fund-option').removeClass('selected');
                $(this).addClass('selected');
                $('#fund-type').val($(this).data('fund'));
            });

            // Donation form submission
            $('#donation-form').on('submit', function(e) {
                e.preventDefault();
                
                // Check honeypot
                if ($('input[name="website_url"]').val() !== '') {
                    return false; // Likely spam
                }

                const formData = {
                    action: 'ktbf_donate',
                    nonce: ktbf_ajax.nonce,
                    amount: $('#donation-amount').val(),
                    donor_name: $('#donor-name').val(),
                    donor_email: $('#donor-email').val(),
                    fund_type: $('#fund-type').val(),
                    message: $('#donation-message').val()
                };

                // Show loading state
                const submitBtn = $(this).find('[type="submit"]');
                const originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Processing...');

                // Submit via AJAX
                $.post(ktbf_ajax.ajax_url, formData)
                    .done(function(response) {
                        if (response.success) {
                            this.showMessage(response.data, 'success');
                            $('#donation-form')[0].reset();
                            $('.fund-option, .amount-btn').removeClass('selected');
                        } else {
                            this.showMessage(response.data || 'An error occurred. Please try again.', 'error');
                        }
                    }.bind(this))
                    .fail(function() {
                        this.showMessage('Network error. Please check your connection and try again.', 'error');
                    }.bind(this))
                    .always(function() {
                        submitBtn.prop('disabled', false).text(originalText);
                    });
            }.bind(this));
        },

        /**
         * Event Registration Handler
         * Manages centennial event registration process
         */
        setupRegistrationHandler: function() {
            // Event selection checkboxes
            $('.event-checkbox').on('change', function() {
                const selectedEvents = $('.event-checkbox:checked').length;
                const maxEvents = 5; // Limit to prevent spam
                
                if (selectedEvents > maxEvents) {
                    $(this).prop('checked', false);
                    this.showMessage(`You can select up to ${maxEvents} events.`, 'warning');
                }
            }.bind(this));

            // Registration form submission
            $('#registration-form').on('submit', function(e) {
                e.preventDefault();
                
                // Check honeypot
                if ($('input[name="website_url"]').val() !== '') {
                    return false; // Likely spam
                }

                const selectedEvents = [];
                $('.event-checkbox:checked').each(function() {
                    selectedEvents.push($(this).val());
                });

                if (selectedEvents.length === 0) {
                    this.showMessage('Please select at least one event.', 'error');
                    return;
                }

                const formData = {
                    action: 'ktbf_register',
                    nonce: ktbf_ajax.nonce,
                    first_name: $('#first-name').val(),
                    last_name: $('#last-name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    affiliation: $('#affiliation').val(),
                    events: selectedEvents
                };

                // Show loading state
                const submitBtn = $(this).find('[type="submit"]');
                const originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Registering...');

                // Submit via AJAX
                $.post(ktbf_ajax.ajax_url, formData)
                    .done(function(response) {
                        if (response.success) {
                            this.showMessage(response.data, 'success');
                            $('#registration-form')[0].reset();
                            $('.event-checkbox').prop('checked', false);
                        } else {
                            this.showMessage(response.data || 'Registration failed. Please try again.', 'error');
                        }
                    }.bind(this))
                    .fail(function() {
                        this.showMessage('Network error. Please check your connection and try again.', 'error');
                    }.bind(this))
                    .always(function() {
                        submitBtn.prop('disabled', false).text(originalText);
                    });
            }.bind(this));
        },

        /**
         * Timeline Animation
         * Animates timeline elements as they come into view
         */
        setupTimeline: function() {
            const timelineItems = $('.timeline-item');
            
            if (timelineItems.length === 0) return;

            // Intersection Observer for scroll animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        $(entry.target).addClass('animate-in');
                    }
                });
            }, {
                threshold: 0.2,
                rootMargin: '50px'
            });

            timelineItems.each(function() {
                observer.observe(this);
            });
        },

        /**
         * Lazy Loading for Images
         * Improves performance by loading images only when needed
         */
        setupImageLazyLoading: function() {
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            img.classList.add('loaded');
                            observer.unobserve(img);
                        }
                    });
                });

                $('.lazy').each(function() {
                    imageObserver.observe(this);
                });
            }
        },

        /**
         * Accessibility Features
         * Enhances keyboard navigation and screen reader support
         */
        setupAccessibilityFeatures: function() {
            // Skip link functionality
            $('.skip-link').on('click', function(e) {
                e.preventDefault();
                const target = $($(this).attr('href'));
                if (target.length) {
                    target.attr('tabindex', '-1').focus();
                }
            });

            // Focus management for modal dialogs
            $(document).on('keydown', function(e) {
                // Escape key closes modals
                if (e.keyCode === 27) {
                    $('.modal.show').modal('hide');
                }
            });

            // Announce dynamic content changes to screen readers
            this.setupLiveRegions();
        },

        /**
         * Live Regions for Screen Reader Announcements
         * Creates ARIA live regions for dynamic content updates
         */
        setupLiveRegions: function() {
            if ($('#live-region').length === 0) {
                $('body').append(
                    '<div id="live-region" aria-live="polite" aria-atomic="true" class="visually-hidden"></div>'
                );
            }
        },

        /**
         * Show Message to User
         * Displays feedback messages with proper accessibility support
         * @param {string} message - The message to display
         * @param {string} type - The type of message (success, error, warning, info)
         */
        showMessage: function(message, type = 'info') {
            // Remove existing messages
            $('.alert').fadeOut(300, function() {
                $(this).remove();
            });

            // Create new message
            const alertClass = `alert alert-${type === 'error' ? 'danger' : type}`;
            const icon = this.getAlertIcon(type);
            
            const alertHtml = `
                <div class="${alertClass} alert-dismissible fade show" role="alert">
                    <i class="${icon}" aria-hidden="true"></i>
                    <span class="alert-message">${message}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                </div>
            `;

            // Insert message at top of page
            $('body').prepend(alertHtml);
            
            // Announce to screen readers
            $('#live-region').text(message);
            
            // Auto-dismiss success messages
            if (type === 'success') {
                setTimeout(() => {
                    $('.alert').fadeOut(300, function() {
                        $(this).remove();
                    });
                }, 5000);
            }

            // Scroll to top to show message
            $('html, body').animate({ scrollTop: 0 }, 300);
        },

        /**
         * Get Alert Icon
         * Returns appropriate Font Awesome icon for message type
         * @param {string} type - The message type
         * @returns {string} - Font Awesome class
         */
        getAlertIcon: function(type) {
            const icons = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-triangle',
                warning: 'fas fa-exclamation-triangle',
                info: 'fas fa-info-circle'
            };
            return icons[type] || icons.info;
        },

        /**
         * Analytics Setup
         * Configures Google Analytics and custom event tracking
         */
        setupAnalytics: function() {
            // Track donation attempts
            $('#donation-form').on('submit', function() {
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'donation_attempt', {
                        event_category: 'engagement',
                        event_label: $('#fund-type').val()
                    });
                }
            });

            // Track registration attempts
            $('#registration-form').on('submit', function() {
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'registration_attempt', {
                        event_category: 'engagement',
                        event_label: 'centennial_event'
                    });
                }
            });

            // Track outbound links
            $('a[href^="http"]').not('[href*="' + window.location.hostname + '"]').on('click', function() {
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'click', {
                        event_category: 'outbound',
                        event_label: $(this).attr('href')
                    });
                }
            });

            // Track file downloads
            $('a[href$=".pdf"], a[href$=".doc"], a[href$=".docx"], a[href$=".zip"]').on('click', function() {
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'download', {
                        event_category: 'engagement',
                        event_label: $(this).attr('href')
                    });
                }
            });
        },

        /**
         * Scroll to Top Functionality
         * Adds smooth scroll to top button
         */
        setupScrollToTop: function() {
            // Create scroll to top button
            if ($('#scroll-top').length === 0) {
                $('body').append(`
                    <button id="scroll-top" class="scroll-top-btn" aria-label="Scroll to top" style="display: none;">
                        <i class="fas fa-chevron-up" aria-hidden="true"></i>
                    </button>
                `);
            }

            const scrollBtn = $('#scroll-top');

            // Show/hide based on scroll position
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    scrollBtn.fadeIn(300);
                } else {
                    scrollBtn.fadeOut(300);
                }
            });

            // Scroll to top on click
            scrollBtn.on('click', function() {
                $('html, body').animate({ scrollTop: 0 }, 600);
            });
        },

        /**
         * Search Functionality
         * Enhances site search with auto-complete and filtering
         */
        setupSearch: function() {
            const searchInput = $('.search-input');
            const searchResults = $('.search-results');
            let searchTimeout;

            searchInput.on('input', function() {
                const query = $(this).val().trim();
                
                clearTimeout(searchTimeout);
                
                if (query.length >= 3) {
                    searchTimeout = setTimeout(() => {
                        this.performSearch(query);
                    }, 300);
                } else {
                    searchResults.empty().hide();
                }
            }.bind(this));

            // Close search results when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-container').length) {
                    searchResults.hide();
                }
            });
        },

        /**
         * Perform Search
         * Executes search query and displays results
         * @param {string} query - Search query
         */
        performSearch: function(query) {
            const searchData = {
                action: 'ktbf_search',
                nonce: ktbf_ajax.nonce,
                query: query
            };

            $.post(ktbf_ajax.ajax_url, searchData)
                .done(function(response) {
                    if (response.success) {
                        this.displaySearchResults(response.data);
                    }
                }.bind(this))
                .fail(function() {
                    console.error('Search request failed');
                });
        },

        /**
         * Display Search Results
         * Renders search results in dropdown
         * @param {Array} results - Search results array
         */
        displaySearchResults: function(results) {
            const searchResults = $('.search-results');
            
            if (results.length === 0) {
                searchResults.html('<div class="no-results">No results found</div>').show();
                return;
            }

            let html = '';
            results.forEach(result => {
                html += `
                    <div class="search-result-item">
                        <h4><a href="${result.url}">${result.title}</a></h4>
                        <p class="search-excerpt">${result.excerpt}</p>
                        <span class="search-type">${result.type}</span>
                    </div>
                `;
            });

            searchResults.html(html).show();
        },

        /**
         * Cookie Consent Management
         * Handles GDPR compliance for cookies
         */
        setupCookieConsent: function() {
            if (localStorage.getItem('ktbf_cookie_consent') === null) {
                const consentBanner = `
                    <div id="cookie-consent" class="cookie-consent">
                        <div class="cookie-content">
                            <p>This website uses cookies to enhance your experience and analyze site usage. 
                            <a href="/privacy-policy" target="_blank">Learn more</a></p>
                            <div class="cookie-buttons">
                                <button id="accept-cookies" class="btn btn-primary">Accept All</button>
                                <button id="reject-cookies" class="btn btn-outline">Essential Only</button>
                            </div>
                        </div>
                    </div>
                `;
                
                $('body').append(consentBanner);

                $('#accept-cookies').on('click', function() {
                    localStorage.setItem('ktbf_cookie_consent', 'accepted');
                    $('#cookie-consent').fadeOut(300);
                    this.loadAnalytics();
                }.bind(this));

                $('#reject-cookies').on('click', function() {
                    localStorage.setItem('ktbf_cookie_consent', 'rejected');
                    $('#cookie-consent').fadeOut(300);
                });
            } else if (localStorage.getItem('ktbf_cookie_consent') === 'accepted') {
                this.loadAnalytics();
            }
        },

        /**
         * Load Analytics Scripts
         * Loads Google Analytics when consent is given
         */
        loadAnalytics: function() {
            if (typeof gtag === 'undefined') {
                // Load Google Analytics
                const script = document.createElement('script');
                script.async = true;
                script.src = 'https://www.googletagmanager.com/gtag/js?id=YOUR_GA_ID';
                document.head.appendChild(script);

                script.onload = function() {
                    window.dataLayer = window.dataLayer || [];
                    function gtag(){dataLayer.push(arguments);}
                    gtag('js', new Date());
                    gtag('config', 'YOUR_GA_ID', {
                        anonymize_ip: true,
                        respect_not_track: true
                    });
                };
            }
        },

        /**
         * Performance Optimization
         * Implements performance monitoring and optimization
         */
        setupPerformanceOptimization: function() {
            // Debounce scroll events
            let scrollTimer;
            $(window).on('scroll', function() {
                if (scrollTimer) {
                    clearTimeout(scrollTimer);
                }
                scrollTimer = setTimeout(function() {
                    // Scroll-dependent operations here
                    this.handleScroll();
                }.bind(this), 16); // ~60fps
            }.bind(this));

            // Preload critical resources
            this.preloadCriticalResources();
        },

        /**
         * Handle Scroll Events
         * Optimized scroll event handler
         */
        handleScroll: function() {
            const scrollTop = $(window).scrollTop();
            
            // Add scrolled class to header for styling
            if (scrollTop > 100) {
                $('.site-header').addClass('scrolled');
            } else {
                $('.site-header').removeClass('scrolled');
            }
        },

        /**
         * Preload Critical Resources
         * Preloads important resources for better performance
         */
        preloadCriticalResources: function() {
            const criticalResources = [
                '/wp-content/themes/ktbf/assets/images/hero-bg.jpg',
                '/wp-content/themes/ktbf/assets/images/king-portrait.jpg'
            ];

            criticalResources.forEach(resource => {
                const link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'image';
                link.href = resource;
                document.head.appendChild(link);
            });
        },

        /**
         * Error Handling
         * Global error handler for JavaScript errors
         */
        setupErrorHandling: function() {
            window.addEventListener('error', function(e) {
                console.error('JavaScript error:', e.error);
                
                // Send error to analytics if available
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'exception', {
                        description: e.error.message,
                        fatal: false
                    });
                }
            });

            // Handle AJAX errors
            $(document).ajaxError(function(event, xhr, settings, thrownError) {
                console.error('AJAX error:', thrownError);
                this.showMessage('A network error occurred. Please try again.', 'error');
            }.bind(this));
        }
    };

    /**
     * Document Ready
     * Initialize all functionality when DOM is loaded
     */
    $(document).ready(function() {
        KTBF.init();
        KTBF.setupScrollToTop();
        KTBF.setupSearch();
        KTBF.setupCookieConsent();
        KTBF.setupPerformanceOptimization();
        KTBF.setupErrorHandling();
    });

    /**
     * Window Load
     * Additional initialization after all resources are loaded
     */
    $(window).on('load', function() {
        // Remove loading overlay if present
        $('.loading-overlay').fadeOut(500);
        
        // Initialize any plugins that require full page load
        KTBF.setupImageLazyLoading();
    });

})(jQuery);