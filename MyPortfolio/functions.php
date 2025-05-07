<?php

/**
 * functions.php de MyPortfolio
 */

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

/**
 * ACF: Guardar y cargar JSON en /acf-json de este tema
 */
add_filter('acf/settings/save_json', function($path){
    // Carpeta donde ACF volcará los .json de los field groups
    return get_stylesheet_directory() . '/acf-json';
});
add_filter('acf/settings/load_json', function($paths){
    // Eliminamos la ruta por defecto y añadimos la de nuestro tema
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

// Verificar que ACF esté activo
add_action('admin_notices', function(){
    if ( ! class_exists('ACF') ) {
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
 * 2. CPT: Intereses Personales
 */
add_action('init', function(){
    $labels = [
        'name'               => 'Intereses Personales',
        'singular_name'      => 'Interés Personal',
        'menu_name'          => 'Intereses Personales',
        'name_admin_bar'     => 'Interés Personal',
        'add_new'            => 'Añadir Interés',
        'add_new_item'       => 'Añadir Nuevo Interés Personal',
        'edit_item'          => 'Editar Interés Personal',
        'new_item'           => 'Nuevo Interés Personal',
        'view_item'          => 'Ver Interés Personal',
        'all_items'          => 'Todos los Intereses Personales',
        'search_items'       => 'Buscar Intereses',
        'not_found'          => 'No se han encontrado intereses',
        'not_found_in_trash' => 'No hay intereses en la papelera',
    ];
    $args = [
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-smiley',
        'supports'           => ['title'],  // solo título; descripción va en ACF
    ];
    register_post_type('interes_personal', $args);
});

