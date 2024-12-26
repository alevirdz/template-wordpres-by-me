<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
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
                    <h1 ">
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



