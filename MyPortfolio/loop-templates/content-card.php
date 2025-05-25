<?php

/**
 * loop-templates/content-card.php
 * Tarjeta genérica para cualquier CPT con campos ACF:
 *  - icono (Selector de iconos, cadena de clases FontAwesome)
 *  - descripcion (Área de texto)
 * El título usaremos el título nativo del post.
 */
?>

<div class="card" style="width: 18rem;"
    data-tilt
    data-tilt-glare
    data-tilt-max-glare="0.1"
    data-tilt-speed="300">
    <div class="card-body text-center">
        <?php
        // 1) Icono ACF
        $icon = get_field('icono');
        if ($icon): ?>
            <div class="icon mb-3">
                <i class="<?php echo esc_attr($icon); ?> text-white" style="font-size:2rem;"></i>
            </div>
        <?php endif; ?>

        <!-- 2) Título del post -->
        <h5 class="card-title"><?php the_title(); ?></h5>

        <!-- 3) Descripción ACF con fallback al excerpt -->
        <p class="card-text">
            <?php
            $desc = get_field('descripcion');
            echo esc_html($desc ? $desc : get_the_excerpt());
            ?>
        </p>
    </div>
</div>