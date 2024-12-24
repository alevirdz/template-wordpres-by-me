<?php get_header(); ?>

<div class="single-post">

  <!-- Hero con título y fecha de publicación -->
  <section class="hero bg-single-post text-center py-5 mb-4">
    <div class="container">
      <h1 class="display-4"><?php the_title(); ?></h1>
      <p class="text-muted mt-3">Publicado el: <?php echo get_the_date(); ?></p>
    </div>
  </section>

  <!-- Contenido del post -->
  <div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <!-- Contenido -->
      <div class="post-content">
        <div class="content">
          <?php the_content(); ?>
        </div>
      </div>

    <?php endwhile; else : ?>
      <p class="text-center">No se encontró la publicación.</p>
    <?php endif; ?>
  </div>

</div>

<?php get_footer(); ?>
