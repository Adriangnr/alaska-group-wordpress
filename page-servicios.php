<?php
/**
 * Página "Servicios" (equivalente a src/app/pages/services).
 * WordPress usa esta plantilla automáticamente para la página con slug "servicios".
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$services = [
    [
        'image' => get_template_directory_uri() . '/assets/images/servicio-aire-acondicionado.jpg',
        'title' => 'Aire acondicionado',
        'subtitle' => 'Split, multisplit, piso/techo, cassette y conductos',
        'description' => 'Instalación, limpieza, revisión y diagnóstico para mejorar el rendimiento y garantizar una climatización eficiente en hogares, comercios e industrias.',
        'points' => [
            'Equipos split, multisplit, piso/techo y cassette',
            'Sistemas por conductos',
            'Limpieza, revisión y diagnóstico de rendimiento',
        ],
    ],
    [
        'image' => get_template_directory_uri() . '/assets/images/servicio-camaras-frigorificas.jpg',
        'title' => 'Cámaras frigoríficas',
        'subtitle' => 'Congelados, carnes y alimentos, cámaras industriales de gran volumen',
        'description' => 'Instalación, mantenimiento y reparación de cámaras frigoríficas: soluciones para conservar productos a la temperatura adecuada.',
        'points' => [
            'Cámaras para congelados, carnes y alimentos',
            'Cámaras industriales de gran volumen',
            'Instalación, mantenimiento y reparación',
        ],
    ],
    [
        'image' => get_template_directory_uri() . '/assets/images/servicio-compresores.jpg',
        'title' => 'Compresores de aire',
        'subtitle' => 'Pistón y tornillo',
        'description' => 'Diagnóstico, reparación y mantenimiento preventivo para garantizar un funcionamiento eficiente y confiable.',
        'points' => [
            'Compresores de pistón y de tornillo',
            'Diagnóstico y reparación',
            'Mantenimiento preventivo',
        ],
    ],
];

$general_title = 'Servicio técnico y urgencias 24h';
$general_description = 'Instalación, mantenimiento y reparación para hogares, comercios e industrias, con atención de urgencias las 24 horas, los 365 días del año. Nos caracteriza el compromiso, la atención personalizada y la rapidez de respuesta.';
?>

<section class="page-hero">
  <div class="container">
    <div class="eyebrow eyebrow--light">Servicios industriales y particulares</div>
    <h1>Climatización, refrigeración y servicio técnico</h1>
    <p class="page-hero__lead">
      Instalación, mantenimiento y reparación para hogares, comercios e industrias, con
      atención de urgencias las 24 horas.
    </p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="services-list">
      <?php foreach ($services as $i => $service) : ?>
        <article class="service-item<?php echo (1 === $i % 2) ? ' service-item--reverse' : ''; ?>">
          <div class="service-item__image">
            <img src="<?php echo esc_url($service['image']); ?>" alt="<?php echo esc_attr($service['title']); ?>" loading="lazy" />
          </div>
          <div class="service-item__body">
            <span class="eyebrow"><?php echo esc_html($service['subtitle']); ?></span>
            <h2><?php echo esc_html($service['title']); ?></h2>
            <p class="text-muted"><?php echo esc_html($service['description']); ?></p>
            <ul class="service-item__points">
              <?php foreach ($service['points'] as $point) : ?>
                <li>
                  <svg viewBox="0 0 24 24" fill="none"><path d="m5 13 4 4 10-10" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  <?php echo esc_html($point); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container general-service">
    <div class="icon-badge icon-badge--lg">
      <svg viewBox="0 0 24 24" fill="none"><path d="M13 2 4 14h6l-1 8 9-12h-6l1-8Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
    </div>
    <h2><?php echo esc_html($general_title); ?></h2>
    <p class="text-muted"><?php echo esc_html($general_description); ?></p>
    <a href="<?php echo esc_url(ALASKA_WHATSAPP_URL); ?>" target="_blank" rel="noopener" class="btn btn--urgent">Escribir por WhatsApp</a>
  </div>
</section>

<section class="section">
  <div class="container cta-final__inner">
    <h2>¿No sabés qué servicio necesitás?</h2>
    <p class="text-muted">Contanos tu caso y te recomendamos la mejor solución sin compromiso.</p>
    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="btn btn--primary">Hablar con Alaska Group</a>
  </div>
</section>

<?php get_footer(); ?>
