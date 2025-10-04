# KTBF WordPress Theme - 2027 Centennial Celebration Website

## Overview

This is a custom WordPress theme built specifically for the King of Thailand Birthplace Foundation (KTBF) to support their 2027 Centennial Celebration of His Majesty King Bhumibol Adulyadej's birth. The theme prioritizes **security**, **accessibility**, and **user experience** while meeting all requirements outlined in the project proposal.

## 🏗️ Theme Architecture

### Core Features
- **Responsive Design**: Mobile-first approach with breakpoints at 768px and 480px
- **Accessibility**: WCAG 2.1 AA compliant with ARIA support
- **Security**: Multiple layers of protection against XSS, CSRF, and SQL injection
- **SEO Optimized**: Structured data, meta tags, and performance optimizations
- **Multilingual Ready**: Prepared for English/Thai translations
- **Performance Focused**: Optimized assets, lazy loading, and caching support

### Custom Post Types
- `ktbf_event` - Events and symposiums
- `ktbf_scholar` - Thai Scholars Program participants
- `ktbf_timeline` - Historical timeline events
- `ktbf_board` - Board members and advisors

### Custom Taxonomies
- `event_category` - Event categorization
- `scholar_field` - Academic fields of study

## 🔧 Installation & Setup

### Prerequisites
- WordPress 6.0 or higher
- PHP 8.0 or higher
- MySQL 5.7 or higher
- SSL certificate (required for secure donations)

### Step 1: Upload Theme Files
1. Create the theme directory structure on your AWS Lightsail WordPress instance:
```bash
/opt/bitnami/wordpress/wp-content/themes/ktbf/
├── functions.php
├── style.css
├── index.php
├── header.php
├── footer.php
├── assets/
│   ├── css/
│   │   └── responsive.css
│   ├── js/
│   │   └── main.js
│   └── images/
└── templates/
```

2. Upload all theme files to the `/opt/bitnami/wordpress/wp-content/themes/ktbf/` directory

### Step 2: Theme Activation
1. Log into WordPress admin dashboard
2. Navigate to **Appearance > Themes**
3. Activate the "KTBF Centennial" theme
4. Go to **Appearance > Customize** to configure color palette and settings

### Step 3: Required Plugins
Install and activate these recommended plugins:
- **Yoast SEO** or **RankMath** - Enhanced SEO features
- **Wordfence Security** - Additional security layer
- **WP Forms** - Advanced form handling
- **UpdraftPlus** - Automated backups
- **Polylang** (optional) - For Thai/English translations

### Step 4: Create Essential Pages
Create these pages with the specified templates:
- **Homepage** (uses `index.php`)
- **About Us** (`page-about.php`)
- **2027 Centennial Event** (`page-centennial.php`)
- **Programs** (`page-programs.php`)
- **Thai Scholars** (`page-scholars.php`)
- **Trail of Thai Royalty** (`page-trail.php`)
- **Donate** (`page-donate.php`)
- **Contact** (`page-contact.php`)
- **Privacy Policy** (for GDPR compliance)

### Step 5: Configure Navigation
1. Go to **Appearance > Menus**
2. Create a menu called "Primary Menu"
3. Assign it to the "Primary Menu" location
4. Add the essential pages in this order:
   - Home
   - About Us
   - 2027 Centennial
   - Programs
   - News
   - Donate
   - Contact

## 🎨 Color Palette Configuration

The theme uses CSS custom properties for easy color customization:

### Default Colors
```css
--primary-color: #0066cc;     /* Royal Blue */
--secondary-color: #ffcc00;   /* Thai Royal Gold */
--accent-color: #cc0000;      /* Thai Royal Red */
--text-color: #333333;        /* Dark Gray */
--background-color: #ffffff;  /* White */
```

### Customization Options
1. **WordPress Customizer**: Go to **Appearance > Customize > KTBF Color Palette**
2. **CSS Variables**: Modify the `:root` section in `style.css`
3. **Thai Royal Colors**: Consider using authentic Thai royal colors:
   - Gold: `#FFD700` or `#B8860B`
   - Red: `#DC143C` or `#8B0000`
   - Blue: `#000080` or `#191970`

## 🔒 Security Features

### Implementation Details
- **Nonce Verification**: All AJAX forms include WordPress nonces
- **Input Sanitization**: All user inputs are sanitized using WordPress functions
- **Output Escaping**: All dynamic content is properly escaped
- **Honeypot Protection**: Hidden fields catch spam bots
- **CSRF Protection**: Token-based form submissions
- **SQL Injection Prevention**: Uses WordPress database APIs exclusively
- **XSS Prevention**: All content filtered through wp_kses functions

