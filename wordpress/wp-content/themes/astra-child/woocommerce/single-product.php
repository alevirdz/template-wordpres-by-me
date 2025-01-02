<?php
/**
 * The Template for displaying all single product pages
 *
 * @package WooCommerce/Templates
 * @version 7.0.0
 */

defined( 'ABSPATH' ) || exit; // Evita el acceso directo

get_header( 'shop' ); // Cargar el encabezado específico de WooCommerce

// Verificar si hay productos
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();

        // Obtener el objeto del producto
        global $product;
        ?>

        <div class="container py-5 product-page">
            <div class="row">
                <!-- Sección de la galería de imágenes -->
                <div class="col-md-6">
                    <div class="product-gallery">
                        <?php
                        // Mostrar la imagen principal del producto
                        if ( has_post_thumbnail() ) {
                            echo '<div class="product-main-image mb-4">';
                            the_post_thumbnail( 'large', ['class' => 'img-fluid rounded shadow-sm main-image', 'id' => 'zoom-main'] ); // Imagen principal con id para el zoom
                            echo '</div>';
                        }
                        ?>

                        <!-- Miniaturas de imágenes adicionales -->
                        <div class="product-thumbnails d-flex justify-content-start gap-3">
                            <?php
                            $attachment_ids = $product->get_gallery_image_ids();
                            if ( $attachment_ids ) {
                                foreach ( $attachment_ids as $attachment_id ) {
                                    echo '<div class="product-thumbnail">';
                                    echo wp_get_attachment_image( $attachment_id, 'thumbnail', false, ['class' => 'img-fluid rounded cursor-pointer thumbnail-image'] );
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Sección de detalles del producto -->
                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title display-4 mb-3"><?php the_title(); ?></h1>
                        <p class="product-price text-danger h3"><?php echo $product->get_price_html(); ?></p>

                        <div class="product-description my-4">
                            <h2 class="h5">Descripción</h2>
                            <?php the_content(); ?>
                        </div>

                        <div class="product-meta">
                            <p class="product-sku mb-1"><strong>SKU:</strong> <?php echo $product->get_sku(); ?></p>
                            <p class="product-category mb-1"><strong>Categoría:</strong> <?php echo wc_get_product_category_list( $product->get_id() ); ?></p>
                        </div>

                        <!-- Botón de añadir al carrito -->
                        <div class="product-action mt-4">
                            <?php 
                            // Verificar si el producto es comprable
                            if ( $product->is_in_stock() && $product->is_purchasable() ) {
                                woocommerce_template_single_add_to_cart(); 
                            } else {
                                echo '<p class="text-danger">Este producto no está disponible para su compra.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estilos y Scripts para Zoom -->
        <style>
            /* Personalización del estilo para el contenido del producto */
            .product-page .product-gallery .product-main-image {
                max-height: 500px;
                object-fit: cover;
            }

            .product-page .product-thumbnail:hover {
                transform: scale(1.1);
                transition: transform 0.3s ease-in-out;
            }

            /* Ajustes generales para el contenido */
            .product-title {
                font-size: 2.5rem;
                font-weight: bold;
            }

            .product-price {
                color: #e74c3c;
                font-weight: bold;
            }

            .product-description {
                font-size: 1rem;
                color: #555;
            }

            .product-meta {
                font-size: 1rem;
                color: #777;
            }

            .product-action button.single_add_to_cart_button {
                background-color: #e74c3c;
                color: white;
                padding: 12px 25px;
                border: none;
                font-size: 1.1rem;
                font-weight: bold;
                cursor: pointer;
                border-radius: 5px;
                transition: background-color 0.3s ease-in-out;
            }

            .product-action button.single_add_to_cart_button:hover {
                background-color: #c0392b;
            }
        </style>

        <!-- Scripts para el Zoom y Galería -->
        <script src="https://cdn.rawgit.com/elevateweb/elevatezoom/master/jquery.elevateZoom.min.js"></script>
        <script>
            jQuery(document).ready(function($) {
                // Activar el zoom en la imagen principal solo dentro de la página de producto
                $(".product-page #zoom-main").elevateZoom({
                    zoomType: "lens", 
                    lensShape: "round", 
                    lensSize: 200
                });

                // Cambiar la imagen principal cuando se hace clic en las miniaturas
                $(".product-page .thumbnail-image").click(function() {
                    var newSrc = $(this).attr('src');
                    $('#zoom-main').attr('src', newSrc);
                    $('#zoom-main').data('zoom-image', newSrc);
                });
            });
        </script>

        <?php
    endwhile;
endif;

get_footer( 'shop' ); // Cargar el pie de página específico de WooCommerce
