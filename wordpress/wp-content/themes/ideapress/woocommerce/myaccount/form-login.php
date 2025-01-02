<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="login-container">

	<!-- Formulario de Login -->
	<div class="login-form-container">
		<div class="login-form-wrapper">
			<h2 class="login-title">Login</h2>
			<p class="login-subtitle">How to get started lorem ipsum dolor at?</p>

			<form class="woocommerce-form woocommerce-form-login login" method="post">
				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<div class="form-group">
					<label for="username" class="form-label"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<div class="form-input-wrapper">
						<span class="input-icon">&#xf007;</span>
						<input type="text" class="input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required />
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="form-label"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<div class="form-input-wrapper">
						<span class="input-icon">&#xf023;</span>
						<input type="password" class="input-text" name="password" id="password" autocomplete="current-password" required />
					</div>
				</div>

				<?php do_action( 'woocommerce_login_form' ); ?>
				<div class="form-group">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
						<span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<button type="submit" class="woocommerce-button button login-button" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
						<?php esc_html_e( 'Login Now', 'woocommerce' ); ?>
					</button>
					<!-- <button type="submit" class="button login-button" name="login" value="Log in">Login Now</button> -->
				</div>

				<p class="lost-password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">
						<?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?>
					</a>
				</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>
			</form>
		</div>
	</div>

	<!-- Imagen -->
	<div class="login-image-container">
		<img src="https://via.placeholder.com/500x600" alt="Login Image">
	</div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

<style>
/* Contenedor principal */
.login-container {
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100vh;
	background-color: #f7f4ff;
	padding: 20px;
	box-sizing: border-box;
	flex-wrap: wrap;
}

/* Formulario */
.login-form-container {
	flex: 1;
	max-width: 480px;
	background: #fff;
	border-radius: 12px;
	box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
	padding: 40px;
	box-sizing: border-box;
}

.login-title {
	font-size: 28px;
	font-weight: 600;
	color: #333;
	margin-bottom: 10px;
	text-align: center;
}

.login-subtitle {
	font-size: 14px;
	color: #666;
	margin-bottom: 30px;
	text-align: center;
}

.form-group {
	margin-bottom: 20px;
}

.form-label {
	font-size: 14px;
	color: #333;
	margin-bottom: 5px;
	display: block;
}

.form-input-wrapper {
	position: relative;
}

.input-icon {
	position: absolute;
	top: 50%;
	left: 10px;
	transform: translateY(-50%);
	font-family: 'FontAwesome';
	font-size: 14px;
	color: #999;
}

.input-text {
	width: 100%;
	padding: 10px 10px 10px 35px;
	border: 1px solid #ddd;
	border-radius: 8px;
	font-size: 14px;
	box-sizing: border-box;
}

.login-button {
	width: 100%;
	padding: 10px;
	background-color: #6c5ce7;
	color: #fff;
	border: none;
	border-radius: 8px;
	font-size: 16px;
	cursor: pointer;
	transition: background-color 0.3s;
}

.login-button:hover {
	background-color: #5a49d6;
}

.login-alt {
	font-size: 14px;
	color: #666;
	margin: 20px 0;
	text-align: center;
}

.social-login .button {
	width: 100%;
	padding: 10px;
	border: none;
	border-radius: 8px;
	font-size: 14px;
	margin-bottom: 10px;
	cursor: pointer;
}

.google-login {
	background-color: #db4437;
	color: #fff;
}

.facebook-login {
	background-color: #4267B2;
	color: #fff;
}

.lost-password {
	text-align: center;
	margin-top: 10px;
}

.lost-password a {
	color: #6c5ce7;
	text-decoration: none;
}

.lost-password a:hover {
	text-decoration: underline;
}

/* Imagen */
.login-image-container {
	flex: 1;
	max-width: 600px;
	display: flex;
	justify-content: center;
	align-items: center;
}

.login-image-container img {
	max-width: 100%;
	height: auto;
	border-radius: 12px;
}

/* Responsive */
@media (max-width: 768px) {
	.login-container {
		flex-direction: column;
	}

	.login-form-container {
		margin-bottom: 20px;
	}
}
</style>
