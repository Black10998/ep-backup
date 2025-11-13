<?php 
get_header(); 

// Get hero section fields
$hero_heading = ep_get_field( 'hero_heading', get_the_ID(), 'Ihr regionaler Fachbetrieb für<br><strong>Elektroinstallation &amp; Elektrotechnik</strong>' );
$hero_subheading = ep_get_field( 'hero_subheading', get_the_ID(), 'Verlassen Sie sich auf schnellen Sofortservice, echte Handwerksqualität und garantierte Termine – rund um die Uhr, auch am Wochenende.' );
$hero_intro = ep_get_field( 'hero_intro', get_the_ID(), 'Als Fachbetrieb für Elektro- und Installationsarbeiten bieten wir zuverlässige Lösungen, faire Preise und kurzfristige Termine. Bei Stromausfall, defekter Steckdose oder Sicherungsausfall sind wir schnell vor Ort – dank 24/7-Notdienst auch an Wochenenden und Feiertagen.' );
$hero_image = ep_get_field( 'hero_image', get_the_ID() );
$hero_features = ep_get_field( 'hero_features', get_the_ID() );

// Default features if ACF not available
$default_features = array(
    '24/7 Notdienst',
    'Elektroinstallation',
    'Sicherungskasten modernisieren',
    'Austausch defekter Steckdosen',
    'Stromausfall – Soforthilfe',
    'Beleuchtung reparieren',
    'Elektrotechnik aller Art',
    'und vieles mehr...'
);

// Phone number for CTA
$phone_link = ep_get_option( 'phone_link', '+4915777406869' );
?>

<!-- Hero Section -->
<section class="hero-section" id="notdienst">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1><?php echo wp_kses_post( $hero_heading ); ?></h1>
                
                <h2><?php echo esc_html( $hero_subheading ); ?></h2>
                
                <p><?php echo esc_html( $hero_intro ); ?></p>
                
                <div class="hero-features">
                    <?php
                    // Use ACF repeater if available, otherwise use defaults
                    $features_to_display = array();
                    if ( ! empty( $hero_features ) && is_array( $hero_features ) ) {
                        foreach ( $hero_features as $feature ) {
                            if ( ! empty( $feature['feature_text'] ) ) {
                                $features_to_display[] = $feature['feature_text'];
                            }
                        }
                    }
                    
                    // If no ACF features, use defaults
                    if ( empty( $features_to_display ) ) {
                        $features_to_display = $default_features;
                    }
                    
                    // Split into two columns
                    $half = ceil( count( $features_to_display ) / 2 );
                    $column1 = array_slice( $features_to_display, 0, $half );
                    $column2 = array_slice( $features_to_display, $half );
                    ?>
                    
                    <ul class="feature-list">
                        <?php foreach ( $column1 as $feature ) : ?>
                        <li>
                            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>
                            <span><?php echo esc_html( $feature ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <ul class="feature-list">
                        <?php foreach ( $column2 as $feature ) : ?>
                        <li>
                            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>
                            <span><?php echo esc_html( $feature ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <a href="tel:<?php echo esc_attr( $phone_link ); ?>" class="cta-button hidden-mobile">
                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"></path></svg>
                    <span>Jetzt Anrufen</span>
                </a>
            </div>
            
            <div class="hero-image">
                <?php
                // Hero image
                $hero_img_url = get_template_directory_uri() . '/assets/img/950201d8-368a-4744-8e05-e305a7a9453a-1024x683.png';
                $hero_img_alt = 'Elektriker bei der Arbeit';
                if ( ! empty( $hero_image ) && is_array( $hero_image ) ) {
                    $hero_img_url = $hero_image['url'];
                    $hero_img_alt = ! empty( $hero_image['alt'] ) ? $hero_image['alt'] : 'Hero Image';
                }
                ?>
                <img src="<?php echo esc_url( $hero_img_url ); ?>" alt="<?php echo esc_attr( $hero_img_alt ); ?>" width="800" height="534">
            </div>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/services' ); ?>
<?php get_template_part( 'template-parts/about' ); ?>
<?php get_template_part( 'template-parts/contact' ); ?>
<?php get_template_part( 'template-parts/problems' ); ?>

<?php get_footer(); ?>
