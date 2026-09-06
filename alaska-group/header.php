<!doctype html>
<html lang="es" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header">
  <div class="header__bar">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="brand">
      <span class="brand__mark" aria-hidden="true">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/alaska-logo.png'); ?>" alt="" width="80" height="79" />
      </span>
      <span class="brand__text">
        <strong>ALASKA GROUP</strong>
        <small>HVAC &amp; Refrigeración</small>
      </span>
    </a>

    <nav class="nav" aria-label="Navegación principal">
      <ul>
        <li><a href="<?php echo esc_url(home_url('/')); ?>" class="<?php echo is_front_page() ? 'active' : ''; ?>">Inicio</a></li>
        <li><a href="<?php echo esc_url(home_url('/servicios')); ?>" class="<?php echo is_page('servicios') ? 'active' : ''; ?>">Servicios</a></li>
        <li><a href="<?php echo esc_url(home_url('/#trabajos')); ?>">Trabajos</a></li>
        <li><a href="<?php echo esc_url(home_url('/nosotros')); ?>" class="<?php echo is_page('nosotros') ? 'active' : ''; ?>">Nosotros</a></li>
        <li><a href="<?php echo esc_url(home_url('/contacto')); ?>" class="<?php echo is_page('contacto') ? 'active' : ''; ?>">Contacto</a></li>
      </ul>
    </nav>

    <a href="tel:<?php echo esc_attr(ALASKA_PHONE_LINK); ?>" class="header__phone">
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.61 21 3 13.39 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.25 1.01l-2.2 2.2Z"
          fill="currentColor"
        />
      </svg>
      <span>
        <small>Urgencias 24h</small>
        <?php echo esc_html(ALASKA_PHONE_DISPLAY); ?>
      </span>
    </a>

    <button
      type="button"
      class="burger"
      aria-expanded="false"
      aria-label="Abrir menú de navegación"
    >
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<main class="site-main">
