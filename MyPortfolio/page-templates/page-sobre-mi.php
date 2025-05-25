<?php

/**
 * Template Name: Sobre Mí
 */
get_header();
?>

<main class="main-content">
    <?php
    // Hero Banner
    get_template_part('global-templates/content', 'herobanner');
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
    // 1) Definimos el CPT que queremos mostrar
    $post_type = 'soft-skill';

    // 2) Comprobamos que exista el CPT
    if (post_type_exists($post_type)) :

        // 3) Obtenemos la etiqueta plural para el título
        $pt_obj = get_post_type_object($post_type);
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

        <!-- Sección de Soft Skills -->
        <section class="container py-5 text-center">
            <h2 class="text-white"><?php echo esc_html($section_title); ?></h2>
            <div class="card-container d-flex flex-wrap gap-3">
                <?php if ($loop->have_posts()) : ?>
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <?php
                        // 5) Llamada al template‐part genérico que renderiza ICONO, TÍTULO y DESCRIPCIÓN
                        get_template_part('loop-templates/content', 'simplecard');
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
    $post_type = 'objetivo-futuro';

    // 2) Comprobamos que exista el CPT
    if (post_type_exists($post_type)) :

        // 3) Obtenemos la etiqueta plural para el título
        $pt_obj = get_post_type_object($post_type);
        $section_title = $pt_obj->labels->name;

        // 4) Preparamos la consulta de todos los items publicados
        $args = [
            'post_type'      => $post_type,
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'ASC', // Cambiamos a ASC para mostrar las más antiguas primero
        ];
        $loop = new WP_Query($args);
    ?>

        <!-- Sección de Objetivos a Futuro -->
        <section class="objetivos-section py-5">
            <div class="container text-center">
                <h2><?php esc_html_e('Objetivos a Futuro', 'myportfolio'); ?></h2>
                <div class="timeline-container">
                    <?php if ($loop->have_posts()) : ?>
                        <div class="timeline-line"></div>
                        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                            <?php
                            // 5) Llamada al template‐part genérico que renderiza ICONO, TÍTULO y DESCRIPCIÓN
                            get_template_part('loop-templates/content', 'timelineitem');
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
    // 1) Definimos el CPT que queremos mostrar
    $post_type = 'interes-personal';

    // 2) Comprobamos que exista el CPT
    if (post_type_exists($post_type)) :

        // 3) Obtenemos la etiqueta plural para el título
        $pt_obj = get_post_type_object($post_type);
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

        <!-- Sección de Intereses Personales -->
        <section class="section">
            <div class="container py-5 mb-5  text-center">
                <!-- Título dinámico según el CPT -->
                <h2><?php echo esc_html($section_title); ?></h2>

                <div class="card-container d-flex flex-wrap gap-3 justify-content-center">
                    <?php if ($loop->have_posts()) : ?>
                        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                            <?php
                            // 5) Llamada al template‐part genérico que renderiza ICONO, TÍTULO y DESCRIPCIÓN
                            get_template_part('loop-templates/content', 'card');
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


</main>

<?php get_footer();
