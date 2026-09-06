<?php
/**
 * Custom post type "Trabajos" (trabajos realizados / casos de éxito).
 */

if (!defined('ABSPATH')) {
    exit;
}

function alaska_register_trabajo_cpt()
{
    $labels = [
        'name' => 'Trabajos',
        'singular_name' => 'Trabajo',
        'menu_name' => 'Trabajos',
        'add_new' => 'Agregar trabajo',
        'add_new_item' => 'Agregar nuevo trabajo',
        'edit_item' => 'Editar trabajo',
        'new_item' => 'Nuevo trabajo',
        'view_item' => 'Ver trabajo',
        'search_items' => 'Buscar trabajos',
        'not_found' => 'No se encontraron trabajos',
        'not_found_in_trash' => 'No hay trabajos en la papelera',
        'all_items' => 'Todos los trabajos',
    ];

    register_post_type('trabajo', [
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-hammer',
        'supports' => ['title', 'thumbnail'],
        'rewrite' => ['slug' => 'trabajos', 'with_front' => false],
    ]);
}
add_action('init', 'alaska_register_trabajo_cpt');

/**
 * Al activar el tema, hay que registrar el CPT y regenerar los permalinks
 * para que /trabajos/{slug} funcione correctamente.
 */
function alaska_flush_rewrite_rules()
{
    alaska_register_trabajo_cpt();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'alaska_flush_rewrite_rules');
