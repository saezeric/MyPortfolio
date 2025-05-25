<?php

/**
 * loop-templates/content-card.php
 * Tarjeta genérica para cualquier CPT con campos ACF:
 *  - icono (Selector de iconos, cadena de clases FontAwesome)
 *  - descripcion (Área de texto)
 * El título usaremos el título nativo del post.
 */
?>

<div class="card text-center" style="width: 18rem;">
    <div class="card-body">
        <?php
        // 1) Icono ACF
        $icon = get_field('icono');
        if ($icon): ?>
            <div class="icon mb-3">
                <i class="<?php echo esc_attr($icon); ?> text-white" style="font-size:2rem;"></i>
            </div>
        <?php endif; ?>
        <!-- 2) Título del post -->
        <h5 class="card-title text-white"><?php the_title(); ?></h5>
        <!-- 3) Descripción ACF con fallback al excerpt -->
        <p class="card-text text-white">
            <?php
            $desc = get_field('descripcion');
            echo esc_html($desc ? $desc : get_the_excerpt());
            ?>
        </p>
    </div>
</div>