<?php
/**
 * ideaPress functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage ideaPress
 * @since ideaPress 1.0
 */

require_once get_template_directory() . '/includes/class-wp-bootstrap-navwalker.php';

function theme_ideaPress() {
    // Registra los menús en el tema
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'ideaPress' ),
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
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // Añadir un control de imagen para subir el logo
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'ideapress_logo',
        array(
            'label'    => __('Subir Logo', 'ideaPress'),
            'section'  => 'title_tagline',
            'settings' => 'ideapress_logo',
        )
    ));
}
add_action('customize_register', 'ideapress_customize_register');

/**
 * Crea una página si no existe y asigna una plantilla.
 */
function crear_pagina($titulo, $contenido, $plantilla = '') {
    // Comprobar si ya existe una página con el título dado
    $pagina = get_page_by_title($titulo);

    if (empty($pagina)) {
        // Crear la página
        $pagina_id = wp_insert_post(array(
            'post_title'   => $titulo,
            'post_content' => $contenido,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_author'  => 1,
        ));

        // Asignar la plantilla si se proporciona
        if ($pagina_id && $plantilla) {
            update_post_meta($pagina_id, '_wp_page_template', $plantilla);
        }
    } else {
        $pagina_id = $pagina->ID;
    }

    return $pagina_id; 
}

/**
 * Crea un menú llamado "Menu - template" y añade las páginas al menú.
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
        $locations['primary'] = $menu_id;
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
    update_option('page_on_front', $pagina_inicio_id);
    update_option('page_for_posts', $pagina_blog_id);
    update_option('show_on_front', 'page');

    // Crear el menú y añadir las páginas
    crear_menu_template($pagina_inicio_id, $pagina_faq_id, $pagina_blog_id, $pagina_privacidad_id);
}

// Ejecutar la creación de las páginas y el menú al activar el tema
add_action('after_switch_theme', 'crear_y_configurar_paginas');

/** WOOCOMMERCE **/

// Añadir soporte para WooCommerce
function ideapress_soporte_woocommerce() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'ideapress_soporte_woocommerce' );

// Comprobar si el plugin de WooCommerce está activo antes de ejecutar cualquier código relacionado
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // Plantilla del carrito personalizada (verificar si es necesario)
    function mi_template_carrito_personalizado( $template ) {
        if ( is_cart() ) {
            $custom_template = locate_template( 'woocommerce/cart/cart.php' );
            if ( $custom_template ) {
                return $custom_template;
            }
        }
        return $template;
    }
    add_filter( 'template_include', 'mi_template_carrito_personalizado', 99 );

    function mi_template_checkout_personalizado( $template ) {
        if ( is_checkout() && ! is_cart() ) {
            $custom_template = get_stylesheet_directory() . '/woocommerce/checkout/form-checkout.php';
            if ( file_exists( $custom_template ) ) {
                return $custom_template;
            }
        }
        return $template;
    }
    add_filter( 'template_include', 'mi_template_checkout_personalizado', 99 );
}

// function custom_woocommerce_form_field( $key, $args, $value = null ) {
//     $args = wp_parse_args( $args, array(
//         'type'              => 'text',
//         'label'             => '',
//         'placeholder'       => '',
//         'class'             => array(),
//         'label_class'       => array(),
//         'input_class'       => array(),
//         'return'            => false,
//         'options'           => array(),
//         'required'          => false,
//         'custom_attributes' => array(),
//     ));

//     if ( $args['required'] ) {
//         $args['label'] .= ' <span class="custom-required">*</span>';
        
//     }
    
//     return $field;
// }



function custom_woocommerce_form_field( $field, $key, $args ) {
    // Verificamos si el campo es obligatorio
    if ( isset( $args['required'] ) && $args['required'] ) {
        // Eliminamos el <abbr class="required"> y su contenido
        $field = preg_replace('/<abbr class="required"[^>]*>\*<\/abbr>/', '', $field);
        
        // Agregar un <span> con la clase personalizada después del texto de la etiqueta
        $field = preg_replace('/(<label[^>]*>)(.*?)(<\/label>)/', '$1$2<span class="field-required">*</span>$3', $field);
    }

    // Retornar el campo con el nuevo asterisco
    return $field;
}
add_filter( 'woocommerce_form_field', 'custom_woocommerce_form_field', 10, 3 );


// add_filter( 'woocommerce_checkout_coupon_message', 'custom_coupon_message' );
// function custom_coupon_message( $message ) {
//     return __( '¿Tienes un código promocional? Haz clic aquí para aplicarlo.', 'woocommerce' );
// }
add_filter( 'woocommerce_no_available_payment_methods_message', 'custom_no_payment_methods_message' );
function custom_no_payment_methods_message( $message ) {
    return __( 'Actualmente no hay métodos de pago configurados. Por favor, contáctanos para procesar tu pedido.', 'woocommerce' );
}


/** ======     Configuraciones para el carrito ======       **/
// function enqueue_custom_scripts() {
//     if (is_cart()) {
//         wp_enqueue_script('update-cart', get_template_directory_uri() . '/assets/js/woocommerce/update-cart.js', array(), null, true);
//         wp_localize_script('update-cart', 'updateCartObj', array(
//             'nonce' => wp_create_nonce('update_cart_nonce'),
//             'ajax_url' => admin_url('admin-ajax.php')
//         ));
//     }
// }
// add_action('wp_enqueue_scripts', 'enqueue_custom_scripts'); 

// function update_cart_qty() {
//     // Verificamos el nonce para asegurar que la solicitud es legítima
//     if ( !isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'update_cart_nonce') ) {
//         wp_send_json_error(array('message' => 'Nonce inválido.'));
//     }

//     // Verificamos si los elementos del carrito y las cantidades fueron enviados
//     if (isset($_POST['cart_items']) && is_array($_POST['cart_items'])) {
//         // Recorremos todos los elementos del carrito
//         foreach ($_POST['cart_items'] as $cart_item_key => $quantity) {
//             $quantity = intval($quantity);  // Aseguramos que la cantidad es un número entero

//             // Si la cantidad es mayor que 0, actualizamos el carrito
//             if ($quantity > 0) {
//                 WC()->cart->set_quantity($cart_item_key, $quantity); // Actualizamos la cantidad del artículo
//             }
//         }

//         // Recalculamos los totales del carrito
//         WC()->cart->calculate_totals();

//         // Devolvemos los fragmentos del carrito actualizado y el nuevo hash
//         wp_send_json_success(array(
//             'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array()),
//             'cart_hash' => WC()->cart->get_cart_hash()
//         ));
//     } else {
//         wp_send_json_error(array('message' => 'Datos de los elementos del carrito no válidos.'));
//     }
// }
// add_action('wp_ajax_update_cart', 'update_cart_qty');
// add_action('wp_ajax_nopriv_update_cart', 'update_cart_qty');



/** ============================================================   **/















// Agregar soporte para imágenes destacadas
add_theme_support('post-thumbnails');

// Registrar y cargar los archivos CSS y JS de Bootstrap
function my_theme_enqueue_scripts() {
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.2', 'all');
    wp_enqueue_style('swiper-css', get_stylesheet_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css', array(), '11.1.9', 'all');
    wp_enqueue_style('aos-css', get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.css', array(), '3','all');
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array('bootstrap-css'), null, 'all');

    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), '5.3.2', true);
    wp_enqueue_script('swiper-js', get_stylesheet_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js', array(), '11.1.9', true);
    wp_enqueue_script('aos-js', get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.js', array(), '3', true);
    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), time(), true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');
?>
