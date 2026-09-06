<?php
/**
 * Maneja el envío del formulario de contacto vía AJAX y lo despacha por
 * correo al administrador del sitio (reemplaza la simulación con
 * setTimeout() de la versión Angular por un envío real).
 */

if (!defined('ABSPATH')) {
    exit;
}

function alaska_handle_contact_submission()
{
    check_ajax_referer('alaska_contact', 'nonce');

    $name = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
    $service = isset($_POST['service']) ? sanitize_text_field(wp_unslash($_POST['service'])) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

    $errors = [];

    if (mb_strlen($name) < 2) {
        $errors[] = 'Ingresá tu nombre (mínimo 2 caracteres).';
    }
    if (!is_email($email)) {
        $errors[] = 'Ingresá un email válido.';
    }
    if (!preg_match('/^[+()\d\s-]{6,}$/', $phone)) {
        $errors[] = 'Ingresá un teléfono válido.';
    }
    if ('' === $service) {
        $errors[] = 'Seleccioná un servicio.';
    }
    if (mb_strlen($message) < 10) {
        $errors[] = 'El mensaje debe tener al menos 10 caracteres.';
    }

    if (!empty($errors)) {
        wp_send_json_error(['message' => implode(' ', $errors)]);
    }

    $to = get_option('admin_email');
    $subject = sprintf('[Alaska Group] Nueva consulta de %s', $name);
    $body = "Nombre: {$name}\n"
        . "Email: {$email}\n"
        . "Teléfono: {$phone}\n"
        . "Servicio de interés: {$service}\n\n"
        . "Mensaje:\n{$message}\n";

    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    if (is_email($email)) {
        $headers[] = 'Reply-To: ' . $email;
    }

    $sent = wp_mail($to, $subject, $body, $headers);

    if (!$sent) {
        wp_send_json_error(['message' => 'No pudimos enviar tu mensaje. Probá de nuevo o escribinos por WhatsApp.']);
    }

    wp_send_json_success(['message' => '¡Mensaje enviado!']);
}
add_action('wp_ajax_alaska_contact', 'alaska_handle_contact_submission');
add_action('wp_ajax_nopriv_alaska_contact', 'alaska_handle_contact_submission');
