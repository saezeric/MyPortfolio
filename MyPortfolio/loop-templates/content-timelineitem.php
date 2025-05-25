<?php

/**
 * loop-templates/content-timelineitem.php
 * Tarjeta genérica para cualquier CPT con campos ACF:
 *  - descripcion (Área de texto)
 * El título usaremos el título nativo del post.
 */
?>

<div
    class="timeline-item">
    <h5><?php the_title(); ?></h5>
    <?php
    $desc = get_field('descripcion');
    ?>
    <p><?php echo ($desc ? $desc : get_the_excerpt()); ?></p>
</div>