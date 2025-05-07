<?php
/**
 * single-proyecto.php
 * Plantilla para vista individual de Proyectos
 */
get_header();
?>

<main class="main-content">
  <!-- Hero Section -->
   <?php
  get_template_part('template-parts/content', 'herobanner');
  ?>

  <!-- Detalles del Proyecto -->
  <section class="section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="project-content">
            <?php
            /* Contenido principal del proyecto (editar en el editor WP) */
            the_content();
            ?>
          </div>

          <!-- Habilidades Técnicas (estático, más adelante via ACF) -->
          <div class="text-center">
            <h2 class="section-title mt-5"><?php _e('Habilidades Técnicas', 'myportfolio'); ?></h2>
          </div>
          <div class="tech-grid px-2">
            <div class="tech-card">
              <img src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/html5.svg" class="tech-icon" alt="HTML5" style="filter: invert(1)" />
              <h3 class="tech-title"><?php _e('Lenguajes', 'myportfolio'); ?></h3>
              <div class="tech-items">
                <span class="tech-item">HTML5</span>
                <span class="tech-item">CSS3</span>
                <span class="tech-item">JavaScript</span>
                <span class="tech-item">PHP</span>
                <span class="tech-item">MySQL</span>
              </div>
            </div>
          </div>

          <!-- Demo Section (estático, cambiar src manualmente o con ACF) -->
          <div class="demo-section mt-5 text-center">
            <h2 class="section-title"><?php _e('Demo del Proyecto', 'myportfolio'); ?></h2>
            <iframe
              src="https://via.placeholder.com/1200x800"
              width="100%"
              height="800px"
              style="border: none; border-radius: 10px; background: #fff"
              title="<?php the_title(); ?> - Demo"
            ></iframe>
          </div>

          <!-- Links Section -->
          <div class="links-section mt-5 text-center">
            <a href="#" class="btn btn-primary me-3"><?php _e('Ver Repositorio', 'myportfolio'); ?></a>
            <a href="#" class="btn btn-primary"><?php _e('Ver Proyecto en Vivo', 'myportfolio'); ?></a>
          </div>

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
          <a href="<?php echo esc_url( get_permalink( get_page_by_path('proyectos') ) ); ?>" class="cta-btn cta-btn-primary">
            <i class="fas fa-folder-open"></i> <?php _e('Ver Portafolio', 'myportfolio'); ?>
          </a>
          <a href="<?php echo esc_url( get_permalink( get_page_by_path('contacto') ) ); ?>" class="cta-btn cta-btn-outline">
            <i class="fas fa-paper-plane"></i> <?php _e('Contactar', 'myportfolio'); ?>
          </a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer();
