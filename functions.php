<?php
/**
 * Alaska Group theme bootstrap.
 */

if (!defined('ABSPATH')) {
    exit;
}

// Datos de contacto de la empresa: cambiar acá si cambian los datos reales.
define('ALASKA_PHONE_DISPLAY', '+54 9 11 2376-3782');
define('ALASKA_PHONE_LINK', '+5491123763782');
define('ALASKA_WHATSAPP_NUMBER', '5491123763782');
define('ALASKA_EMAIL', 'info@alaskagroup.com.ar');
define('ALASKA_WHATSAPP_URL', 'https://wa.me/' . ALASKA_WHATSAPP_NUMBER);

require_once get_template_directory() . '/inc/cpt-trabajos.php';
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/seed-content.php';
require_once get_template_directory() . '/inc/contact-handler.php';

function alaska_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('automatic-feed-links');
}
add_action('after_setup_theme', 'alaska_theme_setup');

function alaska_enqueue_assets()
{
    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style(
        'alaska-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'alaska-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        $theme_version
    );

    wp_enqueue_script(
        'alaska-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $theme_version,
        true
    );

    wp_localize_script('alaska-main', 'alaskaContact', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('alaska_contact'),
    ]);
}
add_action('wp_enqueue_scripts', 'alaska_enqueue_assets');

/**
 * El favicon original vive en assets/images/favicon.ico.
 */
function alaska_favicon()
{
    echo '<link rel="icon" type="image/x-icon" href="' . esc_url(get_template_directory_uri() . '/assets/images/favicon.ico') . '">' . "\n";
}
add_action('wp_head', 'alaska_favicon');

/**
 * Devuelve true si el link de navegación corresponde a la página actual.
 */
function alaska_nav_is_active($path)
{
    if ('/' === $path) {
        return is_front_page();
    }

    return is_page(trim($path, '/'));
}
