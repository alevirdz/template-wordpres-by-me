<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header( 'shop' );
do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation" aria-label="<?php esc_html_e( 'Account pages', 'woocommerce' ); ?>">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="account-menu-item <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" 
                   class="menu-link <?php echo wc_is_current_account_menu_item( $endpoint ) ? 'active' : ''; ?>"
                   aria-current="<?php echo wc_is_current_account_menu_item( $endpoint ) ? 'page' : ''; ?>">
					<?php echo esc_html( $label ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>


<?php do_action( 'woocommerce_after_account_navigation' ); ?>

<style>
	/* Estilo general para la navegación */
.woocommerce-MyAccount-navigation {
    background-color: #f4f4f4; /* Fondo claro para mejor contraste */
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 15px;
}

.woocommerce-MyAccount-navigation ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

/* Estilo para cada item de la navegación */
.woocommerce-MyAccount-navigation li {
    margin-bottom: 10px;
}

/* Estilo de los enlaces del menú */
.woocommerce-MyAccount-navigation a {
    text-decoration: none;
    color: #333; /* Color de texto neutral */
    font-size: 16px;
    font-weight: 600;
    padding: 10px;
    border-radius: 4px;
    display: block;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Efecto cuando el enlace es hover */
.woocommerce-MyAccount-navigation a:hover {
    background-color: #0073e6; /* Fondo azul cuando se pasa el mouse */
    color: white; /* Color blanco en el texto cuando se selecciona */
}

/* Estilo para el item activo */
.woocommerce-MyAccount-navigation a.active {
    background: #046bd2 !important;
    color: white;
    border-left: 4px solid #fff; /* Barra a la izquierda del item activo */
}

/* Efecto de transición cuando se cambia la opción */
.woocommerce-MyAccount-navigation a {
    position: relative;
    opacity: 0;
    animation: fadeIn 0.5s forwards;
}

/* Animación para el cambio suave */
@keyframes fadeIn {
    to {
        opacity: 1;
    }
}


</style>
<script>
	document.querySelectorAll('.woocommerce-MyAccount-navigation a').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelectorAll('.woocommerce-MyAccount-navigation a').forEach(link => {
            link.classList.remove('active'); // Elimina la clase 'active' de todos
        });
        item.classList.add('active'); // Agrega la clase 'active' al enlace clicado
    });
});

</script>