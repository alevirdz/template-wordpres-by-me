<?php get_header(); ?>

<section id="search-results" class="search-results section py-5">
    <div class="container">
        <!-- Título de la sección -->
        <div class="section-title text-center mb-4" data-aos="fade-up">
            <h2>Resultados de Búsqueda</h2>
        </div>

        <!-- Contenido de resultados -->
        <div class="row">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-6 mb-4">
                        <article class="search-result-height-card search-results shadow p-4 h-100" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="search-result-inside-article">
                                <!-- Encabezado con título y enlace -->
                                <header class="entry-header mb-3">
                                    <h2 class="entry-title h5">
                                        <a class="search-result-title" href="<?php the_permalink(); ?>" rel="bookmark" class="text-primary text-decoration-none"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="entry-meta text-muted small">
                                        <span class="posted-on">
                                            <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                                                <?php echo get_the_date(); ?>
                                            </time>
                                        </span>
                                        <span class="byline ms-2">por 
                                            <a class="text-muted" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="Ver todas las entradas de <?php the_author(); ?>" rel="author">
                                                <?php the_author(); ?>
                                            </a>
                                        </span>
                                    </div>
                                </header>

                                <!-- Resumen del contenido -->
                                <div class="entry-summary mb-3" itemprop="text">
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                </div>

                                <!-- Metadatos de categoría y comentarios -->
                                <footer class="entry-meta mt-3 text-muted small">
                                    <span class="cat-links">
                                        <strong>Categorías:</strong> 
                                        <?php
                                            $categories = get_the_category();
                                            if ($categories) {
                                                $category_links = array_map(function ($category) {
                                                    return '<a href="' . esc_url(get_category_link($category->term_id)) . '" rel="category tag">' . esc_html($category->name) . '</a>';
                                                }, $categories);
                                                echo implode(', ', $category_links);
                                            }
                                        ?>
                                    </span>
                                    <span class="comments-link ms-3">
                                        <strong>Comentarios:</strong> 
                                        <a href="<?php comments_link(); ?>" aria-label="Ver comentarios de <?php the_title(); ?>"><?php comments_number('Sin comentarios', '1 comentario', '% comentarios'); ?></a>
                                    </span>
                                </footer>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <!-- Mensaje si no hay resultados -->
                <div class="alert alert-warning text-center col-12">
                    <p>No se encontraron resultados para tu búsqueda.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Volver al inicio</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
