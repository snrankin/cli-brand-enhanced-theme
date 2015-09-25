<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-block'); ?>>
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" <?php if ( has_post_thumbnail() ) { echo 'style="background-image: url(' . $thumb_url . ');"'; } ?>>
<div class="post-block-inner white-txt hvr-sweep-to-top">
  <div class="post-block-title">
    <h3><?php the_title(); ?></h3>
  </div>
  <div class="post-block-date">
    <?php the_time( get_option( 'date_format' ) ); ?>
  </div>
  <div class="post-block-excerpt">
    <?php the_excerpt(); ?>
  </div>
  <div class="post-block-read-more">
    Read More
  </div>
</div>
</a>
</article>