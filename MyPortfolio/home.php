<?php

/**
 * home.php
 * Listado paginado de Noticias (Posts)
 */
get_header();

// 1. Obtener la página actual
$paged = max(
    1,
    get_query_var('paged'),
    get_query_var('page')
);

// 2. Argumentos de la consulta
$args = [
    'post_type'      => 'post',
    'posts_per_page' => 9,          // Número de posts por página
    'orderby'        => 'date',
    'order'          => 'DESC',
    'paged'          => $paged,
];

// 3. Ejecutar la consulta
$blog_query = new WP_Query($args);
?>

<!-- Main Content -->
<main class="main-content">
    <!-- Sección de Últimas Entradas del Blog -->
    <section id="blog" class="blog py-5">
        <div class="container text-center">
            <!-- Título dinámico de la página de entradas -->
            <h1 class="text-center mb-4">
                <?php echo esc_html(get_the_title(get_option('page_for_posts'))); ?>
            </h1>

            <div class="card-container d-flex flex-wrap gap-5 justify-content-center">
                <?php if ($blog_query->have_posts()) : ?>
                    <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        <?php get_template_part('template-parts/content', 'postcard'); ?>
                    <?php endwhile; ?>

                    <!-- Paginación -->
                    <div class="w-100 mt-4">
                        <?php
                        echo paginate_links([
                            'total'     => $blog_query->max_num_pages,
                            'current'   => $paged,
                            'prev_text' => __('Anterior', 'myportfolio'),
                            'next_text' => __('Siguiente', 'myportfolio'),
                        ]);
                        ?>
                    </div>

                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p><?php esc_html_e('No hay noticias publicadas.', 'myportfolio'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>