<?php
// loop-templates/content-timelineitem_lenguages.php
$post_id       = get_the_ID();
$title         = get_the_title();
$nivel         = get_field('nivel');
$mostrar_icono = get_field('mostrar_icono');
$video_embed   = get_field('video'); // HTML oEmbed
?>
<div class="timeline-item" style="cursor:pointer;"
    <?php if ($video_embed) : ?>
    data-video='<?php echo wp_json_encode($video_embed); ?>'
    <?php endif; ?>>
    <?php if ($mostrar_icono) : ?>
        <i class="fas fa-language fa-2x mb-3 text-white"></i>
    <?php endif; ?>

    <h5 class="fs-3"><?php echo esc_html($title); ?></h5>
    <h6 class="my-4 fs-5"><?php echo esc_html($nivel); ?></h6>
    <p class="card-action text-primary">
        <?php esc_html_e('Haz clic para comprobar', 'myportfolio'); ?>
    </p>
</div>