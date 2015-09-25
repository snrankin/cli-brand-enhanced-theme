<?php
//Variables

$page_for_posts = get_option( 'page_for_posts' );  
$postid = get_the_ID();

$item_id = (is_blog()) ? $page_for_posts : $postid;

$col_custom_class = get_sub_field('column_custom_class', $item_id) ? ' ' .  get_sub_field('column_custom_class', $item_id) : '';
$inner_column_class = get_sub_field('inner_column_class', $item_id) ? ' ' . get_sub_field('inner_column_class', $item_id) : '';
$column_width = get_sub_field('column_width', $item_id) ? ' col-' . get_sub_field('column_width', $item_id) : '';
$custom_column_alignment = get_sub_field('custom_column_alignment', $item_id) ? ' flex-single-align-' . get_sub_field('custom_column_alignment', $item_id) : '';
$content_direction = get_sub_field('content_direction', $item_id);
$content_horizontal_alignment = get_sub_field('content_horizontal_alignment', $item_id) ? ' flex-align-' . get_sub_field('content_horizontal_alignment', $item_id) : '';
$content_horizontal_position = get_sub_field('content_horizontal_position', $item_id) ? ' flex-position-' . get_sub_field('content_horizontal_position', $item_id) : '';
$content_vertical_alignment = get_sub_field('content_vertical_alignment', $item_id) ? ' flex-align-' . get_sub_field('content_vertical_alignment', $item_id) : '';
$content_vertical_position = get_sub_field('content_vertical_position', $item_id) ? ' flex-position-' . get_sub_field('content_vertical_position', $item_id) : '';
$column_add_animation = get_sub_field('column_add_animation', $item_id);
$column_animation_effect = get_sub_field('column_animation_effect', $item_id) ? ' ' . get_sub_field('column_animation_effect', $item_id) : '';
$column_animation_delay = get_sub_field('column_animation_delay', $item_id) ? ' data-wow-delay="' . get_sub_field('column_animation_delay', $item_id) . 's"' : '';
$column_animation_offset = get_sub_field('column_animation_offset', $item_id) ? ' data-wow-offset="' . get_sub_field('column_animation_offset', $item_id) . '"' : '';
$column_background_image = get_sub_field('column_background_image', $item_id) ? get_sub_field('column_background_image', $item_id) : '';
$column_background_color = get_sub_field('column_background_color', $item_id) ? get_sub_field('column_background_color', $item_id) : '';
$column_background_color_opacity = get_sub_field('column_background_color_opacity', $item_id) ? get_sub_field('column_background_color_opacity', $item_id) : '';
$column_bg_rgb = hex2rgb($column_background_color);
$link_column = get_sub_field('link_column', $item_id);
$column_link = get_sub_field('column_link', $item_id);

$add_classes_to_outer_column = ' class="flex-col' . $column_width . $custom_column_alignment . $col_custom_class . (($column_add_animation == 1) ? ' wow' : '' ) . $column_animation_effect . '"';
$add_animation = $column_animation_delay . $column_animation_offset;

$column_styles = '';

if($column_background_image && $column_background_color){
  $column_styles = ' style="background: url(' . $column_background_image . ') center no-repeat; background-size: cover; box-shadow: inset 0 0 0 1000px rgba(' . $column_bg_rgb . ', ' . $column_background_color_opacity . ');"'; 
} 
else if($column_background_image && !$column_background_color){ 
  $column_styles = ' style="background: url(' . $column_background_image . ') center no-repeat; background-size: cover;"';
} 
else if(!$column_background_image && $column_background_color) {
  $column_styles = ' style="background: rgba(' . $column_bg_rgb . ', ' . $column_background_color_opacity . ');"';
}  
else{
  $column_styles = '';  
}

if($content_direction === 'row'){
  $content_position = $content_horizontal_position;
  $content_alignment = $content_horizontal_alignment;
  $item_direction = ' flex-direction-row';
}
else{
  $content_position = $content_vertical_position;
  $content_alignment = $content_vertical_alignment;
  $item_direction = ' flex-direction-column';
}


$add_classes_to_inner_column = 'class="col-inner ' . $item_direction . $content_position . $content_alignment . $inner_column_class . '"';

$start_outer_column = ($link_column == 1) ? '<a href="' . $column_link . '"' . $add_classes_to_outer_column . (($column_add_animation == 1) ? $add_animation : '' ) . $column_styles . '>' : '<div ' . $add_classes_to_outer_column . (($column_add_animation == 1) ? $add_animation : '' ) . $column_styles . '>';
$end_outer_column = ($link_column == 1) ? '</a>' : '</div>';

$start_inner_column = '<div ' . $add_classes_to_inner_column . ' >';
$end_inner_column = '</div>';
?>

<?php echo $start_outer_column ; ?> 
  <?php echo $start_inner_column ; ?> 
    <?php if( have_rows('column_content', $item_id) ) : while ( have_rows('column_content', $item_id) ) : the_row(); ?>
      <?php 
        if ( get_row_layout() == 'text' ) { 
          get_template_part('templates/rowlayout', 'text');
        } 
        else if ( get_row_layout() == 'special_button' ) { 
          get_template_part('templates/rowlayout', 'specialbutton'); 
        } 
        else if ( get_row_layout() == 'simple_button' ) { 
          get_template_part('templates/rowlayout', 'button'); 
        }
        else if ( get_row_layout() == 'single_image' ) { 
          get_template_part('templates/rowlayout', 'singleimg'); 
        } 
        else if ( get_row_layout() == 'facebook_feed' ) { 
          get_template_part('templates/rowlayout', 'facebook'); 
        } 
        else if ( get_row_layout() == 'twitter_feed' ) { 
          get_template_part('templates/rowlayout', 'twitter'); 
        }  
        else if ( get_row_layout() == 'instagram_block' ) { 
          get_template_part('templates/rowlayout', 'instagram'); 
        } 
        else if ( get_row_layout() == 'blog_feed' ) { 
          get_template_part('templates/rowlayout', 'blogfeed'); 
        } 
        else if ( get_row_layout() == 'open_positions_grid' ) { 
          get_template_part('templates/rowlayout', 'positionsgrid'); 
        }
        else if ( get_row_layout() == 'single_position_box' ) { 
          get_template_part('templates/rowlayout', 'singleposition'); 
        } 
        else if ( get_row_layout() == 'divider' ) { 
          get_template_part('templates/rowlayout', 'divider');
        } 
        else if ( get_row_layout() == 'social_profiles' ) { 
          get_template_part('templates/rowlayout', 'socialprofiles');
        }
        else if ( get_row_layout() == 'google_map' ) { 
          get_template_part('templates/rowlayout', 'map');
        } 
      ?>
   <?php endwhile; endif; ?>
  <?php echo $end_inner_column ; ?>
<?php echo $end_outer_column ; ?> 