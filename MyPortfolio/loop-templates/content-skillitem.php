<?php

/**
 * loop-templates/content-skillitem.php
 * Tarjeta para Competencias Digitales, nivel puede venir como array o string.
 */

$icon = get_field('icono');
$title = get_the_title();

// 1) Recuperamos el campo ‘nivel’
$nivel_raw = get_field('nivel');

// 2) Normalizamos a scalar
if (is_array($nivel_raw)) {
    // Si es array, tomamos el subcampo ‘value’
    $nivel_value = isset($nivel_raw['value'])
        ? $nivel_raw['value']
        : '';
} else {
    $nivel_value = $nivel_raw;
}

// 3) Aseguramos que nivel_value sea string (clave válida)
$nivel_value = (string) $nivel_value;

// 4) Mapa porcentaje→etiqueta
$labels = [
    '0'   => 'Nulo',
    '25'  => 'Poco',
    '50'  => 'Intermedio',
    '75'  => 'Alto',
    '100' => 'Avanzado',
];

// 5) Sacamos la etiqueta correspondiente o vacío
$etiqueta = isset($labels[$nivel_value])
    ? $labels[$nivel_value]
    : '';
?>

<div class="skill-item">
    <div class="skill-header">
        <?php if ($icon) : ?>
            <div class="icon mb-3">
                <i class="<?php echo esc_attr($icon); ?> text-white" style="font-size:2rem;"></i>
            </div>
        <?php endif; ?>

        <span class="skill-title"><?php echo esc_html($title); ?></span>
        <span class="skill-level"><?php echo esc_html($etiqueta); ?></span>
    </div>
    <div class="progress-bar">
        <div
            class="progress-fill"
            style="width: <?php echo esc_attr($nivel_value); ?>% !important;"></div>
    </div>
</div>