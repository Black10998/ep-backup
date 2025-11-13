<?php
/**
 * EP Restore Theme PRO Functions
 *
 * @package EP_Restore_Theme_PRO
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Theme version constant
define( 'EP_RESTORE_PRO_VERSION', '3.0.0' );

/**
 * Load Customizer Integration
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Theme Setup
 */
function ep_restore_theme_setup() {
    // Add theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 411,
        'width'       => 1585,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    
    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'ep-restore-theme-pro' ),
        'footer'  => __( 'Footer Menu', 'ep-restore-theme-pro' ),
    ) );
}
add_action( 'after_setup_theme', 'ep_restore_theme_setup' );

/**
 * ACF Options Page Setup
 */
function ep_restore_acf_options_page() {
    // Check if ACF function exists
    if ( function_exists( 'acf_add_options_page' ) ) {
        
        // Add main options page
        acf_add_options_page( array(
            'page_title'  => __( 'EP Theme Settings', 'ep-restore-theme-pro' ),
            'menu_title'  => __( 'EP Theme Settings', 'ep-restore-theme-pro' ),
            'menu_slug'   => 'ep-theme-settings',
            'capability'  => 'edit_theme_options',
            'parent_slug' => 'themes.php',
            'icon_url'    => 'dashicons-admin-generic',
            'redirect'    => false,
            'position'    => 61,
        ) );
        
    }
}
add_action( 'acf/init', 'ep_restore_acf_options_page' );

/**
 * Helper function to get ACF field with fallback
 */
function ep_get_field( $selector, $post_id = false, $fallback = '' ) {
    if ( function_exists( 'get_field' ) ) {
        $value = get_field( $selector, $post_id );
        return ! empty( $value ) ? $value : $fallback;
    }
    return $fallback;
}

/**
 * Helper function to get ACF option with fallback
 */
function ep_get_option( $selector, $fallback = '' ) {
    if ( function_exists( 'get_field' ) ) {
        $value = get_field( $selector, 'option' );
        return ! empty( $value ) ? $value : $fallback;
    }
    return $fallback;
}

/**
 * Enqueue Styles and Scripts
 */
function ep_restore_theme_enqueue_assets() {
    // Enqueue Google Fonts
    wp_enqueue_style( 
        'ep-restore-google-fonts', 
        'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap', 
        array(), 
        null 
    );
    
    // Enqueue main stylesheet
    wp_enqueue_style( 
        'ep-restore-style', 
        get_stylesheet_uri(), 
        array(), 
        wp_get_theme()->get( 'Version' ) 
    );
    
    // Enqueue custom JavaScript if needed
    wp_enqueue_script( 
        'ep-restore-script', 
        get_template_directory_uri() . '/assets/js/main.js', 
        array(), 
        wp_get_theme()->get( 'Version' ), 
        true 
    );
}
add_action( 'wp_enqueue_scripts', 'ep_restore_theme_enqueue_assets' );

/**
 * Handle Contact Form Submission
 */
function ep_restore_handle_contact_form() {
    // Verify nonce
    if ( ! isset( $_POST['contact_form_nonce_field'] ) || 
         ! wp_verify_nonce( $_POST['contact_form_nonce_field'], 'contact_form_nonce' ) ) {
        wp_die( 'Sicherheitsüberprüfung fehlgeschlagen.' );
    }
    
    // Sanitize form data
    $name    = sanitize_text_field( $_POST['name'] );
    $phone   = sanitize_text_field( $_POST['phone'] );
    $message = sanitize_textarea_field( $_POST['message'] );
    $privacy = isset( $_POST['privacy'] ) ? true : false;
    
    // Validate required fields
    if ( empty( $name ) || empty( $phone ) || empty( $message ) || ! $privacy ) {
        wp_redirect( add_query_arg( 'contact', 'error', home_url() ) );
        exit;
    }
    
    // Prepare email
    $to      = get_option( 'admin_email' );
    $subject = 'Neue Kontaktanfrage von ' . $name;
    $body    = "Name: $name\n";
    $body   .= "Telefon: $phone\n\n";
    $body   .= "Nachricht:\n$message\n";
    $headers = array( 'Content-Type: text/plain; charset=UTF-8' );
    
    // Send email
    $sent = wp_mail( $to, $subject, $body, $headers );
    
    // Redirect with success or error message
    if ( $sent ) {
        wp_redirect( add_query_arg( 'contact', 'success', home_url() ) );
    } else {
        wp_redirect( add_query_arg( 'contact', 'error', home_url() ) );
    }
    exit;
}
add_action( 'admin_post_nopriv_contact_form_submission', 'ep_restore_handle_contact_form' );
add_action( 'admin_post_contact_form_submission', 'ep_restore_handle_contact_form' );

/**
 * Add custom body classes
 */
function ep_restore_body_classes( $classes ) {
    if ( is_front_page() ) {
        $classes[] = 'home';
    }
    return $classes;
}
add_filter( 'body_class', 'ep_restore_body_classes' );

/**
 * Customize excerpt length
 */
function ep_restore_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'ep_restore_excerpt_length' );

/**
 * Customize excerpt more string
 */
function ep_restore_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'ep_restore_excerpt_more' );

/**
 * Remove unnecessary WordPress features
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
