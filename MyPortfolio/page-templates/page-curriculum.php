<?php

/**
 * Template Name: Curriculum
 */
get_header();
?>

<main class="main-content">
    <?php
    // Hero Banner
    get_template_part('global-templates/content', 'herobanner');
    ?>

    <?php
    // 1) Definimos el CPT que queremos mostrar
    $post_type = 'competencia-digital';

    // 2) Comprobamos que exista el CPT
    if (post_type_exists($post_type)) :

        // 3) Obtenemos la etiqueta plural para el título
        $pt_obj        = get_post_type_object($post_type);
        $section_title = $pt_obj->labels->name;

        // 4) Preparamos la consulta de todos los items publicados
        $args = [
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'ASC',
        ];
        $loop = new WP_Query($args);
    ?>

        <!-- Sección de Competencias Digitales -->
        <section class="container mt-5">
            <div class="text-center">
                <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            </div>

            <div class="skills-grid">
                <?php if ($loop->have_posts()) : ?>
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <?php
                        // 5) Llamada al template‐part que renderiza ICONO, TÍTULO y DESCRIPCIÓN
                        get_template_part('loop-templates/content', 'skillitem');
                        ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p><?php esc_html_e('No hay elementos para mostrar.', 'myportfolio'); ?></p>
                <?php endif; ?>
            </div>
        </section>

    <?php
    endif;
    ?>


    <?php
    // 1) Definimos el CPT que queremos mostrar
    $post_type = 'experiencia-laboral'; // Ajusta este slug al de tu CPT

    // 2) Comprobamos que exista el CPT
    if (post_type_exists($post_type)) :

        // 3) Obtenemos la etiqueta plural para el título
        $pt_obj        = get_post_type_object($post_type);
        $section_title = $pt_obj->labels->name;

        // 4) Preparamos la consulta de todos los items publicados
        $args = [
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];
        $loop = new WP_Query($args);
    ?>

        <!-- Experiencia Laboral -->
        <section class="container my-5">
            <div class="text-center">
                <h2><?php echo esc_html($section_title); ?></h2>
            </div>
            <div class="card-container d-flex flex-wrap gap-4">
                <?php if ($loop->have_posts()) : ?>
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <?php
                        // 5) Llamada al template‐part que renderiza la card + modal
                        get_template_part('loop-templates/content', 'experiencecard');
                        ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p><?php esc_html_e('No hay elementos para mostrar.', 'myportfolio'); ?></p>
                <?php endif; ?>
            </div>
        </section>

    <?php
    endif;
    ?>


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
            'posts_per_page' => -1,
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
                <div class="card-container d-flex flex-wrap gap-4">
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

    <?php
    // 1) Definimos el CPT de Certificaciones (ajusta el slug si lo tuviste distinto)
    $post_type = 'curso'; // o 'cursos', según tu registro

    // 2) Comprobamos que exista
    if (post_type_exists($post_type)) :

        // 3) Obtenemos la etiqueta plural para el título de la sección
        $pt_obj        = get_post_type_object($post_type);
        $section_title = $pt_obj->labels->name;

        // 4) Preparamos la consulta de todos los certificados publicados
        $args = [
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];
        $loop = new WP_Query($args);
    ?>

        <!-- Certificaciones y Cursos Adicionales -->
        <section class="container mt-5 text-center">
            <h2 class="text-white"><?php echo esc_html($section_title); ?></h2>
            <div class="card-container d-flex flex-wrap gap-4">
                <?php if ($loop->have_posts()) : ?>
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <?php
                        // 5) Llamamos a nuestro template‐part genérico de card (icono opcional, título y descripción)
                        get_template_part('loop-templates/content', 'card');
                        ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p class="text-white"><?php esc_html_e('No hay certificaciones para mostrar.', 'myportfolio'); ?></p>
                <?php endif; ?>
            </div>
        </section>

    <?php
    endif;
    ?>

    <?php
    $post_types = ['ia', 'wordpress', 'lenguaje', 'framework', 'componente', 'despliegue', 'herramienta'];
    ?>

    <section class="container mt-5">
        <div class="text-center">
            <h2 class="section-title"><?php esc_html_e('Habilidades Técnicas', 'myportfolio'); ?></h2>
        </div>

        <div class="tech-grid px-2">
            <?php foreach ($post_types as $pt) :
                if (! post_type_exists($pt)) continue;

                $feat = get_posts([
                    'post_type' => '' . $pt . '',
                    'posts_per_page' => 1,
                    'meta_key' => 'destacado',
                    'meta_value' => '1',
                ]);

                $icon_url      = '';
                $icon_post_obj = null;
                if ($feat) {
                    $icon_post_obj = $feat[0];
                    $f = get_field('icono', $icon_post_obj->ID);
                    $icon_url = is_array($f) ? $f['url'] : $f;
                }

                set_query_var('pt', $pt);
                set_query_var('icon_url', $icon_url);
                set_query_var('section_icon_post', $icon_post_obj);

                get_template_part('loop-templates/content', 'techcard');
            endforeach; ?>
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

    <?php
    // 1) Definimos el CPT correcto
    $post_type = 'idioma';
    if (post_type_exists($post_type)) :

        // 2) Etiqueta plural
        $pt_obj        = get_post_type_object($post_type);
        $section_title = $pt_obj->labels->name;

        // 3) Consulta
        $idiomas = new WP_Query([
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);
    ?>

        <!-- Sección de Idiomas -->
        <section class="idiomas-section py-5">
            <div class="container text-center">
                <h2><?php echo esc_html($section_title); ?></h2>
                <div class="timeline-container">
                    <div class="timeline-line"></div>

                    <?php if ($idiomas->have_posts()) : ?>
                        <?php while ($idiomas->have_posts()) : $idiomas->the_post(); ?>
                            <?php
                            // 4) Cada tarjeta
                            get_template_part('loop-templates/content', 'timelineitem_lenguages');
                            ?>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e('No hay idiomas para mostrar.', 'myportfolio'); ?></p>
                    <?php endif; ?>

                </div>
            </div>
        </section>

        <?php
        get_template_part('global-templates/video', 'overlay');
        ?>
    <?php
    endif;
    ?>


    <!-- Descarga del CV -->
    <section class="container my-5 pb-5 text-center">
        <a
            href="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/files/cv.pdf'); ?>"
            class="btn btn-primary"
            download="CV-Eric-Saez.pdf">
            Descargar CV
        </a>
    </section>

</main>

<?php get_footer(); ?>