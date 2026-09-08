<?php
/**
 * Campos personalizados del CPT "trabajo".
 *
 * Reemplazan a la estructura de datos que en la app Angular vivía en
 * src/app/data/works.ts, ahora editable desde el escritorio de WordPress.
 */

if (!defined('ABSPATH')) {
    exit;
}

function alaska_trabajo_meta_fields()
{
    return [
        '_work_category' => ['label' => 'Categoría', 'type' => 'text'],
        '_work_short_description' => ['label' => 'Descripción corta (se ve en las tarjetas)', 'type' => 'textarea'],
        '_work_summary' => ['label' => 'Resumen detallado', 'type' => 'textarea'],
        '_work_sector' => ['label' => 'Sector', 'type' => 'text'],
        '_work_scope' => ['label' => 'Qué hicimos (un ítem por línea)', 'type' => 'textarea'],
        '_work_step1_label' => ['label' => 'Paso 1 — etiqueta (ícono: lupa)', 'type' => 'text'],
        '_work_step2_label' => ['label' => 'Paso 2 — etiqueta (ícono: llave)', 'type' => 'text'],
        '_work_step3_label' => ['label' => 'Paso 3 — etiqueta (ícono: check)', 'type' => 'text'],
    ];
}

function alaska_add_trabajo_meta_box()
{
    add_meta_box(
        'alaska_trabajo_details',
        'Detalles del trabajo',
        'alaska_render_trabajo_meta_box',
        'trabajo',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'alaska_add_trabajo_meta_box');

function alaska_render_trabajo_meta_box($post)
{
    wp_nonce_field('alaska_save_trabajo_meta', 'alaska_trabajo_meta_nonce');

    echo '<p>La imagen destacada del trabajo se usa como la foto principal de la galería. Cargala desde el panel "Imagen destacada".</p>';

    foreach (alaska_trabajo_meta_fields() as $key => $field) {
        $value = get_post_meta($post->ID, $key, true);
        echo '<p><label for="' . esc_attr($key) . '"><strong>' . esc_html($field['label']) . '</strong></label><br>';

        if ('textarea' === $field['type']) {
            echo '<textarea id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" rows="4" style="width:100%;">' . esc_textarea($value) . '</textarea>';
        } else {
            echo '<input type="text" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" style="width:100%;">';
        }

        echo '</p>';
    }
}

function alaska_save_trabajo_meta($post_id)
{
    if (!isset($_POST['alaska_trabajo_meta_nonce']) || !wp_verify_nonce($_POST['alaska_trabajo_meta_nonce'], 'alaska_save_trabajo_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    foreach (alaska_trabajo_meta_fields() as $key => $field) {
        if (!isset($_POST[$key])) {
            continue;
        }

        $raw = wp_unslash($_POST[$key]);
        $sanitized = 'textarea' === $field['type'] ? sanitize_textarea_field($raw) : sanitize_text_field($raw);

        update_post_meta($post_id, $key, $sanitized);
    }
}
add_action('save_post_trabajo', 'alaska_save_trabajo_meta');

/**
 * Devuelve los datos de un trabajo en un formato conveniente para las plantillas.
 */
function alaska_get_work_data($post_id)
{
    $scope_raw = get_post_meta($post_id, '_work_scope', true);
    $scope = array_values(array_filter(array_map('trim', explode("\n", (string) $scope_raw))));

    return [
        'category' => get_post_meta($post_id, '_work_category', true),
        'short_description' => get_post_meta($post_id, '_work_short_description', true),
        'summary' => get_post_meta($post_id, '_work_summary', true),
        'sector' => get_post_meta($post_id, '_work_sector', true),
        'scope' => $scope,
        'steps' => [
            ['icon' => 'search', 'label' => get_post_meta($post_id, '_work_step1_label', true)],
            ['icon' => 'wrench', 'label' => get_post_meta($post_id, '_work_step2_label', true)],
            ['icon' => 'check', 'label' => get_post_meta($post_id, '_work_step3_label', true)],
        ],
    ];
}
