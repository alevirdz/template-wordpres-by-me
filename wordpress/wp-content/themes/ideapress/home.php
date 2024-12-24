<?php
/*
Template Name: Entradas
*/
get_header(); // Carga el encabezado del tema
?>

<section id="posts" class="section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Entradas</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <?php 
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                    ?>
                        <div class="col-md-12 mb-4">
                            <article class="article-height shadow" id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-aos="fade-up" data-aos-delay="100">
                                <div class="inside-article">
                                    <!-- Encabezado con título y enlace -->
                                    <header class="entry-header">
                                        <h2 class="entry-title" itemprop="headline">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                        </h2>
                                        <!-- Metadatos de la entrada (fecha y autor) -->
                                        <div class="entry-meta">
                                            <span class="posted-on">
                                                <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                                                    <?php echo get_the_date(); ?>
                                                </time>
                                            </span>
                                            <span class="byline">por
                                                <span class="author vcard" itemprop="author" itemtype="https://schema.org/Person" itemscope="">
                                                    <a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="Ver todas las entradas de <?php the_author(); ?>" rel="author" itemprop="url">
                                                        <span class="author-name" itemprop="name"><?php the_author(); ?></span>
                                                    </a>
                                                </span>
                                            </span>
                                        </div>
                                    </header>

                                    <!-- Resumen del contenido -->
                                    <div class="entry-summary" itemprop="text">
                                        <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                        <a title="Leer más sobre <?php the_title(); ?>" class="read-more" href="<?php the_permalink(); ?>" aria-label="Leer más sobre <?php the_title(); ?>">Leer más</a>
                                    </div>

                                    <!-- Metadatos de categoría y comentarios -->
                                    <footer class="entry-meta" aria-label="Meta de entradas">
                                        <!-- Categorías -->
                                        <span class="cat-links">
                                            <span class="gp-icon icon-categories">
                                                <svg viewBox="0 0 512 512" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
                                                    <path d="M0 112c0-26.51 21.49-48 48-48h110.014a48 48 0 0143.592 27.907l12.349 26.791A16 16 0 00228.486 128H464c26.51 0 48 21.49 48 48v224c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V112z"></path>
                                                </svg>
                                            </span>
                                            <span class="screen-reader-text">Categorías: </span>
                                            <?php
                                                $categories = get_the_category();
                                                $category_links = array();
                                                foreach ($categories as $category) {
                                                    $category_links[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '" rel="category tag">' . esc_html($category->name) . '</a>';
                                                }
                                                echo implode(', ', $category_links); // Muestra todas las categorías separadas por comas
                                            ?>
                                        </span>

                                        <!-- Comentarios -->
                                        <span class="comments-link">
                                            <span class="gp-icon icon-comments">
                                                <svg viewBox="0 0 512 512" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
                                                    <path d="M132.838 329.973a435.298 435.298 0 0016.769-9.004c13.363-7.574 26.587-16.142 37.419-25.507 7.544.597 15.27.925 23.098.925 54.905 0 105.634-15.311 143.285-41.28 23.728-16.365 43.115-37.692 54.155-62.645 54.739 22.205 91.498 63.272 91.498 110.286 0 42.186-29.558 79.498-75.09 102.828 23.46 49.216 75.09 101.709 75.09 101.709s-115.837-38.35-154.424-78.46c-9.956 1.12-20.297 1.758-30.793 1.758-88.727 0-162.927-43.071-181.007-100.61z"></path>
                                                    <path d="M383.371 132.502c0 70.603-82.961 127.787-185.216 127.787-10.496 0-20.837-.639-30.793-1.757-38.587 40.093-154.424 78.429-154.424 78.429s51.63-52.472 75.09-101.67c-45.532-23.321-75.09-60.619-75.09-102.79C12.938 61.9 95.9 4.716 198.155 4.716 300.41 4.715 383.37 61.9 383.37 132.502z"></path>
                                                </svg>
                                            </span>
                                            <a href="<?php comments_link(); ?>">Deja un comentario</a>
                                        </span>
                                    </footer>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; else : ?>
                        <p>No hay publicaciones disponibles.</p>
                    <?php endif; ?>
                </div>

<!-- Paginación -->
<div class="pagination-wrapper mt-4 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
    <?php 
    echo paginate_links(array(
        'prev_text' => '<span class="pagination-arrow">&laquo;</span> Anterior', // Ícono de flecha
        'next_text' => 'Siguiente <span class="pagination-arrow">&raquo;</span>', // Ícono de flecha
        'type' => 'list', // Tipo de lista para mayor control de estilo
        'before_page_number' => '<span class="page-number">', // Estilo para los números de página
        'after_page_number' => '</span>',
        'end_size' => 2, // Para mostrar siempre las primeras y últimas páginas
        'mid_size' => 2, // Páginas cercanas a la actual
    ));
    ?>
</div>


            </div>

            <div class="col-4" data-aos="fade-up" data-aos-delay="100">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); // Carga el pie de página del tema ?>
