<?php
defined( 'ABSPATH' ) || exit;

get_header();
do_action( 'woocommerce_before_cart' );

if ( WC()->cart->is_empty() ) : ?>
    <div class="alert alert-warning text-center" role="alert">
        <h4 class="alert-heading"><?php esc_html_e( 'Your cart is currently empty.', 'woocommerce' ); ?></h4>
        <p><?php esc_html_e( 'Add some products to your cart before proceeding to checkout.', 'woocommerce' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Go to Shop', 'woocommerce' ); ?></a>
    </div>
<?php else : ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
        <form class="woocommerce-cart-form" id="ajax-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
    <?php do_action( 'woocommerce_before_cart_table' ); ?>

    <table class="table table-striped table-bordered woocommerce-cart-form__contents">
        <thead>
            <tr>
                <th class="product-remove">&nbsp;</th>
                <th class="product-thumbnail">&nbsp;</th>
                <th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                <th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                <th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                <th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product   = $cart_item['data'];
                $product_id = $cart_item['product_id'];

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
                    $product_permalink = $_product->is_visible() ? $_product->get_permalink() : '';
                    ?>
                    <tr>
                        <td class="product-remove">
                            <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" class="remove btn btn-sm btn-danger" title="<?php esc_attr_e( 'Remove this item', 'woocommerce' ); ?>">&times;</a>
                        </td>
                        <td class="product-thumbnail">
                            <?php
                            $thumbnail = $_product->get_image();
                            if ( ! $product_permalink ) {
                                echo $thumbnail;
                            } else {
                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                            }
                            ?>
                        </td>
                        <td class="product-name">
                            <?php
                            if ( ! $product_permalink ) {
                                echo wp_kses_post( $_product->get_name() );
                            } else {
                                echo wp_kses_post( sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ) );
                            }
                            ?>
                        </td>
                        <td class="product-price">
                            <?php echo wc_price( $_product->get_price() ); ?>
                        </td>
                        <td class="product-quantity">
                            <?php
                            // Aquí es donde insertamos el campo de cantidad dinámico
                            $product_quantity = woocommerce_quantity_input( array(
                                'input_name'   => "cart[{$cart_item_key}][qty]", // Nombre del campo de cantidad
                                'input_value'  => $cart_item['quantity'], // Valor actual de la cantidad
                                'max_value'    => $_product->get_max_purchase_quantity(), // Máxima cantidad que se puede comprar
                                'min_value'    => 1, // Mínima cantidad (usualmente 1)
                                'product_name' => $_product->get_name(), // Nombre del producto
                                'input_id'     => 'quantity_' . $cart_item_key, // Id único para cada cantidad
                            ), $_product, false ); // El tercer parámetro `false` evita que se renderice el formulario completo
                            
                            echo $product_quantity; // Mostramos el campo de cantidad
                            ?>
                        </td>
                        <td class="product-subtotal">
                            <?php echo wc_price( WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ) ); ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>

    <div class="text-end">
        <button type="submit" class="btn btn-primary" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update Cart', 'woocommerce' ); ?></button>
    </div>
    <?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

        </div>

        <div class="col-md-4">
            <div class="cart_totals">
                <?php do_action( 'woocommerce_before_cart_totals' ); ?>
                <h2><?php esc_html_e( 'Cart Totals', 'woocommerce' ); ?></h2>
                <table class="table table-striped">
                    <tr>
                        <th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                        <td><?php wc_cart_totals_subtotal_html(); ?></td>
                    </tr>
                    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                        <tr>
                            <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                            <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
                        <td><?php wc_cart_totals_shipping_html(); ?></td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                        <td><?php wc_cart_totals_order_total_html(); ?></td>
                    </tr>
                </table>
                <div class="text-end">
                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-primary btn-lg"><?php esc_html_e( 'Proceed to Checkout', 'woocommerce' ); ?></a>
                </div>
                <?php do_action( 'woocommerce_after_cart_totals' ); ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<?php get_footer(); ?>
