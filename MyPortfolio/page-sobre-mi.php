<?php

/**
 * page-sobre-mi.php
 * Plantilla para la página "Sobre mí"
 * Slug: sobre-mi
 */
get_header();
?>

<main class="main-content">
    <?php
    // Hero Banner
    get_template_part('template-parts/content', 'herobanner');
    ?>

    <!-- Sección de Formación Profesional -->
    <section class="section">
        <div class="container text-center">
            <h2><?php esc_html_e('Formación Profesional', 'myportfolio'); ?></h2>
            <div class="card-container d-flex flex-wrap gap-3 justify-content-center">
                <?php
                // Ejemplo estático - más adelante dinámico con ACF
                ?>
                <div class="card" data-bs-toggle="modal" data-bs-target="#modalQual1" data-tilt data-tilt-glare data-tilt-max-glare="0.1" data-tilt-speed="300" style="cursor: pointer; width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php esc_html_e('Ingeniería Informática', 'myportfolio'); ?></h5>
                        <p class="card-text"><?php esc_html_e('Universidad de Madrid', 'myportfolio'); ?></p>
                        <p class="card-text"><?php esc_html_e('09/2018 — 06/2022', 'myportfolio'); ?></p>
                        <p class="card-text mt-4 fw-bold"><?php esc_html_e('Haz clic para ver más', 'myportfolio'); ?></p>
                    </div>
                </div>
                <!-- Modal Titulación 1 -->
                <div class="modal fade" id="modalQual1" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark text-white">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php esc_html_e('Ingeniería Informática', 'myportfolio'); ?></h5>
                            </div>
                            <div class="modal-body">
                                <p><strong><?php esc_html_e('Institución:', 'myportfolio'); ?></strong> <?php esc_html_e('Universidad de Madrid', 'myportfolio'); ?></p>
                                <p><strong><?php esc_html_e('Período:', 'myportfolio'); ?></strong> <?php esc_html_e('Septiembre 2018 — Junio 2022', 'myportfolio'); ?></p>
                                <p><?php esc_html_e('Descripción detallada de la titulación, asignaturas y proyectos realizados.', 'myportfolio'); ?></p>
                                <hr class="border-secondary" />
                                <h6><?php esc_html_e('Contenidos aprendidos:', 'myportfolio'); ?></h6>
                                <ul>
                                    <li><?php esc_html_e('Programación orientada a objetos', 'myportfolio'); ?></li>
                                    <li><?php esc_html_e('Estructuras de datos y algoritmos', 'myportfolio'); ?></li>
                                    <li><?php esc_html_e('Gestión de bases de datos relacionales', 'myportfolio'); ?></li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><?php esc_html_e('Cerrar', 'myportfolio'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ... Repite bloques para otras titulaciones y secciones ... -->
            </div>
        </div>
    </section>

    <!-- Sección de Intereses Personales -->
    <section class="section">
        <div class="container py-5 text-center">
            <h2><?php esc_html_e('Intereses Personales', 'myportfolio'); ?></h2>
            <div class="intereses-card-container d-flex flex-wrap gap-3 justify-content-center">
                <?php
                // Ejemplos estáticos de intereses
                $intereses = [
                    ['icon' => 'fas fa-code', 'title' => 'Desarrollo Full‑Stack', 'text' => 'Combinando frontend y backend para crear soluciones completas.'],
                    ['icon' => 'fas fa-robot', 'title' => 'Inteligencia Artificial', 'text' => 'Explorando cómo la IA puede mejorar la experiencia del usuario.'],
                    ['icon' => 'fas fa-paint-brush', 'title' => 'Diseño UX/UI', 'text' => 'Creación de interfaces intuitivas y atractivas.'],
                    ['icon' => 'fas fa-chart-line', 'title' => 'Optimización SEO', 'text' => 'Mejora del posicionamiento en buscadores.'],
                ];
                foreach ($intereses as $item) : ?>
                    <div class="intereses-card card" style="width: 18rem;" data-tilt data-tilt-glare data-tilt-max-glare="0.1" data-tilt-speed="300">
                        <div class="card-body text-center">
                            <div class="icon mb-3">
                                <i class="<?php echo esc_attr($item['icon']); ?> text-white" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title"><?php echo esc_html($item['title']); ?></h5>
                            <p class="card-text"><?php echo esc_html($item['text']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Sección de Soft Skills -->
    <section class="soft-skills-section py-5">
        <div class="container text-center">
            <h2><?php esc_html_e('Soft Skills', 'myportfolio'); ?></h2>
            <div class="soft-skills-grid">
                <?php $skills = ['Trabajo en Equipo', 'Aprendizaje Rápido', 'Resolución de Problemas', 'Comunicación Efectiva']; ?>
                <?php foreach ($skills as $skill) : ?>
                    <div class="soft-skill-node">
                        <h5><?php echo esc_html($skill); ?></h5>
                        <p><?php esc_html_e('Descripción de la skill.', 'myportfolio'); ?></p>
                    </div>
                <?php endforeach; ?>
                <div class="neural-connections"></div>
            </div>
        </div>
    </section>

    <!-- Sección de Objetivos a Futuro -->
    <section class="objetivos-section py-5">
        <div class="container text-center">
            <h2><?php esc_html_e('Objetivos a Futuro', 'myportfolio'); ?></h2>
            <div class="timeline-container">
                <div class="timeline-line"></div>
                <div class="timeline-item">
                    <h5><?php esc_html_e('Corto Plazo', 'myportfolio'); ?></h5>
                    <p><?php esc_html_e('Ampliar mis conocimientos en desarrollo web e inteligencia artificial.', 'myportfolio'); ?></p>
                </div>
                <div class="timeline-item">
                    <h5><?php esc_html_e('Largo Plazo', 'myportfolio'); ?></h5>
                    <p><?php esc_html_e('Liderar equipos de desarrollo y crear soluciones impactantes.', 'myportfolio'); ?></p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer();
