<?php

/**
 * archive-proyecto.php
 * Listado de Proyectos (CPT 'proyecto') con filtro y paginación vía shortcode
 */
get_header();

// 1. Obtener la página actual para la paginación (shortcode la usa internamente)
$paged = max(
  1,
  get_query_var('paged'),
  get_query_var('page')
);
?>

<main class="main-content">
  <!-- Proyectos Destacados con Filtro -->
  <section id="proyectos" class="container p-5 text-center">
    <h1 class="mb-5"><?php post_type_archive_title(); ?></h1>
    <?php
    // Insertar shortcode de filtro y listado de proyectos
    echo do_shortcode('[proyectos_filtro]');
    ?>
  </section>
</main>

<?php get_footer();
