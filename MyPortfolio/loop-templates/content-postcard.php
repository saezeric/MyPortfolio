<div class="card" style="width: 18rem">
    <?php if (has_post_thumbnail()) : ?>
        <img
            src="<?php the_post_thumbnail_url('medium'); ?>"
            class="card-img-top"
            alt="<?php the_title(); ?>"
            style="width: 100%; height: 200px; object-fit: cover" />
    <?php else : ?>
        <img
            src="https://via.placeholder.com/300x200"
            class="card-img-top"
            alt="Placeholder"
            style="width: 100%; height: 200px; object-fit: cover" />
    <?php endif; ?>
    <div class="card-body">
        <h5 class="card-title"><?php the_title(); ?></h5>
        <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Leer más</a>
    </div>
</div>