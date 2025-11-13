<?php
/**
 * EP Restore Theme PRO - Customizer Integration
 *
 * @package EP_Restore_Theme_PRO
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Customizer settings
 */
function ep_restore_pro_customize_register( $wp_customize ) {
    
    // ========================================
    // MAIN PANEL
    // ========================================
    $wp_customize->add_panel( 'ep_theme_pro_panel', array(
        'title'       => __( 'EP Restore Theme PRO', 'ep-restore-theme-pro' ),
        'description' => __( 'Global options for header, footer and homepage sections.', 'ep-restore-theme-pro' ),
        'priority'    => 30,
    ) );
    
    // ========================================
    // A) GLOBAL SETTINGS SECTION
    // ========================================
    $wp_customize->add_section( 'ep_global_settings_section', array(
        'title'    => __( 'Global Settings', 'ep-restore-theme-pro' ),
        'panel'    => 'ep_theme_pro_panel',
        'priority' => 10,
    ) );
    
    // Company Name
    $wp_customize->add_setting( 'ep_company_name', array(
        'default'           => 'ELEKTRO RECHBERGER GmbH',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_company_name', array(
        'label'    => __( 'Company Name', 'ep-restore-theme-pro' ),
        'section'  => 'ep_global_settings_section',
        'type'     => 'text',
        'priority' => 10,
    ) );
    
    // Topbar Text
    $wp_customize->add_setting( 'ep_topbar_text', array(
        'default'           => 'Rund um die Uhr erreichbar 24/7 | Notdienst verfügbar!',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_topbar_text', array(
        'label'    => __( 'Topbar Text', 'ep-restore-theme-pro' ),
        'section'  => 'ep_global_settings_section',
        'type'     => 'text',
        'priority' => 20,
    ) );
    
    // Phone Display
    $wp_customize->add_setting( 'ep_phone_display', array(
        'default'           => '0681 10596106',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_phone_display', array(
        'label'       => __( 'Phone Number (Display)', 'ep-restore-theme-pro' ),
        'description' => __( 'Phone number as shown to visitors', 'ep-restore-theme-pro' ),
        'section'     => 'ep_global_settings_section',
        'type'        => 'text',
        'priority'    => 30,
    ) );
    
    // Phone Link
    $wp_customize->add_setting( 'ep_phone_link', array(
        'default'           => '+4368110596106',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_phone_link', array(
        'label'       => __( 'Phone Number (Link)', 'ep-restore-theme-pro' ),
        'description' => __( 'Phone number for tel: links (e.g., +4368110596106)', 'ep-restore-theme-pro' ),
        'section'     => 'ep_global_settings_section',
        'type'        => 'text',
        'priority'    => 40,
    ) );
    
    // Email Address
    $wp_customize->add_setting( 'ep_email_address', array(
        'default'           => 'elektro.rechberger@gmx.at',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_email_address', array(
        'label'    => __( 'Email Address', 'ep-restore-theme-pro' ),
        'section'  => 'ep_global_settings_section',
        'type'     => 'email',
        'priority' => 50,
    ) );
    
    // Logo Image
    $wp_customize->add_setting( 'ep_logo_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ep_logo_image', array(
        'label'       => __( 'Logo Image', 'ep-restore-theme-pro' ),
        'description' => __( 'Upload a custom logo (leave empty to use default)', 'ep-restore-theme-pro' ),
        'section'     => 'ep_global_settings_section',
        'mime_type'   => 'image',
        'priority'    => 60,
    ) ) );
    
    // ========================================
    // B) HOMEPAGE - HERO SECTION
    // ========================================
    $wp_customize->add_section( 'ep_home_hero_section', array(
        'title'    => __( 'Homepage – Hero', 'ep-restore-theme-pro' ),
        'panel'    => 'ep_theme_pro_panel',
        'priority' => 20,
    ) );
    
    // Hero Heading
    $wp_customize->add_setting( 'ep_hero_heading', array(
        'default'           => 'Ihr regionaler Fachbetrieb für<br><strong>Elektroinstallation & Elektrotechnik</strong>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_hero_heading', array(
        'label'    => __( 'Hero Heading', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_hero_section',
        'type'     => 'textarea',
        'priority' => 10,
    ) );
    
    // Hero Subheading
    $wp_customize->add_setting( 'ep_hero_subheading', array(
        'default'           => 'Verlassen Sie sich auf schnellen Sofortservice, echte Handwerksqualität und garantierte Termine – rund um die Uhr, auch am Wochenende.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_hero_subheading', array(
        'label'    => __( 'Hero Subheading', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_hero_section',
        'type'     => 'textarea',
        'priority' => 20,
    ) );
    
    // Hero Intro
    $wp_customize->add_setting( 'ep_hero_intro', array(
        'default'           => 'Als Fachbetrieb für Elektro- und Installationsarbeiten bieten wir zuverlässige Lösungen, faire Preise und kurzfristige Termine. Bei Stromausfall, defekter Steckdose oder Sicherungsausfall sind wir schnell vor Ort – dank 24/7-Notdienst auch an Wochenenden und Feiertagen.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_hero_intro', array(
        'label'    => __( 'Hero Intro Text', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_hero_section',
        'type'     => 'textarea',
        'priority' => 30,
    ) );
    
    // ========================================
    // C) HOMEPAGE - SERVICES SECTION
    // ========================================
    $wp_customize->add_section( 'ep_home_services_section', array(
        'title'    => __( 'Homepage – Services', 'ep-restore-theme-pro' ),
        'panel'    => 'ep_theme_pro_panel',
        'priority' => 30,
    ) );
    
    // Service 1
    $wp_customize->add_setting( 'ep_service1_title', array(
        'default'           => 'Schnelle Hilfe im Notfall',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_service1_title', array(
        'label'    => __( 'Service 1 Title', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_services_section',
        'type'     => 'text',
        'priority' => 10,
    ) );
    
    $wp_customize->add_setting( 'ep_service1_text', array(
        'default'           => 'Unser 24/7-Notdienst ist rund um die Uhr für Sie da – auch an Wochenenden und Feiertagen. Bei Stromausfall oder defekten Anlagen sind wir schnell vor Ort.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_service1_text', array(
        'label'    => __( 'Service 1 Text', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_services_section',
        'type'     => 'textarea',
        'priority' => 20,
    ) );
    
    // Service 2
    $wp_customize->add_setting( 'ep_service2_title', array(
        'default'           => 'Fachgerechte Installation',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_service2_title', array(
        'label'    => __( 'Service 2 Title', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_services_section',
        'type'     => 'text',
        'priority' => 30,
    ) );
    
    $wp_customize->add_setting( 'ep_service2_text', array(
        'default'           => 'Von der Neuinstallation bis zur Modernisierung – wir setzen alle Elektroarbeiten sauber, sicher und nach aktuellen Normen um.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_service2_text', array(
        'label'    => __( 'Service 2 Text', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_services_section',
        'type'     => 'textarea',
        'priority' => 40,
    ) );
    
    // Service 3
    $wp_customize->add_setting( 'ep_service3_title', array(
        'default'           => 'Garantierte Termine',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_service3_title', array(
        'label'    => __( 'Service 3 Title', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_services_section',
        'type'     => 'text',
        'priority' => 50,
    ) );
    
    $wp_customize->add_setting( 'ep_service3_text', array(
        'default'           => 'Wir halten, was wir versprechen: Pünktliche Anfahrt, transparente Preise und zuverlässige Abwicklung – ohne versteckte Kosten.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_service3_text', array(
        'label'    => __( 'Service 3 Text', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_services_section',
        'type'     => 'textarea',
        'priority' => 60,
    ) );
    
    // ========================================
    // D) HOMEPAGE - ABOUT SECTION
    // ========================================
    $wp_customize->add_section( 'ep_home_about_section', array(
        'title'    => __( 'Homepage – About', 'ep-restore-theme-pro' ),
        'panel'    => 'ep_theme_pro_panel',
        'priority' => 40,
    ) );
    
    // About Heading
    $wp_customize->add_setting( 'ep_about_heading', array(
        'default'           => 'Ihr Elektriker für alle Fälle',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_about_heading', array(
        'label'    => __( 'About Heading', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_about_section',
        'type'     => 'text',
        'priority' => 10,
    ) );
    
    // About Text
    $wp_customize->add_setting( 'ep_about_text', array(
        'default'           => 'Als Fachbetrieb für Elektro- und Installationsarbeiten bieten wir zuverlässige Lösungen, faire Preise und kurzfristige Termine. Bei Stromausfall, defekter Steckdose oder Sicherungsausfall sind wir schnell vor Ort – dank 24/7-Notdienst auch an Wochenenden und Feiertagen.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_about_text', array(
        'label'    => __( 'About Text', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_about_section',
        'type'     => 'textarea',
        'priority' => 20,
    ) );
    
    // About Image
    $wp_customize->add_setting( 'ep_about_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ep_about_image', array(
        'label'       => __( 'About Image', 'ep-restore-theme-pro' ),
        'description' => __( 'Upload an image for the about section', 'ep-restore-theme-pro' ),
        'section'     => 'ep_home_about_section',
        'mime_type'   => 'image',
        'priority'    => 30,
    ) ) );
    
    // ========================================
    // E) HOMEPAGE - CONTACT SECTION
    // ========================================
    $wp_customize->add_section( 'ep_home_contact_section', array(
        'title'    => __( 'Homepage – Contact', 'ep-restore-theme-pro' ),
        'panel'    => 'ep_theme_pro_panel',
        'priority' => 50,
    ) );
    
    // Contact Heading
    $wp_customize->add_setting( 'ep_contact_heading', array(
        'default'           => 'Jetzt Kontakt aufnehmen',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_contact_heading', array(
        'label'    => __( 'Contact Heading', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_contact_section',
        'type'     => 'text',
        'priority' => 10,
    ) );
    
    // Contact Intro
    $wp_customize->add_setting( 'ep_contact_intro', array(
        'default'           => 'Ob akuter Notfall oder kurze Rückfrage – wir sind für Sie da. Einfach Formular ausfüllen oder direkt anrufen.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_contact_intro', array(
        'label'    => __( 'Contact Intro Text', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_contact_section',
        'type'     => 'textarea',
        'priority' => 20,
    ) );
    
    // Contact Form Heading
    $wp_customize->add_setting( 'ep_contact_form_heading', array(
        'default'           => 'Kontaktformular',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_contact_form_heading', array(
        'label'    => __( 'Contact Form Heading', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_contact_section',
        'type'     => 'text',
        'priority' => 30,
    ) );
    
    // ========================================
    // F) HOMEPAGE - PROBLEMS SECTION
    // ========================================
    $wp_customize->add_section( 'ep_home_problems_section', array(
        'title'    => __( 'Homepage – Problems', 'ep-restore-theme-pro' ),
        'panel'    => 'ep_theme_pro_panel',
        'priority' => 60,
    ) );
    
    // Problems Heading
    $wp_customize->add_setting( 'ep_problems_heading', array(
        'default'           => 'Typische Probleme – und wie wir sie zuverlässig lösen',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_problems_heading', array(
        'label'    => __( 'Problems Section Heading', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_problems_section',
        'type'     => 'text',
        'priority' => 10,
    ) );
    
    // Problems Intro
    $wp_customize->add_setting( 'ep_problems_intro', array(
        'default'           => 'Viele unserer Einsätze beginnen mit kleinen Alltagsproblemen, die schnell größer werden können. Als Fachbetrieb erkennen wir die Ursache, handeln schnell und sorgen dafür, dass das Problem nicht erneut auftritt.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'ep_problems_intro', array(
        'label'    => __( 'Problems Intro Text', 'ep-restore-theme-pro' ),
        'section'  => 'ep_home_problems_section',
        'type'     => 'textarea',
        'priority' => 20,
    ) );
}
add_action( 'customize_register', 'ep_restore_pro_customize_register' );
