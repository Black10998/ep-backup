<?php
// Get services section fields
$service_1_title = ep_get_field( 'service_1_title', get_the_ID(), 'Schnelle Hilfe im Notfall' );
$service_1_text = ep_get_field( 'service_1_text', get_the_ID(), 'Unser 24/7-Notdienst ist rund um die Uhr für Sie da – auch an Wochenenden und Feiertagen. Bei Stromausfall oder defekten Anlagen sind wir schnell vor Ort.' );
$service_2_title = ep_get_field( 'service_2_title', get_the_ID(), 'Fachgerechte Installation' );
$service_2_text = ep_get_field( 'service_2_text', get_the_ID(), 'Von der Neuinstallation bis zur Modernisierung – wir setzen alle Elektroarbeiten sauber, sicher und nach aktuellen Normen um.' );
$service_3_title = ep_get_field( 'service_3_title', get_the_ID(), 'Garantierte Termine' );
$service_3_text = ep_get_field( 'service_3_text', get_the_ID(), 'Wir halten, was wir versprechen: Pünktliche Anfahrt, transparente Preise und zuverlässige Abwicklung – ohne versteckte Kosten.' );
$phone_link = ep_get_option( 'phone_link', '+4915777406869' );
?>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="services-grid">
            <div class="service-box">
                <div class="service-icon">
                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"></path></svg>
                </div>
                <h3><?php echo esc_html( $service_1_title ); ?></h3>
                <p><?php echo esc_html( $service_1_text ); ?></p>
            </div>
            
            <div class="service-box">
                <div class="service-icon">
                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>
                </div>
                <h3><?php echo esc_html( $service_2_title ); ?></h3>
                <p><?php echo esc_html( $service_2_text ); ?></p>
            </div>
            
            <div class="service-box">
                <div class="service-icon">
                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"></path></svg>
                </div>
                <h3><?php echo esc_html( $service_3_title ); ?></h3>
                <p><?php echo esc_html( $service_3_text ); ?></p>
            </div>
        </div>
        
        <div class="services-button">
            <a href="tel:<?php echo esc_attr( $phone_link ); ?>">
                <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"></path></svg>
                <span>Jetzt Anrufen</span>
            </a>
        </div>
    </div>
</section>
