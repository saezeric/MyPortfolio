<?php

/**
 * page-curriculum.php
 * Plantilla específica para la página “Curriculum”
 *
 * Slug: curriculum
 */
get_header();
?>

<main class="main-content">
    <?php
    // Hero Banner
    get_template_part('template-parts/content', 'herobanner');
    ?>

    <!-- Competencias Digitales -->
    <section class="container mt-5">
        <div class="text-center">
            <h2 class="section-title">Competencias Digitales</h2>
        </div>

        <div class="skills-grid">
            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-title">Alfabetización en información y datos</span>
                    <span class="skill-level">Avanzado</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-title">Comunicación y colaboración</span>
                    <span class="skill-level">Avanzado</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-title">Creación de contenidos digitales</span>
                    <span class="skill-level">Avanzado</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-title">Seguridad</span>
                    <span class="skill-level">Avanzado</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-header">
                    <span class="skill-title">Resolución de problemas</span>
                    <span class="skill-level">Avanzado</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experiencia Laboral -->
    <section class="container mt-5 text-center">
        <h2>Experiencia Laboral</h2>
        <div class="card-container d-flex flex-wrap gap-4">
            <!-- Experiencia 1 -->
            <div
                class="card"
                data-bs-toggle="modal"
                data-bs-target="#modalExp1"
                data-tilt
                data-tilt-glare
                data-tilt-max-glare="0.1"
                data-tilt-speed="300"
                style="cursor: pointer; width: 18rem">
                <div class="card-body">
                    <h5 class="card-title">Desarrollador Web</h5>
                    <p class="card-text">
                        Tech Solutions<br />
                        <small>Enero 2020 - Actualmente</small>
                    </p>
                    <p class="card-text mt-4">Haz clic para ver más</p>
                </div>
            </div>
            <div class="modal fade" id="modalExp1" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #1a0b2e">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">Desarrollador Web</h5>
                        </div>
                        <div class="modal-body text-white">
                            <p>
                                <strong>Empresa:</strong> Tech Solutions<br />
                                <strong>Período:</strong> Enero 2020 - Actualmente
                            </p>
                            <ul>
                                <li>Diseño e implementación de aplicaciones web</li>
                                <li>Mantenimiento y optimización de bases de datos</li>
                                <li>Integración de APIs REST</li>
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

            <!-- Experiencia 2 -->
            <div
                class="card"
                data-bs-toggle="modal"
                data-bs-target="#modalExp2"
                data-tilt
                data-tilt-glare
                data-tilt-max-glare="0.1"
                data-tilt-speed="300"
                style="cursor: pointer; width: 18rem">
                <div class="card-body">
                    <h5 class="card-title">Ingeniero de Software</h5>
                    <p class="card-text">
                        Innovatech<br />
                        <small>Julio 2018 - Diciembre 2019</small>
                    </p>
                    <p class="card-text mt-4">Haz clic para ver más</p>
                </div>
            </div>
            <div class="modal fade" id="modalExp2" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #1a0b2e">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">Ingeniero de Software</h5>
                        </div>
                        <div class="modal-body text-white">
                            <p>
                                <strong>Empresa:</strong> Innovatech<br />
                                <strong>Período:</strong> Julio 2018 - Diciembre 2019
                            </p>
                            <ul>
                                <li>Desarrollo de componentes backend en PHP y Node.js</li>
                                <li>Automatización de procesos con scripts en Python</li>
                                <li>Revisión de código y mentoría de equipo junior</li>
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
        </div>
    </section>

    <!-- Formación Profesional -->
    <section class="section">
        <div class="container text-center">
            <h2>Formación Profesional</h2>
            <div class="card-container d-flex flex-wrap gap-4">
                <!-- Titulación 1 -->
                <div
                    class="card"
                    data-bs-toggle="modal"
                    data-bs-target="#modalQual1"
                    data-tilt
                    data-tilt-glare
                    data-tilt-max-glare="0.1"
                    data-tilt-speed="300"
                    style="cursor: pointer; width: 18rem">
                    <div class="card-body">
                        <h5 class="card-title">Ingeniería Informática</h5>
                        <p class="card-text">Universidad de Madrid</p>
                        <p class="card-text">Septiembre 2014 — Junio 2018</p>
                        <p class="card-text mt-4">Haz clic para ver más</p>
                    </div>
                </div>
                <div class="modal fade" id="modalQual1" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: #1a0b2e">
                            <div class="modal-header">
                                <h5 class="modal-title text-white">Ingeniería Informática</h5>
                            </div>
                            <div class="modal-body text-white">
                                <p><strong>Institución:</strong> Universidad de Madrid</p>
                                <p>
                                    <strong>Período:</strong> Septiembre 2014 — Junio 2018
                                </p>
                                <p>
                                    Estudios centrados en desarrollo de software, algoritmos y
                                    bases de datos.
                                </p>
                                <hr class="border-secondary" />
                                <h6>Contenidos aprendidos:</h6>
                                <ul>
                                    <li>Programación en Java y C++</li>
                                    <li>Bases de datos relacionales</li>
                                    <li>Estructuras de datos y algoritmos</li>
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

                <!-- Titulación 2 -->
                <div
                    class="card"
                    data-bs-toggle="modal"
                    data-bs-target="#modalQual2"
                    data-tilt
                    data-tilt-glare
                    data-tilt-max-glare="0.1"
                    data-tilt-speed="300"
                    style="cursor: pointer; width: 18rem">
                    <div class="card-body">
                        <h5 class="card-title">Máster en Inteligencia Artificial</h5>
                        <p class="card-text">Instituto Tecnológico</p>
                        <p class="card-text">Enero 2021 — Diciembre 2021</p>
                        <p class="card-text mt-4">Haz clic para ver más</p>
                    </div>
                </div>
                <div class="modal fade" id="modalQual2" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: #1a0b2e">
                            <div class="modal-header">
                                <h5 class="modal-title text-white">
                                    Máster en Inteligencia Artificial
                                </h5>
                            </div>
                            <div class="modal-body text-white">
                                <p><strong>Institución:</strong> Instituto Tecnológico</p>
                                <p><strong>Período:</strong> Enero 2021 — Diciembre 2021</p>
                                <p>
                                    Programa avanzado en aprendizaje automático y redes
                                    neuronales.
                                </p>
                                <hr class="border-secondary" />
                                <h6>Contenidos aprendidos:</h6>
                                <ul>
                                    <li>Machine Learning con Python</li>
                                    <li>Redes Neuronales y Deep Learning</li>
                                    <li>Procesamiento de lenguaje natural</li>
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
            </div>
        </div>
    </section>

    <!-- Habilidades Técnicas -->
    <section class="container mt-5">
        <div class="text-center">
            <h2 class="section-title">Habilidades Técnicas</h2>
        </div>

        <div class="tech-grid px-2">
            <div class="tech-card">
                <img
                    src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/javascript.svg"
                    class="tech-icon"
                    alt="Lenguajes"
                    style="filter: invert(1)" />
                <h3 class="tech-title">Lenguajes</h3>
                <div class="tech-items">
                    <span class="tech-item">Java</span>
                    <span class="tech-item">C#</span>
                    <span class="tech-item">C++</span>
                    <span class="tech-item">Python</span>
                    <span class="tech-item">JS</span>
                    <span class="tech-item">PHP</span>
                    <span class="tech-item">SQL</span>
                </div>
            </div>

            <div class="tech-card">
                <img
                    src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/react.svg"
                    class="tech-icon"
                    alt="Frameworks"
                    style="filter: invert(1)" />
                <h3 class="tech-title">Frameworks</h3>
                <div class="tech-items">
                    <span class="tech-item">Django</span>
                    <span class="tech-item">Bootstrap</span>
                </div>
            </div>

            <div class="tech-card">
                <img
                    src="https://cdn.jsdelivr.net/npm/simple-icons@v5/icons/visualstudiocode.svg"
                    class="tech-icon"
                    alt="Entornos"
                    style="filter: invert(1)" />
                <h3 class="tech-title">Entornos</h3>
                <div class="tech-items">
                    <span class="tech-item">Visual Studio</span>
                    <span class="tech-item">VS Code</span>
                </div>
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
                    get_template_part('template-parts/content', 'projectcard');
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>No hay proyectos destacados.</p>';
            endif;
            ?>
        </div>
    </section>


    <!-- Competencias Personales -->
    <section class="container mt-5 text-center">
        <h2 class="text-white">Competencias Personales</h2>
        <div class="card-container d-flex flex-wrap gap-3">
            <div class="card text-center" style="width: 18rem">
                <div class="card-body">
                    <i class="fas fa-comments fa-2x mb-3 text-white"></i>
                    <h5 class="card-title text-white">
                        Alta capacidad de comunicación
                    </h5>
                    <p class="card-text text-white">
                        Habilidad para comunicar ideas de manera clara y efectiva.
                    </p>
                </div>
            </div>
            <div class="card text-center" style="width: 18rem">
                <div class="card-body">
                    <i class="fas fa-users fa-2x mb-3 text-white"></i>
                    <h5 class="card-title text-white">Trabajo en equipo</h5>
                    <p class="card-text text-white">
                        Colaboración efectiva en entornos grupales.
                    </p>
                </div>
            </div>
            <div class="card text-center" style="width: 18rem">
                <div class="card-body">
                    <i class="fas fa-hand-holding-heart fa-2x mb-3 text-white"></i>
                    <h5 class="card-title text-white">Empatía y confianza</h5>
                    <p class="card-text text-white">
                        Capacidad para entender y conectar con los demás.
                    </p>
                </div>
            </div>
            <div class="card text-center" style="width: 18rem">
                <div class="card-body">
                    <i class="fas fa-brain fa-2x mb-3 text-white"></i>
                    <h5 class="card-title text-white">Optimismo y perseverancia</h5>
                    <p class="card-text text-white">
                        Enfoque positivo y determinación para superar desafíos.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Idiomas -->
    <section class="idiomas-section py-5">
        <div class="container text-center">
            <h2>Idiomas</h2>
            <div class="timeline-container">
                <div class="timeline-line"></div>
                <div class="timeline-item">
                    <i class="fas fa-language fa-2x mb-3 text-white"></i>
                    <h5>Castellano</h5>
                    <p>Nativo</p>
                </div>
                <div class="timeline-item">
                    <i class="fas fa-language fa-2x mb-3 text-white"></i>
                    <h5>Catalán</h5>
                    <p>Nativo</p>
                </div>
                <div class="timeline-item">
                    <i class="fas fa-language fa-2x mb-3 text-white"></i>
                    <h5>Inglés</h5>
                    <p>Alto</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Certificaciones y Cursos Adicionales -->
    <section class="container mt-5 text-center">
        <h2 class="text-white">Certificaciones y Cursos Adicionales</h2>
        <div class="card-container d-flex flex-wrap gap-4">
            <div class="card text-center" style="width: 18rem">
                <div class="card-body">
                    <h5 class="card-title text-white">
                        WordPress Básico y Elementor Pro
                    </h5>
                    <p class="card-text text-white">
                        Certificación en diseño y desarrollo con WordPress.
                    </p>
                </div>
            </div>
            <div class="card text-center" style="width: 18rem">
                <div class="card-body">
                    <h5 class="card-title text-white">
                        IA Generativa y Automatización
                    </h5>
                    <p class="card-text text-white">
                        Especialización en IA generativa y automatización de tareas.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Intereses y Hobbies -->
    <section class="container mt-5 mb-5 text-center">
        <h2 class="text-white">Intereses y Hobbies</h2>
        <div class="card-container d-flex flex-wrap gap-4">
            <div class="card text-center" style="width: 18rem">
                <div class="card-body">
                    <i class="fas fa-gamepad fa-2x mb-3 text-white"></i>
                    <h5 class="card-title text-white">
                        Desarrollo de videojuegos con Unity
                    </h5>
                    <p class="card-text text-white">
                        Creación de videojuegos y experiencias interactivas.
                    </p>
                </div>
            </div>
            <div class="card text-center" style="width: 18rem">
                <div class="card-body">
                    <i class="fas fa-code fa-2x mb-3 text-white"></i>
                    <h5 class="card-title text-white">
                        Participación en Hackathones
                    </h5>
                    <p class="card-text text-white">
                        Competencias de programación y soluciones innovadoras.
                    </p>
                </div>
            </div>
            <div class="card text-center" style="width: 18rem">
                <div class="card-body">
                    <i class="fas fa-camera fa-2x mb-3 text-white"></i>
                    <h5 class="card-title text-white">Fotografía Digital</h5>
                    <p class="card-text text-white">
                        Captura y edición de imágenes digitales.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Descarga del CV -->
    <section class="container mt-5 text-center mb-5">
        <a href="<?php echo esc_url(get_stylesheet_directory_uri() . '/cv.pdf'); ?>" class="btn btn-primary" download>
            Descargar CV
        </a>
    </section>
</main>

<?php get_footer(); ?>