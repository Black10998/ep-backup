<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content">Zum Inhalt springen</a>

<?php
// Get global settings from Customizer
$topbar_text = get_theme_mod( 'ep_topbar_text', 'Rund um die Uhr erreichbar 24/7 | Notdienst verfügbar!' );
$phone_display = get_theme_mod( 'ep_phone_display', '0681 10596106' );
$phone_link = get_theme_mod( 'ep_phone_link', '+4368110596106' );
$logo_id = get_theme_mod( 'ep_logo_image' );

// Logo handling
$logo_url = get_template_directory_uri() . '/assets/img/cropped-elektro-pohl.png';
$logo_alt = get_theme_mod( 'ep_company_name', 'ELEKTRO RECHBERGER GmbH' );

if ( ! empty( $logo_id ) ) {
    $logo_image = wp_get_attachment_image_src( $logo_id, 'full' );
    if ( $logo_image ) {
        $logo_url = $logo_image[0];
        $logo_alt_text = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
        if ( ! empty( $logo_alt_text ) ) {
            $logo_alt = $logo_alt_text;
        }
    }
}
?>

<header class="site-header">
    <!-- Header Top Bar -->
    <div class="header-top">
        <span><?php echo esc_html( $topbar_text ); ?></span>
    </div>
    
    <!-- Header Main -->
    <div class="header-main">
        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>" width="1585" height="411">
            </a>
        </div>
        
        <div class="header-button">
            <a href="tel:<?php echo esc_attr( $phone_link ); ?>">
                <svg aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"></path>
                </svg>
                <span><?php echo esc_html( $phone_display ); ?></span>
            </a>
        </div>
    </div>
</header>

<main id="content" class="site-main">
