<?php 
  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
              
  $image = get_sub_field('single_image', $item_id);
  $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
  $title_position = (get_sub_field('title_position', $item_id)) ? get_sub_field('title_position', $item_id) : '';
  $display_title = (get_sub_field('display_title', $item_id) == 1) ? '<div class="single-image-title">' . $image['title'] . '</div>' : '';
  $width = (get_sub_field('single_image_size', $item_id)) ? ' width="' . get_sub_field('single_image_size', $item_id) . '"' : '';
  
  $layout_classes = 'class="single-image-wrapper ' . $title_position . $custom_class . '"';
 
 ?>
<div <?php echo $layout_classes; ?>>
  <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" <?php echo $width; ?> style="height: auto;" class="single-image" />
  <?php echo $display_title ?>
</div>