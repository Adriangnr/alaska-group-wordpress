<?php
/**
 * Vista de detalle de un trabajo (equivalente a src/app/pages/work-detail).
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $post_id = get_the_ID();
        $work = alaska_get_work_data($post_id);
        $thumb_url = get_the_post_thumbnail_url($post_id, 'large');
        ?>

        <section class="page-hero work-hero">
          <div class="container">
            <a href="<?php echo esc_url(home_url('/#trabajos')); ?>" class="back-link">
              <svg viewBox="0 0 24 24" fill="none"><path d="m15 6-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              Volver a trabajos
            </a>
            <div class="eyebrow eyebrow--light"><?php echo esc_html($work['category']); ?></div>
            <h1><?php the_title(); ?></h1>
            <p class="page-hero__lead"><?php echo esc_html($work['summary']); ?></p>
          </div>
        </section>

        <section class="section">
          <div class="container work-detail-grid">
            <div class="work-detail-gallery">
              <?php if ($thumb_url) : ?>
                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="work-detail-gallery__photo" loading="lazy" />
              <?php endif; ?>
            </div>

            <div class="work-detail-body">
              <h2>Qué hicimos</h2>
              <ul class="work-detail-scope">
                <?php foreach ($work['scope'] as $item) : ?>
                  <li>
                    <svg viewBox="0 0 24 24" fill="none"><path d="m5 13 4 4 10-10" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <?php echo esc_html($item); ?>
                  </li>
                <?php endforeach; ?>
              </ul>
              <p class="work-detail-sector"><strong>Sector:</strong> <?php echo esc_html($work['sector']); ?></p>
              <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="btn btn--primary">Quiero un trabajo similar</a>
            </div>
          </div>
        </section>

        <?php
        $others_query = new WP_Query([
            'post_type' => 'trabajo',
            'posts_per_page' => 2,
            'post__not_in' => [$post_id],
            'orderby' => 'date',
            'order' => 'ASC',
        ]);
        ?>

        <?php if ($others_query->have_posts()) : ?>
          <section class="section section--alt">
            <div class="container">
              <div class="section-head center">
                <div class="eyebrow">Más trabajos</div>
                <h2>Otros trabajos realizados</h2>
              </div>
              <div class="grid grid--2">
                <?php while ($others_query->have_posts()) : $others_query->the_post(); ?>
                  <?php get_template_part('template-parts/content', 'work-card', ['work_post_id' => get_the_ID()]); ?>
                <?php endwhile; ?>
              </div>
            </div>
          </section>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <?php
    endwhile;
else :
    ?>
    <section class="section">
      <div class="container cta-final__inner">
        <h2>No encontramos ese trabajo</h2>
        <p class="text-muted">Puede que el enlace esté roto o el trabajo ya no esté disponible.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Volver al inicio</a>
      </div>
    </section>
    <?php
endif;

get_footer();