### Security Headers
The theme automatically adds these security headers:
```php
X-Content-Type-Options: nosniff
X-Frame-Options: SAMEORIGIN
X-XSS-Protection: 1; mode=block
```

### Testing Security
Run the built-in test suite to verify security implementation:
```
https://your-site.com/?run_ktbf_tests
```

## ♿ Accessibility Features

### WCAG 2.1 AA Compliance
- **Skip Links**: "Skip to content" for keyboard users
- **ARIA Labels**: Comprehensive labeling for screen readers
- **Color Contrast**: High contrast mode support
- **Keyboard Navigation**: Full keyboard accessibility
- **Focus Management**: Visible focus indicators
- **Screen Reader Text**: Hidden descriptive text
- **Semantic HTML**: Proper heading hierarchy and landmarks

### Testing Accessibility
- Use **WAVE Web Accessibility Evaluator**
- Test with **NVDA** or **JAWS** screen readers
- Verify keyboard navigation (Tab, Enter, Escape, Arrow keys)
- Check color contrast ratios (minimum 4.5:1 for normal text)

## 📱 Responsive Design

### Breakpoints
- **Desktop**: 1200px+ (default)
- **Tablet**: 768px - 1199px
- **Mobile**: 320px - 767px

### Mobile Optimizations
- Touch-friendly button sizes (44px minimum)
- Simplified navigation with hamburger menu
- Optimized images with `loading="lazy"`
- Reduced motion support for accessibility

## 🚀 Performance Optimization

### Built-in Optimizations
- **CSS Grid & Flexbox**: Modern layout techniques
- **Lazy Loading**: Images load only when visible
- **Minification Ready**: Compressed CSS/JS in production
- **CDN Support**: External resources from reliable CDNs
- **Caching Headers**: Proper cache control headers

### Recommended Optimizations
1. Install **WP Rocket** or **W3 Total Cache**
2. Use **WebP** images where supported
3. Enable **Gzip compression**
4. Configure **CloudFlare** CDN
5. Optimize database with **WP-Optimize**

## 📊 Analytics & Tracking

### Google Analytics Setup
1. Get your Google Analytics 4 tracking ID
2. Replace `YOUR_GA_ID` in `assets/js/main.js`
3. Configure cookie consent for GDPR compliance

### Event Tracking
The theme automatically tracks:
- Donation attempts
- Registration attempts  
- Outbound link clicks
- File downloads
- Form submissions

## 💰 Donation System Integration

### Supported Payment Gateways
- **Stripe**: Recommended for international donations
- **PayPal**: Alternative payment option
- **GiveWP**: WordPress donation plugin integration
- **Custom Integration**: Modify AJAX handlers in `functions.php`

### Fund Types
- Mount Auburn Memorial Fund
- Thai Scholars Fellowship Fund
- KTBF Operations Fund
- 2027 Centennial Fund

### Implementation Steps
1. Set up payment gateway accounts
2. Install payment gateway plugins
3. Configure webhook endpoints
4. Test donation flow thoroughly
5. Set up automated receipts

## 📧 Email Integration

### Automated Emails
- Donation confirmations
- Event registration confirmations
- Newsletter subscriptions
- Contact form submissions

### Recommended Services
- **Mailgun**: Reliable transactional emails
- **SendGrid**: High deliverability
- **Amazon SES**: Cost-effective option
- **WordPress SMTP**: Plugin-based solution

## 🌐 Multilingual Setup (Optional)

### Using Polylang Plugin
1. Install and activate Polylang
2. Configure languages: English (default), Thai
3. Translate theme strings using `__('text', 'ktbf')`
4. Create translated versions of pages
5. Configure language switcher in header

### Translation Files
Create `.po/.mo` files for:
- Theme strings
- Custom post type labels
- Form validation messages
- Email templates

## 🧪 Testing Checklist

### Before Launch
- [ ] Run security test suite
- [ ] Test all forms (donation, registration, contact)
- [ ] Verify responsive design on multiple devices
- [ ] Check accessibility with screen reader
- [ ] Test payment processing (use test mode)
- [ ] Validate HTML/CSS
- [ ] Check page load speeds
- [ ] Test email deliverability
- [ ] Verify SSL certificate
- [ ] Set up Google Analytics
- [ ] Configure backup system
- [ ] Test contact forms
- [ ] Verify SEO meta tags

