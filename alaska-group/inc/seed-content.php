<?php
/**
 * Contenido inicial: crea las páginas y los trabajos de ejemplo la primera
 * vez que se activa el tema, para que el sitio funcione de inmediato
 * (igual que la demo original en Angular).
 */

if (!defined('ABSPATH')) {
    exit;
}

function alaska_seed_pages()
{
    $pages = [
        'servicios' => 'Servicios',
        'nosotros' => 'Nosotros',
        'contacto' => 'Contacto',
    ];

    foreach ($pages as $slug => $title) {
        $existing = get_page_by_path($slug, OBJECT, 'page');
        if ($existing) {
            continue;
        }

        wp_insert_post([
            'post_type' => 'page',
            'post_title' => $title,
            'post_name' => $slug,
            'post_status' => 'publish',
            'post_content' => '',
        ]);
    }
}

/**
 * Copia una imagen del tema a la biblioteca de medios y devuelve el ID del adjunto.
 */
function alaska_seed_attachment($relative_path, $title)
{
    $source = get_theme_file_path($relative_path);
    if (!file_exists($source)) {
        return 0;
    }

    $upload_dir = wp_upload_dir();
    $filename = wp_unique_filename($upload_dir['path'], basename($relative_path));
    $destination = trailingslashit($upload_dir['path']) . $filename;

    if (!copy($source, $destination)) {
        return 0;
    }

    $filetype = wp_check_filetype($filename, null);

    $attachment_id = wp_insert_attachment([
        'post_mime_type' => $filetype['type'],
        'post_title' => $title,
        'post_content' => '',
        'post_status' => 'inherit',
    ], $destination);

    if (!$attachment_id || is_wp_error($attachment_id)) {
        return 0;
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    $attachment_data = wp_generate_attachment_metadata($attachment_id, $destination);
    wp_update_attachment_metadata($attachment_id, $attachment_data);

    return $attachment_id;
}

function alaska_seed_works()
{
    $works = [
        [
            'slug' => 'camara-frigorifica-comercio',
            'title' => 'Cámara frigorífica para comercio',
            'image' => 'assets/images/servicio-camaras-frigorificas.jpg',
            'category' => 'Cámaras frigoríficas',
            'short_description' => 'Instalación de una cámara frigorífica de gran volumen para conservación de alimentos.',
            'summary' => 'Instalación de una cámara frigorífica industrial para la conservación de congelados, carnes y alimentos, pensada para un volumen de almacenamiento de gran escala.',
            'sector' => 'Comercios',
            'scope' => [
                'Relevamiento del espacio y cálculo de carga térmica',
                'Instalación de paneles frigoríficos aislantes',
                'Montaje de equipos de frío y sistema de control de temperatura',
                'Prueba de estanqueidad y puesta en marcha',
            ],
            'steps' => ['Diagnóstico y relevamiento', 'Instalación y montaje', 'Prueba y puesta en marcha'],
        ],
        [
            'slug' => 'climatizacion-oficinas',
            'title' => 'Climatización de oficinas',
            'image' => 'assets/images/servicio-aire-acondicionado.jpg',
            'category' => 'Aire acondicionado',
            'short_description' => 'Instalación de equipos split y por conductos para climatizar un espacio de trabajo.',
            'summary' => 'Instalación de un sistema de climatización combinando equipos split y por conductos, para cubrir distintos ambientes de un espacio de oficinas.',
            'sector' => 'Comercios',
            'scope' => [
                'Relevamiento de ambientes y cálculo de frigorías necesarias',
                'Instalación de unidades split y por conductos',
                'Conexionado eléctrico y de gas refrigerante',
                'Revisión de rendimiento y entrega al cliente',
            ],
            'steps' => ['Diagnóstico y relevamiento', 'Instalación de equipos', 'Revisión y entrega'],
        ],
        [
            'slug' => 'mantenimiento-compresores-industriales',
            'title' => 'Mantenimiento de compresores industriales',
            'image' => 'assets/images/servicio-compresores.jpg',
            'category' => 'Compresores de aire',
            'short_description' => 'Diagnóstico y mantenimiento preventivo de compresores de pistón y tornillo en planta.',
            'summary' => 'Servicio de mantenimiento preventivo sobre compresores de aire de pistón y de tornillo, para garantizar un funcionamiento eficiente y confiable en planta.',
            'sector' => 'Industrias',
            'scope' => [
                'Diagnóstico del estado general de los equipos',
                'Reemplazo de filtros y aceite',
                'Revisión de presiones y componentes críticos',
                'Control final de funcionamiento',
            ],
            'steps' => ['Diagnóstico técnico', 'Mantenimiento preventivo', 'Control de funcionamiento'],
        ],
    ];

    foreach ($works as $work) {
        $existing = get_page_by_path($work['slug'], OBJECT, 'trabajo');
        if ($existing) {
            continue;
        }

        $post_id = wp_insert_post([
            'post_type' => 'trabajo',
            'post_title' => $work['title'],
            'post_name' => $work['slug'],
            'post_status' => 'publish',
        ]);

        if (!$post_id || is_wp_error($post_id)) {
            continue;
        }

        update_post_meta($post_id, '_work_category', $work['category']);
        update_post_meta($post_id, '_work_short_description', $work['short_description']);
        update_post_meta($post_id, '_work_summary', $work['summary']);
        update_post_meta($post_id, '_work_sector', $work['sector']);
        update_post_meta($post_id, '_work_scope', implode("\n", $work['scope']));
        update_post_meta($post_id, '_work_step1_label', $work['steps'][0]);
        update_post_meta($post_id, '_work_step2_label', $work['steps'][1]);
        update_post_meta($post_id, '_work_step3_label', $work['steps'][2]);

        $attachment_id = alaska_seed_attachment($work['image'], $work['title']);
        if ($attachment_id) {
            set_post_thumbnail($post_id, $attachment_id);
        }
    }
}

function alaska_seed_content()
{
    if (get_option('alaska_content_seeded')) {
        return;
    }

    alaska_seed_pages();
    alaska_seed_works();

    update_option('alaska_content_seeded', 1);
}
add_action('after_switch_theme', 'alaska_seed_content');
