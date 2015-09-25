<?php

// Add Shortcode
function flex_row_shortcode( $atts , $content = null ) {

  $a = shortcode_atts( array(
    'position' => 'start',
    'align' => 'start',
    'class' => '',
  ), $atts );
  
  return '<div class="flex-row flex-position-' . esc_attr($a['position']) . ' flex-align-' . esc_attr($a['align']) . ' ' . esc_attr($a['class']) . '">' . do_shortcode($content) . '</div>';
  
}
add_shortcode( 'flex_row', 'flex_row_shortcode' );

function flex_column_shortcode( $atts , $content = null ) {

  $a = shortcode_atts( array(
    'width' => '12',
    'align' => 'none',
    'content_position' => 'start',
    'content_align' => 'stretch',
    'class' => '',
  ), $atts );
  
  return '<div class="flex-col col-' . esc_attr($a['width']) . ' flex-single-align-' . esc_attr($a['align']) . ' ' . esc_attr($a['class']) . '"><div class="col-inner flex-position-' . esc_attr($a['content_position']) . '  flex-align-' . esc_attr($a['content_align']) . '">' . do_shortcode($content) . '</div></div>';
  
}
add_shortcode( 'flex_col', 'flex_column_shortcode' );


