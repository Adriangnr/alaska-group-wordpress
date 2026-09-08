<?php
/**
 * Plantilla de respaldo genérica (requerida por WordPress).
 * El sitio usa front-page.php, page-servicios.php, page-nosotros.php,
 * page-contacto.php y single-trabajo.php para todo el contenido real.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<section class="section">
  <div class="container">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article>
          <h1><?php the_title(); ?></h1>
          <div><?php the_content(); ?></div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <div class="cta-final__inner">
        <h2>No encontramos esta página</h2>
        <p class="text-muted">Puede que el enlace esté roto o el contenido ya no esté disponible.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Volver al inicio</a>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
