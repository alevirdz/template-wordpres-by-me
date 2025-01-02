<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

?>

<div class="shop-page">
    <header class="page-header">
        <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
        <p class="page-description"><?php echo woocommerce_output_content_wrapper(); ?></p>
    </header>

    <div class="product-grid">
        <?php
        if ( woocommerce_product_loop() ) :
            woocommerce_product_loop_start();

            while ( have_posts() ) :
                the_post();

                // Aquí se puede personalizar el contenido de cada producto
                wc_get_template_part( 'content', 'product' );

            endwhile;

            woocommerce_product_loop_end();
        else :
            echo '<p>No products found</p>';
        endif;
        ?>
    </div>
</div>

<?php
get_footer( 'shop' );
