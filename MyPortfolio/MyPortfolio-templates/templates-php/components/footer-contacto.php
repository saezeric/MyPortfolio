<!-- Footer -->
<footer class="footer">
    <!-- Información Personal -->
    <section class="container mt-5">
        <div class="row">
        <div class="col-md-12">
            <h3>Información Personal</h3>
            <div class="d-flex justify-content-between my-4">
            <p>Email: <a href="mailto:ericsaez13@gmail.com" class="text-decoration-none">ericsaez13@gmail.com</a></p>
            <p>Teléfono: <a href="tel:+34633191460" class="text-decoration-none">+34 633 19 14 60</a></p>
            <p>
                LinkedIn:
                <a href="https://www.linkedin.com/in/eric-saez-escalona-877049258/" target="_blank" class="text-decoration-none">
                Eric Sáez
                </a>
            </p>
            <p>
                GitHub:
                <a href="https://github.com/saezeric" target="_blank" class="text-decoration-none">
                saezeric
                </a>
            </p>
            <p>Ubicación: Badalona, Barcelona</p>
            </div>
        </div>
        <div class="col-md-12">
            <h3>Derechos Reservados</h3>
            <p>&copy; 2025 Eric Sáez Escalona. Todos los derechos reservados.</p>
        </div>
        </div>
    </section>
</footer>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Script para manejar el menú desplegable -->
<script>
    document
        .getElementById("menuToggle")
        .addEventListener("click", function() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("active");
        });
</script>

<!-- Script de validación para formulario de contacto -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("contactForm");

        form.addEventListener("submit", function(e) {
            // Seleccionar campos y contenedores de error
            const nameInput = form.querySelector("input[type='text']");
            const emailInput = form.querySelector("input[type='email']");
            const messageInput = form.querySelector("textarea");

            const errorName = document.getElementById("contact-error-name");
            const errorEmail = document.getElementById("contact-error-email");
            const errorMessage = document.getElementById("contact-error-message");

            // Limpiar mensajes de error previos y quitar clases
            errorName.textContent = "";
            errorEmail.textContent = "";
            errorMessage.textContent = "";
            nameInput.classList.remove("input-error");
            emailInput.classList.remove("input-error");
            messageInput.classList.remove("input-error");

            let hasErrors = false;

            // Validación del campo Nombre
            if (nameInput.value.trim() === "") {
                errorName.textContent = "El campo Nombre es obligatorio.";
                nameInput.classList.add("input-error");
                hasErrors = true;
            }

            // Validación del campo Correo Electrónico
            if (emailInput.value.trim() === "") {
                errorEmail.textContent =
                    "El campo Correo Electrónico es obligatorio.";
                emailInput.classList.add("input-error");
                hasErrors = true;
            } else {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value.trim())) {
                    errorEmail.textContent = "El correo electrónico no es válido.";
                    emailInput.classList.add("input-error");
                    hasErrors = true;
                }
            }

            // Validación del campo Descripción
            if (messageInput.value.trim() === "") {
                errorMessage.textContent = "El campo Descripción es obligatorio.";
                messageInput.classList.add("input-error");
                hasErrors = true;
            }

            if (hasErrors) {
                e.preventDefault(); // Evitar el envío del formulario
            }
        });
    });
</script>
</body>

</html>