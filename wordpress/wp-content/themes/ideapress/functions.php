<?php
require_once get_template_directory() . '/includes/class-wp-bootstrap-navwalker.php';
function theme_ideaPress() {
    // Registra los menús en el tema
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'ideaPress' ), // Este es el nombre y la ubicación del menú
    ) );
}
add_action( 'after_setup_theme', 'theme_ideaPress' );


function my_custom_menu_classes($classes, $args) {
    if ($args->theme_location == 'primary') {
        $classes[] = 'navbar-nav';  // Agregar clase al <ul> directamente
    }
    return $classes;
}
add_filter('nav_menu_container_class', 'my_custom_menu_classes', 10, 2);

// // Creación de páginas por defecto al instalar el tema:
// function crear_pagina_inicio() {
//     // Comprobar si ya existe una página llamada 'Página de Inicio'
//     $pagina_inicio = get_page_by_title('Página de Inicio'); // Cambia el título si es necesario
    
//     if (empty($pagina_inicio)) {
//         // Crear la página de inicio
//         $pagina_inicio_id = wp_insert_post(array(
//             'post_title'   => 'Página de Inicio',  // Nombre de la página
//             'post_content' => 'Contenido predeterminado de la página de inicio.',  // Contenido predeterminado
//             'post_status'  => 'publish',            // Publicar inmediatamente
//             'post_type'    => 'page',               // Es una página
//             'post_author'  => 1,                    // ID del autor (generalmente 1 es el administrador)
//         ));

//         // Asignar la plantilla "Página de Inicio" a esta página creada
//         update_post_meta($pagina_inicio_id, '_wp_page_template', 'template-page.php'); // Cambia 'page-home.php' por el nombre de tu plantilla

//         // Establecer esta página como la página de inicio
//         // update_option('page_on_front', $pagina_inicio_id);
//         // update_option('show_on_front', 'page');
//     }
// }
// add_action('after_switch_theme', 'crear_pagina_inicio');

// function crear_pagina_faq() {
//     // Comprobar si ya existe una página llamada 'Preguntas Frecuentes'
//     $pagina_faq = get_page_by_title('Preguntas Frecuentes'); // Cambia el título si es necesario
    
//     if (empty($pagina_faq)) {
//         // Crear la página de Preguntas Frecuentes
//         $pagina_faq_id = wp_insert_post(array(
//             'post_title'   => 'Preguntas Frecuentes',  // Nombre de la página
//             'post_content' => 'Aquí encontrarás las preguntas más frecuentes.', // Contenido predeterminado
//             'post_status'  => 'publish',               // Publicar inmediatamente
//             'post_type'    => 'page',                  // Es una página
//             'post_author'  => 1,                       // ID del autor (generalmente 1 es el administrador)
//         ));

//         // Asignar la plantilla personalizada "preguntas-frecuentes.php" a la página recién creada
//         if ($pagina_faq_id) {
//             update_post_meta($pagina_faq_id, '_wp_page_template', 'preguntas-frecuentes.php'); // Asegúrate que el nombre del archivo sea correcto

//             // Establecer esta página como la página de preguntas frecuentes si lo deseas
//             // (solo es necesario si deseas que sea accesible desde algún lugar específico del sitio)
//         }
//     }
// }
// add_action('after_switch_theme', 'crear_pagina_faq');
// function crear_pagina_blog() {
//     // Comprobar si ya existe una página llamada 'Blog'
//     $pagina_blog = get_page_by_title('Blog'); // Cambia el título si es necesario
    
//     if (empty($pagina_blog)) {
//         // Crear la página de Blog
//         $pagina_blog_id = wp_insert_post(array(
//             'post_title'   => 'Blog',                // Nombre de la página
//             'post_content' => 'Bienvenido al blog de nuestro sitio.', // Contenido predeterminado
//             'post_status'  => 'publish',             // Publicar inmediatamente
//             'post_type'    => 'page',                // Es una página
//             'post_author'  => 1,                     // ID del autor (generalmente 1 es el administrador)
//         ));

