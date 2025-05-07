<?php

/**
 * archive-proyecto.php
 * Listado de Proyectos (CPT 'proyecto') con paginación correcta
 */
get_header();

// 1. Obtener la página actual para la paginación
$paged = max(
  1,
  get_query_var('paged'),  // para /proyectos/page/2/
  get_query_var('page')    // por si usas paginación en plantillas de página
);

// 2. Consulta de proyectos con 'paged'
$args = [
  'post_type'      => 'proyecto',
  'posts_per_page' => 9,
  'orderby'        => 'date',
  'order'          => 'DESC',
  'paged'          => $paged,
];
$proyectos_query = new WP_Query($args);
?>

<main class="main-content">
  <!-- Proyectos Destacados -->
  <section id="proyectos" class="container p-5 text-center">
    <h1 class="mb-4"><?php post_type_archive_title(); ?></h1>

    <div class="card-container proyectos d-flex flex-wrap gap-5 justify-content-center py-4">
      <?php if ($proyectos_query->have_posts()) : ?>
        <?php while ($proyectos_query->have_posts()) : $proyectos_query->the_post(); ?>
          <?php get_template_part('template-parts/content', 'projectcard'); ?>
        <?php endwhile; ?>

        <!-- 3. Paginación -->
        <div class="w-100 mt-4">
          <?php
          echo paginate_links([
            'total'   => $proyectos_query->max_num_pages,
            'current' => $paged,
            'prev_text' => __('Anterior', 'myportfolio'),
            'next_text' => __('Siguiente', 'myportfolio'),
          ]);
          ?>
        </div>

        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <p><?php esc_html_e('No hay proyectos para mostrar.', 'myportfolio'); ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>