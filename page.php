<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php get_template_part('templates/page', 'header') ; ?>
    <section class="entry-content">
    <?php if( have_rows('row') ): while( have_rows('row') ): the_row(); ?>
    <?php get_template_part('templates/pagebuilder', 'row') ; ?>
    <?php endwhile; endif; ?>
    </section>
  </article>
<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>