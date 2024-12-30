<?php
/**
 * Template Name: Custom Checkout
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header(); // Include the header of the theme

do_action( 'woocommerce_before_checkout_form', WC()->checkout );

// Ensure $checkout is defined
$checkout = WC()->checkout;

if ( ! $checkout ) {
    echo '<div class="alert alert-danger text-center">';
    esc_html_e( 'Checkout is currently unavailable.', 'woocommerce' );
    echo '</div>';
    return;
}

// If the user is not logged in and login is required, display login form
if ( ! is_user_logged_in() ) {
    echo '<div class="alert alert-warning text-center" role="alert">';
    esc_html_e( 'You must be logged in to complete your purchase.', 'woocommerce' );
    echo '</div>';
    wp_login_form( array( 'redirect' => wc_get_checkout_url() ) );
    return;
}
?>


<!-- Breadcrumb Section End -->
<div class="container">
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form name="checkout" method="post" class="checkout woocommerce-checkout"
                    action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
                    <?php wp_nonce_field( 'woocommerce_checkout', 'woocommerce_checkout_nonce' ); ?> <div class="row">
                        <div class="col-lg-8 col-md-6">
                            

                            <h6 class="checkout__title"><?php esc_html_e( 'Billing Details', 'woocommerce' ); ?></h6>



                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                    <?php 
                                                woocommerce_form_field( 'billing_first_name', array(
                                                    'type'        => 'text',
                                                    'label'       => __('First Name', 'woocommerce'),
                                                    'placeholder' => __('Enter your name', 'woocommerce'),
                                                    'class'       => array(''), 
                                                    'required'    => true,
                                                ), $checkout->get_value( 'billing_first_name' ));
                                                ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <?php 
                                                woocommerce_form_field( 'billing_last_name', array(
                                                    'type'        => 'text',
                                                    'label'       => __('Last Name', 'woocommerce'),
                                                    'placeholder' => __('Enter your last name', 'woocommerce'),
                                                    'class'       => array(''), 
                                                    'required'    => true,
                                                ), $checkout->get_value( 'billing_last_name' ));
                                                ?>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <?php woocommerce_form_field( 'billing_country', array( 
                                            'type' => 'country', 
                                            'label' => __('Country', 'woocommerce'),
                                            'required' => true, 
                                            ), $checkout->get_value( 'billing_country' )); ?>
                            </div>
                            <div class="checkout__input">
                                <?php woocommerce_form_field( 'billing_address_1', array( 
                                            'type' => 'text', 
                                            'label' => __('Address', 'woocommerce'), 
                                            'required' => true, 
                                            'placeholder' => 'Street Address' 
                                            ), $checkout->get_value( 'billing_address_1' )); ?>
                                <?php woocommerce_form_field( 'billing_address_2', array( 
                                            'type' => 'text', 
                                            'placeholder' => 'Apartment, suite, unit, etc. (optional)' 
                                            ), $checkout->get_value( 'billing_address_2' )); ?>
                            </div>
                            <div class="checkout__input">
                                <?php woocommerce_form_field( 'billing_city', array( 
                                            'type' => 'text', 
                                            'label' => __('Town/City', 'woocommerce'), 
                                            'required' => true, 
                                            ), $checkout->get_value( 'billing_city' )); ?>
                            </div>
                            <div class="checkout__input">
                                <?php woocommerce_form_field( 'billing_state', array( 
                                            'type' => 'state', 
                                            'label' => __('County/State', 'woocommerce'), 
                                            'required' => true, 
                                            ), $checkout->get_value( 'billing_state' )); ?>
                            </div>
                            <div class="checkout__input">
                                <?php woocommerce_form_field( 'billing_postcode', array( 
                                            'type' => 'text', 
                                            'label' => __('Postcode/ZIP', 'woocommerce'), 
                                            'required' => true, 
                                            ), $checkout->get_value( 'billing_postcode' )); ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <?php woocommerce_form_field( 'billing_phone', array( 
                                                    'type' => 'tel', 
                                                    'label' => __('Phone', 'woocommerce'), 
                                                    'required' => true, ), 
                                                    $checkout->get_value( 'billing_phone' )); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <?php woocommerce_form_field( 'billing_email', array( 
                                                    'type' => 'email', 
                                                    'label' => __('Email', 'woocommerce'), 
                                                    'required' => true, 
                                                    ), $checkout->get_value( 'billing_email' )); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Creación de cuenta para la tienda -->
                            <!-- <div class="checkout__input__checkbox"> <label for="createaccount">
                                    <?php woocommerce_form_field( 'createaccount', array( 
                                                'type' => 'checkbox', 
                                                'label' => __('Create an account?', 'woocommerce'), 
                                                ), $checkout->get_value( 'createaccount' )); ?>
                                    <span class="checkmark"></span> </label>
                                <p><?php esc_html_e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page', 'woocommerce' ); ?>
                                </p>
                            </div> -->                            
                            <!-- <?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
                            <?php if ( ! $checkout->get_value( 'createaccount' ) ) : ?>
                            <div class="checkout__input">
                                <p><?php esc_html_e( 'Account Password', 'woocommerce' ); ?><span>*</span></p>
                                <?php woocommerce_form_field( 'account_password', array( 
                                                'type' => 'password', 
                                                'required' => true, 
                                                ), $checkout->get_value( 'account_password' )); ?>
                            </div>
                            <?php endif; ?> <?php endif; ?>
                            <div class="checkout__input__checkbox">
                                <label for="order_comments">
                                    <?php woocommerce_form_field( 'order_comments', array( 'type' => 'textarea', 'label' => __('Note about your order, e.g., special note for delivery', 'woocommerce'), 'placeholder' => __('Notes about your order, e.g. special notes for delivery.', 'woocommerce') ), $checkout->get_value( 'order_comments' )); ?>
                                    <span class="checkmark"></span> </label>
                            </div> -->
                        </div>
                        <!-- Your ORDER -->
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title"><?php esc_html_e( 'Your Order', 'woocommerce' ); ?>
                                </h4>
                                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?> <div id="order_review"
                                    class="woocommerce-checkout-review-order">
                                    <?php do_action( 'woocommerce_checkout_order_review' ); ?> </div>
                                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?> <div
                                    class="checkout__input__checkbox"> <label for="payment_method">
                                        <?php woocommerce_form_field( 'payment_method', array( 'type' => 'radio', 'label' => __('Check Payment', 'woocommerce'), ), $checkout->get_value( 'payment_method' )); ?>
                                        <span class="checkmark"></span> </label> </div>
                                <div class="checkout__input__checkbox"> <label for="paypal">
                                        <?php woocommerce_form_field( 'payment_method', array( 'type' => 'radio', 'label' => __('Paypal', 'woocommerce'), ), $checkout->get_value( 'payment_method' )); ?>
                                        <span class="checkmark"></span> </label> </div> <button type="submit"
                                    class="site-btn"><?php esc_html_e( 'Place Order', 'woocommerce' ); ?></button>
                            </div>
                        </div>
                    </div>
                </form> <?php 
                do_action( 'woocommerce_after_checkout_form', WC()->checkout ); 
                do_action( 'woocommerce_after_checkout_form', $checkout );
                ?>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkoutForm = document.querySelector('.woocommerce-checkout');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            const inputs = checkoutForm.querySelectorAll('input, select, textarea');
            for (const input of inputs) {
                if (input.required && !input.value.trim()) {
                    alert('<?php esc_html_e( "This field is required.", "woocommerce" ); ?>');
                    e.preventDefault();
                    return;
                }
                if (input.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value)) {
                    alert(
                        '<?php esc_html_e( "Please enter a valid email address.", "woocommerce" ); ?>'
                    );
                    e.preventDefault();
                    return;
                }
            }
        });
    }
});
</script>
<?php
get_footer();
?>


<style>


/*---------------------
  Checkout
-----------------------*/

