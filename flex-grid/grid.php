<?php

// Add Shortcode
function flex_row_shortcode( $atts , $content = null ) {

  $a = shortcode_atts( array(
    'position' => 'start',
    'align' => 'start',
    'wrap' => '',
    'class' => '',
    'animation_effect' => '',
    'animation_duration' => '',
    'animation_delay' => '',
    'animation_offset' => '',
  ), $atts );
  
  return '<div class="flex-row flex-position-' . esc_attr($a['position']) . ' ' . esc_attr($a['wrap']) .  'wrap flex-align-' . esc_attr($a['align']) . ' ' . esc_attr($a['class']) . ' ' . esc_attr($a['animation_effect']) . '" data-wow-duration="' . esc_attr($a['animation_duration']) . '" data-wow-delay="' . esc_attr($a['animation_delay']) . '" data-wow-offset="' . esc_attr($a['animation_offset']) . '">' . do_shortcode($content) . '</div>';
  
}
add_shortcode( 'flex_row', 'flex_row_shortcode' );

function flex_column_shortcode( $atts , $content = null ) {

  $a = shortcode_atts( array(
    'width' => '12',
    'align' => 'none',
    'content_position' => 'start',
    'content_align' => 'stretch',
    'class' => '',
    'animation_effect' => '',
    'animation_duration' => '',
    'animation_delay' => '',
    'animation_offset' => '',
  ), $atts );
  
  return '<div class="flex-col col-' . esc_attr($a['width']) . ' flex-single-align-' . esc_attr($a['align']) . ' ' . esc_attr($a['class']) . ' ' . esc_attr($a['animation_effect']) . '" data-wow-duration="' . esc_attr($a['animation_duration']) . '" data-wow-delay="' . esc_attr($a['animation_delay']) . '" data-wow-offset="' . esc_attr($a['animation_offset']) . '"><div class="col-inner flex-position-' . esc_attr($a['content_position']) . '  flex-align-' . esc_attr($a['content_align']) . '">' . do_shortcode($content) . '</div></div>';
  
}
add_shortcode( 'flex_col', 'flex_column_shortcode' );


add_action( 'init', 'grid_buttons' );
function grid_buttons() {
    add_filter( "mce_external_plugins", "grid_add_buttons" );
    add_filter( 'mce_buttons', 'grid_register_buttons' );
}
function grid_add_buttons( $plugin_array ) {
    $plugin_array['grid'] = get_template_directory_uri() . '/flex-grid/grid-plugin.js';
    return $plugin_array;
}
function grid_register_buttons( $buttons ) {
    array_push( $buttons, 'flexrow', 'flexcol' ); // dropcap', 'recentposts
    return $buttons;
}
