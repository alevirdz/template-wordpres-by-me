<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h2><?php esc_html_e( 'Cart totals', 'woocommerce' ); ?></h2>

	<table cellspacing="0" class="shop_table shop_table_responsive">

    <!-- Subtotal -->
    <tr class="cart-subtotal">
        <th class="col-10"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
        <td class="col-2" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
    </tr>

    <!-- Coupons -->
    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
        <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
            <th class="col-10"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
            <td class="col-2" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
        </tr>
    <?php endforeach; ?>

    <!-- Shipping -->
    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
        <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
        <tr class="shipping">
            <th class="col-10"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
            <td class="col-2" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php wc_cart_totals_shipping_html(); ?></td>
        </tr>
        <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
    <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
        <tr class="shipping">
            <th class="col-10"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
            <td class="col-2" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
        </tr>
    <?php endif; ?>

    <!-- Fees -->
    <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
        <tr class="fee">
            <th class="col-10"><?php echo esc_html( $fee->name ); ?></th>
            <td class="col-2" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
        </tr>
    <?php endforeach; ?>

    <!-- Taxes -->
    <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
        <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
            <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <th class="col-10"><?php echo esc_html( $tax->label ); ?></th>
                <td class="col-2" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Total -->
    <tr class="order-total">
        <th class="col-10"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
        <td class="col-2" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
    </tr>

</table>


	<div class="wc-proceed-to-checkout">
    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-proceed-checkout">
        <?php esc_html_e( 'Proceder la compra', 'woocommerce' ); ?>
    </a>
</div>


	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>

<style>

.btn-proceed-checkout{
	font-size: 14px;
    color: #ffffff;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    background: #111111;
    border-radius: 0px;
    padding: 15px 20px
}
</style>