.coupon__code {
    color: #0d0d0d;
    font-size: 14px;
    border-top: 2px solid #77b527;
    background: #f5f5f5;
    padding: 23px 30px 18px;
    margin-bottom: 50px;
}

.coupon__code span {
    margin-right: 15px;
}

.coupon__code a {
    color: #0d0d0d;
}

.checkout__title {
    color: #111111;
    font-weight: 700;
    text-transform: uppercase;
    border-bottom: 1px solid #e1e1e1;
    padding-bottom: 25px;
    margin-bottom: 30px;
}

.checkout__input {
    margin-bottom: 6px;
}

.checkout__input p {
    color: #111111;
    margin-bottom: 12px;
}

.checkout__input p span {
    color: #e53637;
}

.checkout__input input {
    height: 50px;
    width: 100%;
    border: 1px solid #e1e1e1;
    font-size: 14px;
    color: #b7b7b7;
    padding-left: 20px;
    margin-bottom: 20px;
}

.checkout__input input::-webkit-input-placeholder {
    color: #b7b7b7;
}

.checkout__input input::-moz-placeholder {
    color: #b7b7b7;
}

.checkout__input input:-ms-input-placeholder {
    color: #b7b7b7;
}

.checkout__input input::-ms-input-placeholder {
    color: #b7b7b7;
}

