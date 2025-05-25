<?php
if (is_page('contacto')) {
    get_template_part('global-templates/contacto-footer');
} else {
?>
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-particles" id="footerParticles"></div>

        <!-- CTA de Contacto -->
        <section class="cta-contacto">
            <div class="container text-center">
                <h2>¿Buscas algo más personalizado? ¡Contáctanos!</h2>
                <form id="ctaForm" novalidate>
                    <input type="text" placeholder="Nombre" required />
                    <span class="error-message" id="error-name"></span>

                    <input type="email" placeholder="Correo Electrónico" required />
                    <span class="error-message" id="error-email"></span>

                    <textarea
                        placeholder="Describa el motivo del contacto"
                        required></textarea>
                    <span class="error-message" id="error-message"></span>

                    <button type="submit">ENVIAR MENSAJE</button>
                </form>
            </div>
        </section>

        <!-- Información Personal -->
        <?php
        // 1) Obtenemos el post de contacto
        $contact_posts = get_posts([
            'post_type'      => 'contacto',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ]);
        if ($contact_posts) :
            $contact_id = $contact_posts[0]->ID;

            // 2) Leemos los campos ACF
            $email            = get_field('email', $contact_id);
            $telefono         = get_field('telefono', $contact_id);
            $whatsapp         = get_field('whatsapp', $contact_id);
            $linkedin         = get_field('linkedin', $contact_id);
            $github           = get_field('github', $contact_id);
            $provincia_ciudad = get_field('provincia_ciudad', $contact_id);
        ?>
            <!-- Información Personal -->
            <section class="container footer-info">
                <h3><?php esc_html_e('Información de Contacto', 'myportfolio'); ?></h3>
                <div class="contact-grid">
                    <?php if ($email) : ?>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?php echo esc_attr($email); ?>">
                                <?php echo esc_html($email); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($telefono) : ?>
                        <div class="contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <a href="tel:<?php echo esc_attr($telefono); ?>">
                                <?php echo esc_html($telefono); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($whatsapp) : ?>
                        <div class="contact-item">
                            <i class="fab fa-whatsapp"></i>
                            <a href="<?php echo esc_url($whatsapp); ?>" target="_blank" rel="noopener">
                                <?php esc_html_e('WhatsApp', 'myportfolio'); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($linkedin) : ?>
                        <div class="contact-item">
                            <i class="fab fa-linkedin"></i>
                            <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener">
                                <?php esc_html_e('LinkedIn', 'myportfolio'); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($github) : ?>
                        <div class="contact-item">
                            <i class="fab fa-github"></i>
                            <a href="<?php echo esc_url($github); ?>" target="_blank" rel="noopener">
                                <?php esc_html_e('GitHub', 'myportfolio'); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($provincia_ciudad) : ?>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo esc_html($provincia_ciudad); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="copyright">
                    <p>
                        &copy; <?php echo date_i18n('Y'); ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php bloginfo('name'); ?>
                        </a>.
                        <?php esc_html_e('Todos los derechos reservados.', 'myportfolio'); ?>
                    </p>
                </div>
            </section>
        <?php
        endif;
        ?>

    </footer>
<?php
}
wp_footer();
?>
</body>

</html>