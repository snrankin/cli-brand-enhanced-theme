<?php

function custom_div( $atts, $content = null ) {

	 $a = shortcode_atts( array(
			'class' => '',
      'animation_effect' => '',
      'animation_duration' => '',
      'animation_delay' => '',
      'animation_offset' => '',
		), $atts );

  return '<div class="' . esc_attr($a['class']) . ' ' . esc_attr($a['animation_effect']) . '" data-wow-duration="' . esc_attr($a['animation_duration']) . '" data-wow-delay="' . esc_attr($a['animation_delay']) . '" data-wow-offset="' . esc_attr($a['animation_offset']) . '">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'custom_div', 'custom_div' );

function btn_shortcode( $atts ) {

  $a = shortcode_atts( array(
    'title' => '',
    'link' => '',
    'btn_color' => '',
    'customclass' => '',
    'target' => 'self',
    'animation_effect' => '',
    'animation_duration' => '',
    'animation_delay' => '',
    'animation_offset' => '',
  ), $atts );
  
  return '<a href="' . esc_attr($a['link']) . '" data-wow-duration="' . esc_attr($a['animation_duration']) . '" data-wow-delay="' . esc_attr($a['animation_delay']) . '" data-wow-offset="' . esc_attr($a['animation_offset']) . '" target="_' . esc_attr($a['target']) . '" class="btn ' . esc_attr($a['btn_color']) . '-btn ' . esc_attr($a['customclass']) . ' ' . esc_attr($a['animation_effect']) . '">' . esc_attr($a['title']) . '</a>';
  
}
add_shortcode( 'btn', 'btn_shortcode' );


function custom_shortcode( $atts ) {

	// Attributes
	$a = shortcode_atts(
		array(
			'default_text' => '',
			'hover_text' => '',
			'link' => '',
      'btn_color' => '',
      'class' => '',
      'target' => 'self',
      'animation_effect' => '',
      'animation_duration' => '',
      'animation_delay' => '',
      'animation_offset' => '',
		), $atts );
    
  return '<a class="special-btn ' . esc_attr($a['btn_color']) . '-btn ' . esc_attr($a['class']) . ' ' . esc_attr($a['animation_effect']) . '" data-wow-duration="' . esc_attr($a['animation_duration']) . '" data-wow-delay="' . esc_attr($a['animation_delay']) . '" data-wow-offset="' . esc_attr($a['animation_offset']) . '" href="' . esc_attr($a['link']) . '" target="_' . esc_attr($a['target']) . '"><span class="first-panel">' . esc_attr($a['default_text']) . '</span><span class="second-panel">' . esc_attr($a['hover_text']) . '</span></a>';
}
add_shortcode( 'special_btn', 'custom_shortcode' );

function page_box_shortcode( $atts ) {

  $a = shortcode_atts( array(
    'width' => '12',
    'align' => 'none',
    'content_position' => 'start',
    'content_align' => 'stretch',
    'page_slug' => '',
    'class' => '',
    'animation_effect' => '',
    'animation_duration' => '',
    'animation_delay' => '',
    'animation_offset' => '',
  ), $atts );
  
  return '<div class="flex-col col-' . esc_attr($a['width']) . ' flex-single-align-' . esc_attr($a['align']) . ' ' . esc_attr($a['page_slug']) . ' ' . esc_attr($a['class']) . ' ' . esc_attr($a['animation_effect']) . ' page-link-box" data-wow-duration="' . esc_attr($a['animation_duration']) . '" data-wow-delay="' . esc_attr($a['animation_delay']) . '" data-wow-offset="' . esc_attr($a['animation_offset']) . '"><div class="col-inner flex-position-' . esc_attr($a['content_position']) . '  flex-align-' . esc_attr($a['content_align']) . '" '. page_box_bg(esc_attr($a['page_slug'])) . '>' . create_page_box(esc_attr($a['page_slug'])) . '</div></div>';
  
}
add_shortcode( 'page_box', 'page_box_shortcode' );

function show_full_Address() {
  
  return displayfullAddress();
  
}
add_shortcode( 'full_address', 'show_full_Address' );

function show_Address() {
  
  return displayAddress();
  
}
add_shortcode( 'address', 'show_Address' );

function show_Contact() {
  
  return displayContactInfo();
  
}
add_shortcode( 'contact_info', 'displayContactInfo' );

function copyright() {
  
  $siteTitle = get_bloginfo( 'name' ); 
  
  $currentYear = date("Y");
  
  return $siteTitle . ' &copy; ' . $currentYear;
  
}
add_shortcode( 'copyright', 'copyright' );

function show_SocialProfiles() {
  
  $icon_type = get_field('type_of_icon', 'options');
  return displaySocialProfiles($icon_type, 'shortcode');
  
}
add_shortcode( 'social_profiles', 'show_SocialProfiles' );

function show_team() {
  
  get_template_part('templates/team-loop');
  
}
add_shortcode( 'team', 'show_team' );

function show_positions() {
  
  get_template_part('templates/positions-loop');
  
}
add_shortcode( 'positions', 'show_positions' );