.checkout__input input::placeholder {
    color: #b7b7b7;
}

.checkout__input__checkbox label {
    font-size: 15px;
    color: #0d0d0d;
    position: relative;
    padding-left: 30px;
    cursor: pointer;
    margin-bottom: 16px;
    display: block;
}

.checkout__input__checkbox label input {
    position: absolute;
    visibility: hidden;
}

.checkout__input__checkbox label input:checked~.checkmark {
    border-color: #e53637;
}

.checkout__input__checkbox label input:checked~.checkmark:after {
    opacity: 1;
}

.checkout__input__checkbox label .checkmark {
    position: absolute;
    left: 0;
    top: 3px;
    height: 14px;
    width: 14px;
    border: 1.5px solid #d7d7d7;
    content: "";
    border-radius: 2px;
}

.checkout__input__checkbox label .checkmark:after {
    position: absolute;
    left: 1px;
    top: -3px;
    width: 14px;
    height: 7px;
    border: solid #e53637;
    border-width: 1.5px 1.5px 0px 0px;
    -webkit-transform: rotate(127deg);
    -ms-transform: rotate(127deg);
    transform: rotate(127deg);
    content: "";
    opacity: 0;
}

.checkout__input__checkbox p {
    color: #0d0d0d;
    font-size: 14px;
    line-height: 24px;
    margin-bottom: 22px;
}

.checkout__order {
    background: #f3f2ee;
    padding: 30px;
}

.checkout__order .order__title {
    color: #111111;
    font-weight: 700;
    text-transform: uppercase;
    border-bottom: 1px solid #d7d7d7;
    padding-bottom: 25px;
    margin-bottom: 30px;
}

.checkout__order p {
    color: #444444;
    font-size: 16px;
    line-height: 28px;
}

.checkout__order .site-btn {
    width: 100%;
    margin-top: 8px;
}

.checkout__order__products {
    font-size: 16px;
    color: #111111;
    overflow: hidden;
    margin-bottom: 18px;
}

.checkout__order__products span {
    float: right;
}

.checkout__total__products {
    margin-bottom: 20px;
}

.checkout__total__products li {
    font-size: 16px;
    color: #444444;
    list-style: none;
    line-height: 26px;
    overflow: hidden;
    margin-bottom: 15px;
}

.checkout__total__products li:last-child {
    margin-bottom: 0;
}

.checkout__total__products li span {
    color: #111111;
    float: right;
}

.checkout__total__all {
    border-top: 1px solid #d7d7d7;
    border-bottom: 1px solid #d7d7d7;
    padding: 15px 0;
    margin-bottom: 26px;
}

.checkout__total__all li {
    list-style: none;
    font-size: 16px;
    color: #111111;
    line-height: 40px;
    overflow: hidden;
}

.checkout__total__all li span {
    color: #e53637;
    font-weight: 700;
    float: right;
}






.field-required {
    color: red;
    font-weight: bold;
    font-size: 1.2em;
    margin-left: 2px;
}
</style>