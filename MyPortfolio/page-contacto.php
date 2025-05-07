<?php

/**
 * page-contacto.php
 * Plantilla específica para la página “Contacto”
 *
 * Slug: contacto
 */
get_header();

// Procesamiento del formulario
$errors  = [];
$success = false;
$name    = '';
$email   = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoge y sanitiza los datos
    $name    = sanitize_text_field($_POST['name']    ?? '');
    $email   = sanitize_email($_POST['email']   ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Validaciones
    if (empty($name)) {
        $errors['name'] = 'El campo Nombre es obligatorio.';
    }
    if (empty($email)) {
        $errors['email'] = 'El campo Correo Electrónico es obligatorio.';
    } elseif (! is_email($email)) {
        $errors['email'] = 'El correo electrónico no es válido.';
    }
    if (empty($message)) {
        $errors['message'] = 'El campo Describa el motivo del contacto es obligatorio.';
    }

    // Si no hay errores, envía el correo
    if (empty($errors)) {
        $to      = get_option('admin_email');
        $subject = 'Nuevo mensaje de contacto desde ' . get_bloginfo('name');
        $body    = "Nombre: $name\nEmail: $email\n\nMensaje:\n$message";
        $headers = [
            'From: ' . $name . ' <' . $email . '>',
            'Reply-To: ' . $email,
        ];
        if (wp_mail($to, $subject, $body, $headers)) {
            $success = true;
            // Limpia el formulario
            $name = $email = $message = '';
        } else {
            $errors['form'] = 'Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.';
        }
    }
}
?>

<main class="main-content">
    <!-- Banner de Contacto -->
    <section class="contact-banner">
        <div class="container text-center">
            <h1><?php the_title(); ?></h1>
            <p>
                Si estás interesado en mi perfil o tienes alguna pregunta, no dudes
                en contactarme. Estoy disponible para colaboraciones, proyectos y
                oportunidades laborales.
            </p>

            <div class="contact-grid">
                <!-- Información de Contacto -->
                <div class="contact-info">
                    <div class="contact-method">
                        <i class="fas fa-phone"></i>
                        <a
                            class="text-decoration-none text-white"
                            href="tel:+34633191460">+34 633 19 14 60</a>
                    </div>
                    <div class="contact-method">
                        <i class="fas fa-envelope"></i>
                        <a
                            class="text-decoration-none text-white"
                            href="mailto:ericsaez13@gmail.com">ericsaez13@gmail.com</a>
                    </div>
                    <div class="contact-method">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Barcelona, España</p>
                    </div>
                </div>

                <!-- Formulario de Contacto -->
                <div class="container text-center">
                    <?php if ($success) : ?>
                        <p class="alert alert-success">
                            ¡Mensaje enviado correctamente! Te responderé lo antes posible.
                        </p>
                    <?php endif; ?>

                    <?php if (! empty($errors['form'])) : ?>
                        <p class="alert alert-danger"><?php echo esc_html($errors['form']); ?></p>
                    <?php endif; ?>

                    <form id="ctaForm" method="post" novalidate>
                        <input
                            type="text"
                            name="name"
                            placeholder="Nombre"
                            required
                            value="<?php echo esc_attr($name); ?>" />
                        <span class="error-message" id="error-name">
                            <?php echo esc_html($errors['name'] ?? ''); ?>
                        </span>

                        <input
                            type="email"
                            name="email"
                            placeholder="Correo Electrónico"
                            required
                            value="<?php echo esc_attr($email); ?>" />
                        <span class="error-message" id="error-email">
                            <?php echo esc_html($errors['email'] ?? ''); ?>
                        </span>

                        <textarea
                            name="message"
                            placeholder="Describa el motivo del contacto"
                            required><?php echo esc_textarea($message); ?></textarea>
                        <span class="error-message" id="error-message">
                            <?php echo esc_html($errors['message'] ?? ''); ?>
                        </span>

                        <button type="submit">ENVIAR MENSAJE</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Mapa de Google Maps -->
    <div
        class="map-container my-5"
        style="
      margin: 40px auto;
      max-width: 800px;
      border-radius: 10px;
      overflow: hidden;
    ">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2993.013671588592!2d2.245032315422792!3d41.45004197925856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4bcf3e7b4b7b7%3A0x8b8b8b8b8b8b8b8b!2sBadalona%2C%20Barcelona%2C%20Spain!5e0!3m2!1sen!2ses!4v1634567890123!5m2!1sen!2ses"
            width="100%"
            height="800"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"></iframe>
    </div>
</main>

<?php get_footer(); ?>