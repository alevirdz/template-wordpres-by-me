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
