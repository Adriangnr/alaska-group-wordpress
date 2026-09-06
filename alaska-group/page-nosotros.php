<?php
/**
 * Página "Nosotros" (equivalente a src/app/pages/about).
 * WordPress usa esta plantilla automáticamente para la página con slug "nosotros".
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$values = [
    ['title' => 'Compromiso', 'description' => 'Cumplimos con lo acordado en cada trabajo, del diagnóstico a la entrega.'],
    ['title' => 'Atención personalizada', 'description' => 'Escuchamos tu necesidad puntual y proponemos la solución que corresponde, sin vueltas.'],
    ['title' => 'Rapidez de respuesta', 'description' => 'Coordinamos la visita técnica lo antes posible, sin demoras innecesarias.'],
    ['title' => 'Urgencias 24 horas', 'description' => 'Servicio de emergencias disponible los 365 días del año, para que nada se detenga.'],
];

$sectors = [
    ['title' => 'Hogares', 'description' => 'Instalación, limpieza y mantenimiento de aires acondicionados y equipos de refrigeración doméstica.'],
    ['title' => 'Comercios', 'description' => 'Climatización y refrigeración comercial: vitrinas, cámaras y equipos de conservación de alimentos.'],
    ['title' => 'Industrias', 'description' => 'Cámaras frigoríficas de gran volumen, compresores de aire y mantenimiento técnico industrial.'],
];
?>

<section class="page-hero">
  <div class="container">
    <div class="eyebrow eyebrow--light">Nosotros</div>
    <h1>Tu necesidad, nuestra solución</h1>
    <p class="page-hero__lead">
      Somos especialistas en climatización, refrigeración y servicio técnico, ofreciendo
      instalación, mantenimiento y reparación para hogares, comercios e industrias. Nos
      caracteriza el compromiso, la atención personalizada y la rapidez de respuesta, con
      servicio de urgencias las 24 horas.
    </p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow">Lo que nos define</div>
      <h2>Cómo trabajamos</h2>
    </div>
    <div class="grid grid--4">
      <?php foreach ($values as $value) : ?>
        <div class="card value-card">
          <h3><?php echo esc_html($value['title']); ?></h3>
          <p class="text-muted"><?php echo esc_html($value['description']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section--alt">
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow">Sectores</div>
      <h2>Servicios industriales y particulares</h2>
    </div>
    <div class="grid grid--3">
      <?php foreach ($sectors as $sector) : ?>
        <div class="card">
          <h3><?php echo esc_html($sector['title']); ?></h3>
          <p class="text-muted"><?php echo esc_html($sector['description']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container contact-highlight">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/alaska-logo.png'); ?>" alt="" width="80" height="79" class="contact-highlight__logo" />
    <div>
      <h2>Hablá directamente con nosotros</h2>
      <p class="text-muted">
        Emmanuel Sibona atiende personalmente cada consulta: contanos qué necesitás y te
        proponemos la mejor solución.
      </p>
    </div>
    <a href="<?php echo esc_url(ALASKA_WHATSAPP_URL); ?>" target="_blank" rel="noopener" class="btn btn--primary">Escribir por WhatsApp</a>
  </div>
</section>

<section class="section section--alt">
  <div class="container cta-final__inner">
    <h2>¿Querés trabajar con nosotros?</h2>
    <p class="text-muted">Contanos sobre tus instalaciones y cómo podemos ayudarte a mantenerlas.</p>
    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="btn btn--primary">Contactar</a>
  </div>
</section>

<?php get_footer(); ?>
