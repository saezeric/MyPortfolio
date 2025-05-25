<?php

/**
 * template-parts/content-herobanner.php
 * Hero banner reutilizable sin necesidad de Loop
 */
$queried = get_queried_object();
$title   = $queried->post_title;
$content = apply_filters('the_content', $queried->post_content);
?>

<section class="section about-banner mb-5">
    <div class="container py-5 text-center position-relative">
        <h1><?php echo esc_html($title); ?></h1>
        <!-- Partículas decorativas -->
        <div class="particle" style="top: 20%; left: 15%; width: 8px; height: 8px; animation-delay: -2s;"></div>
        <div class="particle" style="top: 70%; right: 10%; width: 12px; height: 12px; animation-duration: 8s;"></div>
    </div>
</section>