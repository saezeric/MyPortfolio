<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php wp_head(); ?>

</head>

<body>
    <header>
        <!-- Botón para abrir/cerrar el menú en móviles/tablets -->
        <button class="menu-toggle" id="menuToggle">☰</button>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <!-- Se muestra el avatar y el dropdown de usuario (estáticos) -->
            <div class="dropdown text-center">
                <h2><?= get_bloginfo('name') ?></h2>
                <div class="d-flex justify-content-center align-items-center">
                    <?php
                    if (function_exists('the_custom_logo')) {
                        the_custom_logo();
                    }
                    ?>
                </div>
            </div>

            <!-- Menú de navegación -->
            <nav>
                <?php wp_nav_menu(
                    array(
                        'menu' => 'primary',
                        'container' => '',
                        'theme_location' => 'header-menu',
                        'items_wrap' => '<ul id="" class="">%3$s</ul>',
                    )
                ) ?>
            </nav>
        </div>
    </header>