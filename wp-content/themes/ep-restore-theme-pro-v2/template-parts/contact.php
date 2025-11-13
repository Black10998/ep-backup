<?php
// Get contact section fields from Customizer
$contact_heading = get_theme_mod( 'ep_contact_heading', 'Jetzt Kontakt aufnehmen' );
$contact_intro = get_theme_mod( 'ep_contact_intro', 'Ob akuter Notfall oder kurze Rückfrage – wir sind für Sie da. Einfach Formular ausfüllen oder direkt anrufen.' );
$contact_form_heading = get_theme_mod( 'ep_contact_form_heading', 'Kontaktformular' );
$phone_link = get_theme_mod( 'ep_phone_link', '+4368110596106' );
?>

<!-- Contact Section -->
<section class="contact-section" id="kontakt">
    <div class="container">
        <div class="contact-content">
            <div class="contact-info">
                <h2><?php echo esc_html( $contact_heading ); ?></h2>
                <p><?php echo esc_html( $contact_intro ); ?></p>
                
                <a href="tel:<?php echo esc_attr( $phone_link ); ?>" class="cta-button">
                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"></path></svg>
                    <span>Jetzt Anrufen</span>
                </a>
                
                <hr style="border: 0; border-top: 1px solid #444; margin: 30px 0;">
            </div>
            
            <div class="contact-form">
                <h2><?php echo esc_html( $contact_form_heading ); ?></h2>
                
                <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
                    <input type="hidden" name="action" value="contact_form_submission">
                    <?php wp_nonce_field( 'contact_form_nonce', 'contact_form_nonce_field' ); ?>
                    
                    <input type="text" name="name" placeholder="Name" required>
                    
                    <input type="tel" name="phone" placeholder="Telefonnumer" required pattern="[0-9()#+*\-=.]+" title="Nur Zahlen und Telefonzeichen (#, -, *, etc) sind erlaubt.">
                    
                    <textarea name="message" rows="3" placeholder="Ihre Nachricht" required></textarea>
                    
                    <div class="checkbox-wrapper">
                        <input type="checkbox" name="privacy" id="privacy" required>
                        <label for="privacy">Ich bin mit der Verarbeitung meiner personenbezogenen Daten zum Zwecke der Kontaktaufnahme einverstanden und habe die Hinweise zum Datenschutz gelesen und akzeptiert.</label>
                    </div>
                    
                    <button type="submit">
                        <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M440 6.5L24 246.4c-34.4 19.9-31.1 70.8 5.7 85.9L144 379.6V464c0 46.4 59.2 65.5 86.6 28.6l43.8-59.1 111.9 46.2c5.9 2.4 12.1 3.6 18.3 3.6 8.2 0 16.3-2.1 23.6-6.2 12.8-7.2 21.6-20 23.9-34.5l59.4-387.2c6.1-40.1-36.9-68.8-71.5-48.9zM192 464v-64.6l36.6 15.1L192 464zm212.6-28.7l-153.8-63.5L391 169.5c10.7-15.5-9.5-33.5-23.7-21.2L155.8 332.6 48 288 464 48l-59.4 387.3z"></path></svg>
                        <span>Anfrage senden</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
