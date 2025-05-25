<?php

/**
 * loop-templates/content-experienceitem.php
 * Tarjeta + Modal para cada experiencia laboral
 * Fechas sin formatear, se muestran crudas.
 */

$post_id       = get_the_ID();
$title         = get_the_title();

// 1) Campos ACF y sus labels
$field_empresa  = get_field_object('empresa');
$field_inicio   = get_field_object('fecha_inicio');
$field_final    = get_field_object('fecha_final');
$field_tareas   = get_field_object('tareas');

$company        = get_field('empresa');
$fecha_inicio   = get_field('fecha_inicio');  // Ejemplo: "2020-01-15"
$fecha_final    = get_field('fecha_final');   // Ejemplo: "2022-06-30"

// Si no hay fecha_final, mostramos “En curso...”
if (! $fecha_final) {
    $fecha_final = __('En curso...', 'myportfolio');
}

// Período crudo
$period = "{$fecha_inicio} – {$fecha_final}";

// Descripción breve
$description = get_field('descripcion_experiencia') ?: get_the_excerpt();

// Tareas como textarea
$tareas_raw = get_field('tareas');
$tareas     = $tareas_raw
    ? preg_split('/\r\n|\r|\n/', $tareas_raw)
    : [];

// Labels dinámicos
$label_empresa = $field_empresa['label']  ?? __('Empresa', 'myportfolio');
$label_inicio  = $field_inicio['label']   ?? __('Fecha de inicio', 'myportfolio');
$label_final   = $field_final['label']    ?? __('Fecha final', 'myportfolio');
$label_tareas  = $field_tareas['label']   ?? __('Tareas', 'myportfolio');
?>

<!-- Card que abre el modal -->
<div
    class="card"
    data-bs-toggle="modal"
    data-bs-target="#modal-exp-<?php echo esc_attr($post_id); ?>"
    data-tilt data-tilt-glare data-tilt-max-glare="0.1"
    data-tilt-speed="300"
    style="cursor: pointer; width: 18rem">
    <div class="card-body">
        <h5 class="card-title"><?php echo esc_html($title); ?></h5>
        <p class="card-text"><strong><?php echo esc_html($company); ?></strong></p>
        <p class="card-text"><?php echo esc_html($period); ?></p>
        <p class="card-text mt-4"><strong><?php esc_html_e('Haz clic para ver más', 'myportfolio'); ?></strong></p>
    </div>
</div>

<!-- Modal de detalle -->
<div class="modal fade" id="modal-exp-<?php echo esc_attr($post_id); ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #1a0b2e">
            <div class="modal-header">
                <h5 class="modal-title text-white"><?php echo esc_html($title); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Cerrar', 'myportfolio'); ?>"></button>
            </div>

            <div class="modal-body text-white">
                <!-- Empresa -->
                <p>
                    <strong><?php echo esc_html($label_empresa); ?>:</strong>
                    <?php echo esc_html($company); ?>
                </p>

                <!-- Período -->
                <p>
                    <strong>
                        <?php
                        // Unimos los labels de inicio y final
                        echo esc_html("Periodo");
                        ?>:
                    </strong>
                    <?php echo esc_html($period); ?>
                </p>

                <!-- Descripción breve -->
                <?php if ($description) : ?>
                    <p><?php echo esc_html($description); ?></p>
                <?php endif; ?>

                <hr class="border-secondary" />

                <!-- Tareas -->
                <h6><?php echo esc_html($label_tareas); ?></h6>
                <?php if (! empty($tareas)) : ?>
                    <ul>
                        <?php foreach ($tareas as $line) :
                            $item = trim($line);
                            if ($item) : ?>
                                <li><?php echo esc_html($item); ?></li>
                        <?php endif;
                        endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p><?php esc_html_e('No hay tareas disponibles.', 'myportfolio'); ?></p>
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