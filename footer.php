</main>

<footer class="footer">
  <div class="footer__top container">
    <div class="footer__brand">
      <span class="brand__text">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/alaska-logo.png'); ?>" alt="" width="80" height="79" class="footer__logo" />
        <span>
          <strong>ALASKA GROUP</strong>
          <small>HVAC &amp; Refrigeración</small>
        </span>
      </span>
      <p class="text-muted">
        Especialistas en climatización, refrigeración y servicio técnico: instalación,
        mantenimiento y reparación para hogares, comercios e industrias. Compromiso, atención
        personalizada y rapidez de respuesta, con urgencias las 24 horas.
      </p>
      <div class="footer__social">
        <a href="<?php echo esc_url(ALASKA_WHATSAPP_URL); ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5.06-1.33A10 10 0 1 0 12 2Zm0 18.2a8.16 8.16 0 0 1-4.17-1.14l-.3-.18-3.09.81.82-3.02-.2-.31A8.2 8.2 0 1 1 12 20.2Zm4.52-6.13c-.25-.12-1.45-.72-1.68-.8-.22-.08-.39-.12-.55.12-.16.25-.63.8-.78.96-.14.16-.29.18-.53.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.14-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.14.16-.25.24-.41.08-.16.04-.31-.02-.43-.06-.12-.55-1.33-.76-1.82-.2-.48-.4-.42-.55-.42h-.47c-.16 0-.43.06-.65.31-.22.25-.86.84-.86 2.04 0 1.2.88 2.37 1 2.53.12.16 1.73 2.64 4.2 3.7.59.25 1.05.4 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.45-.59 1.65-1.16.2-.57.2-1.06.14-1.16-.06-.1-.22-.16-.47-.28Z" fill="currentColor"/></svg>
        </a>
        <a href="tel:<?php echo esc_attr(ALASKA_PHONE_LINK); ?>" aria-label="Llamar">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.61 21 3 13.39 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.25 1.01l-2.2 2.2Z" fill="currentColor"/></svg>
        </a>
        <a href="mailto:<?php echo esc_attr(ALASKA_EMAIL); ?>" aria-label="Email">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 5h18v14H3V5Zm0 0 9 7 9-7" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
        </a>
      </div>
    </div>

    <div class="footer__col">
      <h4>Enlaces</h4>
      <ul>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a></li>
        <li><a href="<?php echo esc_url(home_url('/servicios')); ?>">Servicios</a></li>
        <li><a href="<?php echo esc_url(home_url('/nosotros')); ?>">Nosotros</a></li>
        <li><a href="<?php echo esc_url(home_url('/contacto')); ?>">Contacto</a></li>
      </ul>
    </div>

    <div class="footer__col">
      <h4>Servicios</h4>
      <ul>
        <?php foreach (['Aire acondicionado', 'Cámaras frigoríficas', 'Compresores de aire', 'Urgencias 24 horas'] as $service) : ?>
          <li><a href="<?php echo esc_url(home_url('/servicios')); ?>"><?php echo esc_html($service); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="footer__col">
      <h4>Contacto</h4>
      <ul class="footer__contact">
        <li>
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.61 21 3 13.39 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.25 1.01l-2.2 2.2Z" fill="currentColor"/></svg>
          <a href="tel:<?php echo esc_attr(ALASKA_PHONE_LINK); ?>"><?php echo esc_html(ALASKA_PHONE_DISPLAY); ?></a>
        </li>
        <li>
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 5h18v14H3V5Zm0 0 9 7 9-7" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
          <a href="mailto:<?php echo esc_attr(ALASKA_EMAIL); ?>"><?php echo esc_html(ALASKA_EMAIL); ?></a>
        </li>
        <li>
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 21s7-6.1 7-11.5A7 7 0 0 0 5 9.5C5 14.9 12 21 12 21Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="12" cy="9.5" r="2.3" stroke="currentColor" stroke-width="1.6"/></svg>
          <span>Buenos Aires, Argentina</span>
        </li>
      </ul>
    </div>
  </div>

  <div class="footer__bottom">
    <div class="container footer__bottom-inner">
      <p>&copy; <?php echo esc_html(date('Y')); ?> Alaska Group. Todos los derechos reservados.</p>
      <p class="text-muted">Sitio web de demostración.</p>
    </div>
  </div>
</footer>

<a href="<?php echo esc_url(ALASKA_WHATSAPP_URL); ?>" target="_blank" rel="noopener" class="call-fab" aria-label="Escribir por WhatsApp">
  <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path
      d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5.06-1.33A10 10 0 1 0 12 2Zm0 18.2a8.16 8.16 0 0 1-4.17-1.14l-.3-.18-3.09.81.82-3.02-.2-.31A8.2 8.2 0 1 1 12 20.2Zm4.52-6.13c-.25-.12-1.45-.72-1.68-.8-.22-.08-.39-.12-.55.12-.16.25-.63.8-.78.96-.14.16-.29.18-.53.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.14-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.14.16-.25.24-.41.08-.16.04-.31-.02-.43-.06-.12-.55-1.33-.76-1.82-.2-.48-.4-.42-.55-.42h-.47c-.16 0-.43.06-.65.31-.22.25-.86.84-.86 2.04 0 1.2.88 2.37 1 2.53.12.16 1.73 2.64 4.2 3.7.59.25 1.05.4 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.45-.59 1.65-1.16.2-.57.2-1.06.14-1.16-.06-.1-.22-.16-.47-.28Z"
      fill="currentColor"
    />
  </svg>
  <span class="call-fab__text">WhatsApp</span>
</a>

<?php wp_footer(); ?>
</body>
</html>
