<?php
defined( 'ABSPATH' ) || exit;

// Verificar si los cupones están habilitados en WooCommerce
if ( ! wc_coupons_enabled() ) { 
    return;
}

// Mostrar mensajes de error o éxito relacionados con el cupón
// if ( WC()->cart->has_discount() ) {
//     wc_print_notice( __( 'Coupon applied successfully!', 'woocommerce' ), 'success' );
// }

// Mostrar un mensaje si el cupón no es válido
// if ( isset( $_GET['coupon_error'] ) && $_GET['coupon_error'] == 'invalid' ) {
//     wc_print_notice( __( 'The coupon code you entered is invalid.', 'woocommerce' ), 'error' );
// }
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="woocommerce-breadcrumb">
                        <?php woocommerce_breadcrumb(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="custom-coupon">
    <h6 class="coupon__header">
        <span class="dashicons dashicons-tag"></span>
        <?php esc_html_e( 'Have a coupon?', 'woocommerce' ); ?>
    </h6>
    <div class="coupon__form" id="coupon_form" style="display: none;">
        <form method="post" class="woocommerce-form woocommerce-form-coupon" action="">
            <p>
                <?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?>
            </p>
            <p class="form-row form-row-first">
                <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
            </p>
            <p class="form-row form-row-last">
                <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
                    <?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?>
                </button>
            </p>
            <div class="clear"></div>
        </form>
    </div>

    <button id="show_coupon_button" class="button" onclick="toggleCouponForm()">
        <?php esc_html_e( 'Add Coupon', 'woocommerce' ); ?>
    </button>
</div>

<style>
    .custom-coupon {
        border: 2px dashed #77b527;
        background: #f9f9f9;
        padding: 20px;
        margin-bottom: 30px;
        text-align: center;
        border-radius: 8px;
    }

    .coupon__header {
        font-size: 16px;
        font-weight: bold;
        color: #111;
        margin-bottom: 10px;
    }

    .coupon__header span {
        color: #77b527;
        font-size: 20px;
        margin-right: 10px;
        vertical-align: middle;
    }

    .coupon__form {
        margin-top: 15px;
    }

    .woocommerce-form-coupon input {
        width: 70%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .woocommerce-form-coupon .button {
        background-color: #77b527;
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
    }

    .woocommerce-form-coupon .button:hover {
        background-color: #5a8d20;
    }

    #show_coupon_button {
        background-color: #77b527;
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    #show_coupon_button:hover {
        background-color: #5a8d20;
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

<script>
    // Función para alternar la visibilidad del formulario de cupón
    const toggleCouponForm = () => {
        const couponForm = document.getElementById('coupon_form');
        const showButton = document.getElementById('show_coupon_button');
        
        // Alterna la visibilidad del formulario y cambia el texto del botón
        if (couponForm.style.display === "none") {
            couponForm.style.display = "block";
            showButton.textContent = "<?php esc_html_e( 'Hide Coupon', 'woocommerce' ); ?>"; // Cambia el texto del botón
        } else {
            couponForm.style.display = "none";
            showButton.textContent = "<?php esc_html_e( 'Add Coupon', 'woocommerce' ); ?>"; // Cambia el texto del botón
        }
    }
</script>
