<?php
/**
 * Professional and Secure Checkout Page Template
 * Optimized for UI/UX
 *
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

get_header(); // Include the header of the theme
do_action( 'woocommerce_before_checkout_form' );

// Ensure $checkout is defined
$checkout = WC()->checkout;

if ( ! $checkout ) {
    echo '<div class="alert alert-danger text-center">';
    esc_html_e( 'Checkout is currently unavailable.', 'woocommerce' );
    echo '</div>';
    return;
}

if ( ! is_user_logged_in() ) {
    echo '<div class="alert alert-warning text-center" role="alert">';
    esc_html_e( 'You must be logged in to complete your purchase.', 'woocommerce' );
    echo '</div>';
    wp_login_form( array( 'redirect' => wc_get_checkout_url() ) );
    return;
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
                <?php wp_nonce_field( 'woocommerce_checkout', 'woocommerce_checkout_nonce' ); ?>

                <?php if ( $checkout->get_checkout_fields() ) : ?>
                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                    <div id="customer_details">
                        <div class="billing-details">
                            <h3><?php esc_html_e( 'Billing Details', 'woocommerce' ); ?></h3>
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>
                        <div class="shipping-details mt-4">
                            <h3><?php esc_html_e( 'Shipping Details', 'woocommerce' ); ?></h3>
                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                        </div>
                    </div>
                    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                <?php endif; ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <h3><?php esc_html_e( 'Your Order', 'woocommerce' ); ?></h3>
                    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
                    <div class="order-review-table">
                        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                    </div>
                    <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                </div>

                <div class="form-row place-order text-end mt-4">
                    <button type="submit" class="btn btn-black btn-lg" name="woocommerce_checkout_place_order" id="place_order" value="<?php esc_attr_e( 'Place Order', 'woocommerce' ); ?>">
                        <?php esc_html_e( 'Place Order', 'woocommerce' ); ?>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="order-summary">
                <h3><?php esc_html_e( 'Summary', 'woocommerce' ); ?></h3>
                <table class="table table-striped">
                    <tr>
                        <th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                        <td><?php wc_cart_totals_subtotal_html(); ?></td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
                        <td><?php wc_cart_totals_shipping_html(); ?></td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                        <td><?php wc_cart_totals_order_total_html(); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkoutForm = document.querySelector('.woocommerce-checkout');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function (e) {
            const inputs = checkoutForm.querySelectorAll('input, select, textarea');
            for (const input of inputs) {
                if (input.required && !input.value.trim()) {
                    alert(checkoutMessages.requiredField);
                    e.preventDefault();
                    return;
                }
                if (input.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value)) {
                    alert(checkoutMessages.invalidEmail);
                    e.preventDefault();
                    return;
                }
            }
        });
    }
});
</script>
<?php
do_action( 'woocommerce_after_checkout_form', $checkout );
get_footer();
