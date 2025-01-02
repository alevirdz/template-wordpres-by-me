<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>
<!-- Botón para abrir el menú -->
<button class="menu-toggle" id="menu-toggle">
    <span class="menu-icon"></span>
</button>

<!-- Menú deslizable -->
<div class="slide-menu" id="slide-menu">
    <div class="menu-header">
        <button class="close-menu" id="close-menu">&times;</button>
        <h3><?php esc_html_e( 'Account Navigation', 'woocommerce' ); ?></h3>

        <!-- Mostrar el nombre del usuario -->
        <?php 
            if ( is_user_logged_in() ) {
                $current_user = wp_get_current_user();
                echo '<p class="user-name">Hello, ' . esc_html( $current_user->display_name ) . '!</p>';
            } else {
                echo '<p class="user-name">Hello, Guest!</p>';
            }
        ?>
    </div>

    <ul class="menu-items">
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            <li class="menu-item <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" 
                   class="menu-link <?php echo wc_is_current_account_menu_item( $endpoint ) ? 'active' : ''; ?>"
                   aria-current="<?php echo wc_is_current_account_menu_item( $endpoint ) ? 'page' : ''; ?>">
                    <?php echo esc_html( $label ); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<style>
    /* Estilo general del menú */
.slide-menu {
    position: fixed;
    top: 0;
    left: -250px; /* Menú oculto a la izquierda */
    width: 250px;
    height: 100%;
    background-color: #2c3e50; /* Fondo oscuro */
    color: #fff;
    padding: 20px;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease; /* Efecto deslizante */
    z-index: 1000;
}

.slide-menu.open {
    transform: translateX(250px); /* Mueve el menú a la vista */
}

.menu-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.menu-header h3 {
    font-size: 18px;
    font-weight: 700;
}

.close-menu {
    font-size: 24px;
    background: none;
    border: none;
    color: #fff;
    cursor: pointer;
    padding: 5px;
}

/* Estilo del botón para abrir el menú */
.menu-toggle {
    position: fixed;
    top: 20px;
    left: 20px;
    background-color: #0073e6;
    border: none;
    color: #fff;
    padding: 12px;
    font-size: 18px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 1100; /* Aseguramos que el botón esté encima */
}

/* Estilo de los enlaces del menú */
.menu-items {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.menu-item {
    margin-bottom: 20px;
}

.menu-link {
    text-decoration: none;
    color: #fff;
    font-size: 16px;
    padding: 10px;
    border-radius: 4px;
    display: block;
    transition: background-color 0.3s ease;
}

.menu-link:hover {
    background-color: #0073e6;
}

/* Estilo para la opción activa */
.menu-link.active {
    background-color: #0073e6;
    font-weight: 600;
    padding-left: 20px;
}

/* Animación del botón de abrir */
.menu-icon::before {
    content: '\2630'; /* Símbolo de menú hamburguesa */
    font-size: 28px;
    color: white;
}
/* Estilo para el nombre del usuario */
.user-name {
    font-size: 16px;
    color: #fff;
    margin-top: 10px;
    font-weight: 500;
}


</style>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.getElementById('menu-toggle');
    const slideMenu = document.getElementById('slide-menu');
    const closeMenu = document.getElementById('close-menu');

    // Toggle para abrir y cerrar el menú
    menuToggle.addEventListener('click', function() {
        slideMenu.classList.toggle('open'); // Cambiar entre abrir y cerrar
    });

    // Cerrar el menú al hacer clic en el botón de cerrar
    closeMenu.addEventListener('click', function() {
        slideMenu.classList.remove('open'); // Cerrar el menú
    });

    // Añadir o quitar clase 'active' a las opciones de menú
    const menuLinks = document.querySelectorAll('.menu-link');
    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            menuLinks.forEach(l => l.classList.remove('active')); // Eliminar 'active' de todos
            link.classList.add('active'); // Agregar 'active' al clicado
        });
    });
});

</script>