<?php
/**
 * The main homepage template for KTBF
 * King of Thailand Birthplace Foundation - 2027 Centennial Website
 * 
 * This template showcases the foundation's mission, upcoming centennial event,
 * and provides easy access to key sections of the website.
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero-section" role="banner" aria-label="Welcome to KTBF">
    <div class="container">
        <div class="hero-content">
            <div class="centennial-badge" role="img" aria-label="2027 Centennial Celebration">
                <?php echo esc_html(get_theme_mod('centennial_date', 'December 3-7, 2027')); ?> Centennial
            </div>
            
            <h1 class="hero-title">
                King of Thailand Birthplace Foundation
                <span class="visually-hidden">celebrating the centennial of His Majesty King Bhumibol Adulyadej</span>
            </h1>
            
            <p class="hero-subtitle">
                Preserving Thai royal heritage in Massachusetts and honoring the legacy of 
                His Majesty King Bhumibol Adulyadej through education, public health, and cultural preservation.
            </p>
            
            <div class="hero-buttons">
                <a href="#centennial-event" class="btn btn-primary btn-lg" aria-describedby="centennial-description">
                    <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                    2027 Centennial Event
                </a>
                <a href="#donate" class="btn btn-secondary btn-lg" aria-describedby="donation-description">
                    <i class="fas fa-heart" aria-hidden="true"></i>
                    Support Our Mission
                </a>
            </div>
            
            <!-- Hidden descriptions for screen readers -->
            <div id="centennial-description" class="visually-hidden">
                Learn about our upcoming centennial celebration symposium and concert
            </div>
            <div id="donation-description" class="visually-hidden">
                Support KTBF's mission through donations to our various funds
            </div>
        </div>
    </div>
</section>

<!-- Mission Statement Section -->
<section class="main-content" id="mission" aria-label="Our Mission">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title">Our Mission</h2>
                <div class="lead text-center mb-5">
                    KTBF's mission is to keep alive the legacies of Prince Mahidol and His Majesty King 
                    Bhumibol Adulyadej and to pay forward their good deeds through historical preservation, 
                    cultural promotion, and support for public health and education.
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-content">
                        <i class="fas fa-landmark fa-3x text-primary mb-3" aria-hidden="true"></i>
                        <h3 class="card-title">Historical Preservation</h3>
                        <p class="card-excerpt">
                            Maintaining 14 historic sites across Massachusetts, New Hampshire, and New York 
                            that commemorate the royal family's time in America from 1916-1928.
                        </p>
                        <a href="/trail-of-thai-royalty" class="btn btn-outline">
                            Explore the Trail <span class="visually-hidden">of Thai Royalty</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-content">
                        <i class="fas fa-graduation-cap fa-3x text-primary mb-3" aria-hidden="true"></i>
                        <h3 class="card-title">Education & Scholarships</h3>
                        <p class="card-excerpt">
                            Supporting Thai students through our Thai Scholars Fellowship Fund at Harvard T.H. Chan 
                            School of Public Health and other educational initiatives.
                        </p>
                        <a href="/thai-scholars-program" class="btn btn-outline">
                            Learn About Scholarships <span class="visually-hidden">program</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-content">
                        <i class="fas fa-heartbeat fa-3x text-primary mb-3" aria-hidden="true"></i>
                        <h3 class="card-title">Public Health Legacy</h3>
                        <p class="card-excerpt">
                            Continuing Prince Mahidol's medical legacy through symposiums at Harvard Medical School 
                            and the Mount Auburn Memorial Fund supporting mothers and children.
                        </p>
                        <a href="/public-health-initiatives" class="btn btn-outline">
                            View Health Programs <span class="visually-hidden">and initiatives</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Centennial Event Highlight -->
<section id="centennial-event" class="donation-section" aria-label="2027 Centennial Event">
    <div class="container">
        <h2 class="section-title">2027 Centennial Celebration</h2>
        
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <h3>A Historic Milestone</h3>
                <p class="mb-4">
                    Join us in December 2027 as we commemorate the 100th anniversary of His Majesty 
                    King Bhumibol Adulyadej's birth at Mount Auburn Hospital in Cambridge, Massachusetts. 
                    This historic celebration will feature a multi-day symposium, concert, and community events.
                </p>
                
                <div class="event-highlights mb-4">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="event-highlight-item">
                                <i class="fas fa-users fa-2x text-secondary mb-2" aria-hidden="true"></i>
                                <h4>Medical Symposium</h4>
                                <p>International experts discussing public health advancements</p>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="event-highlight-item">
                                <i class="fas fa-music fa-2x text-secondary mb-2" aria-hidden="true"></i>
                                <h4>Memorial Concert</h4>
                                <p>Musical tribute celebrating His Majesty's artistic legacy</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="event-buttons">
                    <a href="/centennial-event" class="btn btn-primary">
                        Full Event Details <span class="visually-hidden">about the centennial celebration</span>
                    </a>
                    <a href="#registration" class="btn btn-outline">
                        Register Now <span class="visually-hidden">for the centennial event</span>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="event-info-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/king-portrait.jpg" 
                         alt="Portrait of His Majesty King Bhumibol Adulyadej" 
                         class="img-fluid rounded"
                         loading="lazy">
                    
                    <div class="event-details mt-4">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="event-stat">
                                    <h4 class="text-primary">100</h4>
                                    <p>Years Since Birth</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="event-stat">
                                    <h4 class="text-primary">5</h4>
                                    <p>Days of Events</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="event-stat">
                                    <h4 class="text-primary">14</h4>
                                    <p>Historic Sites</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent News and Updates -->
<section class="main-content" id="news" aria-label="Latest News">
    <div class="container">
        <h2 class="section-title">Latest News & Updates</h2>
        
        <div class="row">
            <?php
            // Query recent posts and events
            $recent_posts = new WP_Query(array(
                'post_type' => array('post', 'ktbf_event'),
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'featured_on_homepage',
                        'value' => '1',
                        'compare' => '='
                    ),
                    array(
                        'key' => 'featured_on_homepage',
                        'compare' => 'NOT EXISTS'
                    )
                )
            ));
            
            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    $post_type_obj = get_post_type_object(get_post_type());
                    $type_label = $post_type_obj ? $post_type_obj->labels->singular_name : 'Post';
            ?>
                <div class="col-md-4 mb-4">
                    <article class="card h-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" 
                                 alt="<?php echo esc_attr(get_the_title()); ?>" 
                                 class="card-image"
                                 loading="lazy">
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="post-type"><?php echo esc_html($type_label); ?></span>
                                <span class="post-date">
                                    <time datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </span>
                            </div>
                            
                            <h3 class="card-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <p class="card-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </p>
                            
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm">
                                Read More <span class="visually-hidden">about <?php the_title(); ?></span>
                            </a>
                        </div>
                    </article>
                </div>
            <?php 
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="col-12">
                    <p class="text-center">No recent news available. Check back soon for updates!</p>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="/news" class="btn btn-primary">
                View All News <span class="visually-hidden">and updates</span>
            </a>
        </div>
    </div>
</section>

<!-- Support/Donation Section -->
<section id="donate" class="donation-section" aria-label="Support Our Mission">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Support Our Mission</h2>
                <p class="lead mb-5">
                    Your generous contributions help us preserve Thai royal heritage, support education, 
                    and continue the legacy of service established by Prince Mahidol and His Majesty King Bhumibol.
                </p>
            </div>
        </div>
        
        <div class="fund-options">
            <div class="fund-option" data-fund="mount-auburn">
                <i class="fas fa-baby fa-3x text-primary mb-3" aria-hidden="true"></i>
                <h3>Mount Auburn Memorial Fund</h3>
                <p>Supporting underprivileged mothers delivering babies at Mount Auburn Hospital, 
                reflecting His Majesty's compassion for mothers and children.</p>
                <div class="fund-amount">$100,000 Endowed</div>
            </div>
            
            <div class="fund-option" data-fund="thai-scholars">
                <i class="fas fa-user-graduate fa-3x text-primary mb-3" aria-hidden="true"></i>
                <h3>Thai Scholars Fellowship Fund</h3>
                <p>Enabling Thai professionals and students to pursue advanced studies at Harvard T.H. Chan 
                School of Public Health.</p>
                <div class="fund-amount">Ongoing Support Needed</div>
            </div>
            
            <div class="fund-option" data-fund="operations">
                <i class="fas fa-hands-helping fa-3x text-primary mb-3" aria-hidden="true"></i>
                <h3>KTBF Operations Fund</h3>
                <p>Supporting the foundation's daily operations, website maintenance, and preservation 
                activities across all historic sites.</p>
                <div class="fund-amount">General Support</div>
            </div>
            
            <div class="fund-option" data-fund="centennial">
                <i class="fas fa-calendar-star fa-3x text-primary mb-3" aria-hidden="true"></i>
                <h3>2027 Centennial Fund</h3>
                <p>Help make the centennial celebration a memorable tribute worthy of His Majesty's 
                legacy and impact on public health and education.</p>
                <div class="fund-amount">Event Support</div>
            </div>
        </div>
        
        <div class="text-center">
            <a href="/donate" class="btn btn-primary btn-lg">
                <i class="fas fa-heart" aria-hidden="true"></i>
                Make a Donation <span class="visually-hidden">to support KTBF</span>
            </a>
            <p class="mt-3 text-muted">
                <small>KTBF is a 501(c)(3) non-profit organization. All donations are tax-deductible.</small>
            </p>
        </div>
    </div>
</section>

<!-- Quick Registration CTA -->
<section id="registration" class="main-content bg-light" aria-label="Event Registration">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2>Reserve Your Place in History</h2>
                <p class="lead mb-0">
                    Be part of this momentous centennial celebration. Registration is now open for the 
                    2027 symposium, concert, and related events.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/register" class="btn btn-primary btn-lg">
                    Register Now <span class="visually-hidden">for the centennial event</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>