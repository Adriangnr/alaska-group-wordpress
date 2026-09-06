<?php
/**
 * Tarjeta de un "trabajo" (work-card). Se usa en el carrusel de la home,
 * en la sección "Más trabajos" del detalle, y en cualquier grilla de trabajos.
 *
 * Espera `$work_post_id` en scope; si no está definido usa el post actual.
 */

if (!defined('ABSPATH')) {
    exit;
}

$work_post_id = isset($work_post_id) ? $work_post_id : get_the_ID();
$work = alaska_get_work_data($work_post_id);
$title = get_the_title($work_post_id);
$permalink = get_permalink($work_post_id);
$thumb_url = get_the_post_thumbnail_url($work_post_id, 'medium_large');

$icons = [
    'search' => '<svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="1.6"/><path d="m20 20-3.8-3.8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
    'wrench' => '<svg viewBox="0 0 24 24" fill="none"><path d="M14.7 6.3a4 4 0 0 0-5.4 4.9L4 16.5V20h3.5l5.3-5.3a4 4 0 0 0 4.9-5.4l-2.8 2.8-2-2 2.8-2.8Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>',
    'check' => '<svg viewBox="0 0 24 24" fill="none"><path d="m5 13 4 4 10-10" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
];
?>
<div class="work-card-host">
  <a href="<?php echo esc_url($permalink); ?>" class="work-card">
    <div class="work-card__gallery">
      <?php if ($thumb_url) : ?>
        <div class="work-card__slide is-active" data-type="photo">
          <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy" />
        </div>
      <?php endif; ?>

      <?php foreach ($work['steps'] as $index => $step) :
        if ('' === trim((string) $step['label'])) {
            continue;
        }
        $is_active = !$thumb_url && 0 === $index;
        ?>
        <div class="work-card__slide<?php echo $is_active ? ' is-active' : ''; ?>" data-type="step">
          <div class="work-card__step">
            <div class="work-card__step-icon">
              <?php echo $icons[$step['icon']]; ?>
            </div>
            <span><?php echo esc_html($step['label']); ?></span>
          </div>
        </div>
      <?php endforeach; ?>

      <span class="work-card__category<?php echo $thumb_url ? '' : ' is-visible'; ?>"><?php echo esc_html($work['category']); ?></span>

      <div class="work-card__dots">
        <?php
        $slide_count = ($thumb_url ? 1 : 0) + count(array_filter($work['steps'], function ($step) {
            return '' !== trim((string) $step['label']);
        }));
        for ($i = 0; $i < $slide_count; $i++) :
            ?>
          <span class="work-card__dot<?php echo (0 === $i) ? ' is-active' : ''; ?>"></span>
        <?php endfor; ?>
      </div>
    </div>

    <div class="work-card__body">
      <h3><?php echo esc_html($title); ?></h3>
      <p class="text-muted"><?php echo esc_html($work['short_description']); ?></p>
      <span class="work-card__link">
        Ver detalle
        <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </span>
    </div>
  </a>
</div>
