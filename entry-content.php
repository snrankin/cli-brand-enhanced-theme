<header class="post-header">
<h1><?php the_title(); ?></h1>
<span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
</header>
<section class="entry-content-inner">
<?php the_content(); ?>
</section>
<?php get_template_part( 'entry-footer' ); ?>