<?php 

  $page_for_posts = get_option( 'page_for_posts' );  
  $postid = get_the_ID();
  
  $item_id = (is_blog()) ? $page_for_posts : $postid;
              
  $link = get_sub_field('link', $item_id);
  $custom_class = (get_sub_field('custom_class', $item_id)) ? ' ' . get_sub_field('custom_class', $item_id) : '';
  $first_panel_text = (get_sub_field('first_panel_text', $item_id)) ? get_sub_field('first_panel_text', $item_id) : '';
  $first_panel_text_color = (get_sub_field('first_panel_text_color', $item_id)) ? ' color: ' . get_sub_field('first_panel_text_color', $item_id) . '; ' : '';
  $first_panel_border_color = (get_sub_field('first_panel_border_color', $item_id)) ? ' border-color: ' . get_sub_field('first_panel_border_color', $item_id) . '; ' : '';
  $first_panel_background_color = (get_sub_field('first_panel_background_color', $item_id)) ? ' background-color: ' . get_sub_field('first_panel_background_color', $item_id) . '; ' : '';
  $second_panel_text = (get_sub_field('second_panel_text', $item_id)) ? get_sub_field('second_panel_text', $item_id) : '';
  $second_panel_text_color = (get_sub_field('second_panel_text_color', $item_id)) ? ' color: ' . get_sub_field('second_panel_text_color', $item_id) . '; ' : '';
  $second_panel_border_color = (get_sub_field('second_panel_border_color', $item_id)) ? ' border-color: ' . get_sub_field('second_panel_border_color', $item_id) . '; ' : '';
  $second_panel_background_color = (get_sub_field('second_panel_background_color', $item_id)) ? ' background-color: ' . get_sub_field('second_panel_background_color', $item_id) . '; ' : '';
  
  $first_panel_styles = ($first_panel_text_color || $first_panel_border_color || $first_panel_background_color) ? 'style=" ' . $first_panel_text_color . $first_panel_border_color . $first_panel_background_color . '"' : '';
  
  $second_panel_styles = ($second_panel_text_color || $second_panel_border_color || $second_panel_background_color) ? 'style=" ' . $second_panel_text_color . $second_panel_border_color . $second_panel_background_color . '"' : '';
 
 ?>
<a class="special-btn <?php echo $custom_class; ?>" href="<?php echo $link; ?>">
  <div class="first-panel panel">
    <div class="panel-inner" <?php echo $first_panel_styles; ?>>
      <?php echo $first_panel_text; ?>
    </div>
  </div>
  <div class="second-panel panel">
    <div class="panel-inner" <?php echo $second_panel_styles; ?>>
    <?php echo $second_panel_text; ?>
    </div>
  </div>
</a>