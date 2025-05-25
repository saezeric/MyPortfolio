<?php

/**
 * loop-templates/content-techcard.php
 *
 * Partial template for “tech-card” blocks,
 * handles both curriculum and project-detail contexts,
 * supports icon inversion via ACF 'invertir_icono' field.
 */

// Retrieve query vars
$items             = get_query_var('tech_items');
$post_type         = get_query_var('tech_slug');
$section_icon_url  = get_query_var('section_icon_url');
$invert_section    = get_query_var('invert_section');
$section_icon_id   = get_query_var('section_icon_id');

// Determine context: project-detail if items array exists
if (empty($items) || ! is_array($items)) {
    // Curriculum context fallback
    $post_type        = get_query_var('pt');
    $section_icon_url = get_query_var('icon_url');
    $invert_section   = false;

    // Identify featured post for this CPT
    $feat = get_posts([
        'post_type'      => $post_type,
        'posts_per_page' => 1,
        'meta_key'       => 'destacado',
        'meta_value'     => '1',
    ]);
    if (! empty($feat)) {
        $section_icon_id = $feat[0]->ID;
        $invert_section  = (bool) get_field('invertir_icono', $section_icon_id);
    }

    // Query all published items
    $query = new WP_Query([
        'post_type'      => $post_type,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);
    if ($query->have_posts()) {
        $items = [];
        while ($query->have_posts()) {
            $query->the_post();
            $items[] = get_post();
        }
        wp_reset_postdata();
    }
} else {
    // Project-detail context: override invert_section based on highlighted icon post
    if (! empty($section_icon_id)) {
        $invert_section = (bool) get_field('invertir_icono', $section_icon_id);
    }
}

// Get CPT object for labels
$pt_obj = get_post_type_object($post_type);
if (! $pt_obj) {
    return;
}
?>

<div class="tech-card">
    <?php if (! empty($section_icon_url)) : ?>
        <img
            src="<?php echo esc_url($section_icon_url); ?>"
            class="tech-icon<?php echo $invert_section ? ' tech-icon--invert' : ''; ?>"
            alt="<?php echo esc_attr($pt_obj->labels->name); ?>">
    <?php endif; ?>

    <h3 class="tech-title"><?php echo esc_html($pt_obj->labels->name); ?></h3>

    <div class="tech-items">
        <?php foreach ($items as $item) :
            $item_icon     = get_field('icono', $item->ID);
            $item_icon_url = is_array($item_icon) ? $item_icon['url'] : $item_icon;
            $invert_small  = (bool) get_field('invertir_icono', $item->ID);
        ?>
            <span class="tech-item">
                <?php if ($item_icon_url) : ?>
                    <img
                        src="<?php echo esc_url($item_icon_url); ?>"
                        class="tech-icon-sm<?php echo $invert_small ? ' tech-icon-sm--invert' : ''; ?>"
                        alt="<?php echo esc_attr(get_the_title($item)); ?>">
                <?php endif; ?>
                <?php echo esc_html(get_the_title($item)); ?>
            </span>
        <?php endforeach; ?>
    </div>
</div>