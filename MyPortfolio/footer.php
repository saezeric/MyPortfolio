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
    <section class="container footer-info">
        <h3>Información de Contacto</h3>
        <div class="contact-grid">
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <a href="mailto:ericsaez13@gmail.com">ericsaez13@gmail.com</a>
            </div>
            <div class="contact-item">
                <i class="fas fa-phone-alt"></i>
                <a href="tel:+34633191460">+34 633 19 14 60</a>
            </div>
            <div class="contact-item">
                <i class="fab fa-linkedin"></i>
                <a
                    href="https://www.linkedin.com/in/eric-saez-escalona-877049258/"
                    target="_blank">LinkedIn</a>
            </div>
            <div class="contact-item">
                <i class="fab fa-github"></i>
                <a href="https://github.com/saezeric" target="_blank">GitHub</a>
            </div>
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>Badalona, Barcelona</span>
            </div>
        </div>

        <div class="copyright">
            <p>
                &copy; 2025 <a href="#">Eric Sáez Escalona</a>. Todos los derechos
                reservados.
            </p>
        </div>
    </section>
</footer>

<?php wp_footer(); ?>

</body>

</html>