<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header();
do_action( 'woocommerce_before_cart' );


if ( WC()->cart->is_empty() ) : ?>
<div class="alert alert-warning text-center" role="alert">
    <h4 class="alert-heading"><?php esc_html_e( 'Your cart is currently empty.', 'woocommerce' ); ?></h4>
    <p><?php esc_html_e( 'Add some products to your cart before proceeding to checkout.', 'woocommerce' ); ?></p>
    <a href="<?php echo esc_url( home_url( '/tienda/' ) ); ?>"
        class="btn btn-primary"><?php esc_html_e( 'Go to Shop', 'woocommerce' ); ?></a>
</div>
<?php else : ?>



<div class="container">
    <div class="proceed-checkout mt-5 mb-5">
    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php do_action( 'woocommerce_before_cart_table' ); ?>

            <div class="row">
                <!-- Sección de los ítems del carrito -->
                <div class="col-12 col-md-8">
                    <div class="shopping__cart__table">
                        <table class="table-responsive woocommerce-cart-form__contents">
                            <thead>
                                <tr>

                                    <th class="product-thumbnail"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                                    <th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                                    <th class="product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                                    <th class="product-remove"><?php esc_html_e( '', 'woocommerce' ); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                                <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                                <tr
                                    class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                    <td class="product-thumbnail text-center">
                                    <div class="row">
                                        <!-- Columna para la imagen -->
                                        <div class="col-4">
                                            <?php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                            if ( ! $product_permalink ) {
                                                echo str_replace( '<img', '<img width="100" height="100"', $thumbnail );
                                            } else {
                                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), str_replace( '<img', '<img width="100" height="100"', $thumbnail ) );
                                            }
                                            ?>
                                        </div>

                                        <!-- Columna para el nombre y el precio -->
                                        <div class="col-8">
                                            <!-- Nombre del producto -->
                                            <div class="product-name">
                                                <?php
                                                if ( ! $product_permalink ) {
                                                    echo wp_kses_post( $product_name . '&nbsp;' );
                                                } else {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                }
                                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                                                echo wc_get_formatted_cart_item_data( $cart_item );

                                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                }
                                                ?>
                                            </div>

                                            <!-- Precio del producto -->
                                            <div class="product-price">
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    </td>


                                    <td class="product-quantity"
                                        data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                        <?php
                                    if ( $_product->is_sold_individually() ) {
                                        $min_quantity = 1;
                                        $max_quantity = 1;
                                    } else {
                                        $min_quantity = 0;
                                        $max_quantity = $_product->get_max_purchase_quantity();
                                    }

                                    $product_quantity = woocommerce_quantity_input(
                                        array(
                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                            'input_value'  => $cart_item['quantity'],
                                            'max_value'    => $max_quantity,
                                            'min_value'    => $min_quantity,
                                            'product_name' => $product_name,
                                        ),
                                        $_product,
                                        false
                                    );

                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                    ?>
                                    </td>

                                    <td class="product-subtotal text-right"
                                        data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                        <?php
                                        echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                                    ?>
                                    </td>




                                    <td class="product-remove text-center">
                                    <?php
                                        echo apply_filters( 'woocommerce_cart_item_remove_link',
                                            sprintf(
                                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                                    <i class="product-remove-icon fa fa-close" aria-hidden="true"></i>
                                                </a>',
                                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                                esc_attr( $product_id ),
                                                esc_attr( $_product->get_sku() )
                                            ),
                                            $cart_item_key
                                        );
                                        ?>
                                    </td>
                                </tr>
                                <?php
                        }
                    }
                    ?>

                                <?php do_action( 'woocommerce_cart_contents' ); ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                 <!-- Total para ir a pagar -->
                <div class="col-12 col-md-4">
                <div class="coupon-section">
                    
                    <?php if ( wc_coupons_enabled() ) { ?>
                        <div class="button-container">
                            <div class="coupon">
                                <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> 
                                <input type="text" name="coupon_code" class="cart__discount input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
                                <button type="submit" class="cart__btn-theme button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
                                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                            </div>
                        </div>
					<?php } ?>
                </div>

                    <div class="cart__total">
                        <?php
                            do_action( 'woocommerce_cart_collaterals' );
                        ?>
                    </div>
                </div>
            </div>
                <!-- Botónes para actualizar o ir a la tienda -->
            <div class="row">
                <div class="col-6">
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-continue-shopping">
                            <?php esc_html_e( 'Go to Store', 'woocommerce' ); ?>
                        </a>
                </div>
                <div class="col-6">
                    <div class="actions text-right">
                        <!-- Botón para actualizar el carrito -->
                        <button type="submit" class="btn btn-update-cart" name="update_cart"
                            value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                    </div>
                </div>
            </div>

          

            <?php do_action( 'woocommerce_after_cart_table' ); ?>
        </form>
    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>

