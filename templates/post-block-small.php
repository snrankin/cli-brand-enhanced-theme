<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-block-small'); ?>>
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" >
  <?php if ( has_post_thumbnail() ) { echo '<div class="post-img" style="background-image: url(' . $thumb_url . ');"></div>'; } ?>
<div class="post-block-inner white-txt">
  <div class="entry-meta"><img src="<?php echo get_template_directory_uri()?>/imgs/news-icon.png" alt="News Icon" class="news-icon" /><span class="post-block-date"><?php the_time( get_option( 'date_format' ) ); ?></span></div>
  <div class="post-block-content max-width-col-6">
    <h3 class="post-block-title"><?php the_title(); ?></h3>
    <?php the_excerpt(); ?>
  </div>
</div>
</a>
</article>