### Content Testing
- [ ] Add sample events
- [ ] Create scholar profiles
- [ ] Upload timeline content
- [ ] Test image galleries
- [ ] Verify social sharing
- [ ] Check search functionality

## 📝 Content Management

### Adding Events
1. Go to **Events > Add New**
2. Fill in event details
3. Set featured image (recommended: 800x400px)
4. Assign to event category
5. Set event date and location using custom fields

### Managing Scholars
1. Navigate to **Thai Scholars > Add New**
2. Add scholar bio and photo
3. Set field of study taxonomy
4. Include graduation year and current position

### Timeline Updates
1. Go to **Timeline Events > Add New**
2. Set event date in custom field
3. Add description and images
4. Order by date for proper display

## 🔧 Customization Guide

### Adding Custom Fields
```php
// Add to functions.php
add_action('add_meta_boxes', 'ktbf_add_meta_boxes');

function ktbf_add_meta_boxes() {
    add_meta_box(
        'event_details',
        'Event Details',
        'ktbf_event_details_callback',
        'ktbf_event'
    );
}
```

### Modifying Colors
Edit CSS variables in `style.css`:
```css
:root {
    --primary-color: #YOUR_COLOR;
    --secondary-color: #YOUR_COLOR;
    --accent-color: #YOUR_COLOR;
}
```

### Adding New Page Templates
1. Create `page-template-name.php`
2. Add template header:
```php
<?php
/*
Template Name: Your Template Name
*/
get_header();
// Your custom content
get_footer();
?>
```

## 🚨 Troubleshooting

### Common Issues

**Theme not activating:**
- Check PHP version (8.0+ required)
- Verify all files uploaded correctly
- Check WordPress error logs

**Forms not submitting:**
- Verify AJAX URLs in JavaScript
- Check nonce implementation
- Test with debugging enabled

**Styling issues:**
- Clear browser cache
- Check CSS file paths
- Verify CDN resources load correctly

**Performance problems:**
- Enable caching plugin
- Optimize images
- Check for plugin conflicts

### Debug Mode
Enable WordPress debugging in `wp-config.php`:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

## 📞 Support & Maintenance

### Regular Maintenance Tasks
- **Weekly**: Update plugins and WordPress core
- **Monthly**: Review security logs and performance
- **Quarterly**: Full backup and disaster recovery test
- **Annually**: Security audit and accessibility review

### Monitoring
Set up monitoring for:
- Site uptime (UptimeRobot)
- Performance (GTmetrix)
- Security (Wordfence)
- Broken links (Broken Link Checker)

### Documentation Updates
Keep documentation current when making changes:
- Update README for new features
- Document customizations
- Maintain changelog
- Update user manuals

## 🤝 Contributing

### Development Workflow
1. Create feature branch from `main`
2. Make changes following coding standards
3. Test thoroughly using test suite
4. Submit pull request with description
5. Review and merge after approval

### Coding Standards
- Follow [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- Use proper indentation (4 spaces)
- Comment complex functions
- Sanitize all inputs
- Escape all outputs

## 📄 License & Credits

### License
This theme is licensed under GPL v2 or later.

### Credits
- **Development Team**: Curtis Hoffmann, Christian Richardson, Elijah Pearce
- **Advisors**: Dr. Rangsun Sittichai, Cholthanee Koerojna
- **Inspiration**: Nobel Prize, Rockefeller Foundation, Harvard T.H. Chan School websites
- **Framework**: WordPress, Bootstrap 5, Font Awesome

### Third-Party Resources
- Bootstrap CSS Framework
- Font Awesome Icons
- Google Fonts (if used)
- Various WordPress functions and hooks

---

## 🎯 Launch Timeline

### Phase 1: Development (September-October 2025)
- [x] Theme development
- [x] Security implementation
- [x] Accessibility features
- [x] Testing suite creation

### Phase 2: Content & Testing (November-December 2025)
- [ ] Content creation and migration
- [ ] User acceptance testing
- [ ] Security audit
- [ ] Performance optimization

### Phase 3: Launch (December 13, 2025)
- [ ] Final pre-launch checklist
- [ ] DNS configuration
- [ ] SSL certificate installation
- [ ] Go-live deployment
- [ ] Post-launch monitoring

---

*This documentation was created for the King of Thailand Birthplace Foundation's 2027 Centennial Celebration website. For technical support, contact the development team.*