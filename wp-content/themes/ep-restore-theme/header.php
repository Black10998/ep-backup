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

<header class="site-header">
    <!-- Header Top Bar -->
    <div class="header-top">
        <span>🕜 Rund um die Uhr erreichbar 24/7 | Notdienst verfügbar! 🚨</span>
    </div>
    
    <!-- Header Main -->
    <div class="header-main">
        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/cropped-elektro-pohl.png" alt="Elektriker Pohl Logo" width="1585" height="411">
            </a>
        </div>
        
        <div class="header-button">
            <a href="tel:+4915777406869">
                <svg aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"></path>
                </svg>
                <span>0157 77406869</span>
            </a>
        </div>
    </div>
</header>

<main id="content" class="site-main">
