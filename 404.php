<?php
/**
 * Página 404.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<section class="section">
  <div class="container cta-final__inner">
    <h2>No encontramos esa página</h2>
    <p class="text-muted">Puede que el enlace esté roto o el contenido ya no esté disponible.</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Volver al inicio</a>
  </div>
</section>

<?php get_footer(); ?>
