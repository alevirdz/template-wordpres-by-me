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
        wp_enqueue_style( 'chld_thm_cfg_separate', trailingslashit( get_stylesheet_directory_uri() ) . 'ctc-style.css', array( 'astra-theme-css','woocommerce-layout','woocommerce-smallscreen','woocommerce-general' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION
function mi_template_carrito_personalizado( $template ) {
    if ( is_cart() ) {
        $custom_template = get_stylesheet_directory() . '/woocommerce/cart/cart.php' ;
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



