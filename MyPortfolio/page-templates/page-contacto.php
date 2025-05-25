<?php

/**
 * Template Name: Contacto
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

            <!-- Título de la página -->
            <h1><?php the_title(); ?></h1>

            <!-- Contenido editable desde el editor de la página -->
            <div class="contact-intro">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        the_content();
                    }
                }
                ?>
            </div>

            <div class="contact-grid">

                <?php
                // 1) Obtenemos el único post de CPT 'contacto'
                $contact_posts = get_posts([
                    'post_type'      => 'contacto',
                    'posts_per_page' => 1,
                    'post_status'    => 'publish',
                ]);
                if ($contact_posts) :
                    $cID            = $contact_posts[0]->ID;
                    // 2) Leemos los campos ACF exactos como en el footer
                    $telefono       = get_field('telefono',          $cID);
                    $email          = get_field('email',             $cID);
                    $provincia_ciudad = get_field('provincia_ciudad', $cID);
                ?>

                    <!-- Información de Contacto -->
                    <div class="contact-info">

                        <?php if ($telefono) : ?>
                            <div class="contact-method">
                                <i class="fas fa-phone"></i>
                                <a
                                    class="text-decoration-none text-white"
                                    href="tel:<?php echo esc_attr($telefono); ?>">
                                    <?php echo esc_html($telefono); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($email) : ?>
                            <div class="contact-method">
                                <i class="fas fa-envelope"></i>
                                <a
                                    class="text-decoration-none text-white"
                                    href="mailto:<?php echo esc_attr($email); ?>">
                                    <?php echo esc_html($email); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($provincia_ciudad) : ?>
                            <div class="contact-method">
                                <i class="fas fa-map-marker-alt"></i>
                                <p><?php echo esc_html($provincia_ciudad); ?></p>
                            </div>
                        <?php endif; ?>

                    </div><!-- .contact-info -->

                <?php endif; ?>

                <!-- Formulario de Contacto -->
                <div class="text-center">
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
                            value="" />
                        <span class="error-message" id="error-name">
                            <?php echo esc_html($errors['name'] ?? ''); ?>
                        </span>

                        <input
                            type="email"
                            name="email"
                            placeholder="Correo Electrónico"
                            required
                            value="" />
                        <span class="error-message" id="error-email">
                            <?php echo esc_html($errors['email'] ?? ''); ?>
                        </span>

                        <textarea
                            name="message"
                            placeholder="Describa el motivo del contacto"
                            required
                            rows="4"></textarea>
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
    <?php
    // 1) Obtenemos el post de contacto (igual que en el footer)
    $contact_posts = get_posts([
        'post_type'      => 'contacto',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ]);

    if ($contact_posts) :
        $contact_id = $contact_posts[0]->ID;

        // 2) Recuperamos el embed HTML de ACF
        $map_src = get_field('maps', $contact_id); // devuelve algo como '<iframe src="..."></iframe>'
    ?>
        <!-- Mapa dinámico -->
        <div
            class="map-container my-5"
            style="
            margin: 40px auto;
            max-width: 800px;
            border-radius: 10px;
            overflow: hidden;
        ">
            <?php if ($map_src) : ?>
                <iframe src="<?php echo $map_src ?>" width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <?php elseif ($map_embed) : ?>
                <?php
                // fallback: si no hemos podido parsear la URL, imprimimos el embed completo
                echo $map_embed;
                ?>
            <?php else : ?>
                <p><?php esc_html_e('Mapa no disponible.', 'myportfolio'); ?></p>
            <?php endif; ?>
        </div>
    <?php
    endif;
    ?>

</main>

<?php get_footer(); ?>