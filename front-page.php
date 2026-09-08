<?php
/**
 * Página de inicio (equivalente a src/app/pages/home).
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$highlights = [
    ['value' => '24/7', 'label' => 'Urgencias todo el año'],
    ['value' => 'Hogares', 'label' => 'Instalación y service'],
    ['value' => 'Comercios', 'label' => 'Mantenimiento y reparación'],
    ['value' => 'Industrias', 'label' => 'Servicio técnico integral'],
];

$services = [
    [
        'title' => 'Aire acondicionado',
        'subtitle' => 'Split, multisplit, piso/techo, cassette y conductos',
        'description' => 'Instalación, limpieza, revisión y diagnóstico para mejorar el rendimiento y garantizar una climatización eficiente.',
        'image' => get_template_directory_uri() . '/assets/images/servicio-aire-acondicionado.jpg',
    ],
    [
        'title' => 'Cámaras frigoríficas',
        'subtitle' => 'Congelados, carnes y alimentos, cámaras industriales de gran volumen',
        'description' => 'Instalación, mantenimiento y reparación de cámaras frigoríficas. Soluciones para conservar productos a la temperatura adecuada.',
        'image' => get_template_directory_uri() . '/assets/images/servicio-camaras-frigorificas.jpg',
    ],
    [
        'title' => 'Compresores de aire',
        'subtitle' => 'Pistón y tornillo',
        'description' => 'Diagnóstico, reparación y mantenimiento preventivo para garantizar un funcionamiento eficiente y confiable.',
        'image' => get_template_directory_uri() . '/assets/images/servicio-compresores.jpg',
    ],
];

$features = [
    ['title' => 'Compromiso', 'description' => 'Cumplimos con lo acordado en cada trabajo, del diagnóstico a la entrega.'],
    ['title' => 'Atención personalizada', 'description' => 'Escuchamos tu necesidad puntual y proponemos la solución que corresponde.'],
    ['title' => 'Rapidez de respuesta', 'description' => 'Coordinamos la visita técnica lo antes posible, sin demoras innecesarias.'],
    ['title' => 'Urgencias 24 horas', 'description' => 'Servicio de emergencias disponible los 365 días del año.'],
];

$sectors = ['Hogares', 'Comercios', 'Industrias'];
?>

<section class="hero">
  <div class="hero__bg" aria-hidden="true"></div>
  <div class="container hero__inner">
    <div class="eyebrow eyebrow--light">Servicios industriales y particulares</div>
    <h1>Soluciones que mantienen todo en funcionamiento</h1>
    <p class="hero__lead">
      Somos especialistas en climatización, refrigeración y servicio técnico: instalación,
      mantenimiento y reparación para hogares, comercios e industrias. Tu necesidad, nuestra
      solución.
    </p>
    <div class="hero__actions">
      <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="btn btn--primary">Solicitar presupuesto</a>
      <a href="<?php echo esc_url(home_url('/servicios')); ?>" class="btn btn--outline">Ver servicios</a>
    </div>

    <dl class="hero__stats">
      <?php foreach ($highlights as $item) : ?>
        <div class="hero__stat">
          <dt><?php echo esc_html($item['value']); ?></dt>
          <dd><?php echo esc_html($item['label']); ?></dd>
        </div>
      <?php endforeach; ?>
    </dl>
  </div>
</section>

<section class="section" id="servicios">
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow">Qué hacemos</div>
      <h2>Nuestros servicios</h2>
      <p class="text-muted">
        Instalación, mantenimiento y reparación de sistemas de climatización y refrigeración,
        para hogares, comercios e industrias.
      </p>
    </div>

    <div class="grid grid--3">
      <?php foreach ($services as $service) : ?>
        <article class="card service-card">
          <div class="service-card__image">
            <img src="<?php echo esc_url($service['image']); ?>" alt="<?php echo esc_attr($service['title']); ?>" loading="lazy" />
          </div>
          <h3><?php echo esc_html($service['title']); ?></h3>
          <p class="service-card__subtitle"><?php echo esc_html($service['subtitle']); ?></p>
          <p class="text-muted"><?php echo esc_html($service['description']); ?></p>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="services-cta">
      <a href="<?php echo esc_url(home_url('/servicios')); ?>" class="btn btn--dark">Ver todos los servicios</a>
    </div>
  </div>
</section>

<section class="section" id="trabajos">
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow">Nuestros trabajos</div>
      <h2>Trabajos realizados</h2>
      <p class="text-muted">
        Un vistazo a instalaciones y mantenimientos que hicimos en hogares, comercios e
        industrias. Tocá un trabajo para ver el detalle.
      </p>
    </div>

    <?php
    $works_query = new WP_Query([
        'post_type' => 'trabajo',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'ASC',
    ]);
    ?>

    <?php if ($works_query->have_posts()) : ?>
      <div class="works-carousel">
        <button type="button" class="works-carousel__nav works-carousel__nav--prev" aria-label="Trabajo anterior">
          <svg viewBox="0 0 24 24" fill="none"><path d="m15 6-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>

        <div class="works-carousel__track">
          <?php while ($works_query->have_posts()) : $works_query->the_post(); ?>
            <div class="works-carousel__item">
              <?php get_template_part('template-parts/content', 'work-card', ['work_post_id' => get_the_ID()]); ?>
            </div>
          <?php endwhile; ?>
        </div>

        <button type="button" class="works-carousel__nav works-carousel__nav--next" aria-label="Trabajo siguiente">
          <svg viewBox="0 0 24 24" fill="none"><path d="m9 6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
</section>

<section class="section section--alt">
  <div class="container features">
    <div class="section-head">
      <div class="eyebrow">Por qué elegirnos</div>
      <h2>Compromiso, atención personalizada y rapidez de respuesta</h2>
    </div>

    <div class="grid grid--2 features__grid">
      <?php foreach ($features as $feature) : ?>
        <div class="feature">
          <div class="feature__check" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none"><path d="m5 13 4 4 10-10" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div>
            <h3><?php echo esc_html($feature['title']); ?></h3>
            <p class="text-muted"><?php echo esc_html($feature['description']); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow">Sectores</div>
      <h2>Trabajamos en hogares, comercios e industrias</h2>
    </div>
    <ul class="sectors">
      <?php foreach ($sectors as $sector) : ?>
        <li><?php echo esc_html($sector); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="urgent-band">
  <div class="container urgent-band__inner">
    <div>
      <h2>¿Necesitás asistencia técnica ahora?</h2>
      <p>Servicio de urgencias las 24 horas, los 365 días del año.</p>
    </div>
    <a href="<?php echo esc_url(ALASKA_WHATSAPP_URL); ?>" target="_blank" rel="noopener" class="btn btn--urgent">Escribir por WhatsApp</a>
  </div>
</section>

<section class="section cta-final">
  <div class="container cta-final__inner">
    <h2>Pedí tu presupuesto sin compromiso</h2>
    <p class="text-muted">Contanos qué necesitás y te respondemos a la brevedad.</p>
    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="btn btn--primary">Contactar ahora</a>
  </div>
</section>

<?php get_footer(); ?>