//         // Asignar la plantilla personalizada "page-home.php" a la página recién creada
//         if ($pagina_blog_id) {
//             update_post_meta($pagina_blog_id, '_wp_page_template', 'page-home.php'); // Cambia 'page-home.php' por el nombre de tu plantilla

//         }
//     }
// }
// add_action('after_switch_theme', 'crear_pagina_blog');

// function crear_pagina_politicas_privacidad() {
//     // Comprobar si ya existe una página llamada 'Política de Privacidad'
//     $pagina_privacidad = get_page_by_title('Política de Privacidad'); // Cambia el título si es necesario
    
//     if (empty($pagina_privacidad)) {
//         // Crear la página de política de privacidad
//         $pagina_privacidad_id = wp_insert_post(array(
//             'post_title'   => 'Política de Privacidad',  // Nombre de la página
//             'post_status'  => 'publish',                 // Publicar inmediatamente
//             'post_type'    => 'page',                    // Es una página
//             'post_author'  => 1,                         // ID del autor (generalmente 1 es el administrador)
//         ));

//         // Asignar la plantilla "preguntas-frecuentes.php" a esta página creada
//         update_post_meta($pagina_privacidad_id, '_wp_page_template', 'politica-privacidad.php'); // Cambia 'politica-privacidad.php' por el nombre de tu plantilla

//         // Establecer esta página como la página de Política de Privacidad
//         update_option('page_on_privacy', $pagina_privacidad_id);
//     }
// }
// add_action('after_switch_theme', 'crear_pagina_politicas_privacidad');


// function configurar_pagina_inicio_y_blog() {
//     // Comprobar si ya existen las páginas de inicio y blog
//     $pagina_inicio = get_page_by_title('Página de Inicio');
//     $pagina_blog = get_page_by_title('Blog');
    
//     // Si las páginas no existen, crearlas
//     if (empty($pagina_inicio)) {
//         $pagina_inicio_id = wp_insert_post(array(
//             'post_title'   => 'Página de Inicio',
//             'post_content' => 'Contenido predeterminado de la página de inicio.',
//             'post_status'  => 'publish',
//             'post_type'    => 'page',
//             'post_author'  => 1,
//         ));
//         update_post_meta($pagina_inicio_id, '_wp_page_template', 'preguntas-frecuentes.php');
//     } else {
//         $pagina_inicio_id = $pagina_inicio->ID;
//     }
    
//     if (empty($pagina_blog)) {
//         $pagina_blog_id = wp_insert_post(array(
//             'post_title'   => 'Blog',
//             'post_content' => 'Contenido predeterminado del blog.',
//             'post_status'  => 'publish',
//             'post_type'    => 'page',
//             'post_author'  => 1,
//         ));
//         update_post_meta($pagina_blog_id, '_wp_page_template', 'page-home.php');
//     } else {
//         $pagina_blog_id = $pagina_blog->ID;
//     }

//     // Configurar los ajustes de lectura
//     update_option('page_on_front', $pagina_inicio_id);  // Página de inicio
//     update_option('page_for_posts', $pagina_blog_id);  // Página de blog
//     update_option('show_on_front', 'page');            // Asegurarse de que se use una página estática
// }
// add_action('after_switch_theme', 'configurar_pagina_inicio_y_blog');
// Función para crear páginas predeterminadas

/**
 * Crea una página si no existe y asigna una plantilla.
 *
 * @param string $titulo    El título de la página.
 * @param string $contenido El contenido de la página.
 * @param string $plantilla La plantilla a asignar (si se proporciona).
 * 
 * @return int El ID de la página creada o existente.
 */
function crear_pagina($titulo, $contenido, $plantilla = '') {
    // Comprobar si ya existe una página con el título dado
    $pagina = get_page_by_title($titulo);

    if (empty($pagina)) {
        // Crear la página
        $pagina_id = wp_insert_post(array(
            'post_title'   => $titulo,        // Título de la página
            'post_content' => $contenido,     // Contenido predeterminado
            'post_status'  => 'publish',      // Publicar inmediatamente
            'post_type'    => 'page',         // Es una página
            'post_author'  => 1,              // ID del autor (generalmente 1 es el administrador)
        ));

        // Asignar la plantilla si se proporciona
        if ($pagina_id && $plantilla) {
            update_post_meta($pagina_id, '_wp_page_template', $plantilla);
        }
    } else {
        $pagina_id = $pagina->ID;
    }

    return $pagina_id;  // Retornar el ID de la página creada o existente
}

