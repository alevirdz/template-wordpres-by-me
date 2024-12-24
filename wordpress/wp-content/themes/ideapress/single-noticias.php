<?php get_header(); ?>

<div class="container single-noticias">
  <h1>Noticias Destacadas</h1>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h2 class="post-title"><?php the_title(); ?></h2>
      <div class="post-content">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
