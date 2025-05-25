<?php
get_header();
?>

<main class="main-content">
    <?php
    get_template_part('global-templates/content', 'herobanner_nocontent');
    ?>
    <!-- Contenido de la noticia -->
    <section class="section py-5">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('loop-templates/content', 'article');
            }
        }
        ?>
    </section>

    <?php
    comments_template();
    ?>
</main>

<?php
get_footer();
?>