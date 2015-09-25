<?php get_header(); 
$page_for_posts = get_option( 'page_for_posts' ); 
?>
<section id="content" role="main">
  <?php get_template_part('templates/page', 'header') ; ?>
  <section class="entry-content">
    <?php if( have_rows('row', $page_for_posts) ): while( have_rows('row', $page_for_posts) ): the_row(); ?>
    <?php get_template_part('templates/pagebuilder', 'row') ; ?>
    <?php endwhile; endif; ?>
  </section>
  <section class="entry-content news-feed">
    <div class="news-feed-inner">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'templates/post-block-small' ); ?>
      <?php endwhile; endif; ?>
    </div>
  </section>
</section>
<?php get_footer(); ?>