<?php 

  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
              
  $link = get_sub_field('link', $item_id);
  $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
  $text = (get_sub_field('text', $item_id)) ? get_sub_field('text', $item_id) : '';
  $text_color = (get_sub_field('text_color', $item_id)) ? ' color: ' . get_sub_field('text_color', $item_id) . '; ' : '';
  $border_color = (get_sub_field('border_color', $item_id)) ? ' border-color: ' . get_sub_field('border_color', $item_id) . '; ' : '';
  $background_color = (get_sub_field('background_color', $item_id)) ? ' background-color: ' . get_sub_field('background_color', $item_id) . '; ' : '';
  
  $styles = ($text_color || $border_color || $background_color) ? 'style=" ' . $text_color . $border_color . $background_color . '"' : '';
  
 
 ?>
<a class="btn <?php echo $custom_class; ?>" href="<?php echo $link; ?>" <?php echo $styles; ?>><?php echo $text; ?></a>