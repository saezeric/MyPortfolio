<?php get_header(); ?>
<!-- Header -->

<!-- Main Content -->
<main class="main-content">
    <!-- Banner Rediseñado -->
    <section class="banner">
        <div class="connection-dots">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div
            class="connection-line"
            style="top: 30%; left: 20%; width: 100px; transform: rotate(30deg)"></div>
        <div
            class="connection-line"
            style="top: 60%; right: 25%; width: 150px; transform: rotate(-15deg)"></div>

        <div
            class="container d-flex align-items-center justify-content-between py-5">
            <div class="banner-text px-3">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
                <a href="/contacto" class="btn btn-primary">Conóceme más</a>
            </div>
            <?php
            if (function_exists('the_custom_logo')) {
                the_custom_logo();
            }
            ?>
        </div>
    </section>

    <?php
    // Obtenemos la(s) entrada(s) de “Quién soy”
    $qs_posts = get_posts([
        'post_type'      => 'quien-soy',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ]);

    if ($qs_posts) :
        // Tomamos la primera
        $qs = $qs_posts[0];
        $title = get_the_title($qs);
        // Campo ACF “descripcion”
        $description = get_field('descripcion', $qs->ID);
    ?>
        <!-- Resumen Personal dinámico -->
        <section id="quien-soy" class="resumen-personal py-5">
            <div class="container text-center">
                <h2><?php echo esc_html($title); ?></h2>
                <?php if ($description) : ?>
                    <p><?php echo wp_kses_post($description); ?></p>
                <?php endif; ?>
            </div>
        </section>
    <?php
    endif;
    ?>


    <!-- Sección de Información Relevante -->
    <section id="informacion-relevante" class="curriculum p-lg-5">
        <div class="container">
            <h2 class="w-100 text-center"><?php esc_html_e('Información Relevante', 'myportfolio'); ?></h2>
            <div class="d-flex flex-wrap gap-5 informacion-relevante-container px-lg-5">

                <?php
                // 1) Experiencia Laboral – última entrada
                $exp_posts = get_posts([
                    'post_type'      => 'experiencia-laboral',
                    'posts_per_page' => 1,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);
                if ($exp_posts) {
                    global $post;
                    $post = $exp_posts[0];
                    setup_postdata($post);
                    get_template_part('loop-templates/content', 'experiencecard');
                    wp_reset_postdata();
                }

                // 2) Formación Profesional – última entrada
                $for_posts = get_posts([
                    'post_type'      => 'formacio-profesional',
                    'posts_per_page' => 1,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);
                if ($for_posts) {
                    global $post;
                    $post = $for_posts[0];
                    setup_postdata($post);
                    get_template_part('loop-templates/content', 'formationcard');
                    wp_reset_postdata();
                }
                ?>

            </div>
        </div>
    </section>

    <!-- Proyectos Destacados -->
    <section id="proyectos" class="container p-5 text-center">
        <h2>Proyectos Destacados</h2>
        <div class="card-container proyectos d-flex flex-wrap gap-5 justify-content-center py-4">
            <?php
            $args = [
                'post_type'      => 'proyecto',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'meta_query'     => [
                    [
                        'key'     => 'proyecto_destacado',
                        'value'   => '1',
                        'compare' => '=',
                    ]
                ],
            ];
            $destacados = new WP_Query($args);

            if ($destacados->have_posts()):
                while ($destacados->have_posts()): $destacados->the_post();
                    get_template_part('loop-templates/content', 'projectcard');
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>No hay proyectos destacados.</p>';
            endif;
            ?>
        </div>
    </section>


    <!-- Sección de Titulaciones Oficiales -->
    <?php
    // 1) Definimos el CPT
    $post_type = 'formacio-profesional';

    // 2) Comprobamos que exista
    if (post_type_exists($post_type)) :

        // 3) Obtenemos el nombre plural para el título
        $pt_obj        = get_post_type_object($post_type);
        $section_title = $pt_obj->labels->name;

        // 4) Preparamos la consulta
        $args = [
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'posts_per_page' => 2,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];
        $loop = new WP_Query($args);
    ?>
        <!-- Formación Profesional -->
        <section class="section">
            <div class="container">
                <div class="text-center">
                    <h2><?php echo esc_html($section_title); ?></h2>
                </div>
                <div class="card-container d-flex flex-wrap gap-5">
                    <?php if ($loop->have_posts()) : ?>
                        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                            <?php
                            // 5) Llamamos al template‐part genérico que renderiza card+modal
                            get_template_part('loop-templates/content', 'formationcard');
                            ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e('No hay elementos para mostrar.', 'myportfolio'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php
    endif;
    ?>

    <!-- Sección de Últimas Entradas del Blog -->
    <section id="blog" class="blog py-5">
        <div class="container text-center">
            <h2 class="text-center mb-4">Últimas Entradas del Blog</h2>
            <div class="card-container d-flex flex-wrap gap-5 justify-content-center">
                <?php
                // Query para obtener las últimas 3 entradas
                $recent_posts = new WP_Query(array(
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                ));

                // Loop para mostrar las entradas
                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) : $recent_posts->the_post();
                ?>
                        <?php get_template_part('loop-templates/content', 'postcard'); ?>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No hay entradas recientes.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
<!-- Footer -->