<?php endif; ?>

<?php get_footer(); ?>


<style>

/*---------------------
  Shopping Cart
-----------------------*/

.shopping__cart__table {
	margin-bottom: 30px;
}

.shopping__cart__table table {
	width: 100%;
}

.shopping__cart__table table thead {
	border-bottom: 1px solid #f2f2f2;
}

.shopping__cart__table table thead tr th {
	color: #111111;
	font-size: 16px;
	font-weight: 700;
	text-transform: uppercase;
	padding-bottom: 25px;
}

.shopping__cart__table table tbody tr {
	border-bottom: 1px solid #f2f2f2;
}

.shopping__cart__table table tbody tr td {
	padding-bottom: 30px;
	padding-top: 30px;
}

.shopping__cart__table table tbody tr td.product__cart__item {
	width: 400px;
}

.shopping__cart__table table tbody tr td.product__cart__item .product__cart__item__pic {
	float: left;
	margin-right: 30px;
}

.shopping__cart__table table tbody tr td.product__cart__item .product__cart__item__text {
	overflow: hidden;
	padding-top: 21px;
}

.shopping__cart__table table tbody tr td.product__cart__item .product__cart__item__text h6 {
	color: #111111;
	font-size: 15px;
	font-weight: 600;
	margin-bottom: 10px;
}

.shopping__cart__table table tbody tr td.product__cart__item .product__cart__item__text h5 {
	color: #0d0d0d;
	font-weight: 700;
}

.shopping__cart__table table tbody tr td.quantity__item {
	width: 175px;
}

.shopping__cart__table table tbody tr td.quantity__item .quantity .pro-qty-2 {
	width: 80px;
}

.shopping__cart__table table tbody tr td.quantity__item .quantity .pro-qty-2 input {
	width: 50px;
	border: none;
	text-align: center;
	color: #111111;
	font-size: 16px;
}

.shopping__cart__table table tbody tr td.quantity__item .quantity .pro-qty-2 .qtybtn {
	font-size: 16px;
	color: #888888;
	width: 10px;
	cursor: pointer;
}

.shopping__cart__table table tbody tr td.cart__price {
	color: #111111;
	font-size: 18px;
	font-weight: 700;
	width: 140px;
}

.shopping__cart__table table tbody tr td.cart__close i {
	font-size: 18px;
	color: #111111;
	height: 40px;
	width: 40px;
	background: #f3f2ee;
	border-radius: 50%;
	line-height: 40px;
	text-align: center;
}




.cart__total{
    background: #f3f2ee;
    padding: 35px 40px 40px;
}
.checkout-pay{
    padding-top: 100px;
}
.button-coupon {
    font-size: 14px;
    color: #ffffff;
    font-weight: 700;
    text-transform: uppercase;
    background: #111111;
    padding: 0 30px;
    border: none;
    height: 100%;
}
.btn-theme {
    font-size: 14px;
    text-transform: uppercase;
    border: none;
    border-radius: 0px;
    color:  #ffffff;
    background: #111111;
    background: #111111;
}

input.cart__discount{
    font-size: 14px;
    color: #b7b7b7;
    height: 50px;
    width: 55%;
    border: 1px solid #e1e1e1;
    padding-left: 20px; 
}
.button-container {
    position: relative;
    width: 100%;
    height: 75px; 
}
.cart__btn-theme{
    font-size: 14px;
    color: #ffffff;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    background: #111111;
    /* padding: 0 30px; */
    border: none;
    position: absolute;
    right: 22px;
    top: 0px;
    height: 66%;
}
.product-remove-icon{
    font-size: 18px;
    color: #111111;
    height: 40px;
    width: 40px;
    background: #f3f2ee;
    border-radius: 50%;
    line-height: 40px;
    text-align: center;
}
.btn-continue-shopping{
    font-size: 14px;
    color: #111111;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    background: #ffffff;
    border: 1px solid #e1e1e1;
    border-radius: 0px;
    padding: 15px 75px
}
.btn-update-cart {
    font-size: 14px;
    color: #ffffff;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    background: #111111;
    border-radius: 0px;
    padding: 15px 20px
}
    /*---------------------
  Breadcrumb
-----------------------*/

.breadcrumb-option {
    background: #f3f2ee;
    padding: 40px 0;
}

.breadcrumb__text h4 {
    color: #111111;
    font-weight: 700;
    margin-bottom: 8px;
}

.breadcrumb__links a {
    font-size: 15px;
    color: #111111;
    margin-right: 18px;
    display: inline-block;
    position: relative;
}

.breadcrumb__links a:after {
    position: absolute;
    right: -14px;
    top: 0;
    content: "";
    font-family: "FontAwesome";
}

.breadcrumb__links span {
    font-size: 15px;
    color: #b7b7b7;
    display: inline-block;
}
</style>