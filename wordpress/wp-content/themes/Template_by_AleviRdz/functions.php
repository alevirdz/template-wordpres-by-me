<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_separate', trailingslashit( get_stylesheet_directory_uri() ) . 'ctc-style.css', array( 'generate-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );
// END ENQUEUE PARENT ACTION


/** ======     Configuraciones para el carrito ======       **/
// if ( class_exists( 'WooCommerce' ) ) {
//     add_filter( 'template_include', 'mi_template_personalizado', 99 );

//     function mi_template_personalizado( $template ) {
//         if ( is_cart() ) {
//             $custom_template = locate_template( 'woocommerce/cart/cart.php' );
//             if ( $custom_template ) {
//                 return $custom_template;
//             }
//         }

//         if ( is_checkout() && ! is_cart() ) {
//             $custom_template = locate_template( 'woocommerce/checkout/form-checkout.php' );
//             if ( $custom_template ) {
//                 return $custom_template;
//             }
//         }

//         return $template;
//     }
// }

function enqueue_ajax_cart_script() {
    if ( is_cart() ) {
        wp_enqueue_script(
            'ajax-cart-script',
            get_stylesheet_directory_uri() . '/assets/js/woocommerce/update-cart.js', // Ajusta la ruta según la ubicación del archivo
            array(),
            '1.0.0',
            true
        );

        // wp_localize_script( 'ajax-cart-script', 'woocommerce_params', array(
        //     'ajax_url'    => admin_url( 'admin-ajax.php' ),
        //     'cart_nonce'  => wp_create_nonce( 'woocommerce-cart' ),
        // ));
        // wp_localize_script('ajax-cart-script', 'updateCartObj', array(
        //     'ajax_url' => admin_url('admin-ajax.php'), // URL para las solicitudes AJAX
        //     'nonce'    => wp_create_nonce('update_cart_nonce'), // Genera el nonce para seguridad
        // ));
        // Actualizar el nonce para que coincida con el del lado del servidor
wp_localize_script('ajax-cart-script', 'updateCartObj', array(
    'ajax_url' => admin_url('admin-ajax.php'), // URL para las solicitudes AJAX
    'nonce'    => wp_create_nonce('actualizar_carrito_nonce'), // Genera el nonce para seguridad
));

    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_ajax_cart_script' );


function update_cart_qty() {
    // Verificamos el nonce para asegurar que la solicitud es legítima
    if ( !isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'update_cart_nonce') ) {
        wp_send_json_error(array('message' => 'Nonce inválido.'));
    }

    // Verificamos si los elementos del carrito y las cantidades fueron enviados
    if (isset($_POST['cart_items']) && is_array($_POST['cart_items'])) {
        // Recorremos todos los elementos del carrito
        foreach ($_POST['cart_items'] as $cart_item_key => $quantity) {
            $quantity = intval($quantity);  // Aseguramos que la cantidad es un número entero

            // Si la cantidad es mayor que 0, actualizamos el carrito
            if ($quantity > 0) {
                WC()->cart->set_quantity($cart_item_key, $quantity); // Actualizamos la cantidad del artículo
            }
        }

        // Recalculamos los totales del carrito
        WC()->cart->calculate_totals();

        // Devolvemos los fragmentos del carrito actualizado y el nuevo hash
        wp_send_json_success(array(
            'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array()),
            'cart_hash' => WC()->cart->get_cart_hash()
        ));
    } else {
        wp_send_json_error(array('message' => 'Datos de los elementos del carrito no válidos.'));
    }
}
add_action('wp_ajax_update_cart', 'update_cart_qty');
add_action('wp_ajax_nopriv_update_cart', 'update_cart_qty');




