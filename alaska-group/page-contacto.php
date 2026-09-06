<?php
/**
 * Página "Contacto" (equivalente a src/app/pages/contact).
 * WordPress usa esta plantilla automáticamente para la página con slug "contacto".
 * El envío del formulario lo maneja inc/contact-handler.php vía admin-ajax.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$service_options = ['Aire acondicionado', 'Cámaras frigoríficas', 'Compresores de aire', 'Urgencia 24h', 'Otro'];
?>

<section class="page-hero">
  <div class="container">
    <div class="eyebrow eyebrow--light">Contacto</div>
    <h1>Hablemos de tu instalación</h1>
    <p class="page-hero__lead">
      Contanos qué necesitás y nuestro equipo técnico te responde a la brevedad. Para
      urgencias, escribinos por WhatsApp o llamanos directamente.
    </p>
  </div>
</section>

<section class="section">
  <div class="container contact-grid">
    <div class="contact-info">
      <div class="info-card">
        <div class="icon-badge">
          <svg viewBox="0 0 24 24" fill="none"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5.06-1.33A10 10 0 1 0 12 2Zm0 18.2a8.16 8.16 0 0 1-4.17-1.14l-.3-.18-3.09.81.82-3.02-.2-.31A8.2 8.2 0 1 1 12 20.2Zm4.52-6.13c-.25-.12-1.45-.72-1.68-.8-.22-.08-.39-.12-.55.12-.16.25-.63.8-.78.96-.14.16-.29.18-.53.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.14-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.14.16-.25.24-.41.08-.16.04-.31-.02-.43-.06-.12-.55-1.33-.76-1.82-.2-.48-.4-.42-.55-.42h-.47c-.16 0-.43.06-.65.31-.22.25-.86.84-.86 2.04 0 1.2.88 2.37 1 2.53.12.16 1.73 2.64 4.2 3.7.59.25 1.05.4 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.45-.59 1.65-1.16.2-.57.2-1.06.14-1.16-.06-.1-.22-.16-.47-.28Z" fill="currentColor"/></svg>
        </div>
        <h3>WhatsApp</h3>
        <p><a href="<?php echo esc_url(ALASKA_WHATSAPP_URL); ?>" target="_blank" rel="noopener"><?php echo esc_html(ALASKA_PHONE_DISPLAY); ?></a></p>
        <p class="text-muted">La forma más rápida de contactarnos</p>
      </div>

      <div class="info-card">
        <div class="icon-badge">
          <svg viewBox="0 0 24 24" fill="none"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.61 21 3 13.39 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.25 1.01l-2.2 2.2Z" fill="currentColor"/></svg>
        </div>
        <h3>Teléfono</h3>
        <p><a href="tel:<?php echo esc_attr(ALASKA_PHONE_LINK); ?>"><?php echo esc_html(ALASKA_PHONE_DISPLAY); ?></a></p>
        <p class="text-muted">Emmanuel Sibona · Urgencias 24h</p>
      </div>

      <div class="info-card">
        <div class="icon-badge">
          <svg viewBox="0 0 24 24" fill="none"><path d="M3 5h18v14H3V5Zm0 0 9 7 9-7" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
        </div>
        <h3>Email</h3>
        <p><a href="mailto:<?php echo esc_attr(ALASKA_EMAIL); ?>"><?php echo esc_html(ALASKA_EMAIL); ?></a></p>
        <p class="text-muted">Buenos Aires, Argentina</p>
      </div>
    </div>

    <div class="contact-form-wrap">
      <div class="form-success" hidden>
        <div class="icon-badge">
          <svg viewBox="0 0 24 24" fill="none"><path d="m5 13 4 4 10-10" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <h3>¡Mensaje enviado!</h3>
        <p class="text-muted">
          Gracias por contactar con Alaska Group. Te respondemos a la brevedad.
        </p>
        <button type="button" class="btn btn--outline-dark" data-action="new-message">Enviar otro mensaje</button>
      </div>

      <form class="contact-form" novalidate>
        <div class="form-row" data-field="name">
          <label for="name">Nombre y apellido</label>
          <input id="name" name="name" type="text" placeholder="Tu nombre" />
        </div>

        <div class="form-row form-row--split">
          <div data-field="email">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="tucorreo@empresa.com" />
          </div>
          <div data-field="phone">
            <label for="phone">Teléfono</label>
            <input id="phone" name="phone" type="tel" placeholder="11 2345-6789" />
          </div>
        </div>

        <div class="form-row" data-field="service">
          <label for="service">Servicio de interés</label>
          <select id="service" name="service">
            <option value="" disabled selected>Seleccioná un servicio</option>
            <?php foreach ($service_options as $option) : ?>
              <option value="<?php echo esc_attr($option); ?>"><?php echo esc_html($option); ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-row" data-field="message">
          <label for="message">Mensaje</label>
          <textarea id="message" name="message" rows="5" placeholder="Contanos brevemente qué necesitás..."></textarea>
        </div>

        <button type="submit" class="btn btn--primary btn--block">Enviar mensaje</button>
      </form>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="map-placeholder">
      <svg viewBox="0 0 24 24" fill="none"><path d="M12 21s7-6.1 7-11.5A7 7 0 0 0 5 9.5C5 14.9 12 21 12 21Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/><circle cx="12" cy="9.5" r="2.3" stroke="currentColor" stroke-width="1.4"/></svg>
      <span>Buenos Aires, Argentina</span>
    </div>
  </div>
</section>

<?php get_footer(); ?>
