<?php
/**
 * My Account Dashboard
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

<!-- Start of the Dashboard Container -->
<div class="container mt-5">
	<div class="row">
		<div class="col-md-12">
			<!-- Greeting Card -->
			<div class="card shadow-sm">
				<div class="card-body">
					<h3 class="card-title">Welcome Back, <strong><?php echo esc_html( $current_user->display_name ); ?></strong>!</h3>
					<p class="card-text">
						<?php
						printf(
							/* translators: 1: user display name 2: logout url */
							wp_kses( __( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ), $allowed_html ),
							'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
							esc_url( wc_logout_url() )
						);
						?>
					</p>
				</div>
			</div>
			<!-- End Greeting Card -->

			<!-- Dashboard Description Card -->
			<div class="card mt-4 shadow-sm">
				<div class="card-body">
					<h5 class="card-title">Account Dashboard</h5>
					<p class="card-text">
						<?php
						/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
						$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
						if ( wc_shipping_enabled() ) {
							/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
							$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
						}
						printf(
							wp_kses( $dashboard_desc, $allowed_html ),
							esc_url( wc_get_endpoint_url( 'orders' ) ),
							esc_url( wc_get_endpoint_url( 'edit-address' ) ),
							esc_url( wc_get_endpoint_url( 'edit-account' ) )
						);
						?>
					</p>
				</div>
			</div>
			<!-- End Dashboard Description Card -->
		</div>
	</div>

	<!-- Add some space for actions and custom WooCommerce actions -->
	<div class="row mt-4">
		<div class="col-md-12">
			<?php
				// WooCommerce custom actions
				do_action( 'woocommerce_account_dashboard' );
			?>
		</div>
	</div>
</div>
<!-- End of the Dashboard Container -->

