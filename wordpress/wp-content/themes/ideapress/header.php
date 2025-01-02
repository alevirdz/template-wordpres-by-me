<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body <?php body_class(); ?>>

<header class="bg-light">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid inside-header">
                <?php
                $logo_url = get_theme_mod('ideapress_logo');
                if ($logo_url) : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                        <img class="custom-logo" src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                    </a>
                <?php else : ?>
                    <h1>
                        <a class="navbar-brand site-title" href="<?php echo esc_url(home_url('/')); ?>">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php endif; ?>
                
                <!-- Toggler Button for mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Navbar Links -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'navbar-nav',
                            'walker' => new WP_Bootstrap_Navwalker(),
                        ));
                    } else {
                        echo 'No se ha asignado un menú a la ubicación "Primary Menu".';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- Breadcrumb Section Begin -->
<?php
if ( is_shop() || is_product() || is_cart() || is_checkout() ) : ?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4><?php if ( is_shop() ) {
                            echo esc_html( 'Shop' ); // Página de la tienda
                        } elseif ( is_cart() ) {
                            echo esc_html( 'Cart' ); // Página del carrito
                        } elseif ( is_checkout() ) {
                            echo esc_html( 'Checkout' ); // Página de pago
                        } elseif ( is_product() ) {
                            // Si estamos en una página de producto individual
                            echo get_the_title();
                        } elseif ( is_account_page() ) {
                            echo esc_html( 'My Account' ); // Página de la cuenta
                        } elseif ( is_tax() ) {
                            // Si estamos en una página de categoría o etiquetas
                            single_term_title();
                        } else {
                            // Obtener el título de la página actual si no es ninguna de las anteriores
                            echo get_the_title();
                        }
                        ?></h4>
                    <div class="woocommerce-breadcrumb">
                        <?php woocommerce_breadcrumb(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>




