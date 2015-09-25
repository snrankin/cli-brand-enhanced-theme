<?php get_header(); 

$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
$thumb_url = $thumb_url_array[0];
$placeholder_img = get_field('background_image', 10);
?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<header class="post-image-window" style=" background-image: url(<?php if ( has_post_thumbnail() ) { echo $thumb_url; } else { echo $placeholder_img; }  ?>); background-position: 50% 70%; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium'); } ?></header>
<section class="entry-content">
<?php get_template_part( 'entry', 'content' ); ?>
</section>
<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>