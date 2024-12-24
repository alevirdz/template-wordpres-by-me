<?php get_header(); ?>

<div class="blog-archive py-5">
  <div class="container">
    <!-- Título de la sección -->
    <div class="text-center mb-5">
      <h1 class="display-4">Blog</h1>
      <p class="text-muted">Explora nuestras últimas publicaciones</p>
    </div>

    <!-- Listado de posts -->
    <div class="row">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <!-- Imagen destacada -->
            <?php if (has_post_thumbnail()) : ?>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
              </a>
            <?php endif; ?>

            <div class="card-body">
              <!-- Título del post -->
              <h5 class="card-title">
                <a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a>
              </h5>
              <!-- Meta (Fecha) -->
              <p class="card-text text-muted">Publicado el: <?php echo get_the_date(); ?></p>
              <!-- Extracto -->
              <p class="card-text"><?php echo get_the_excerpt(); ?></p>
            </div>

            <div class="card-footer text-center">
              <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Leer más</a>
            </div>
          </div>
        </div>
      <?php endwhile; else : ?>
        <div class="col-12">
          <p class="text-center">No se encontraron publicaciones.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- Paginación -->
    <div class="pagination mt-5">
      <?php
        the_posts_pagination(array(
          'prev_text' => __('&laquo; Anterior'),
          'next_text' => __('Siguiente &raquo;'),
          'mid_size'  => 2,
        ));
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
