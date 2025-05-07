<div
    class="card"
    data-tilt
    data-tilt-glare
    data-tilt-max-glare="0.1"
    data-tilt-speed="300">
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="mobile-link" aria-label="<?php the_title_attribute(); ?>"></a>
        <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => get_the_title()]); ?>
    <?php endif; ?>

    <div class="card-overlay">
        <h5 class="card-title"><?php the_title(); ?></h5>
        <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 10, '...') ?></p>
        <a href="<?php the_permalink(); ?>" class="btn"><?php _e('Ver Proyecto', 'myportfolio'); ?></a>
    </div>
</div>