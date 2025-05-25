<?php

/**
 * Template Name: Vista de Proyecto
 */
get_header();
?>

<main class="main-content">
  <!-- Hero Section -->
  <?php
  get_template_part('global-templates/content', 'herobanner_nocontent');
  ?>

  <!-- Detalles del Proyecto -->
  <section class="section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="project-content">
            <?php if (has_post_thumbnail()) : ?>
              <div class="project-featured-image mb-4 text-center">
                <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
              </div>
            <?php endif; ?>
            <?php the_content(); ?>
          </div>

          <?php
          // 1) Define los CPT y sus campos de relación
          $post_types = [
            'ia'         => 'ias_usadas',
            'wordpress'  => 'wordpress_usadas',
            'lenguaje'   => 'lenguajes_usadas',
            'framework'  => 'frameworks_usadas',
            'componente' => 'componentes_usadas',
            'despliegue' => 'despliegues_usadas',
            'herramienta' => 'herramientas_usadas',
          ];

          // 2) Verificamos si al menos uno tiene selección
          $has_any = false;
          foreach ($post_types as $slug => $field) {
            if (get_field($field)) {
              $has_any = true;
              break;
            }
          }

          if ($has_any) : ?>
            <div class="text-center">
              <h2 class="section-title mt-5"><?php esc_html_e('Habilidades Técnicas', 'myportfolio'); ?></h2>
            </div>
            <div class="tech-grid px-2">
              <?php foreach ($post_types as $slug => $field_name) :
                // 3) Items seleccionados para este CPT
                $items = get_field($field_name);
                if (empty($items) || ! is_array($items)) continue;

                // 4) Recuperar item destacado y estado de inversión
                $featured           = get_field("{$slug}_destacada");
                if ($featured instanceof WP_Post) {
                  $icono             = get_field('icono', $featured->ID);
                  $section_icon_url  = is_array($icono) ? $icono['url'] : $icono;
                  $invert_section    = (bool) get_field('invertir_icono', $featured->ID);
                } else {
                  $section_icon_url  = '';
                  $invert_section    = false;
                }

                // 5) Pasar vars al template parcial
                set_query_var('tech_items',        $items);
                set_query_var('tech_slug',         $slug);
                set_query_var('section_icon_url',  $section_icon_url);
                set_query_var('invert_section',    $invert_section);

                // 6) Llamar al loop-templates/content-techcard.php
                get_template_part('loop-templates/content', 'techcard');
              endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- Demo Section -->
          <?php
          // Obtener el enlace de demo desde un campo personalizado (ej: 'demo_proyecto')
          $demo_proyecto = get_field('demo_proyecto');
          if ($demo_proyecto) : ?>
            <div class="demo-section mt-5 text-center">
              <h2 class="section-title"><?php esc_html_e('Demo del Proyecto', 'myportfolio'); ?></h2>
              <iframe
                src="<?php echo esc_url($demo_proyecto); ?>"
                width="100%"
                height="800px"
                style="border: none; border-radius: 10px; background: #fff"
                title="<?php esc_attr_e('Demo de Proyecto', 'myportfolio'); ?>">
              </iframe>
            </div>
          <?php endif; ?>

          <?php
          // Links Section dinámico
          $repo_url  = get_field('repositorio');
          $page_url  = get_field('pagina_proyecto');
          if ($repo_url || $page_url) : ?>
            <div class="links-section mt-5 text-center">
              <?php if ($repo_url) : ?>
                <a href="<?php echo esc_url($repo_url); ?>" class="btn btn-primary me-3" target="_blank" rel="noopener">
                  <?php esc_html_e('Ver Repositorio', 'myportfolio'); ?>
                </a>
              <?php endif; ?>
              <?php if ($page_url) : ?>
                <a href="<?php echo esc_url($page_url); ?>" class="btn btn-primary" target="_blank" rel="noopener">
                  <?php esc_html_e('Ver Proyecto en Vivo', 'myportfolio'); ?>
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="cta-section">
    <div class="cta-particles">
      <div class="cta-particle" style="top: 20%; left: 15%; width: 8px; height: 8px; animation-delay: -2s;"></div>
      <div class="cta-particle" style="top: 70%; right: 10%; width: 12px; height: 12px; animation-duration: 8s;"></div>
    </div>
    <div class="container">
      <div class="cta-content text-center">
        <h2><?php _e('¿Interesado en más proyectos?', 'myportfolio'); ?></h2>
        <p><?php _e('Explora otros proyectos en mi portafolio o contáctame para colaborar.', 'myportfolio'); ?></p>
        <div class="cta-buttons">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('proyectos'))); ?>" class="cta-btn cta-btn-primary">
            <i class="fas fa-folder-open"></i> <?php _e('Ver Portafolio', 'myportfolio'); ?>
          </a>
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('contacto'))); ?>" class="cta-btn cta-btn-outline">
            <i class="fas fa-paper-plane"></i> <?php _e('Contactar', 'myportfolio'); ?>
          </a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer();