/**
 * Crea un menú llamado "Menu - template" y añade las páginas al menú.
 *
 * @param int $pagina_inicio_id      ID de la página de Inicio.
 * @param int $pagina_faq_id         ID de la página de Preguntas Frecuentes.
 * @param int $pagina_blog_id        ID de la página del Blog.
 * @param int $pagina_privacidad_id  ID de la página de Política de Privacidad.
 */
function crear_menu_template($pagina_inicio_id, $pagina_faq_id, $pagina_blog_id, $pagina_privacidad_id) {
    // Verificar si el menú ya existe
    $menu_name = 'Menu - template';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    // Si el menú no existe, lo creamos
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        // Añadir las páginas al menú
        if ($pagina_inicio_id) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Inicio',
                'menu-item-object' => 'page',
                'menu-item-object-id' => $pagina_inicio_id,
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
            ));
        }

        if ($pagina_faq_id) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Preguntas Frecuentes',
                'menu-item-object' => 'page',
                'menu-item-object-id' => $pagina_faq_id,
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
            ));
        }

        if ($pagina_blog_id) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Blog',
                'menu-item-object' => 'page',
                'menu-item-object-id' => $pagina_blog_id,
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
            ));
        }

        if ($pagina_privacidad_id) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Política de Privacidad',
                'menu-item-object' => 'page',
                'menu-item-object-id' => $pagina_privacidad_id,
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
            ));
        }

        // Asignar el menú a la ubicación principal del tema
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;  // Asignar el menú creado a la ubicación 'primary'
        set_theme_mod('nav_menu_locations', $locations);
    }
}

/**
 * Crea las páginas predeterminadas y configura los ajustes de lectura.
 */
function crear_y_configurar_paginas() {
    // Crear o obtener las páginas
    $pagina_inicio_id = crear_pagina('Página de Inicio', 'Contenido predeterminado de la página de inicio.', 'template-page.php');
    $pagina_faq_id = crear_pagina('Preguntas Frecuentes', 'Aquí encontrarás las preguntas más frecuentes.', 'preguntas-frecuentes.php');
    $pagina_blog_id = crear_pagina('Blog', 'Bienvenido al blog de nuestro sitio.', 'home.php');
    $pagina_privacidad_id = crear_pagina('Política de Privacidad', 'Aquí está nuestra política de privacidad.', 'politica-privacidad.php');

    // Configurar los ajustes de lectura de WordPress
    update_option('page_on_front', $pagina_inicio_id);  // Página de inicio
    update_option('page_for_posts', $pagina_blog_id);   // Página de blog
    update_option('show_on_front', 'page');              // Asegurarse de que se use una página estática

    // Crear el menú y añadir las páginas
    crear_menu_template($pagina_inicio_id, $pagina_faq_id, $pagina_blog_id, $pagina_privacidad_id);
}

// Ejecutar la creación de las páginas y el menú al activar el tema
add_action('after_switch_theme', 'crear_y_configurar_paginas');








// Agregar soporte para imágenes destacadas
add_theme_support('post-thumbnails');


// Registrar y cargar los archivos CSS y JS de Bootstrap
function my_theme_enqueue_scripts() {
    // Cargar Bootstrap CSS
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.2', 'all');
    wp_enqueue_style('swiper-css', get_stylesheet_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css', array(), '11.1.9', 'all');
    wp_enqueue_style('aos-css', get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.css', array(), '3','all');
    // Cargar el CSS principal del tema (style.css)
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array('bootstrap-css'), null, 'all');

    // Cargar Bootstrap JS
    
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), '5.3.2', true);
    wp_enqueue_script('swiper-js', get_stylesheet_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js', array(), '11.1.9', true);
    wp_enqueue_script('aos-js', get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.js', array(), '3', true);
    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), time(), true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');
