<?php
// Get about section fields
$about_heading = ep_get_field( 'about_heading', get_the_ID(), 'Ihr Elektriker für alle Fälle' );
$about_text = ep_get_field( 'about_text', get_the_ID(), 'Als Fachbetrieb für Elektro- und Installationsarbeiten bieten wir zuverlässige Lösungen, faire Preise und kurzfristige Termine. Bei Stromausfall, defekter Steckdose oder Sicherungsausfall sind wir schnell vor Ort – dank 24/7-Notdienst auch an Wochenenden und Feiertagen.' );
$about_image = ep_get_field( 'about_image', get_the_ID() );
$about_features = ep_get_field( 'about_features', get_the_ID() );
$phone_link = ep_get_option( 'phone_link', '+4915777406869' );

// Default features
$default_about_features = array(
    'Elektroinstallation',
    'Sicherungskasten modernisieren',
    'Beleuchtung installieren',
    'Fehlersuche & Reparatur',
    'Notdienst 24/7',
    'Elektrotechnik aller Art'
);
?>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2><?php echo esc_html( $about_heading ); ?></h2>
                
                <p><?php echo esc_html( $about_text ); ?></p>
                
                <div class="hero-features">
                    <?php
                    // Use ACF repeater if available, otherwise use defaults
                    $features_to_display = array();
                    if ( ! empty( $about_features ) && is_array( $about_features ) ) {
                        foreach ( $about_features as $feature ) {
                            if ( ! empty( $feature['feature_text'] ) ) {
                                $features_to_display[] = $feature['feature_text'];
                            }
                        }
                    }
                    
                    // If no ACF features, use defaults
                    if ( empty( $features_to_display ) ) {
                        $features_to_display = $default_about_features;
                    }
                    
                    // Split into two columns
                    $half = ceil( count( $features_to_display ) / 2 );
                    $column1 = array_slice( $features_to_display, 0, $half );
                    $column2 = array_slice( $features_to_display, $half );
                    ?>
                    
                    <ul class="feature-list">
                        <?php foreach ( $column1 as $feature ) : ?>
                        <li>
                            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path></svg>
                            <span><?php echo esc_html( $feature ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <ul class="feature-list">
                        <?php foreach ( $column2 as $feature ) : ?>
                        <li>
                            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path></svg>
                            <span><?php echo esc_html( $feature ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <a href="tel:<?php echo esc_attr( $phone_link ); ?>" class="cta-button">
                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"></path></svg>
                    <span>Jetzt Anrufen</span>
                </a>
            </div>
            
            <div class="about-image">
                <?php
                // About image
                $about_img_url = get_template_directory_uri() . '/assets/img/21391b07-45f9-4235-9d2b-865be5c0dc86.png';
                $about_img_alt = 'Elektriker Werkzeug';
                if ( ! empty( $about_image ) && is_array( $about_image ) ) {
                    $about_img_url = $about_image['url'];
                    $about_img_alt = ! empty( $about_image['alt'] ) ? $about_image['alt'] : 'About Image';
                }
                ?>
                <img src="<?php echo esc_url( $about_img_url ); ?>" alt="<?php echo esc_attr( $about_img_alt ); ?>" width="800" height="800">
            </div>
        </div>
    </div>
</section>
