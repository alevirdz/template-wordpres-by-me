<?php
// Encolar la hoja de estilo del tema padre y tema hijo
function generatepress_child_enqueue_styles() {
    // Encolar el estilo del tema padre
    wp_enqueue_style('generatepress-parent-style', get_template_directory_uri() . '/style.css');

    // Encolar Bootstrap (CDN o archivo local)
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.2');

    // Encolar el JavaScript de Bootstrap (local o CDN)
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), '5.3.2', true);

    // Encolar el estilo del tema hijo (asegúrate de que se cargue después de Bootstrap)
    wp_enqueue_style('generatepress-child-style', get_stylesheet_directory_uri() . '/style.css', array('generatepress-parent-style', 'bootstrap-css'));
}
add_action('wp_enqueue_scripts', 'generatepress_child_enqueue_styles');


// Registrar el menú
function generatepress_child_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'generatepress-child' ),
    ) );
}
add_action( 'after_setup_theme', 'generatepress_child_register_menus' );






