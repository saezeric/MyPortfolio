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

    <!-- Resumen Personal -->
    <section id="quien-soy" class="resumen-personal py-5">
        <div class="container text-center">
            <h2>¿Quién soy?</h2>
            <p>
                Soy un apasionado del desarrollo web y la tecnología, con
                experiencia en la creación de soluciones digitales innovadoras. Mi
                enfoque se centra en ofrecer experiencias de usuario excepcionales y
                en construir proyectos que marquen la diferencia.
            </p>
        </div>
    </section>

    <!-- Sección de Información Relevante -->
    <section class="curriculum p-lg-5">
        <div class="container text-center">
            <h2>Información Relevante</h2>
            <div
                class="d-flex flex-wrap gap-5 informacion-relevante-container px-lg-5">
                <!-- Tarjeta de Experiencia -->
                <div
                    class="card text-white bg-secondary"
                    style="cursor: pointer"
                    data-bs-toggle="modal"
                    data-bs-target="#modalExperiencia1"
                    data-tilt
                    data-tilt-glare
                    data-tilt-max-glare="0.1"
                    data-tilt-speed="300">
                    <div class="card-body">
                        <h5 class="card-title">Desarrollador Web</h5>
                        <p class="card-text">2020 – Actualmente</p>
                        <p class="card-text mt-3 fw-bold">Haz clic para ver más</p>
                    </div>
                </div>
                <!-- Tarjeta de Educación -->
                <div
                    class="card text-white bg-secondary"
                    style="cursor: pointer"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEducacion1"
                    data-tilt
                    data-tilt-glare
                    data-tilt-max-glare="0.1"
                    data-tilt-speed="300">
                    <div class="card-body">
                        <h5 class="card-title">Ingeniería Informática</h5>
                        <p class="card-text">2018 – En proceso</p>
                        <p class="card-text mt-3 fw-bold">Haz clic para ver más</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Experiencia -->
    <div
        class="modal fade"
        id="modalExperiencia1"
        tabindex="-1"
        aria-labelledby="modalExperienciaLabel1"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExperienciaLabel1">
                        Desarrollador Web
                    </h5>
                </div>
                <div class="modal-body">
                    <p><strong>Empresa:</strong> Tech Solutions</p>
                    <p><strong>Periodo:</strong> Enero 2020 – Actualmente</p>
                    <ul>
                        <li>Desarrollo de aplicaciones web</li>
                        <li>Mantenimiento de bases de datos</li>
                        <li>Soporte técnico</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Educación -->
    <div
        class="modal fade"
        id="modalEducacion1"
        tabindex="-1"
        aria-labelledby="modalEducacionLabel1"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEducacionLabel1">
                        Ingeniería Informática
                    </h5>
                </div>
                <div class="modal-body">
                    <p><strong>Institución:</strong> Universidad de Madrid</p>
                    <p><strong>Periodo:</strong> Septiembre 2018 – En proceso</p>
                    <ul>
                        <li>Estudio de algoritmos</li>
                        <li>Desarrollo de software</li>
                        <li>Prácticas profesionales</li>
                    </ul>
                    <hr class="border-secondary" />
                    <h6>Contenidos aprendidos:</h6>
                    <ul>
                        <li>Programación orientada a objetos</li>
                        <li>Bases de datos relacionales</li>
                        <li>Desarrollo web</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

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
                    get_template_part('template-parts/content', 'projectcard');
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>No hay proyectos destacados.</p>';
            endif;
            ?>
        </div>
    </section>


    <!-- Sección de Titulaciones Oficiales -->
    <section id="titulaciones" class="section skills-section py-5">
        <div class="container text-center">
            <h2 class="text-center mb-4">Titulaciones Oficiales</h2>
            <div
                class="titulaciones-container d-flex flex-wrap gap-5 justify-content-center">
                <!-- Tarjeta Titulación 1 -->
                <div
                    class="card"
                    style="width: 18rem; cursor: pointer"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTitulo1"
                    data-tilt
                    data-tilt-glare
                    data-tilt-max-glare="0.1"
                    data-tilt-speed="300">
                    <div class="card-body p-4">
                        <h5 class="card-title">Licenciatura en Informática</h5>
                        <p class="card-text">Universidad Complutense de Madrid</p>
                        <p class="card-text">09/2014 — 07/2018</p>
                        <p class="card-text fw-bold">Haz clic para ver más detalles.</p>
                    </div>
                </div>
                <!-- Modal Titulación 1 -->
                <div
                    class="modal fade"
                    id="modalTitulo1"
                    tabindex="-1"
                    aria-labelledby="modalTituloLabel1"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div
                            class="modal-content"
                            style="background-color: #1a0b2e; color: #fff">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTituloLabel1">
                                    Licenciatura en Informática
                                </h5>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Estudios enfocados en desarrollo de software, algoritmos y
                                    estructuras de datos.
                                </p>
                                <hr class="border-secondary" />
                                <h6>Contenidos aprendidos:</h6>
                                <ul>
                                    <li>Programación en PHP y MySQL</li>
                                    <li>Desarrollo web con HTML, CSS y Bootstrap</li>
                                    <li>Sistemas de información</li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    data-bs-dismiss="modal">
                                    Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta Titulación 2 -->
                <div
                    class="card"
                    style="width: 18rem; cursor: pointer"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTitulo2"
                    data-tilt
                    data-tilt-glare
                    data-tilt-max-glare="0.1"
                    data-tilt-speed="300">
                    <div class="card-body p-4">
                        <h5 class="card-title">Diplomado en Diseño Web</h5>
                        <p class="card-text">Instituto Tecnológico</p>
                        <p class="card-text">01/2019 — 12/2019</p>
                        <p class="card-text fw-bold">Haz clic para ver más detalles.</p>
                    </div>
                </div>
                <!-- Modal Titulación 2 -->
                <div
                    class="modal fade"
                    id="modalTitulo2"
                    tabindex="-1"
                    aria-labelledby="modalTituloLabel2"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div
                            class="modal-content"
                            style="background-color: #1a0b2e; color: #fff">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTituloLabel2">
                                    Diplomado en Diseño Web
                                </h5>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Curso intensivo en diseño web, enfocado en la creación de
                                    interfaces atractivas y usables.
                                </p>
                                <hr class="border-secondary" />
                                <h6>Contenidos aprendidos:</h6>
                                <ul>
                                    <li>Diseño responsivo</li>
                                    <li>UX/UI Design</li>
                                    <li>Herramientas de diseño gráfico</li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    data-bs-dismiss="modal">
                                    Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                        <?php get_template_part('template-parts/content', 'postcard'); ?>
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