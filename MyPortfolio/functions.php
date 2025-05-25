<?php

/**
 * functions.php de MyPortfolio
 */

/**
 * Enqueue Dashicons para poder usar las clases 'dashicons dashicons-*' en front.
 */
function MyPortfolio_enqueue_dashicons()
{
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'MyPortfolio_enqueue_dashicons', 20);

// 1. Soporte de tema básico
function MyPortfolio_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'MyPortfolio_theme_support');

// 2. Registro de menús
function MyPortfolio_menus()
{
    $locations = [
        'header-menu' => "Desktop Primary Sidebar Menu",
        'footer-menu' => "Footer Menu Items"
    ];
    register_nav_menus($locations);
}
add_action('init', 'MyPortfolio_menus');

// 3. Enqueue de estilos
function MyPortfolio_register_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('MyPortfolio-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css", [], '5.3.0', 'all');
    wp_enqueue_style('MyPortfolio-style', get_template_directory_uri() . '/style.css', ['MyPortfolio-bootstrap'], $version, 'all');
    wp_enqueue_style('MyPortfolio-googlefonts', "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap", [], null, 'all');
    wp_enqueue_style('MyPortfolio-fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css", [], '6.0.0-beta3', 'all');
}
add_action('wp_enqueue_scripts', 'MyPortfolio_register_styles');

// 4. Enqueue de scripts
function MyPortfolio_register_scripts()
{
    wp_enqueue_script('MyPortfolio-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js", [], '5.3.0', true);
    wp_enqueue_script('MyPortfolio-mainjs', get_template_directory_uri() . "/assets/js/main.js", [], '1.0', true);
    wp_enqueue_script('MyPortfolio-vanillatilt', get_template_directory_uri() . "/assets/js/vanilla-tilt.min.js", [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'MyPortfolio_register_scripts');

// 6. Flush rewrite rules al activar tema (para que reconozca de inmediato el CPT y sus URLs)
function MyPortfolio_rewrite_flush()
{
    MyPortfolio_register_cpt_proyecto();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'MyPortfolio_rewrite_flush');

// 7. Forzar plantilla single-proyecto.php para el CPT 'proyecto'
function MyPortfolio_force_single_template($single_template)
{
    global $post;
    if ($post->post_type === 'proyecto') {
        $template = locate_template('single-proyecto.php');
        if ($template) {
            return $template;
        }
    }
    return $single_template;
}
add_filter('single_template', 'MyPortfolio_force_single_template');

// 8. Metabox “Destacar” para el CPT proyecto
add_action('add_meta_boxes', function () {
    add_meta_box(
        'proyecto_destacado_mb',
        'Proyecto Destacado',
        function ($post) {
            $value = get_post_meta($post->ID, 'proyecto_destacado', true);
            wp_nonce_field('guardar_destacado', 'proyecto_destacado_nonce');
?>
        <label>
            <input type="checkbox" name="proyecto_destacado" value="1" <?php checked($value, '1'); ?> />
            DESTACAR
        </label>
    <?php
        },
        'proyecto',
        'side',
        'default'
    );
});

add_action('save_post', function ($post_id) {
    if (
        wp_is_post_autosave($post_id) ||
        wp_is_post_revision($post_id) ||
        !isset($_POST['proyecto_destacado_nonce']) ||
        !wp_verify_nonce($_POST['proyecto_destacado_nonce'], 'guardar_destacado')
    ) {
        return;
    }
    $destacado = isset($_POST['proyecto_destacado']) ? '1' : '0';
    update_post_meta($post_id, 'proyecto_destacado', $destacado);
});

// 9. ACF: Cargar y guardar JSON en /acf-json de este tema

// ACF JSON: guardar en /wp-content/themes/tu-tema/acf-json
add_filter('acf/settings/save_json', function ($path) {
    // Cambia 'tu-tema' por el slug de tu tema si fuera necesario
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
});

// ACF JSON: cargar también desde /acf-json de tu tema
add_filter('acf/settings/load_json', function ($paths) {
    // Añadimos nuestra ruta, manteniendo las demás
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

// Verificar que ACF esté activo
add_action('admin_notices', function () {
    if (! class_exists('ACF')) {
        echo '<div class="error"><p>Por favor, activa el plugin Advanced Custom Fields.</p></div>';
    }
});


// Registro de los Custom Post Types (CPTs) necesarios para el tema

/**
 * 1. CPT: Proyectos
 */
function MyPortfolio_register_cpt_proyecto()
{
    $labels = [
        'name'                  => 'Proyectos',
        'singular_name'         => 'Proyecto',
        'menu_name'             => 'Proyectos',
        'name_admin_bar'        => 'Proyecto',
        'add_new'               => 'Añadir nuevo',
        'add_new_item'          => 'Añadir nuevo proyecto',
        'edit_item'             => 'Editar proyecto',
        'new_item'              => 'Nuevo proyecto',
        'view_item'             => 'Ver proyecto',
        'all_items'             => 'Todos los proyectos',
        'search_items'          => 'Buscar proyectos',
        'not_found'             => 'No se han encontrado proyectos',
        'not_found_in_trash'    => 'No hay proyectos en la papelera',
    ];
    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'proyectos'],
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
    ];
    register_post_type('proyecto', $args);
}
add_action('init', 'MyPortfolio_register_cpt_proyecto');

/**
 * Shortcode [proyectos_filtro]
 * Formulario con filtros y listado de proyectos filtrados.
 */
add_shortcode('proyectos_filtro', function ($atts) {
    // 1) Define CPT & campos ACF para filtrado
    $post_types = [
        'ia'          => 'ias_usadas',
        'wordpress'   => 'wordpress_usadas',
        'lenguaje'    => 'lenguajes_usadas',
        'framework'   => 'frameworks_usadas',
        'componente'  => 'componentes_usadas',
        'despliegue'  => 'despliegues_usadas',
        'herramienta' => 'herramientas_usadas',
    ];

    // 2) Leer orden y dirección
    $orderby = in_array($_GET['orderby'] ?? '', ['title', 'date']) ? $_GET['orderby'] : 'date';
    $order   = in_array($_GET['order']   ?? '', ['ASC', 'DESC'])   ? $_GET['order']   : 'DESC';

    // 3) Leer filtros checkbox
    $filters = [];
    foreach ($post_types as $slug => $field) {
        $key = 'filter_' . $slug;
        if (!empty($_GET[$key]) && is_array($_GET[$key])) {
            $filters[$field] = array_map('intval', $_GET[$key]);
        }
    }

    // 4) Generar formulario
    ob_start(); ?>
    <form method="get" class="proyectos-filtro">
        <div id="filtros-panel">
            <!-- Ordenación -->
            <div class="filter-category">
                <div class="category-title">
                    <h3><?php esc_html_e('Ordenar por', 'myportfolio'); ?></h3>
                </div>
                <div class="category-content filter-group">
                    <select name="orderby" class="form-select">
                        <option value="date" <?php selected($orderby, 'date'); ?>>
                            <?php esc_html_e('Fecha', 'myportfolio'); ?>
                        </option>
                        <option value="title" <?php selected($orderby, 'title'); ?>>
                            <?php esc_html_e('Título', 'myportfolio'); ?>
                        </option>
                    </select>
                    <select name="order" class="form-select">
                        <option value="DESC" <?php selected($order, 'DESC'); ?>>
                            <?php esc_html_e('Descendente', 'myportfolio'); ?>
                        </option>
                        <option value="ASC" <?php selected($order, 'ASC'); ?>>
                            <?php esc_html_e('Ascendente', 'myportfolio'); ?>
                        </option>
                    </select>
                </div>
            </div>

            <!-- Filtros dinámicos -->
            <?php foreach ($post_types as $slug => $field):
                $terms = get_posts([
                    'post_type'      => $slug,
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ]);
                if (!$terms) continue;
                $key = 'filter_' . $slug;
            ?>
                <div class="filter-category">
                    <div class="category-title">
                        <h3><?php echo esc_html(ucfirst($slug)); ?></h3>
                    </div>
                    <div class="category-content">
                        <div class="filter-options">
                            <?php foreach ($terms as $t):
                                $icon       = get_field('icono', $t->ID);
                                $icon_url   = is_array($icon) ? $icon['url'] : $icon;
                                // Leer si este icono debe invertirse
                                $invert     = (bool) get_field('invertir_icono', $t->ID);
                            ?>
                                <label class="filter-option">
                                    <input
                                        type="checkbox"
                                        name="<?php echo esc_attr($key); ?>[]"
                                        value="<?php echo esc_attr($t->ID); ?>"
                                        <?php checked(in_array($t->ID, $filters[$field] ?? [])); ?>>
                                    <span class="custom-checkbox"></span>
                                    <?php if ($icon_url): ?>
                                        <img
                                            src="<?php echo esc_url($icon_url); ?>"
                                            alt="<?php echo esc_attr(get_the_title($t)); ?>"
                                            class="filter-icon<?php echo $invert ? ' filter-icon--invert' : ''; ?>">
                                    <?php endif; ?>
                                    <span><?php echo esc_html(get_the_title($t)); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Botones de acción -->
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">
                    <?php esc_html_e('Filtrar', 'myportfolio'); ?>
                </button>
                <a class="btn btn-link" href="<?php echo esc_url(remove_query_arg(array_map(fn($s) => 'filter_' . $s, array_keys($post_types)))); ?>">
                    <?php esc_html_e('Restablecer', 'myportfolio'); ?>
                </a>
            </div>
        </div>
    </form>
<?php
    // 5) Preparar consulta
    $paged = max(1, get_query_var('paged'), get_query_var('page'));
    $args = [
        'post_type'      => 'proyecto',
        'posts_per_page' => 9,
        'orderby'        => $orderby,
        'order'          => $order,
        'paged'          => $paged,
    ];

    if ($filters) {
        // Cada filtro y cada valor deben cumplirse: AND general
        $meta_queries = ['relation' => 'AND'];
        foreach ($filters as $meta_key => $ids) {
            // Para cada ID seleccionado
            foreach ($ids as $id) {
                $meta_queries[] = [
                    'key'     => $meta_key,
                    'value'   => '"' . intval($id) . '"',
                    'compare' => 'LIKE',
                ];
            }
        }
        $args['meta_query'] = $meta_queries;
    }

    // 6) Loop y paginación
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        echo '<div class="card-container proyectos d-flex flex-wrap gap-5 justify-content-center py-4">';
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('loop-templates/content', 'projectcard');
        }
        echo '</div>';
        echo '<div class="w-100 mt-4">' . paginate_links([
            'total'     => $query->max_num_pages,
            'current'   => $paged,
            'prev_text' => __('Anterior', 'myportfolio'),
            'next_text' => __('Siguiente', 'myportfolio'),
        ]) . '</div>';
        wp_reset_postdata();
    } else {
        echo '<p>' . esc_html__('No hay proyectos para mostrar.', 'myportfolio') . '</p>';
    }

    return ob_get_clean();
});

// 10. Filtros de plantilla para páginas específicas
// Para páginas estáticas como 'contacto', 'sobre-mi', 'curriculum' y 'vista de proyecto'

add_filter('page_template', function ($page_template) {
    if (is_page('contacto') && $tpl = locate_template('page-templates/page-contacto.php')) {
        return $tpl;
    }
    if (is_page('sobre-mi') && $tpl = locate_template('page-templates/page-sobre-mi.php')) {
        return $tpl;
    }
    if (is_page('curriculum') && $tpl = locate_template('page-templates/page-curriculum.php')) {
        return $tpl;
    }
    return $page_template;
});

// Para single-proyecto (CPT 'proyecto')
add_filter('single_template', function ($single_template) {
    if (is_singular('proyecto') && $tpl = locate_template('page-templates/single-proyecto.php')) {
        return $tpl;
    }
    return $single_template;
});
