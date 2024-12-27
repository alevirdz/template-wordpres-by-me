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
        $classes[] = 'navbar-nav';
    }
    return $classes;
}
add_filter('nav_menu_container_class', 'my_custom_menu_classes', 10, 2);


/**
* Create Logo Setting and Upload Control
*/
function ideapress_customize_register($wp_customize) {
    // Añadir una configuración para el logo
    $wp_customize->add_setting('ideapress_logo', array(
        'default'           => '', // Valor predeterminado vacío
        'sanitize_callback' => 'esc_url_raw', // Sanitizar la URL del logo
    ));

    // Añadir un control de imagen para subir el logo
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'ideapress_logo',
        array(
            'label'    => __('Subir Logo', 'ideaPress'),
            'section'  => 'title_tagline', // Sección de identidad del sitio
            'settings' => 'ideapress_logo',
        )
    ));
}
add_action('customize_register', 'ideapress_customize_register');




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
    $pagina_inicio_id = crear_pagina('Página de Inicio', 'Contenido predeterminado de la página de inicio.', 'templates/template-page.php');
    $pagina_faq_id = crear_pagina('Preguntas Frecuentes', 'Aquí encontrarás las preguntas más frecuentes.', 'templates/preguntas-frecuentes.php');
    $pagina_blog_id = crear_pagina('Blog', 'Bienvenido al blog de nuestro sitio.', 'templates/home.php');
    $pagina_privacidad_id = crear_pagina('Política de Privacidad', 'Aquí está nuestra política de privacidad.', 'templates/politica-privacidad.php');

    // Configurar los ajustes de lectura de WordPress
    update_option('page_on_front', $pagina_inicio_id);  // Página de inicio
    update_option('page_for_posts', $pagina_blog_id);   // Página de blog
    update_option('show_on_front', 'page');              // Asegurarse de que se use una página estática

    // Crear el menú y añadir las páginas
    crear_menu_template($pagina_inicio_id, $pagina_faq_id, $pagina_blog_id, $pagina_privacidad_id);
}

// Ejecutar la creación de las páginas y el menú al activar el tema
add_action('after_switch_theme', 'crear_y_configurar_paginas');


/** WOOCOMMERCE **/
add_theme_support('woocommerce');

function mi_template_carrito_personalizado( $template ) {
    // Verificar si es la página del carrito
    if ( is_cart() ) {
        // Verificar si existe tu plantilla personalizada en el tema
        $custom_template = locate_template( 'woocommerce/cart/cart.php' );
        
        // Si existe la plantilla personalizada, cargarla
        if ( $custom_template ) {
            return $custom_template;
        }
    }
    
    // Si no hay plantilla personalizada, WooCommerce usará la predeterminada
    return $template;
}
add_filter( 'template_include', 'mi_template_carrito_personalizado', 99 );

// Función para cargar la plantilla personalizada de finalizar compra
function mi_template_checkout_personalizado( $template ) {
    if ( is_checkout() && ! is_cart() ) {
        // Ruta de tu plantilla personalizada dentro del tema o tema hijo
        $custom_template = get_stylesheet_directory() . '/woocommerce/checkout/form-checkout.php';
        if ( file_exists( $custom_template ) ) {
            return $custom_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'mi_template_checkout_personalizado', 99 );


define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);






















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
