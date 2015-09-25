<?php

$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));

if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
//    require_once( $root.'/wp-config.php' );
} else {
	$root = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
	if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
//    require_once( $root.'/wp-config.php' );
	}
}

$header_bottom_border_width = 1;
header("Content-type: text/css; charset=utf-8");

if( function_exists('get_field') ) :

$content_background_color = get_field('content_background_color', 'option');
$main_font_color = get_field('main_font_color', 'option');
$text_highlight_color = get_field('text_highlight_color', 'option');
$header_color = get_field('header_color', 'option');
$header_background_opacity = get_field('header_background_opacity', 'option');
$desktop_header_height = get_field('desktop_header_height', 'option');
$mobile_header_height = get_field('mobile_header_height', 'option');
$header_bg_rgb = hex2rgb($header_color);
$menu_link_color = get_field('menu_link_color', 'option');
$menu_font_size = get_field('menu_font_size', 'option');

$menu_font_family = get_field_object('menu_font_family', 'option'); 
$menu_font_family_value = get_field('menu_font_family', 'option');
$menu_font_family_label = $menu_font_family['choices'][ $menu_font_family_value ];

$menu_link_active_color = get_field('menu_link_active_color', 'option');
$general_font_family = get_field('general_font_family', 'option'); 
$general_font = $general_font_family["fonts"];
$general_font_variants = implode(",", $general_font_family["variants"]);

$headings_font_family = get_field_object('headings_font_family', 'option'); 
$headings_font_family_value = get_field('headings_font_family', 'option');
$headings_font_family_label = $headings_font_family['choices'][ $headings_font_family_value ];
$headings_font_color = get_field('headings_font_color', 'option');
$headings_text_transform = get_field('headings_text_transform', 'option');
$headings_line_height = get_field('headings_line_height', 'option');
$headings_font_weight = get_field('headings_font_weight', 'option');

$paragraph_font_family = get_field_object('paragraph_font_family', 'option'); 
$paragraph_font_family_value = get_field('paragraph_font_family', 'option');
$paragraph_font_family_label = $paragraph_font_family['choices'][ $paragraph_font_family_value ];
$paragraph_font_color = get_field('paragraph_font_color', 'option');
$paragraph_text_transform = get_field('paragraph_text_transform', 'option');
$paragraph_line_height = get_field('paragraph_line_height', 'option');
$paragraph_font_weight = get_field('paragraph_font_weight', 'option');

$footer_top_background_color = get_field('footer_top_background_color', 'option');
$footer_top_text_color = get_field('footer_top_text_color', 'option');
$footer_top_link_color = get_field('footer_top_link_color', 'option');
$footer_top_link_hover_color = get_field('footer_top_link_hover_color', 'option');
$footer_bottom_background_color = get_field('footer_bottom_background_color', 'option');
$footer_bottom_text_color = get_field('footer_bottom_text_color', 'option');
$footer_bottom_link_color = get_field('footer_bottom_link_color', 'option');
$footer_bottom_link_hover_color = get_field('footer_bottom_link_hover_color', 'option');

?>

<?php if ($text_highlight_color) : ?>

::-moz-selection { background: <?php echo $text_highlight_color; ?>; color: #FFF; }
::selection { background: <?php echo $text_highlight_color; ?>; color: #FFF;}

<?php endif; ?>

<?php if($content_background_color) { echo '#wrapper{background-color: ' . $content_background_color . ';} '; }?>

<?php if($main_font_color) { echo 'body{color: ' . $main_font_color . ';} '; }?>

#header, #header .menu-container { background-color: <?php echo $header_color; ?> }

.header-inner{ height: <?php echo $mobile_header_height; ?>px;}

.page-header, .post-image-window{ padding-top: <?php echo $mobile_header_height; ?>px;}

@media screen and (min-width: 1000px){
  #header .menu-container{ background-color: transparent; }
  #header { background-color: rgba(<?php echo $header_bg_rgb; ?>, <?php echo $header_background_opacity; ?>);}
  .header-inner{ height: <?php echo $desktop_header_height; ?>px; }
  #header .menu a{ line-height: <?php echo $desktop_header_height; ?>px; }
  .page-header, .post-image-window{ padding-top: <?php echo $desktop_header_height; ?>px;}
}

#header .menu a{
  <?php if ($menu_link_color) { echo 'color: ' . $menu_link_color . '; '; }?>
  <?php if ($menu_font_family) { echo 'font-family: "' . $menu_font_family_label  . '"; '; }?>
}

#header .menu .current-menu-item a, #header .menu a:hover{
  <?php if ($menu_link_active_color) { echo 'color: ' . $menu_link_active_color . '; '; }?>
}

<?php if ($footer_top_background_color) : ?>

#top-footer{ 
  background-color: <?php echo $footer_top_background_color; ?>;
  <?php if ($footer_top_text_color) : ?>
  color: <?php echo $footer_top_text_color; ?>;
  <?php endif; ?>
}

<?php endif; ?>


<?php if ($footer_top_link_color) : ?>

#top-footer a{ 
  color: <?php echo $footer_top_link_color; ?>;
}

#top-footer .social-icon svg path{
  stroke: <?php echo $footer_top_link_color; ?>;
}

<?php endif; ?>

<?php if ($footer_top_link_hover_color) : ?>

#top-footer a:hover{ 
  color: <?php echo $footer_top_link_hover_color; ?>;
}

<?php endif; ?>

<?php if ($footer_bottom_background_color) : ?>

#bottom-footer{ 
  background-color: <?php echo $footer_bottom_background_color; ?>;
  <?php if ($footer_bottom_text_color) : ?>
  color: <?php echo $footer_bottom_text_color; ?>;
  <?php endif; ?>
}

<?php endif; ?>


<?php if ($footer_bottom_link_color) : ?>

#bottom-footer a{ 
  color: <?php echo $footer_bottom_link_color; ?>;
}

#bottom-footer .social-icon svg path{
  stroke: <?php echo $footer_bottom_link_color; ?>;
}

<?php endif; ?>

<?php if ($footer_bottom_link_hover_color) : ?>

#bottom-footer a:hover{ 
  color: <?php echo $footer_bottom_link_hover_color; ?>;
}

<?php endif; ?>

h1,h2,h3,h4,h5,h6{font-family: '<?php echo $headings_font_family_label; ?>'; line-height: <?php echo $headings_line_height; ?>; color: <?php echo $headings_font_color; ?>; font-weight: <?php echo $headings_font_weight; ?>; text-transform: <?php echo $headings_text_transform; ?>;}

p, ul li, ol li{font-family: '<?php echo $paragraph_font_family_label; ?>'; color: <?php echo $paragraph_font_color; ?>; line-height: <?php echo $paragraph_line_height; ?>; font-weight: <?php echo $paragraph_font_weight; ?>; text-transform: <?php echo $paragraph_text_transform; ?>;}

<?php endif; ?>

