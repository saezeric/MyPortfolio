<?php

/**
 * loop-templates/content-formationitem.php
 * Tarjeta + Modal para cada ítem de Formación Profesional
 */

$post_id                = get_the_ID();
$title                  = get_the_title();

// 1) Cargamos los objetos de campo para sacar sus etiquetas (labels)
$field_institucion      = get_field_object('institucion');
$field_fecha_inicio     = get_field_object('fecha_inicio');
$field_fecha_final      = get_field_object('fecha_final');
$field_descripcion      = get_field_object('descripcion_breve');
$field_conocimientos    = get_field_object('conocimientos_aprendidos');

// 2) Valores crudos
$institucion       = get_field('institucion');
$fecha_inicio      = get_field('fecha_inicio');
$fecha_final       = get_field('fecha_final');
$descripcion_breve = get_field('descripcion_breve');

// Si no hay fecha_final, solo mostramos la de inicio
$period = $fecha_inicio . ($fecha_final ? " — {$fecha_final}" : '');

// 3) Convertimos el textarea de conocimientos en un array de líneas
$raw_items = get_field('conocimientos_aprendidos');
$items     = $raw_items
    ? preg_split('/\r\n|\r|\n/', $raw_items)
    : [];

// 4) Labels dinámicos
$label_inst      = $field_institucion['label']      ?? __('Institución',      'myportfolio');
$label_periodo   = "Periodo";
$label_items     = $field_conocimientos['label']    ?? __('Conocimientos aprendidos', 'myportfolio');
?>

<!-- Card que abre el modal -->
<div
    class="card"
    data-bs-toggle="modal"
    data-bs-target="#modal-qual-<?php echo esc_attr($post_id); ?>"
    data-tilt data-tilt-glare data-tilt-max-glare="0.1"
    data-tilt-speed="300"
    style="cursor: pointer; width: 18rem">
    <div class="card-body text-center">
        <h5 class="card-title"><?php echo esc_html($title); ?></h5>
        <p class="card-text"><strong><?php echo esc_html($institucion); ?></strong></p>
        <p class="card-text"><?php echo esc_html($period); ?></p>
        <p class="card-text mt-4">
            <strong><?php esc_html_e('Haz clic para ver más', 'myportfolio'); ?></strong>
        </p>
    </div>
</div>

<!-- Modal de detalle -->
<div class="modal fade" id="modal-qual-<?php echo esc_attr($post_id); ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #1a0b2e">
            <div class="modal-header">
                <h5 class="modal-title text-white"><?php echo esc_html($title); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Cerrar', 'myportfolio'); ?>"></button>
            </div>
            <div class="modal-body text-white">
                <!-- Institución -->
                <p>
                    <strong><?php echo esc_html($label_inst); ?>:</strong>
                    <?php echo esc_html($institucion); ?>
                </p>

                <!-- Período -->
                <p>
                    <strong><?php echo esc_html($label_periodo); ?>:</strong>
                    <?php echo esc_html($period); ?>
                </p>

                <!-- Descripción breve -->
                <?php if ($descripcion_breve) : ?>
                    <p>
                        <?php echo esc_html($descripcion_breve); ?>
                    </p>
                    <hr class="border-secondary" />
                <?php endif; ?>

                <!-- Conocimientos aprendidos -->
                <h6><?php echo esc_html($label_items); ?></h6>
                <?php if (! empty($items)) : ?>
                    <ul>
                        <?php foreach ($items as $line) :
                            $item = trim($line);
                            if ($item) : ?>
                                <li><?php echo esc_html($item); ?></li>
                        <?php endif;
                        endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p><?php esc_html_e('No hay contenidos para mostrar.', 'myportfolio'); ?></p>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">
                    <?php esc_html_e('Cerrar', 'myportfolio'); ?>
                </button>
            </div>
        </div>
    </div>
</div>