<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <p class="publication-date mb-5">
                <?php echo strtoupper(get_the_date()); ?>
            </p>
            <div class="news-content">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image mb-4">
                        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid w-100" style="height: 500px; object-fit: cover; border-radius: 5px;" />
                    </div>
                <?php endif; ?>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>